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
use cms\base\Configuration;
use cms\base\DB;
use cms\base\Startup;
use cms\base\Language;
use language\Messages;
use security\Password;
use util\exception\ObjectNotFoundException;
use util\Request;


/**
 * Darstellen eines Benutzers
 *
 * @author Jan Dankert
 */
class User extends ModelBase
{
	/**
	 * Local user database
	 */
	const AUTH_TYPE_INTERNAL = 1;

	/**
	 * OpenId Connect
	 */
	const AUTH_TYPE_OIDC = 2;

	const STYLE_SCHEME_AUTO  = 1;
	const STYLE_SCHEME_LIGHT = 2;
	const STYLE_SCHEME_DARK  = 3;

	public $userid   = 0;

	/**
	 * Username.
	 * This name should not be displayed to other users.
	 *
	 * @var string
	 */
	public $name     = '';

	/**
	 * natural name of this user.
	 *
	 * @var string
	 */
	public $fullname = '';
	public $tel;
	public $mail;
	public $desc;
	public $style;
	public $styleScheme;
	public $isAdmin;
	public $loginDate = 0;

	/**
	 * User prefered language.
	 *
	 * As ISO string.
	 *
	 * @var string
	 */
	public $language;

	public $timezone;
	public $passwordExpires;
	public $passwordAlgo;

	public $lastLogin;
	public $otpSecret;
	public $hotp     ;
	public $hotpCount;
	public $totp     ;

	public $issuer = null;
	public $type = User::AUTH_TYPE_INTERNAL;

	public $passwordFailedCount = 0;
	public $passwordLockedUntil = 0;

	private $groups = null;


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
		$sql = Db::sql( <<<SQL
			SELECT id,name
		      FROM {{user}}
		     ORDER BY name
SQL
		);
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
		$sql = Db::sql( <<<SQL
                 SELECT *
		           FROM {{user}}
		          ORDER BY name
SQL
		);
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

		Request::setUser( $this );
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
	    $stmt->execute();
	}


	/**
	 * Creates an SQL-WHERE-Clause.
	 *
	 * A "WHERE IN()" clause is difficult, because groups may be part of another groups.
	 *
	 * @return String SQL-WHERE-Clause
	 */
	public function getGroupClause()
	{
		$groupIds = $this->getEffectiveGroups();
		
		if	( count($groupIds) > 0 )
			$groupclause = ' groupid='.implode(' OR groupid=',$groupIds );
		else
			$groupclause = ' 1=0 ';

		return $groupclause;
	}


	/**
	 * Lesen aller Projekte, fuer die der Benutzer berechtigt ist.
	 *
	 * @return array [Projekt-Id] = Projekt-Name
	 */
	public function getReadableProjects()
	{
		$db = Db::get();

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
						 (
							{{acl}}.type = {usertype}  AND {{acl}}.userid={userid}
						 OR {{acl}}.type = {grouptype} AND $groupClause 
						 OR ({{acl}}.type = {alltype}
						 OR ({{acl}}.type = {guesttype}
					   ) 
				 ORDER BY {{project}}.name
SQL
);
			$sql->setInt( 'userid',$this->userid );
			$sql->setInt( 'usertype' ,Permission::TYPE_USER  );
			$sql->setInt( 'grouptype',Permission::TYPE_GROUP );
			$sql->setInt( 'alltype'  ,Permission::TYPE_AUTH  );
			$sql->setInt( 'guesttype',Permission::TYPE_GUEST );

			return $sql->getAssoc();
		}
		
	}



	/**
	 * Ermittelt alls Projekte, fuer die der Benutzer berechtigt ist.
	 * @return array [0..n] = Projekt-Id
	 */
	function getReadableProjectIds()
	{
		return array_keys( $this->getReadableProjects() );
	}


	/**
	 * Gets all login tokens for this user.
	 *
	 * @return array
	 */
	public function getLoginTokens() {

		$stmt = Db::sql( <<<SQL
              SELECT selector,expires,create_date,platform,name
                FROM {{auth}} 
               WHERE userid={userid}
SQL
		);

		$stmt->setInt('userid',$this->getId() );

		return $stmt->getAll();
	}

	/**
	 * Creates a completly new login token.
	 *
	 * @return string new login token
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
		$expirationPeriodDays = Configuration::Conf()->subset('user')->subset('security')->get('token_expires_after_days',730);

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
	 * Creates a new login token for a serial.
	 *
	 * @param $selector string selector
	 * @return string new login token
	 */
	public function createNewLoginTokenForSerial( $selector )
	{
		$algo      = Password::ALGO_SHA1;
		$token     = Password::randomHexString(24);

		$tokenHash = Password::hash($token,$algo);

		$stmt = Db::sql( <<<SQL
              UPDATE {{auth}}
                 SET token={token},token_algo={token_algo}
                 WHERE selector={selector}
SQL
		);

		$stmt->setString( 'selector'   ,$selector     );
		$stmt->setString( 'token'      ,$tokenHash    );
		$stmt->setInt   ( 'token_algo' ,$algo         );
		$stmt->execute();

		// Zusammensetzen des Tokens
		return $selector.'.'.$token;
	}




	/**
     * Deletes a login token.
	 * @param $selector string selector
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
			throw new \util\exception\ObjectNotFoundException();
		
		$this->setDatabaseRow( $row );		
	}


	/**
	 * Gets a user by its name.
	 * 
	 * @static 
	 * @param $name string user name
	 * @param $authType int authentication type
	 * @param $issuer string issuer who created this user
	 * @return User or null, if user is not found
	 */
	public static function loadWithName( $name,$authType,$issuer = null )
	{
		// Search user with name
		$sql = Db::sql( <<<SQL
			SELECT id FROM {{user}}
		                WHERE name={name}
		                  AND auth_type={type}
		                  AND ( issuer={issuer}
		                        OR (auth_type=1 AND issuer IS NULL)
		                      )
SQL
		);
		$sql->setString( 'name'  ,$name     );
		$sql->setString( 'type'  ,$authType );
		$sql->setString( 'issuer',$issuer   );

		$userId = $sql->getOne();

		if ( ! $userId )
		    return null; // no user found.

		// Create the user by id.
		$namedUser = new User( $userId );
		
		$namedUser->load();
		
		return $namedUser;
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
		$this->userid      = $row['id'      ];
		$this->name        = $row['name'    ];
		$this->style       = $row['style'   ];
		$this->styleScheme = $row['style_scheme' ];
		$this->isAdmin     = ( $row['is_admin'] == '1');
		$this->fullname    = $row['fullname'];
		$this->tel         = $row['tel'     ];
		$this->mail        = $row['mail'    ];
		$this->desc        = $row['descr'   ];
		$this->language    = $row['language'];
		$this->timezone    = $row['timezone'];
		$this->lastLogin   = $row['last_login'];
		$this->otpSecret   = $row['otp_secret'];
		$this->hotp        = ($row['hotp']==1);
		$this->hotpCount   = $row['hotp_counter'];
		$this->totp        = ($row['totp']==1);
		$this->passwordExpires = $row['password_expires'];
		$this->passwordAlgo    = $row['password_algo'];
		$this->passwordLockedUntil = $row['password_locked_until'];
		$this->passwordFailedCount = $row['password_fail_count'  ];
		$this->type      = $row['auth_type'];
		$this->issuer    = $row['issuer'];

		if	( ! $this->fullname )
			$this->fullname = $this->name;
			
		if	( ! $this->style )
			$this->style = Configuration::get(['interface','style','default']);
	}



	/**
	 * Namen ermitteln.<br>
	 * Wenn "fullname" gefuellt, dann diesen benutzen, sonst den Benutzernamen.
	 */
	function getName()
	{
		if	( ! $this->fullname )
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
	public static function getUserName( $userid )
	{
		$db = Db::get();

		$sql = $db->sql( 'SELECT name FROM {{user}}'.
		                ' WHERE id={userid}' );
		$sql->setInt( 'userid',$userid );

		$name = $sql->getOne();
		
		if	( $name == '' )
			return Language::lang(Messages::UNKNOWN);
		else return $name;
	}


	/**
	 * Speichern Benutzer in der Datenbank.
	 */
	protected function save()
	{
		$sql = Db::sql( <<<SQL
                         UPDATE {{user}}
		                 SET name={name},
		                     fullname={fullname},
		                     tel     ={tel}     ,
		                     descr   ={desc}    ,
		                     mail    ={mail}    ,
		                     style   ={style}   ,
		                     style_scheme = {style_scheme},
		                     language = {language},
		                     timezone = {timezone},
		                     is_admin = {isAdmin},
		                     totp     = {totp},
		                     hotp     = {hotp},
		                     password_fail_count   = {fail_count},
		                     password_locked_until = {locked_until}
		                 WHERE id={userid}
SQL
 );
		$sql->setString ( 'name'    ,$this->name    );
		$sql->setString ( 'fullname',$this->fullname);
		$sql->setString ( 'tel'     ,$this->tel     );
		$sql->setString ( 'desc'    ,$this->desc    );
		$sql->setString ( 'mail'    ,$this->mail    );
		$sql->setString ( 'style'   ,$this->style   );
		$sql->setInt    ( 'style_scheme',$this->styleScheme );
		$sql->setStringOrNull( 'language',$this->language);
		$sql->setStringOrNull( 'timezone',$this->timezone);
		$sql->setBoolean( 'isAdmin' ,$this->isAdmin );
		$sql->setBoolean( 'totp'    ,$this->totp    );
		$sql->setBoolean( 'hotp'    ,$this->hotp    );
		$sql->setInt    ( 'userid'  ,$this->userid  );
		$sql->setInt    ( 'fail_count'  ,$this->passwordFailedCount  );
		$sql->setInt    ( 'locked_until',$this->passwordLockedUntil  );

		// Datenbankabfrage ausfuehren
		$sql->execute();
	}


	/**
	 * Benutzer hinzuf�gen
	 *
	 * @param String $name Benutzername
	 */
	public function add()
	{
		$sql = Db::sql( <<<SQL
	SELECT MAX(id) FROM {{user}}
SQL
		);
		$this->userid = intval($sql->getOne())+1;

		$sql = Db::sql( <<<SQL
	INSERT INTO {{user}}
		(id,name,password_hash,fullname,tel,mail,descr,style,is_admin,password_salt,auth_type,issuer)
		VALUES( {userid},{name},'','','','','','default',0,'',{type},{issuer} )
SQL
		);
		$sql->setInt         ('userid',$this->userid );
		$sql->setString      ('name'  ,$this->name   );
		$sql->setStringOrNull('issuer',$this->issuer );
		$sql->setString      ('type'  ,$this->type   );

		// Datenbankbefehl ausfuehren
		$sql->execute();
		
		$this->addNewUserGroups(); // Neue Gruppen hinzufuegen.
		
		$this->renewOTPSecret();
	}

	

	/**
	 * Enrich a new user with groups.
	 *
	 * Called from add()
	 */
	protected function addNewUserGroups()
	{
		$newUserConfig = Configuration::subset( ['security','newuser'] );
		$templateUser = $newUserConfig->get('copy_user');

		$userToCopy = null;

		if   ( is_int($templateUser)) {
			$userToCopy = new User( $templateUser );
			try {
				$userToCopy->load();
			} catch( ObjectNotFoundException $onfe) {
				$userToCopy = null;
			}
		}elseif ( is_string($templateUser)) {
			$userToCopy = User::loadWithName( $templateUser,User::AUTH_TYPE_INTERNAL );
		}

		if   ( $userToCopy ) {
			foreach( $userToCopy->getGroupIds() as $groupId ) {
				$this->addGroup( $groupId );
			}

			$this->fullname = $userToCopy->fullname;
			$this->desc     = $userToCopy->desc;
			$this->style    = $userToCopy->style;
			$this->mail     = $userToCopy->mail;
			$this->tel      = $userToCopy->tel;
			$this->language = $userToCopy->language;
			$this->timezone = $userToCopy->timezone;
		}


		foreach ( $newUserConfig->get('groups',[]) as $group) {

			if   ( is_int($group)) {
				$groupToAdd = new Group( $group );
				$groupToAdd->load();
				if   ( ! $groupToAdd->groupid )
					$groupToAdd = null;
			}
			elseif ( is_string($group)) {
				$groupToAdd = Group::loadWithName($group);
			}

			if   ( $groupToAdd )
				$this->addGroup( $groupToAdd->groupid );
		}
		
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
		$db = Db::get();

		// "Erzeugt von" f�r diesen Benutzer entfernen.
		$sql = $db->sql( 'UPDATE {{object}} '.
		                'SET create_userid=null '.
		                'WHERE create_userid={userid}' );
		$sql->setInt   ('userid',$this->userid );
		$sql->execute();

		// "Letzte �nderung von" f�r diesen Benutzer entfernen
		$sql = $db->sql( 'UPDATE {{object}} '.
		                'SET lastchange_userid=null '.
		                'WHERE lastchange_userid={userid}' );
		$sql->setInt   ('userid',$this->userid );
		$sql->execute();

		// Alle Archivdaten in Dateien mit diesem Benutzer entfernen
		$sql = $db->sql( 'UPDATE {{value}} '.
		                'SET lastchange_userid=null '.
		                'WHERE lastchange_userid={userid}' );
		$sql->setInt   ('userid',$this->userid );
		$sql->execute();

		// Alle Berechtigungen dieses Benutzers l?schen
		$sql = $db->sql( 'DELETE FROM {{acl}} '.
		                'WHERE userid={userid}' );
		$sql->setInt   ('userid',$this->userid );
		$sql->execute();

		// Alle Gruppenzugehoerigkeiten dieses Benutzers l?schen
		$sql = $db->sql( 'DELETE FROM {{usergroup}} '.
		                'WHERE userid={userid}' );
		$sql->setInt   ('userid',$this->userid );
		$sql->execute();

		// Delete all bookmarks
		$sql = $db->sql( 'DELETE FROM {{bookmark}} '.
		                'WHERE userid={userid}' );
		$sql->setInt   ('userid',$this->userid );
		$sql->execute();

		$this->deleteAllLoginTokens();
        // Benutzer loeschen
		$sql = $db->sql( 'DELETE FROM {{user}} '.
		                'WHERE id={userid}' );
		$sql->setInt   ('userid',$this->userid );
		$sql->execute();

		$this->userid = null;
	}


	/**
	 * Delete all Login tokens for this user.
	 *
	 * @throws \util\exception\DatabaseException
	 */
	public function deleteAllLoginTokens() {

		$stmt = Db::sql( <<<SQL
              DELETE FROM {{auth}}
               WHERE userid={userid}
SQL
		);
		$stmt->setInt   ('userid',$this->userid );
		$stmt->execute();
	}


	/**
	 * Ermitteln der Eigenschaften zu diesem Benutzer
	 *
	 * @return array Liste der Eigenschaften als assoziatives Array
	 */
	public function getProperties()
	{
	    return array_merge( parent::getProperties(), [
	    	'id'        => $this->userid,
			'is_admin'  => $this->isAdmin,
			'auth_type' => ($this->type==User::AUTH_TYPE_INTERNAL?'local':'remote')
		] );
	}



	/**
	 * Sets a new password for the user.
	 *
	 * if the user account was locked it will be unlocked.
	 * 
	 * @param $password string new password
	 * @param $forever int true, wenn Kennwort dauerhaft.
	 */
	public function setPassword($password, $forever = true )
	{
		$sql = DB::sql( <<<SQL
           UPDATE {{user}}
              SET password_hash={password}, password_algo={algo}, password_expires={expires}, password_fail_count=0, password_locked_until=NULL
		    WHERE id={userid}
SQL
		);
		if	( $forever ) {
			$algo   = Password::bestAlgoAvailable();
			$expire = null;
		}
		else {
			// cleartext-password, the user must change the password on the next login.
			$algo   = Password::ALGO_PLAIN;
			$expire = time();
		}

		// Hashsumme für Kennwort erzeugen
		$sql->setIntOrNull('expires',$expire);
		$sql->setInt   ('algo'    ,$algo                                                  );
		$sql->setString('password',Password::hash(Password::pepperPassword($password),$algo) );
		$sql->setInt   ('userid'  ,$this->userid  );

		$sql->execute(); // Updating the password

		// Delete all login tokens, because the user should
		// use the new password on all devices
		$this->deleteAllLoginTokens();
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
			$sql = DB::sql( <<<SQL
				SELECT {{group}}.id,{{group}}.name FROM {{group}}
			                LEFT JOIN {{usergroup}} ON {{usergroup}}.groupid={{group}}.id
			                WHERE {{usergroup}}.userid={userid}
SQL
			);
			$sql->setInt('userid',$this->userid );
			$this->groups = $sql->getAssoc();
		}
		
		return $this->groups;
	}



	/**
	 * Calculates the effective group list.
	 *
	 * @return array
	 */
	function getEffectiveGroups()
	{
		$groupIds = array_keys( $this->getGroups() );
		$effectiveGroupIds = $groupIds;

		foreach( $groupIds as $id ) {
			$group = new Group( $id );
			$group->load();
			$effectiveGroupIds = array_merge( $effectiveGroupIds,$group->getParentGroups() );
		}
		$effectiveGroupIds = array_unique( $effectiveGroupIds );

		return $effectiveGroupIds;
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
		$db = Db::get();

		$sql = $db->sql( 'SELECT {{group}}.id,{{group}}.name FROM {{group}}'.
		                '   LEFT JOIN {{usergroup}} ON {{usergroup}}.groupid={{group}}.id AND {{usergroup}}.userid={userid}'.
		                '   WHERE {{usergroup}}.userid IS NULL' );
		$sql->setInt('userid'  ,$this->userid );

		return $sql->getAssoc();
	}


	
	/**
	 * Benutzer zu einer Gruppe hinzufuegen.
	 * 
	 * @param $groupid int die Gruppen-Id
	 */
	function addGroup( $groupid )
	{
		$db = Db::get();

		$sql = $db->sql('SELECT MAX(id) FROM {{usergroup}}');
		$usergroupid = intval($sql->getOne())+1;

		$sql = $db->sql( 'INSERT INTO {{usergroup}} '.
		                '       (id,userid,groupid) '.
		                '       VALUES( {usergroupid},{userid},{groupid} )' );
		$sql->setInt('usergroupid',$usergroupid  );
		$sql->setInt('userid'     ,$this->userid );
		$sql->setInt('groupid'    ,$groupid      );

		$sql->execute();
	
	}


	
	/**
	 * Benutzer aus Gruppe entfernen.
	 * 
	 * @param $groupid int die Gruppen-Id
	 */
	function delGroup( $groupid )
	{
		$db = Db::get();

		$sql = $db->sql( 'DELETE FROM {{usergroup}} '.
		                '  WHERE userid={userid} AND groupid={groupid}' );
		$sql->setInt   ('userid'  ,$this->userid );
		$sql->setInt   ('groupid' ,$groupid      );

		$sql->execute();
	}
	

	/**
	 * Ermitteln aller Berechtigungen des Benutzers.<br>
	 * Diese Daten werden auf der Benutzerseite in der Administration angezeigt.
	 *
	 * @return array
	 */
	public function getAllAcls()
	{
		$groupClause = $this->getGroupClause();

		$sql = Db::sql( <<<SQL
			              SELECT    {{acl}}.*,
			                        {{object}}.projectid,
			                        {{language}}.name AS languagename
			                   FROM {{acl}}
		                  LEFT JOIN {{object}}
		                         ON {{object}}.id={{acl}}.objectid
		                  LEFT JOIN {{language}}
		                         ON {{language}}.id={{acl}}.languageid
		                  WHERE ( 
										{{acl}}.type = {usertype}  AND {{acl}}.userid={userid}
									 OR {{acl}}.type = {grouptype} AND ($groupClause) 
									 OR {{acl}}.type = {alltype}
									 OR {{acl}}.type = {guesttype}
						  )
		                  ORDER BY {{object}}.projectid,{{acl}}.languageid
SQL
		);
		$sql->setInt( 'userid'   ,$this->userid                );
		$sql->setInt( 'usertype' ,Permission::TYPE_USER  );
		$sql->setInt( 'grouptype',Permission::TYPE_GROUP );
		$sql->setInt( 'alltype'  ,Permission::TYPE_AUTH  );
		$sql->setInt( 'guesttype',Permission::TYPE_GUEST );

		$aclList = array();

		foreach($sql->getAll() as $row )
		{
			$permission = new Permission();
			$permission->setDatabaseRow( $row );
			$permission->projectid    = $row['projectid'   ];
			if	( intval($permission->languageid) == 0 )
				$permission->languagename = Language::lang( Messages::ALL_LANGUAGES);
			else
				$permission->languagename = $row['languagename'];
			$aclList[] = $permission;
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
	 * Ermitteln aller zur Verfuegung stehenden Stylesheets
	 * @return array
	 */
	public function getAvailableStyles()
	{
		return array_map( function($styleConfig) {
			return $styleConfig->get('name','');
		},Configuration::subset('style')->subsets());
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
		$db = Db::get();
		// Laden des Benutzers aus der Datenbank, um Password-Hash zu ermitteln.
		$sql = $db->sql( 'SELECT * FROM {{user}}'.
			' WHERE id={userid}' );
		$sql->setInt( 'userid',$this->userid );
		$row_user = $sql->getRow();
		
		// Pruefen ob Kennwort mit Datenbank uebereinstimmt.
		return Password::check(Password::pepperPassword($password),$row_user['password_hash'],$row_user['password_algo']);
	}
	


	/**
	 * Ermittelt projektübergreifend die letzten Änderungen des Benutzers.
	 *
	 * @return array <string, unknown>
	 */
	public function getLastChanges()
	{
		$db = Db::get();
	
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
	 * Erzeugt ein neues OTP-Secret.
	 */
	public function renewOTPSecret() {
	    
	    $secret = Password::randomHexString(64);
	    
	    $stmt = DB::sql('UPDATE {{user}} SET otp_secret={secret} WHERE id={id}');
	    
	    $stmt->setString( 'secret', $secret       );
	    $stmt->setInt   ( 'id'    , $this->userid );
	    
	    $stmt->execute();
	}


	public function getId()
	{
		return $this->userid;
	}


}

