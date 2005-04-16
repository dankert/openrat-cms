<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// DaCMS Content Management System
// Copyright (C) 2002 Jan Dankert, jandankert@jandankert.de
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
// ---------------------------------------------------------------------------
// $Log$
// Revision 1.13  2005-04-16 22:25:06  dankert
// Verbindung zum LDAP-Server schlie?en
//
// Revision 1.12  2005/01/24 21:41:25  dankert
// Abfrage auf Readonly-Mode
//
// Revision 1.11  2004/12/20 23:29:51  dankert
// neue Methode setDatabaseRow()
//
// Revision 1.10  2004/12/20 23:19:41  dankert
// Neue Methode getAllUsers()
//
// Revision 1.9  2004/12/19 19:24:27  dankert
// getAvailableStyles()
//
// Revision 1.8  2004/11/28 22:32:33  dankert
// getAllAcls(): Lesen aller Rechte des Benutzers
//
// Revision 1.7  2004/11/28 16:56:38  dankert
// Beruecksichtigen von Berechtigungen fuer "alle"
//
// Revision 1.6  2004/11/15 21:35:39  dankert
// Berechtigungen mit Bitmasken
//
// Revision 1.5  2004/11/10 22:48:25  dankert
// Neue Methoden zum Einlesen der Berechtigungen
//
// Revision 1.4  2004/10/14 21:12:59  dankert
// Methoden fuer Berechtigungen
//
// Revision 1.3  2004/05/07 21:29:16  dankert
// Url ?ber Html::url erzeugen
//
// Revision 1.2  2004/05/02 14:41:31  dankert
// Einf?gen package-name (@package)
//
// ---------------------------------------------------------------------------

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
	var $projects;
	var $rights;


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

		$sql = new Sql( 'SELECT id,name '.
		                '  FROM {t_user}'.
		                '  ORDER BY name' );

		return $db->getAssoc( $sql->query );
	}


	// Lesen Benutzer aus der Datenbank
	function getAllUsers()
	{
		$list = array();
		$db = db_connection();

		$sql = new Sql( 'SELECT * '.
		                '  FROM {t_user}'.
		                '  ORDER BY name' );

		foreach( $db->getAll( $sql->query ) as $row )
		{
			$user = new User();
			$user->setDatabaseRow( $row );

			$list[] = $user;
		}
		
		return $list;
	}


	/**
	  * Benutzer als aktiven Benutzer in die Session schreiben
	  */
	function setCurrent()
	{
		global $SESS;

		$SESS['user'] = $this->getProperties();
		$SESS['userobject'] = $this;
	}


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

		$sql = new Sql( 'SELECT COUNT(*)'.
		                '  FROM {t_acl}'.
		                '  LEFT JOIN {t_object} ON {t_object}.id={t_acl}.objectid '.
		                '  WHERE projectid={projectidid} AND '.
		                '        ( userid={userid} OR'.
		                '          '.$this->getGroupClause().'    )' );
		$sql->setInt   ( 'userid',$this->userid );

		return $db->getOne( $sql->query ) > 0;
	}



	/**
	 * Lesen aller Projekte, fuer die der Benutzer berechtigt ist.
	 *
	 */
	function getReadableProjects()
	{
		$db = db_connection();

		if	( $this->isAdmin )
		{
			return Project::getAllProjects();
		}
		else
		{
			$sql = new Sql( 'SELECT {t_project}.id,{t_project}.name'.
			                '  FROM {t_acl}'.
			                '  LEFT JOIN {t_object}  ON {t_object}.id ={t_acl}.objectid '.
			                '  LEFT JOIN {t_project} ON {t_project}.id={t_object}.projectid '.
			                '  WHERE userid={userid} OR'.
			                '        '.$this->getGroupClause().' OR '.
			                '        ({t_acl}.userid IS NULL AND {t_acl}.groupid IS NULL) '.
			                '  ORDER BY {t_project}.name' );
			$sql->setInt   ( 'userid',$this->userid );

			return $db->getAssoc( $sql->query );
		}
	}



	// Prueft, ob der Benutzer fuer ein Projekt berechtigt ist
	function getReadableProjectIds()
	{
		$db = db_connection();

		if	( $this->isAdmin )
		{
			return Project::getAllProjectIds();
		}
		else
		{
			$sql = new Sql( 'SELECT DISTINCT {t_object}.projectid'.
			                '  FROM {t_acl}'.
			                '  LEFT JOIN {t_object} ON {t_object}.id={t_acl}.objectid '.
			                '  WHERE userid={userid} OR'.
			                '        '.$this->getGroupClause().' OR '.
			                '        ({t_acl}.userid IS NULL AND {t_acl}.groupid IS NULL) '.
			                '  ORDER BY {t_project}.name' );
			$sql->setInt   ( 'userid',$this->userid );

			return $db->getCol( $sql->query );
		}
	}


	function loadProjects()
	{
		$this->projects = $this->getReadableProjects();
	}



	// Lesen Benutzer aus der Datenbank
	function load()
	{
		global $conf;
		$db = db_connection();

		$sql = new Sql( 'SELECT * FROM {t_user}'.
		                ' WHERE id={userid}' );
		$sql->setInt( 'userid',$this->userid );
		$row = $db->getRow( $sql->query );

		$this->setDatabaseRow( $row );		
	}



	// Lesen Benutzer aus der Datenbank
	function setDatabaseRow( $row )
	{
		if	( count($row) > 1 )
		{
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
				$this->style = 'default';
		}
		else
		{
			$this->userid   = -99;
			$this->name     = lang('UNKNOWN');
			$this->style    = 'default';
			$this->isAdmin  = false;
			$this->ldap_dn  = '';
			$this->fullname = lang('UNKNOWN');
			$this->tel      = '';
			$this->mail     = '';
			$this->desc     = '';
		}

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



	// Lesen Benutzername
	function getUserName( $userid )
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT name FROM {t_user}'.
		                ' WHERE id={userid}' );
		$sql->setInt( 'userid',$userid );

		$name = $db->getOne( $sql->query );
		
		if	( $name == '' )
			return lang('UNKNOWN');
		else return $name;
	}


	// Speichern Benutzer in der Datenbank
	function save()
	{
		$db = db_connection();

		$sql = new Sql( 'UPDATE {t_user}'.
		                ' SET name={name},'.
		                '     fullname={fullname},'.
		                '     ldap_dn ={ldap_dn} ,'.
		                '     tel     ={tel}     ,'.
		                '     descr   ={desc}    ,'.
		                '     mail    ={mail}    ,'.
		                '     style   ={style}   ,'.
		                '     is_admin={isAdmin} '.
		                ' WHERE id={userid}' );
		$sql->setInt    ( 'userid'  ,$this->userid  );
		$sql->setString ( 'fullname',$this->fullname);
		$sql->setString ( 'name'    ,$this->name    );
		$sql->setString ( 'ldap_dn' ,$this->ldap_dn );
		$sql->setString ( 'tel'     ,$this->tel     );
		$sql->setString ( 'desc'    ,$this->desc    );
		$sql->setString ( 'mail'    ,$this->mail    );
		$sql->setString ( 'style'   ,$this->style   );
		$sql->setBoolean( 'isAdmin' ,$this->isAdmin );
		// Datenbankabfrage ausfuehren
		$db->query( $sql->query );
	}


	// Benutzer hinzufuegen
	function add( $name = '' )
	{
		if	( $name != '' )
			$this->name = $name;

		$db = db_connection();

		$sql = new Sql('SELECT MAX(id) FROM {t_user}');
		$this->userid = intval($db->getOne($sql->query))+1;

		$sql = new Sql('INSERT INTO {t_user}'.
		               ' (id,name,password,ldap_dn,fullname,tel,mail,descr,style,is_admin)'.
		               " VALUES( {userid},{name},'','','','','','','default',0 )" );
		$sql->setInt   ('userid',$this->userid);
		$sql->setString('name'  ,$this->name  );

		// Datenbankbefehl ausfuehren
		$db->query( $sql->query );
	}


	// Benutzer entfernen
	function delete()
	{
		$db = db_connection();

		// Alle Archivdaten in Dateien mit diesem Benutzer entfernen
		$sql = new Sql( 'UPDATE {t_object} '.
		                'SET create_userid=null '.
		                'WHERE create_userid={userid}' );
		$sql->setInt   ('userid',$this->userid );
		$db->query( $sql->query );

		// Alle Berechtigungen dieses Benutzers l?schen
		$sql = new Sql( 'DELETE FROM {t_acl} '.
		                'WHERE userid={userid}' );
		$sql->setInt   ('userid',$this->userid );
		$db->query( $sql->query );

		// Alle Gruppenzugeh?rigkeiten dieses Benutzers l?schen
		$sql = new Sql( 'DELETE FROM {t_usergroup} '.
		                'WHERE userid={userid}' );
		$sql->setInt   ('userid',$this->userid );
		$db->query( $sql->query );

		// Benutzer l?schen
		$sql = new Sql( 'DELETE FROM {t_user} '.
		                'WHERE id={userid}' );
		$sql->setInt   ('userid',$this->userid );
		$db->query( $sql->query );
	}


	/** Ermitteln der Eigenschaften zu diesem Benutzer
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
	 * Ueberpruefen des Kennwortes.
	 *
	 * Das Kennwort wird ueber Datenbank oder ueber LDAP-Verzeichnisdienst geprueft.
	 * Wenn
	 * - ein LDAP-Dn ("distinghished-name") vorhanden ist, dann Pruefung ueber den LDAP-Server,
	 * - sonst ueber die Benutzertabelle in der Datenbank.
	 */
	function checkPassword( $password )
	{
		global $conf;

		$db = db_connection();

		// Lesen des Benutzers aus der DB-Tabelle
		$sql = new Sql( 'SELECT * FROM {t_user} WHERE name={name}' );
		$sql->setString('name',$this->name);
	
		$res_user = $db->query( $sql->query );

		if	( $res_user->numRows() == 1 )
		{
			$row_user = $res_user->fetchRow();
			$this->userid = $row_user['id'];

			// Falls LDAP-dn vorhanden wird Benutzer per LDAP authentifiziert
			if   ( $row_user['ldap_dn'] != '' )
			{
				Logger::debug( 'checking login via ldap' );
				$ldapHost = $conf['ldap']['host'];
				$ldapPort = $conf['ldap']['port'];

				// Verbindung zum LDAP-Server herstellen
				$ldap_conn = @ldap_connect( $ldapHost,$ldapPort );
				
				// siehe http://bugs.php.net/bug.php?id=15637
				// Unter bestimmten Bedingungen wird trotz nicht erreichbarem LDAP-Server eine PHP-Resource
				// zurueck gegeben. Dann erscheint zwar keine Fehlermeldung, aber zumindestens misslingt
				// der nachfolgende Bind-Befehl.
				if	( !$ldap_conn )
				{
					Logger::error( "connect to ldap server '$ldapHost:$ldapPort' failed" );
					
					// Abbruch, wenn LDAP-Server nicht erreichbar
					die( "Cannot connect to directory server $ldapHost:$ldapPort, please contact your administrator." );
				}

				// LDAP-Login versuchen
				if   ( @ldap_bind( $ldap_conn,$row_user['ldap_dn'],$password) )
				{
					// Verbindung zum LDAP-Server brav beenden
					@ldap_close( $ldap_conn );
					
					// Login erfolgreich
					return true;
				}
				
				// Verbindung zum LDAP-Server brav beenden
				@ldap_close( $ldap_conn );
			}
			else
			{
//				Logger::debug( 'checking md5-password '.md5($password).' against database' );

				// Pruefen ob Kennwort mit Datenbank uebereinstimmt
				if   ( $row_user['password'] == md5( $password ) )
				{
					// Juchuu, Login ist erfolgreich
					return true;
				}
			}
		}

		// Benutzername nicht in Datenbank oder Kennwort falsch
		return false;
	}
	
	
	// Neues Kennwort fuer diesen Benutzer setzen
	function setPassword( $password )
	{
		$db = db_connection();

		$sql = new Sql( 'UPDATE {t_user} SET password={password}'.
		                'WHERE id={userid}' );
		$sql->setString('password',md5($password) );
		$sql->setInt   ('userid'  ,$this->userid  );

		$db->query( $sql->query );
	}


	// Gruppen ermitteln, in denen der Benutzer Mitglied ist
	function getGroups()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT {t_group}.id,{t_group}.name FROM {t_group} '.
		                'LEFT JOIN {t_usergroup} ON {t_usergroup}.groupid={t_group}.id '.
		                'WHERE {t_usergroup}.userid={userid}' );
		$sql->setInt('userid',$this->userid );

		return $db->getAssoc( $sql->query );
	}
	

	// Gruppen ermitteln, in denen der Benutzer Mitglied ist
	function getGroupIds()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT groupid FROM {t_usergroup} '.
		                'WHERE userid={userid}' );
		$sql->setInt('userid',$this->userid );

		return $db->getCol( $sql->query );
	}
	

	// Gruppen ermitteln, in denen der Benutzer *nicht* Mitglied ist
	function getOtherGroups()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT {t_group}.id,{t_group}.name FROM {t_group}'.
		                '   LEFT JOIN {t_usergroup} ON {t_usergroup}.groupid={t_group}.id AND {t_usergroup}.userid={userid}'.
		                '   WHERE {t_usergroup}.userid IS NULL' );
		$sql->setInt('userid'  ,$this->userid );

		return $db->getAssoc( $sql->query );
	}


	// Benutzer einer Gruppe hinzufuegen
	function addGroup( $groupid )
	{
		$db = db_connection();

		$sql = new Sql('SELECT MAX(id) FROM {t_usergroup}');
		$usergroupid = intval($db->getOne($sql->query))+1;

		$sql = new Sql( 'INSERT INTO {t_usergroup} '.
		                '       (id,userid,groupid) '.
		                '       VALUES( {usergroupid},{userid},{groupid} )' );
		$sql->setInt('usergroupid',$usergroupid  );
		$sql->setInt('userid'     ,$this->userid );
		$sql->setInt('groupid'    ,$groupid      );

		$db->query( $sql->query );
	
	}


	// Benutzer aus Gruppe entfernen
	function delGroup( $groupid )
	{
		$db = db_connection();

		$sql = new Sql( 'DELETE FROM {t_usergroup} '.
		                '  WHERE userid={userid} AND groupid={groupid}' );
		$sql->setInt   ('userid'  ,$this->userid );
		$sql->setInt   ('groupid' ,$groupid      );

		$db->query( $sql->query );
	}
	

	function loadRights( $projectid,$languageid )
	{
		Logger::debug( 'Lade Berechtigungen' );

		$this->delRights();

		global $SESS,$conf_php;
		$db = db_connection();

		$group_clause = $this->getGroupClause();

		$sql = new Sql( 'SELECT {t_acl}.* FROM {t_acl}'.
		                '  LEFT JOIN {t_object} '.
		                '         ON {t_object}.id={t_acl}.objectid '.
		                '  WHERE projectid={projectid}'.
		                '    AND ( languageid={languageid} OR languageid IS NULL )'.
		                '    AND ( {t_acl}.userid={userid} OR '.$group_clause.
		                                                 ' OR ({t_acl}.userid IS NULL AND {t_acl}.groupid IS NULL) )' );
		$sql->setInt  ( 'languageid',$languageid    );
		$sql->setInt  ( 'projectid' ,$projectid     );
		$sql->setInt  ( 'userid'    ,$this->userid );
		Logger::debug( 'sql='.$sql->query );
		foreach( $db->getAll( $sql->query ) as $row )
		{
			Logger::debug( 'lese aclid '.$row['id'] );
			
			$acl = new Acl();
			$acl->setDatabaseRow( $row );

			$this->addRight($acl->objectid,$acl->getMask() );

			$o = new Object( $acl->objectid );
			$o->objectLoadRaw();

			// Vererben der Berechtigung an Unterordner
			if	( $acl->transmit )
			{
				$f = new Folder( $o->objectid );
				Logger::debug( 'vererbung!' );
			
				foreach( $f->getAllSubfolderIds() as $sfid )
					$this->addRight($sfid,$acl->getMask() );
			}

			// Uebergeordneten Ordnern das Leserecht geben
			if	( !$o->isRoot )
			{
				$f = new Folder( $o->parentid );
				$oids = $f->parentObjectIds( true, true );
				foreach( $oids as $oid )
					$this->addRight($oid,ACL_READ);
			}
		}
	}


	function getAllAcls()
	{
		Logger::debug( 'Lade Berechtigungen' );

		$this->delRights();

		global $SESS,$conf_php;
		$db = db_connection();

		$group_clause = $this->getGroupClause();

		$sql = new Sql( 'SELECT {t_acl}.*,{t_object}.projectid,{t_language}.name AS languagename FROM {t_acl}'.
		                '  LEFT JOIN {t_object} '.
		                '         ON {t_object}.id={t_acl}.objectid '.
		                '  LEFT JOIN {t_language} '.
		                '         ON {t_language}.id={t_acl}.languageid '.
		                '  WHERE ( {t_acl}.userid={userid} OR '.$group_clause.
		                                                 ' OR ({t_acl}.userid IS NULL AND {t_acl}.groupid IS NULL) )'.
		                '  ORDER BY {t_object}.projectid,{t_acl}.languageid' );
		$sql->setInt  ( 'userid'    ,$this->userid );

		$aclList = array();

		foreach( $db->getAll( $sql->query ) as $row )
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


	// Alle Berechtigungen ermitteln
	function getRights()
	{
		global $SESS,$conf_php;
		$db = db_connection();
		$var = array();

		// Alle Projekte lesen
		$sql = new Sql( 'SELECT id,name FROM {t_project}' );
		$projects = $db->getAssoc( $sql->query );	

		foreach( $projects as $projectid=>$projectname )
		{
			$var[$projectid] = array();
			$var[$projectid]['name'] = $projectname;
			$var[$projectid]['folders'] = array();
			$var[$projectid]['rights'] = array();

			$sql = new Sql( 'SELECT {t_acl}.* FROM {t_acl}'.
			                '  LEFT JOIN {t_folder} ON {t_acl}.folderid = {t_folder}.id'.
			                '  WHERE {t_folder}.projectid={projectid}'.
			                '    AND {t_acl}.userid={userid}' );
			$sql->setInt('projectid',$projectid    );
			$sql->setInt('userid'   ,$this->userid );
			
			$acls = $db->getAll( $sql->query );

			foreach( $acls as $acl )
			{
				$aclid = $acl['id'];
				$folder = new Folder( $acl['folderid'] );
				$folder->load();
				$var[$projectid]['rights'][$aclid] = $acl;
				$var[$projectid]['rights'][$aclid]['foldername'] = implode(' &raquo; ',$folder->parentfolder( false,true ));
				$var[$projectid]['rights'][$aclid]['delete_url'] = Html::url(array('action'=>'user','subaction'=>'delright','aclid'=>$aclid));
			}
			
			$sql = new Sql( 'SELECT id FROM {t_folder}'.
			                '  WHERE projectid={projectid}' );
			$sql->setInt('projectid',$projectid);
			$folders = $db->getCol( $sql->query );

			$var[$projectid]['folders'] = array();

			foreach( $folders as $folderid )
			{
				$folder = new Folder( $folderid );
				$folder->load();
				$var[$projectid]['folders'][$folderid] = implode(' &raquo; ',$folder->parentfolder( false,true ));
			}

			asort( $var[$projectid]['folders'] );
		}
		
		return $var;
	}


	function delRights()
	{
		$this->rights = array();
	}


	/**
	 * Ueberpruft, ob der Benutzer ein bestimmtes Recht hat
	 *
	 * @param objectid Objekt-Id zu dem Objekt, dessen Rechte untersucht werden sollen
	 * @param type Typ des Rechts (Lesen,Schreiben,...)
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
	 * Berechtigung dem Benutzer hinzufuegen
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
			
		Logger::trace( 'Objekt '.$objectid.' erhaelt Recht '.$type );
	}


	/**
	 * Ermitteln aller zur Verfuegung stehenden Stylesheets
	 */
	function getAvailableStyles()
	{
		global $conf_themedir;
		$allstyles = array();
		$handle=opendir( $conf_themedir.'/css' ); 

		while ($file = readdir ($handle))
		{ 
			if ( eregi('\.css$',$file) )
			{ 
				$file = eregi_replace('\.css$','',$file);
				$allstyles[$file] = $file;
			}
		}
		closedir($handle);

		return $allstyles;	
	}
}

?>