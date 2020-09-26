<?php

namespace cms\model;

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
use cms\base\DB as Db;
use security\Password;


/**
 * Darstellen eines Benutzers
 *
 * @author Jan Dankert
 */
class User extends ModelBase
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
	var $rights;
	var $loginDate = 0;

	var $language;
	var $timezone;
	var $passwordExpires;
	var $passwordAlgo;
	
	var $lastLogin;
	var $otpSecret;
	var $hotp     ;
	var $hotpCount;
	var $totp     ;
	
	
	
	var $mustChangePassword = false;
	var $groups = null;
	var $loginModuleName = null;

	// Konstruktor
	public function __construct( $userid='' )
	{
		if   ( is_numeric($userid) )
			$this->userid = $userid;
	}


    /**
     * get all users.
     *
     * @return array
     */
	public static function listAll()
	{
		$sql = Db::sql( 'SELECT id,name '.
		                '  FROM {{user}}'.
		                '  ORDER BY name' );

		return $sql->getAssoc();
	}


    /**
     * Get all users.
     *
     * @return array with user objects
     */
	public static function getAllUsers()
	{
		$list = array();
		$sql = Db::sql( 'SELECT * '.
		                '  FROM {{user}}'.
		                '  ORDER BY name' );

		foreach($sql->getAll() as $row )
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
	public function setCurrent()
	{
		$this->loginDate = time();

		\util\Session::setUser( $this );
	}



	/**
	  * Benutzer als aktiven Benutzer in die Session schreiben.
	  */
	public function updateLoginTimestamp()
	{
	    $stmt = Db::sql( <<<SQL
                     UPDATE {{user}}
	                 SET last_login={time}
	                 WHERE id={userid}
SQL
	        );
	    $stmt->setInt( 'time'  ,time() );
	    $stmt->setInt( 'userid',$this->userid  );

	    // Datenbankabfrage ausfuehren
	    $stmt->query();
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


	/**
	 * Lesen aller Projekte, fuer die der Benutzer berechtigt ist.
	 *
	 * @return Array [Projekt-Id] = Projekt-Name
	 */
	public function getReadableProjects()
	{
		$db = \cms\base\DB::get();

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

			return $sql->getAssoc();
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
	 * Ermittelt zu diesem Benutzer den Login-Token.
	 */ 
	function createNewLoginToken()
	{
	    $selector = Password::randomHexString(24);
	    $token    = Password::randomHexString(24);

	    $tokenHash = Password::hash($token,Password::ALGO_SHA1);

		$stmt = Db::sql( 'SELECT max(id) FROM {{auth}}');
		$count = $stmt->getOne();

		$stmt = Db::sql( <<<SQL
              INSERT INTO {{auth}} (id,userid,selector,token,token_algo,expires,create_date,platform,name)
                 VALUES( {id},{userid},{selector},{token},{token_algo},{expires},{create_date},{platform},{name} )
SQL
        );
		$expirationPeriodDays = Conf()->subset('user')->subset('security')->get('token_expires_after_days',730);

		$stmt->setInt( 'id'         ,++$count      );
		$stmt->setInt( 'userid'     ,$this->userid );

		$stmt->setString( 'selector'   ,$selector     );
		$stmt->setString( 'token'      ,$tokenHash    );
		$stmt->setInt   ( 'token_algo' ,Password::ALGO_SHA1        );

		$stmt->setInt( 'expires'    ,time() + ($expirationPeriodDays*24*60*60) );
		$stmt->setInt( 'create_date',time()                           );

		$browser = new \util\Browser();
		$stmt->setString( 'platform',$browser->platform );
		$stmt->setString( 'name'    ,$browser->name     );
		$row = $stmt->getRow();

		// Zusammensetzen des Tokens
		return $selector.'.'.$token;
	}


    /**
     * Ermittelt zu diesem Benutzer den Login-Token.
     */
    function deleteLoginToken( $selector )
    {
        $stmt = Db::sql( <<<SQL
              DELETE FROM {{auth}}
               WHERE selector = {selector}
SQL
        );
        $stmt->setString('selector',$selector );
        $stmt->execute();
    }


    /**
	 * Lesen Benutzer aus der Datenbank.
	 */ 
	public function load()
	{
		$stmt = Db::sql( 'SELECT * FROM {{user}}'.
		                ' WHERE id={userid}' );
		$stmt->setInt( 'userid',$this->userid );
		$row = $stmt->getRow();

		if	( count($row) == 0 )
			throw new \ObjectNotFoundException();
		
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
		// Benutzer �ber Namen suchen
		$sql = Db::sql( 'SELECT id FROM {{user}}'.
		                ' WHERE name={name}' );
		//Html::debug($sql);
		$sql->setString( 'name',$name );

		$userId = $sql->getOne();

		if (empty($userId))
		    return null; // no user found.

		// Benutzer �ber Id instanziieren
		$neuerUser = new \cms\model\User( $userId );
		
		$neuerUser->load();
		
		return $neuerUser;
	}
	
	
	
	/**
	 * Stellt fest, ob der Benutzer korrekt geladen ist.
	 */
	public function isValid()
	{
		return intval($this->userid) > 0;
	}



	/**
	 * Lesen Benutzer aus der Datenbank
	 */
	protected function setDatabaseRow( $row )
	{
		global $conf;
		
		$this->userid    = $row['id'      ];
		$this->name      = $row['name'    ];
		$this->style     = $row['style'   ];
		$this->isAdmin   = ( $row['is_admin'] == '1');
		$this->ldap_dn   = $row['ldap_dn' ];
		$this->fullname  = $row['fullname'];
		$this->tel       = $row['tel'     ];
		$this->mail      = $row['mail'    ];
		$this->desc      = $row['descr'   ];
		$this->language  = $row['language'];
		$this->timezone  = $row['timezone'];
		$this->lastLogin = $row['last_login'];
		$this->otpSecret = $row['otp_secret'];
		$this->hotp      = ($row['hotp']==1);
		$this->hotpCount = $row['hotp_counter'];
		$this->totp      = ($row['totp']==1);
		$this->passwordExpires = $row['password_expires'];
		$this->passwordAlgo    = $row['password_algo'];
		
		if	( $this->fullname == '' )
			$this->fullname = $this->name;
			
		if	( empty($this->style) )
				$this->style = $conf['interface']['style']['default'];
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
		$db = \cms\base\DB::get();

		$sql = $db->sql( 'SELECT name FROM {{user}}'.
		                ' WHERE id={userid}' );
		$sql->setInt( 'userid',$userid );

		$name = $sql->getOne();
		
		if	( $name == '' )
			return \cms\base\Language::lang('UNKNOWN');
		else return $name;
	}


	/**
	 * Speichern Benutzer in der Datenbank.
	 */
	function save()
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql( <<<SQL
                         UPDATE {{user}}
		                 SET name={name},
		                     fullname={fullname},
		                     ldap_dn ={ldap_dn} ,
		                     tel     ={tel}     ,
		                     descr   ={desc}    ,
		                     mail    ={mail}    ,
		                     style   ={style}   ,
		                     language = {language},
		                     timezone = {timezone},
		                     is_admin = {isAdmin},
		                     totp     = {totp},
		                     hotp     = {hotp}
		                 WHERE id={userid}
SQL
 );
		$sql->setString ( 'name'    ,$this->name    );
		$sql->setString ( 'fullname',$this->fullname);
		$sql->setString ( 'ldap_dn' ,$this->ldap_dn );
		$sql->setString ( 'tel'     ,$this->tel     );
		$sql->setString ( 'desc'    ,$this->desc    );
		$sql->setString ( 'mail'    ,$this->mail    );
		$sql->setString ( 'style'   ,$this->style   );
		$sql->setString ( 'language',$this->language);
		$sql->setString ( 'timezone',$this->timezone);
		$sql->setBoolean( 'isAdmin' ,$this->isAdmin );
		$sql->setBoolean( 'totp'    ,$this->totp    );
		$sql->setBoolean( 'hotp'    ,$this->hotp    );
		$sql->setInt    ( 'userid'  ,$this->userid  );
		
		// Datenbankabfrage ausfuehren
		$sql->query();
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

		$db = \cms\base\DB::get();

		$sql = $db->sql('SELECT MAX(id) FROM {{user}}');
		$this->userid = intval($sql->getOne())+1;

		$sql = $db->sql('INSERT INTO {{user}}'.
		               ' (id,name,password_hash,ldap_dn,fullname,tel,mail,descr,style,is_admin,password_salt)'.
		               " VALUES( {userid},{name},'','','','','','','default',0,'' )" );
		$sql->setInt   ('userid',$this->userid);
		$sql->setString('name'  ,$this->name  );

		// Datenbankbefehl ausfuehren
		$sql->query();
		
		$this->addNewUserGroups(); // Neue Gruppen hinzufuegen.
		
		$this->renewOTPSecret();
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
			
		$db = \cms\base\DB::get();

		$groupNames = "'".implode("','",$groupNames)."'";
		$sql = $db->sql("SELECT id FROM {{group}} WHERE name IN($groupNames)");
		$groupIds = array_unique( $sql->getCol() );
		
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
		$db = \cms\base\DB::get();

		// "Erzeugt von" f�r diesen Benutzer entfernen.
		$sql = $db->sql( 'UPDATE {{object}} '.
		                'SET create_userid=null '.
		                'WHERE create_userid={userid}' );
		$sql->setInt   ('userid',$this->userid );
		$sql->query();

		// "Letzte �nderung von" f�r diesen Benutzer entfernen
		$sql = $db->sql( 'UPDATE {{object}} '.
		                'SET lastchange_userid=null '.
		                'WHERE lastchange_userid={userid}' );
		$sql->setInt   ('userid',$this->userid );
		$sql->query();

		// Alle Archivdaten in Dateien mit diesem Benutzer entfernen
		$sql = $db->sql( 'UPDATE {{value}} '.
		                'SET lastchange_userid=null '.
		                'WHERE lastchange_userid={userid}' );
		$sql->setInt   ('userid',$this->userid );
		$sql->query();

		// Alle Berechtigungen dieses Benutzers l?schen
		$sql = $db->sql( 'DELETE FROM {{acl}} '.
		                'WHERE userid={userid}' );
		$sql->setInt   ('userid',$this->userid );
		$sql->query();

		// Alle Gruppenzugehoerigkeiten dieses Benutzers l?schen
		$sql = $db->sql( 'DELETE FROM {{usergroup}} '.
		                'WHERE userid={userid}' );
		$sql->setInt   ('userid',$this->userid );
		$sql->query();

        $stmt = Db::sql( <<<SQL
              DELETE FROM {{auth}}
               WHERE userid={userid}
SQL
        );
        $stmt->setInt   ('userid',$this->userid );
        $stmt->execute();

        // Benutzer loeschen
		$sql = $db->sql( 'DELETE FROM {{user}} '.
		                'WHERE id={userid}' );
		$sql->setInt   ('userid',$this->userid );
		$sql->query();

		$this->userid = null;
	}


	/**
	 * Ermitteln der Eigenschaften zu diesem Benutzer
	 *
	 * @return array Liste der Eigenschaften als assoziatives Array
	 */
	public function getProperties()
	{
	    return parent::getProperties() + array('id'=>$this->userid,'is_admin'=> $this->isAdmin);
	}



	/**
	 * Setzt ein neues Kennwort fuer diesen Benutzer.
	 * 
	 * @param password Kennwortt
	 * @param always true, wenn Kennwort dauerhaft.
	 */
	function setPassword( $password, $always=true )
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql( 'UPDATE {{user}} SET password_hash={password},password_algo={algo},password_expires={expires} '.
		                'WHERE id={userid}' );
		                
		if	( $always )
		{
			$algo   = Password::bestAlgoAvailable();
			$expire = null;
		}
		else
		{
			// Klartext-Kennwort, der Benutzer muss das Kennwort beim nä. Login ändern.
			$algo   = Password::ALGO_PLAIN;
			$expire = time();
		}

		// Hashsumme für Kennwort erzeugen
		if	( $expire == null )
			$sql->setNull('expires');
		else
			$sql->setInt('expires',$expire);
		
		$sql->setInt   ('algo'    ,$algo                                                  );
		$sql->setString('password',Password::hash(User::pepperPassword($password),$algo) );
		$sql->setInt   ('userid'  ,$this->userid  );

		$sql->query();
	}


	/**
	 * Gruppen ermitteln, in denen der Benutzer Mitglied ist.
	 *
	 * @return array mit Id:Name
	 */
	function getGroups()
	{
		if	( !is_array($this->groups) )
		{
			$db = \cms\base\DB::get();
	
			$sql = $db->sql( 'SELECT {{group}}.id,{{group}}.name FROM {{group}} '.
			                'LEFT JOIN {{usergroup}} ON {{usergroup}}.groupid={{group}}.id '.
			                'WHERE {{usergroup}}.userid={userid}' );
			$sql->setInt('userid',$this->userid );
			$this->groups = $sql->getAssoc();
		}
		
		return $this->groups;
	}
	

	// Gruppen ermitteln, in denen der Benutzer Mitglied ist
	function getGroupIds()
	{
		return array_keys( $this->getGroups() );

		/*
		$db = \cms\base\DB::get();

		$sql = $db->sql( 'SELECT groupid FROM {{usergroup}} '.
		                'WHERE userid={userid}' );
		$sql->setInt('userid',$this->userid );

		return $sql->getCol( $sql );
		*/
	}
	

	// Gruppen ermitteln, in denen der Benutzer *nicht* Mitglied ist
	function getOtherGroups()
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql( 'SELECT {{group}}.id,{{group}}.name FROM {{group}}'.
		                '   LEFT JOIN {{usergroup}} ON {{usergroup}}.groupid={{group}}.id AND {{usergroup}}.userid={userid}'.
		                '   WHERE {{usergroup}}.userid IS NULL' );
		$sql->setInt('userid'  ,$this->userid );

		return $sql->getAssoc();
	}


	
	/**
	 * Benutzer zu einer Gruppe hinzufuegen.
	 * 
	 * @param groupid die Gruppen-Id
	 */
	function addGroup( $groupid )
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql('SELECT MAX(id) FROM {{usergroup}}');
		$usergroupid = intval($sql->getOne())+1;

		$sql = $db->sql( 'INSERT INTO {{usergroup}} '.
		                '       (id,userid,groupid) '.
		                '       VALUES( {usergroupid},{userid},{groupid} )' );
		$sql->setInt('usergroupid',$usergroupid  );
		$sql->setInt('userid'     ,$this->userid );
		$sql->setInt('groupid'    ,$groupid      );

		$sql->query();
	
	}


	
	/**
	 * Benutzer aus Gruppe entfernen.
	 * 
	 * @param groupid die Gruppen-Id
	 */
	function delGroup( $groupid )
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql( 'DELETE FROM {{usergroup}} '.
		                '  WHERE userid={userid} AND groupid={groupid}' );
		$sql->setInt   ('userid'  ,$this->userid );
		$sql->setInt   ('groupid' ,$groupid      );

		$sql->query();
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
	 * @return array
	 */
	function getAllAcls()
	{

		$this->delRights();

		$group_clause = $this->getGroupClause();

		$sql = Db::sql( 'SELECT {{acl}}.*,{{object}}.projectid,{{language}}.name AS languagename FROM {{acl}}'.
		                '  LEFT JOIN {{object}} '.
		                '         ON {{object}}.id={{acl}}.objectid '.
		                '  LEFT JOIN {{language}} '.
		                '         ON {{language}}.id={{acl}}.languageid '.
		                '  WHERE ( {{acl}}.userid={userid} OR '.$group_clause.
		                                                 ' OR ({{acl}}.userid IS NULL AND {{acl}}.groupid IS NULL) )'.
		                '  ORDER BY {{object}}.projectid,{{acl}}.languageid' );
		$sql->setInt  ( 'userid'    ,$this->userid );

		$aclList = array();

		foreach($sql->getAll() as $row )
		{
			$acl = new Acl();
			$acl->setDatabaseRow( $row );
			$acl->projectid    = $row['projectid'   ];
			if	( intval($acl->languageid) == 0 )
				$acl->languagename = \cms\base\Language::lang('ALL_LANGUAGES');
			else
				$acl->languagename = $row['languagename'];
			$aclList[] = $acl;
		}
		
		return $aclList;
	}


	/**
	 * Ermitteln aller Berechtigungen.
	 * @return array Berechtigungen
	 */
	function getRights()
	{
		throw new \DomainException('User.class::getRights()');
		
//		$db = \cms\base\DB::get();
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
	 * @param $type Typ des Rechts (Lesen,Schreiben,...) als Konstante Acl::ACL_*
	 */ 
	function hasRight( $objectid,$type )
	{
		global $conf;
		if	( $this->isAdmin && !$conf['security']['readonly'] )
			return true;

		if	( $this->isAdmin && $type & Acl::ACL_READ )
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
			if	( $type & Acl::ACL_READ )
				$type = Acl::ACL_READ;
			else
				$type = 0;

		if	( $type & Acl::ACL_PUBLISH && $conf['security']['nopublish'] )
			$type -= Acl::ACL_PUBLISH;


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
	 * Ueberpruefen des Kennwortes.
	 *
	 * Es wird festgestellt, ob das Kennwort dem des Benutzers entspricht.
	 * Es wird dabei nur gegen die interne Datenbank geprüft. Weitere
	 * Loginmodule werden nicht aufgerufen!
	 * Diese Methode darf kein Bestandteil des Logins sein, da nur das Kennwort geprüft wird!
	 * Kennwortablauf und Token werden nicht geprüft!
	 */
	function checkPassword( $password )
	{
		$db = \cms\base\DB::get();
		// Laden des Benutzers aus der Datenbank, um Password-Hash zu ermitteln.
		$sql = $db->sql( 'SELECT * FROM {{user}}'.
			' WHERE id={userid}' );
		$sql->setInt( 'userid',$this->userid );
		$row_user = $sql->getRow();
		
		// Pruefen ob Kennwort mit Datenbank uebereinstimmt.
		return Password::check(User::pepperPassword($password),$row_user['password_hash'],$row_user['password_algo']);
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
	public static function pepperPassword( $pass )
	{
		$salt = Conf()->subset('security')->subset('password')->get('pepper');

		return $salt.$pass;
	}
	
	
	/**
	 * Ermittelt projektübergreifend die letzten Änderungen des Benutzers.
	 *
	 * @return array <string, unknown>
	 */
	public function getLastChanges()
	{
		$db = \cms\base\DB::get();
	
		$sql = $db->sql( <<<SQL
		SELECT {{object}}.id       as objectid,
		       {{object}}.filename as filename,
		       {{object}}.typeid   as typeid,
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
	
		return $sql->getAll();
	
	}
	
	
	/**
	 * Calculate the code, with given secret and point in time.
	 *
	 * @param string   $secret
	 * @param int|null $timeSlice
	 *
	 * @return string
	 */
	public function getTOTPCode()
	{
	    $codeLength = 6;
	    $timeSlice = floor(time() / 30);
	    $secretkey = @hex2bin($this->otpSecret);
	    // Pack time into binary string
	    $time = chr(0).chr(0).chr(0).chr(0).pack('N*', $timeSlice);
	    // Hash it with users secret key
	    $hm = hash_hmac('SHA1', $time, $secretkey, true);
	    // Use last nipple of result as index/offset
	    $offset = ord(substr($hm, -1)) & 0x0F;
	    // grab 4 bytes of the result
	    $hashpart = substr($hm, $offset, 4);
	    // Unpak binary value
	    $value = unpack('N', $hashpart);
	    $value = $value[1];
	    // Only 32 bits
	    $value = $value & 0x7FFFFFFF;
	    $modulo = pow(10, $codeLength);
	    return str_pad($value % $modulo, $codeLength, '0', STR_PAD_LEFT);
	}
	
	
	/**
	 * Erzeugt ein neues OTP-Secret.
	 */
	public function renewOTPSecret() {
	    
	    $secret = Password::randomHexString(64);
	    
	    $db = \cms\base\DB::get();
	    
	    $stmt = $db->sql('UPDATE {{user}} SET otp_secret={secret} WHERE id={id}');
	    
	    $stmt->setString( 'secret', $secret       );
	    $stmt->setInt   ( 'id'    , $this->userid );
	    
	    $stmt->execute();
	    
	}
	
}

