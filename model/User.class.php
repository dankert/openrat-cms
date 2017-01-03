<?php
// OpenRat Content Management System
// Copyright (C) 2002-2012 Jan Dankert, cms@jandankert.de
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.



/**
 * Darstellen eines Benutzers
 *
 * @version $Revision$
 * @author $Author$
 * @package openrat.objects
 */
class User
{
	var $userid   = 0;
	var $error    = '';

	var $name     = '';
	var $fullname = '';
	var $ldap_dn;
	var $tel;
	var $mail;
	var $desc;
	var $style;
	var $isAdmin;
	var $projects  = array();
	var $rights;
	var $loginDate = 0;
	
	var $mustChangePassword = false;
	var $groups = null;
	var $loginModuleName = null;

	// Konstruktor
	function User( $userid='' )
	{
		if   ( is_numeric($userid) )
			$this->userid = $userid;
	}


	// Lesen Benutzer aus der Datenbank
	function listAll()
	{
		global $conf;
		$db = db_connection();

		$sql = $db->sql( 'SELECT id,name '.
		                '  FROM {{user}}'.
		                '  ORDER BY name' );

		return $sql->getAssoc( $sql );
	}


	// Lesen Benutzer aus der Datenbank
	function getAllUsers()
	{
		$list = array();
		$db = db_connection();

		$sql = $db->sql( 'SELECT * '.
		                '  FROM {{user}}'.
		                '  ORDER BY name' );

		foreach( $sql->getAll( $sql ) as $row )
		{
			$user = new User();
			$user->setDatabaseRow( $row );

			$list[] = $user;
		}
		
		return $list;
	}


	/**
	  * Benutzer als aktiven Benutzer in die Session schreiben.
	  */
	function setCurrent()
	{
		$this->loadProjects();
		$this->loginDate = time();

		Session::setUser( $this );
	}


	/**
	 * Erzeugt eine WHERE-Bedingung zur Verwendung in einer SQL-Anfrage.<br>
	 * Es wird eine Oder-Liste mit allen Gruppen-Ids erzeugt.
	 *
	 * @return String SQL-WHERE-Bedingung
	 */
	function getGroupClause()
	{
		$groupIds = $this->getGroupIds();
		
		if	( count($groupIds) > 0 )
			$groupclause = ' groupid='.implode(' OR groupid=',$groupIds );
		else
			$groupclause = ' 1=0 ';

		return $groupclause;
	}


	// Prueft, ob der Benutzer fuer ein Projekt berechtigt ist
	function hasProject( $projectid )
	{
		$db = db_connection();

		$sql = $db->sql( 'SELECT COUNT(*)'.
		                '  FROM {{acl}}'.
		                '  LEFT JOIN {{object}} ON {{object}}.id={{acl}}.objectid '.
		                '  WHERE projectid={projectidid} AND '.
		                '        ( userid={userid} OR'.
		                '          '.$this->getGroupClause().'    )' );
		$sql->setInt   ( 'userid',$this->userid );

		return $sql->getOne( $sql ) > 0;
	}



	/**
	 * Lesen aller Projekte, fuer die der Benutzer berechtigt ist.
	 *
	 * @return Array [Projekt-Id] = Projekt-Name
	 */
	function getReadableProjects()
	{
		$db = db_connection();

		if	( $this->isAdmin )
		{
			// Administratoren haben Rechte auf alle Projekte.
			return Project::getAllProjects();
		}
		else
		{
			$groupClause = $this->getGroupClause();
			$sql = $db->sql(<<<SQL
SELECT DISTINCT {{project}}.id,{{project}}.name
  FROM {{object}}
  LEFT JOIN {{acl}}     ON {{object}}.id  = {{acl}}.objectid 
  LEFT JOIN {{project}} ON {{project}}.id = {{object}}.projectid 
 WHERE {{object}}.parentid IS NULL     AND
       {{acl}}.id          IS NOT NULL AND
       (  {{acl}}.userid={userid} OR
       $groupClause OR 
       ({{acl}}.userid IS NULL AND {{acl}}.groupid IS NULL)) 
 ORDER BY {{project}}.name
SQL
);
		$sql->setInt   ( 'userid',$this->userid );

			return $sql->getAssoc( $sql );
		}
		
	}



	/**
	 * Ermittelt alls Projekte, fuer die der Benutzer berechtigt ist.
	 * @return Array [0..n] = Projekt-Id
	 */
	function getReadableProjectIds()
	{
		return array_keys( $this->getReadableProjects() );
	}


	/**
	 * Lädt die Liste alle Projekte, fuer die der Benutzer berechtigt ist und
	 * speichert diese in diesem Benutzerobjekt.
	 */
	function loadProjects()
	{
		$this->projects = $this->getReadableProjects();
	}



	/**
	 * Ermittelt zu diesem Benutzer den Login-Token.
	 */ 
	function loginToken()
	{
		global $conf;
		$db = db_connection();

		$sql = $db->sql( 'SELECT id,mail,name,password FROM {{user}}'.
		                ' WHERE id={userid}' );
		$sql->setInt( 'userid',$this->userid );
		$row = $sql->getRow( $sql );

		if	( count($row) == 0 )
			throw new ObjectNotFoundException();

		// Zusammensetzen des Tokens
		return sha1( $row['password'].$row['name'].$row['id'].$row['mail'] );
	}


	/**
	 * Lesen Benutzer aus der Datenbank.
	 */ 
	function load()
	{
		global $conf;
		$db = db_connection();

		$sql = $db->sql( 'SELECT * FROM {{user}}'.
		                ' WHERE id={userid}' );
		$sql->setInt( 'userid',$this->userid );
		$row = $sql->getRow( $sql );

		if	( count($row) == 0 )
			throw new ObjectNotFoundException();
		
		$this->setDatabaseRow( $row );		
	}


	/**
	 * Benutzerobjekt �ber Benutzernamen ermitteln.<br>
	 * Liefert ein neues Benutzerobjekt zur�ck.
	 * 
	 * @static 
	 * @param name Benutzername
	 */
	public static function loadWithName( $name )
	{
		global $conf;
		$db = db_connection();

		// Benutzer �ber Namen suchen
		$sql = $db->sql( 'SELECT id FROM {{user}}'.
		                ' WHERE name={name}' );
		//Html::debug($sql);
		$sql->setString( 'name',$name );
		$userId = $sql->getOne( $sql );

		// Benutzer �ber Id instanziieren
		$neuerUser = new User( $userId );
		$neuerUser->load();
		
		return $neuerUser;
	}
	
	
	
	/**
	 * Stellt fest, ob der Benutzer korrekt geladen ist.
	 */
	function isValid()
	{
		return intval($this->userid) > 0;
	}



	// Lesen Benutzer aus der Datenbank
	function setDatabaseRow( $row )
	{
		global $conf;
		
		$this->userid   = $row['id'      ];
		$this->name     = $row['name'    ];
		$this->style    = $row['style'   ];
		$this->isAdmin  = ( $row['is_admin'] == '1');
		$this->ldap_dn  = $row['ldap_dn' ];
		$this->fullname = $row['fullname'];
		$this->tel      = $row['tel'     ];
		$this->mail     = $row['mail'    ];
		$this->desc     = $row['descr'   ];
		
		if	( $this->fullname == '' )
			$this->fullname = $this->name;
			
		if	( $this->style == '' )
				$this->style = $conf['interface']['style']['default'];

		/* vorerst unbenutzt:
		if	( $row['use_ldap'] == '1' )
		{
			// Daten aus LDAP-Verzeichnisdienst lesen

			// Verbindung zum LDAP-Server herstellen
			$ldap_conn = @ldap_connect( $conf['ldap']['host'],$conf['ldap']['port'] );
			
			if	( !$ldap_conn )
			{
				logger( 'INFO','cannot connect to LDAP server '.$conf['ldap']['host'].' '.$conf['ldap']['port'] );
				$this->error = 'cannot connect to LDAP server';
				return false;
			}
			
			// Anonymes LDAP-Login versuchen
			$ldap_bind = @ldap_bind( $ldap_conn );
			
			if   ( $ldap_bind )
			{
				// Login erfolgreich
				$sr = ldap_read( $ldap_conn,$row['ldap_dn'],'(objectclass=*)' );
				
				$daten   = ldap_get_entries( $ldap_conn,$sr );
				
				$this->fullname = $daten[0]['givenName'][0].' '.$daten[0]['sn'][0];
				$this->tel      = $daten[0]['telephoneNumber'][0];
				$this->mail     = $daten[0]['mail'][0];
				$this->desc     = $daten[0]['description'][0];
			}
			
		}
		*/
	}



	/**
	 * Namen ermitteln.<br>
	 * Wenn "fullname" gefuellt, dann diesen benutzen, sonst den Benutzernamen.
	 */
	function getName()
	{
		if	( empty($this->fullname))
			return $this->name;
		else
			return $this->fullname;
	}
	
	
	
	/**
	 * Liest einen Benutzernamen aus der Datenbank.
	 * 
	 * @param int Benutzer-Id
	 * @return String Benutzername
	 */
	function getUserName( $userid )
	{
		$db = db_connection();

		$sql = $db->sql( 'SELECT name FROM {{user}}'.
		                ' WHERE id={userid}' );
		$sql->setInt( 'userid',$userid );

		$name = $sql->getOne( $sql );
		
		if	( $name == '' )
			return lang('UNKNOWN');
		else return $name;
	}


	/**
	 * Speichern Benutzer in der Datenbank.
	 */
	function save()
	{
		$db = db_connection();

		$sql = $db->sql( 'UPDATE {{user}}'.
		                ' SET name={name},'.
		                '     fullname={fullname},'.
		                '     ldap_dn ={ldap_dn} ,'.
		                '     tel     ={tel}     ,'.
		                '     descr   ={desc}    ,'.
		                '     mail    ={mail}    ,'.
		                '     style   ={style}   ,'.
		                '     is_admin={isAdmin} '.
		                ' WHERE id={userid}' );
		$sql->setString ( 'name'    ,$this->name    );
		$sql->setString ( 'fullname',$this->fullname);
		$sql->setString ( 'ldap_dn' ,$this->ldap_dn );
		$sql->setString ( 'tel'     ,$this->tel     );
		$sql->setString ( 'desc'    ,$this->desc    );
		$sql->setString ( 'mail'    ,$this->mail    );
		$sql->setString ( 'style'   ,$this->style   );
		$sql->setBoolean( 'isAdmin' ,$this->isAdmin );
		$sql->setInt    ( 'userid'  ,$this->userid  );
		
		// Datenbankabfrage ausfuehren
		$sql->query( $sql );
	}


	/**
	 * Benutzer hinzuf�gen
	 *
	 * @param String $name Benutzername
	 */
	function add( $name = '' )
	{
		if	( $name != '' )
			$this->name = $name;

		$db = db_connection();

		$sql = $db->sql('SELECT MAX(id) FROM {{user}}');
		$this->userid = intval($sql->getOne($sql))+1;

		$sql = $db->sql('INSERT INTO {{user}}'.
		               ' (id,name,password,ldap_dn,fullname,tel,mail,descr,style,is_admin)'.
		               " VALUES( {userid},{name},'','','','','','','default',0 )" );
		$sql->setInt   ('userid',$this->userid);
		$sql->setString('name'  ,$this->name  );

		// Datenbankbefehl ausfuehren
		$sql->query( $sql );
		
		$this->addNewUserGroups(); // Neue Gruppen hinzufuegen.
	}

	

	/**
	 * Zu einem neuen Benutzer automatisch Gruppen hinzufuegen.
	 * Diese Methode wird automatisch in "add()" aufgerufen.
	 */
	function addNewUserGroups()
	{
		global $conf;
		$groupNames = explode(',',@$conf['security']['newuser']['groups']);
		
		if	( count($groupNames) == 0 )
			return; // Nichts zu tun.
			
		$db = db_connection();

		$groupNames = "'".implode("','",$groupNames)."'";
		$sql = $db->sql("SELECT id FROM {{group}} WHERE name IN($groupNames)");
		$groupIds = array_unique( $sql->getCol($sql) );
		
		// Wir brauchen hier nicht weiter pr�fen, ob der Benutzer eine Gruppe schon hat, denn
		// - passiert dies nur bei der Neuanlage eines Benutzers
		// - Enth�lt die Group-Id-Liste eine ID nur 1x.

		// Gruppen diesem Benutzer zuordnen.
		foreach( $groupIds as $groupId )
			$this->addGroup( $groupId );
	}


	/**
	 * Benutzer entfernen.<br>
	 * Vor dem Entfernen werden alle Referenzen auf diesen Benutzer entfernt:<br>
	 * - "Erzeugt von" f�r diesen Benutzer entfernen.<br>
	 * - "Letzte �nderung von" f�r diesen Benutzer entfernen<br>
	 * - Alle Archivdaten in Dateien mit diesem Benutzer entfernen<br>
	 * - Alle Berechtigungen dieses Benutzers l?schen<br>
	 * - Alle Gruppenzugehoerigkeiten dieses Benutzers l?schen<br>
	 * - Benutzer loeschen<br>
	 */
	public function delete()
	{
		$db = db_connection();

		// "Erzeugt von" f�r diesen Benutzer entfernen.
		$sql = $db->sql( 'UPDATE {{object}} '.
		                'SET create_userid=null '.
		                'WHERE create_userid={userid}' );
		$sql->setInt   ('userid',$this->userid );
		$sql->query( $sql );

		// "Letzte �nderung von" f�r diesen Benutzer entfernen
		$sql = $db->sql( 'UPDATE {{object}} '.
		                'SET lastchange_userid=null '.
		                'WHERE lastchange_userid={userid}' );
		$sql->setInt   ('userid',$this->userid );
		$sql->query( $sql );

		// Alle Archivdaten in Dateien mit diesem Benutzer entfernen
		$sql = $db->sql( 'UPDATE {{value}} '.
		                'SET lastchange_userid=null '.
		                'WHERE lastchange_userid={userid}' );
		$sql->setInt   ('userid',$this->userid );
		$sql->query( $sql );

		// Alle Berechtigungen dieses Benutzers l?schen
		$sql = $db->sql( 'DELETE FROM {{acl}} '.
		                'WHERE userid={userid}' );
		$sql->setInt   ('userid',$this->userid );
		$sql->query( $sql );

		// Alle Gruppenzugehoerigkeiten dieses Benutzers l?schen
		$sql = $db->sql( 'DELETE FROM {{usergroup}} '.
		                'WHERE userid={userid}' );
		$sql->setInt   ('userid',$this->userid );
		$sql->query( $sql );

		// Benutzer loeschen
		$sql = $db->sql( 'DELETE FROM {{user}} '.
		                'WHERE id={userid}' );
		$sql->setInt   ('userid',$this->userid );
		$sql->query( $sql );
	}


	/**
	 * Ermitteln der Eigenschaften zu diesem Benutzer
	 *
	 * @return Array Liste der Eigenschaften als assoziatives Array
	 */
	function getProperties()
	{
		return Array( 'userid'  => $this->userid,
		              'id'      => $this->userid,
		              'fullname'=> $this->fullname,
		              'name'    => $this->name,
		              'ldap_dn' => $this->ldap_dn,
		              'tel'     => $this->tel,
		              'desc'    => $this->desc,
		              'mail'    => $this->mail,
		              'style'   => $this->style,
		              'is_admin'=> $this->isAdmin,
		              'isAdmin' => $this->isAdmin );
	}



	/**
	 * Setzt ein neues Kennwort f�r diesen Benutzer.
	 * 
	 * @param password Kennwortt
	 * @param always true, wenn Kennwort dauerhaft.
	 */
	function setPassword( $password, $always=true )
	{
		$db = db_connection();

		$sql = $db->sql( 'UPDATE {{user}} SET password={password} '.
		                'WHERE id={userid}' );
		                
		if	( $always )
			// Hashsumme für Kennwort erzeugen und speichern.
			// Workaround: Hashsumme auf 50 Zeichen kürzen (da die DB-Spalte nicht länger ist)
			$sql->setString('password',substr(Password::hash($this->pepperPassword($password)),0,50) );
		else
			// Klartext-Kennwort, der Benutzer muss das Kennwort beim nä. Login ändern.
			$sql->setString('password',$password);
			
		$sql->setInt   ('userid'  ,$this->userid  );

		$sql->query( $sql );
	}


	/**
	 * Gruppen ermitteln, in denen der Benutzer Mitglied ist.
	 *
	 * @return Array mit Id:Name
	 */
	function getGroups()
	{
		if	( !is_array($this->groups) )
		{
			$db = db_connection();
	
			$sql = $db->sql( 'SELECT {{group}}.id,{{group}}.name FROM {{group}} '.
			                'LEFT JOIN {{usergroup}} ON {{usergroup}}.groupid={{group}}.id '.
			                'WHERE {{usergroup}}.userid={userid}' );
			$sql->setInt('userid',$this->userid );
			$this->groups = $sql->getAssoc( $sql );
		}
		
		return $this->groups;
	}
	

	// Gruppen ermitteln, in denen der Benutzer Mitglied ist
	function getGroupIds()
	{
		return array_keys( $this->getGroups() );

		/*
		$db = db_connection();

		$sql = $db->sql( 'SELECT groupid FROM {{usergroup}} '.
		                'WHERE userid={userid}' );
		$sql->setInt('userid',$this->userid );

		return $sql->getCol( $sql );
		*/
	}
	

	// Gruppen ermitteln, in denen der Benutzer *nicht* Mitglied ist
	function getOtherGroups()
	{
		$db = db_connection();

		$sql = $db->sql( 'SELECT {{group}}.id,{{group}}.name FROM {{group}}'.
		                '   LEFT JOIN {{usergroup}} ON {{usergroup}}.groupid={{group}}.id AND {{usergroup}}.userid={userid}'.
		                '   WHERE {{usergroup}}.userid IS NULL' );
		$sql->setInt('userid'  ,$this->userid );

		return $sql->getAssoc( $sql );
	}


	
	/**
	 * Benutzer zu einer Gruppe hinzufuegen.
	 * 
	 * @param groupid die Gruppen-Id
	 */
	function addGroup( $groupid )
	{
		$db = db_connection();

		$sql = $db->sql('SELECT MAX(id) FROM {{usergroup}}');
		$usergroupid = intval($sql->getOne($sql))+1;

		$sql = $db->sql( 'INSERT INTO {{usergroup}} '.
		                '       (id,userid,groupid) '.
		                '       VALUES( {usergroupid},{userid},{groupid} )' );
		$sql->setInt('usergroupid',$usergroupid  );
		$sql->setInt('userid'     ,$this->userid );
		$sql->setInt('groupid'    ,$groupid      );

		$sql->query( $sql );
	
	}


	
	/**
	 * Benutzer aus Gruppe entfernen.
	 * 
	 * @param groupid die Gruppen-Id
	 */
	function delGroup( $groupid )
	{
		$db = db_connection();

		$sql = $db->sql( 'DELETE FROM {{usergroup}} '.
		                '  WHERE userid={userid} AND groupid={groupid}' );
		$sql->setInt   ('userid'  ,$this->userid );
		$sql->setInt   ('groupid' ,$groupid      );

		$sql->query( $sql );
	}
	

	/**
	 * Ermitteln aller Rechte des Benutzers im aktuellen Projekt.
	 *
	 * @param Integer $projectid  Projekt-Id
	 * @param Integer $languageid Sprache-Id
	 */
	function loadRights( $projectid,$languageid )
	{
	}


	/**
	 * Ermitteln aller Berechtigungen des Benutzers.<br>
	 * Diese Daten werden auf der Benutzerseite in der Administration angezeigt.
	 *
	 * @return unknown
	 */
	function getAllAcls()
	{

		$this->delRights();

		$db = db_connection();

		$group_clause = $this->getGroupClause();

		$sql = $db->sql( 'SELECT {{acl}}.*,{{object}}.projectid,{{language}}.name AS languagename FROM {{acl}}'.
		                '  LEFT JOIN {{object}} '.
		                '         ON {{object}}.id={{acl}}.objectid '.
		                '  LEFT JOIN {{language}} '.
		                '         ON {{language}}.id={{acl}}.languageid '.
		                '  WHERE ( {{acl}}.userid={userid} OR '.$group_clause.
		                                                 ' OR ({{acl}}.userid IS NULL AND {{acl}}.groupid IS NULL) )'.
		                '  ORDER BY {{object}}.projectid,{{acl}}.languageid' );
		$sql->setInt  ( 'userid'    ,$this->userid );

		$aclList = array();

		foreach( $sql->getAll( $sql ) as $row )
		{
			$acl = new Acl();
			$acl->setDatabaseRow( $row );
			$acl->projectid    = $row['projectid'   ];
			if	( intval($acl->languageid) == 0 )
				$acl->languagename = lang('GLOBAL_ALL_LANGUAGES');
			else
				$acl->languagename = $row['languagename'];
			$aclList[] = $acl;
		}
		
		return $aclList;
	}


	/**
	 * Ermitteln aller Berechtigungen.
	 * @return Array Berechtigungen
	 */
	function getRights()
	{
		die('User.class::getRights()');
		
//		$db = db_connection();
//		$var = array();
//
//		// Alle Projekte lesen
//		$sql = $db->sql( 'SELECT id,name FROM {{project}}' );
//		$projects = $sql->getAssoc( $sql );	
//
//		foreach( $projects as $projectid=>$projectname )
//		{
//			$var[$projectid] = array();
//			$var[$projectid]['name'] = $projectname;
//			$var[$projectid]['folders'] = array();
//			$var[$projectid]['rights'] = array();
//
//			$sql = $db->sql( 'SELECT {{acl}}.* FROM {{acl}}'.
//			                '  LEFT JOIN {{folder}} ON {{acl}}.folderid = {{folder}}.id'.
//			                '  WHERE {{folder}}.projectid={projectid}'.
//			                '    AND {{acl}}.userid={userid}' );
//			$sql->setInt('projectid',$projectid    );
//			$sql->setInt('userid'   ,$this->userid );
//			
//			$acls = $sql->getAll( $sql );
//
//			foreach( $acls as $acl )
//			{
//				$aclid = $acl['id'];
//				$folder = new Folder( $acl['folderid'] );
//				$folder->load();
//				$var[$projectid]['rights'][$aclid] = $acl;
//				$var[$projectid]['rights'][$aclid]['foldername'] = implode(' &raquo; ',$folder->parentfolder( false,true ));
//				$var[$projectid]['rights'][$aclid]['delete_url'] = Html::url(array('action'=>'user','subaction'=>'delright','aclid'=>$aclid));
//			}
//			
//			$sql = $db->sql( 'SELECT id FROM {{folder}}'.
//			                '  WHERE projectid={projectid}' );
//			$sql->setInt('projectid',$projectid);
//			$folders = $sql->getCol( $sql );
//
//			$var[$projectid]['folders'] = array();
//
//			foreach( $folders as $folderid )
//			{
//				$folder = new Folder( $folderid );
//				$folder->load();
//				$var[$projectid]['folders'][$folderid] = implode(' &raquo; ',$folder->parentfolder( false,true ));
//			}
//
//			asort( $var[$projectid]['folders'] );
//		}
//		
//		return $var;
	}


	/**
	 * Entfernt alle Rechte aus diesem Benutzerobjekt.
	 */
	function delRights()
	{
		$this->rights = array();
	}


	/**
	 * Ueberpruft, ob der Benutzer ein bestimmtes Recht hat
	 *
	 * @param $objectid Objekt-Id zu dem Objekt, dessen Rechte untersucht werden sollen
	 * @param $type Typ des Rechts (Lesen,Schreiben,...) als Konstante ACL_*
	 */ 
	function hasRight( $objectid,$type )
	{
		global $conf;
		if	( $this->isAdmin && !$conf['security']['readonly'] )
			return true;

		if	( $this->isAdmin && $type & ACL_READ )
			return true;
			
		if	( !isset($this->rights[$objectid]) )
			return false;

		return $this->rights[$objectid] & $type;
	}


	/**
	 * Berechtigung dem Benutzer hinzufuegen.
	 * 
	 * @param objectid Objekt-Id, zu dem eine Berechtigung hinzugefuegt werden soll
	 * @param Art des Rechtes, welches hinzugefuegt werden soll
	 */
	function addRight( $objectid,$type )
	{
		global $conf;
		
		if	( $conf['security']['readonly'] )
			if	( $type & ACL_READ )
				$type = ACL_READ;
			else
				$type = 0;

		if	( $type & ACL_PUBLISH && $conf['security']['nopublish'] )
			$type -= ACL_PUBLISH;


		if	( !isset($this->rights[$objectid]) )
			$this->rights[$objectid] = 0;

		$this->rights[$objectid] = $this->rights[$objectid] | $type;
	}


	/**
	 * Ermitteln aller zur Verfuegung stehenden Stylesheets
	 */
	public function getAvailableStyles()
	{
		global $conf;
		$styles = array();
		
		foreach( $conf['style'] as $key=>$values)
			$styles[$key] = $values['name'];

		return $styles;	
	}
	
	
	/**
	 * Erzeugt ein aussprechbares Kennwort.
	 * 
	 * Inspired by http://www.phpbuilder.com/annotate/message.php3?id=1014451
	 * 
	 * @return String Zuf�lliges Kennwort
	 */
	function createPassword()
	{
		global $conf;
		
		$pw = '';
		$c  = 'bcdfghjklmnprstvwz'; //consonants except hard to speak ones
		$v  = 'aeiou';              //vowels
		$a  = $c.$v;                //both
		 
		//use two syllables...
		for ( $i=0; $i < intval($conf['security']['password']['min_length'])/3; $i++ )
		{
			$pw .= $c[rand(0, strlen($c)-1)];
			$pw .= $v[rand(0, strlen($v)-1)];
			$pw .= $a[rand(0, strlen($a)-1)];
		}
		//... and add a nice number
		$pw .= rand(10,99);
		 
		return $pw;
	}

	
	/**
	 * Das Kennwort "pfeffern".
	 * 
	 * Siehe http://de.wikipedia.org/wiki/Salt_%28Kryptologie%29#Pfeffer
	 * für weitere Informationen.
	 * 
	 * @param Kennwort
	 * @return Das gepfefferte Kennwort
	 */
	public function pepperPassword( $pass )
	{
		global $conf;
		return $conf['security']['password']['pepper'].$pass;
	}
	
	
	/**
	 * Ermittelt projektübergreifend die letzten Änderungen des Benutzers.
	 *
	 * @return Ambigous <string, unknown>
	 */
	public function getLastChanges()
	{
		$db = db_connection();
	
		$sql = $db->sql( <<<SQL
		SELECT {{object}}.id       as objectid,
		       {{object}}.filename as filename,
		       {{object}}.lastchange_date as lastchange_date,
		       {{project}}.id      as projectid,
			   {{project}}.name    as projectname
		  FROM {{object}}
		LEFT JOIN {{project}}
		       ON {{object}}.projectid = {{project}}.id
		   WHERE {{object}}.lastchange_userid = {userid}
		ORDER BY {{object}}.lastchange_date DESC
SQL
		);
	
		$sql->setInt( 'userid', $this->userid );
	
		return $sql->getAll( $sql );
	
	}
	
}

?>