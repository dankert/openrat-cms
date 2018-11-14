<?php

namespace cms\action;


use cms\model\User;
use cms\model\Project;
use cms\model\Group;
use cms\model\Value;
use cms\model\Element;
use cms\model\Page;
use cms\model\BaseObject;
use cms\model\Language;
use cms\model\Model;


use \database\Database;
use \DB;
use \DbUpdate;
use \Exception;
use \Http;
use \InternalAuth;
use \Logger;
use \ObjectNotFoundException;
use \OpenRatException;
use \security\Password;
use \Session;
use \Html;
use \Mail;
use \Text;


// OpenRat Content Management System
// Copyright (C) 2002-2007 Jan Dankert, jandankert@jandankert.de
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; version 2.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.


define('PROJECTID_ADMIN',-1);

/**
 * Action-Klasse fuer die Start-Action
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */

class LoginAction extends Action
{
	public $security = SECURITY_GUEST;


	public function __construct()
    {
        parent::__construct();
    }

    /**
     * Eine Datenbankverbindugn wird aufgebaut und initalisiert.
     *
     * @param $dbid Datenbank-Id
     * @throws OpenRatException
     */
	private function setDb( $dbid )
	{
		global $conf;

		if	( !isset($conf['database'][$dbid] ))
			throw new \LogicException( 'unknown DB-Id: '.$dbid );
			
		$db = db_connection();
		if	( is_object($db) )
        {
			$db->rollback();
			$db->disconnect(); // Bäm. Dies. ist. notwenig. WTF.
			//$db = null;
            //Session::setDatabase( null );
        }

        try
        {
            $db = new Database( $conf['database'][$dbid] );
            $db->id = $dbid;
            $db->start(); // Transaktion starten.
            Session::setDatabase( $db );
        }catch(\Exception $e)
        {
            throw new OpenRatException('DATABASE_ERROR_CONNECTION',$e->getMessage() );
        }
	}


    /**
     * Prueft, ob der Parameter 'dbid' übergeben wurde.
     * @throws OpenRatException
     */
	function checkForDb()
	{
		global $conf;
		$dbid = $this->getRequestVar('dbid'); 

		if	( $dbid != '' )
			$this->setDb( $dbid );
	}


    /**
     * @throws OpenRatException
     */
    function setDefaultDb()
	{
		if	( $this->hasRequestVar(REQ_PARAM_DATABASE_ID) )
		{
			$dbid = $this->getRequestVar(REQ_PARAM_DATABASE_ID);
		}
		else
		{
			global $conf;
	
			if	( !isset($conf['database']['default']) )
				throw new \LogicException('default-database not set');
	
			$dbid = $conf['database']['default'];
		}

		$this->setDb( $dbid );
	}


    /**
     * Führt ein Login durch.
     * @param $name string Benutzername
     * @param $pw string Password
     * @param $pw1 string new Password
     * @param $pw2 string new Password repeated
     * @return bool
     * @throws ObjectNotFoundException
     */
    private function checkLogin($name, $pw, $pw1, $pw2 )
	{
		Logger::debug( "Login user: '$name'.'" );
	
		global $conf;
		global $SESS;
	
		unset( $SESS['user'] );	
	
		
		$db = db_connection();
		
		if	( !is_object($db) )
		{
			$this->addNotice('database','','DATABASE_CONNECTION_ERROR',OR_NOTICE_ERROR,array(),array('no connection'));
			//$this->callSubAction('showlogin');
			return false;
		}
		
		if	( !$db->available )
		{
			$this->addNotice('database',$db->conf['description'],'DATABASE_CONNECTION_ERROR',OR_NOTICE_ERROR,array(),array('Database Error: '.$db->error));
			//$this->callSubAction('showlogin');
			return false;
		}
		
		$ip = getenv("REMOTE_ADDR");
	
		$user = new User();
		$user->name = $name;
		
		$ok = $user->checkPassword( $pw );
		
		$mustChangePassword = $user->mustChangePassword;
		
		if	( $mustChangePassword )
		{
			// Der Benutzer hat zwar ein richtiges Kennwort eingegeben, aber dieses ist abgelaufen.
			// Wir versuchen hier, das neue zu setzen (sofern eingegeben).
			if	( empty($pw1) )
			{
			}
			elseif	( $pw1 != $pw2 )
			{
				$this->addValidationError('password1','PASSWORDS_DO_NOT_MATCH');
				$this->addValidationError('password2','');
			}
			elseif	( strlen($pw2) < $conf['security']['password']['min_length'] )
			{
				$this->addValidationError('password1','PASSWORD_MINLENGTH',array('minlength'=>$conf['security']['password']['min_length']));
				$this->addValidationError('password2','');
			}
			else
			{
				// Kennw?rter identisch und lang genug.
				$user->setPassword( $pw1,true );
				
				// Das neue Kennwort ist gesetzt, die Anmeldung ist also doch noch gelungen. 
				$ok = true;
				$mustChangePassword = false;
				
				$pw = $pw1;
			}
		}
		
		// Falls Login erfolgreich
		if  ( $ok )
		{
			// Login war erfolgreich!
			$user->load();
			$user->setCurrent();
			
			if ($user->passwordAlgo != Password::bestAlgoAvailable() )
    			// Re-Hash the password with a better hash algo.
			    $user->setPassword($pw);
			
			
			Logger::info( "login successful for {$user->name} from IP $ip" );

			return true;
		}
		else
		{
			Logger::info( "login failed for user {$user->name} from IP $ip" );

			return false;
		}
	}


    /**
     * Anzeigen der Loginmaske.
     *
     * Es wird nur die Loginmaske angezeigt.
     * @throws OpenRatException
     */
    function loginView()
    {
        // Hier nie "304 not modified" setzen, da sonst keine
        // Login-Fehlermeldung erscheinen kann.
        global $conf;

        $sso = $conf['security']['sso'];
        $ssl = $conf['security']['ssl'];

        $ssl_trust    = false;
        $ssl_user_var = '';
        extract( $ssl, EXTR_PREFIX_ALL, 'ssl' );

        if	( $sso['enable'] )
        {
            $authid = $this->getRequestVar( $sso['auth_param_name']);

            if	( empty( $authid) )
                throw new \SecurityException( 'no authorization data (no auth-id)');

            if	( $sso['auth_param_serialized'] )
                $authid = unserialize( $authid );

            $purl = parse_url($sso['url']);
            // Verbindung zu URL herstellen.
            $errno=0; $errstr='';
            $fp = fsockopen ($purl['host'],80, $errno, $errstr, 30);
            if	( !$fp )
            {
                echo "Connection failed: $errstr ($errno)";
            }
            else
            {
                $http_get = $purl['path'];
                if	( !empty($purl['query']) )
                    $http_get .= '?'.$purl['query'];

                $header = array();

                $header[] = "GET $http_get HTTP/1.0";
                $header[]  ="Host: ".$purl['host'];
                $header[] = "User-Agent: Mozilla/5.0 (OpenRat CMS Single Sign-on Check)";
                $header[] = "Connection: Close";

                if	( $sso['cookie'] )
                {
                    $cookie = 'Cookie: ';
                    if	( is_array($authid))
                        foreach( $authid as $cookiename=>$cookievalue)
                            $cookie .= $cookiename.'='.$cookievalue."; ";
                    else
                        $cookie .= $sso['cookie_name'].'='.$authid;

                    $header[] = $cookie;
                }

//				Html::debug($header);
                fputs ($fp, implode("\r\n",$header)."\r\n\r\n");

                $inhalt=array();
                while (!feof($fp)) {
                    $inhalt[] = fgets($fp,128);
                }
                fclose($fp);

                $html = implode('',$inhalt);
//				Html::debug($html);
                if	( !preg_match($sso['expect_regexp'],$html) )
                    throw new \SecurityException('auth failed');
                $treffer=0;
                if	( !preg_match($sso['username_regexp'],$html,$treffer) )
                    throw new \SecurityException('auth failed');
                if	( !isset($treffer[1]) )
                    throw new \SecurityException('authorization failed');

                $username = $treffer[1];

//				Html::debug( $treffer );
                $this->setDefaultDb();

                $user = User::loadWithName( $username );

                if	( ! $user->isValid( ))
                    throw new \SecurityException('authorization failed: user not found: '.$username);

                $user->setCurrent();

                $this->callSubAction('show');
            }
        }

        elseif	( $ssl_trust )
        {
            if	( empty($ssl_user_var) )
                throw new \LogicException( 'please set environment variable name in ssl-configuration.' );

            $username = getenv( $ssl_user_var );

            if	( empty($username) )
                throw new \SecurityException( 'no username in client certificate ('.$ssl_user_var.') (or there is no client certificate...?)' );

            $this->setDefaultDb();

            $user = User::loadWithName( $username );

            if	( !$user->isValid() )
                throw new \LogicException( 'unknown username: '.$username );

            $user->setCurrent();

            $this->callSubAction('show');
        }

        $dbids = array();

        $databases = Conf()->get('database');

        if   ( !is_array($databases))
            throw new \LogicException("Corrupt configuration: Databases configuration must be an array.");


        foreach( $databases as $dbid => $dbconf )
        {
            if   ( !is_array($dbconf))
                throw new \LogicException("Corrup configuration: Database configuration '".$dbid."' must be an array.'");

            $dbconf += $conf['database-default']['defaults']; // Add Default-Values

            if	( is_array($dbconf) && $dbconf['enabled'] ) // Database-Connection is enabled
                $dbids[$dbid] = array(
                    'key'   => $dbid,
                    'value' => empty($dbconf['name']) ? $dbid : Text::maxLength($dbconf['name']),
                    'title' => $dbconf['description']
                );
        }


        if	( empty($dbids) )
            $this->addNotice('','','no_database_configuration',OR_NOTICE_WARN);

        if	( !isset($this->templateVars['login_name']) && isset($_COOKIE['or_username']) )
            $this->setTemplateVar('login_name',$_COOKIE['or_username']);

        if	( !isset($this->templateVars['login_name']) )
            $this->setTemplateVar('login_name',@$conf['security']['default']['username']);

        if	( @$this->templateVars['login_name']== @$conf['security']['default']['username'])
            $this->setTemplateVar('login_password',@$conf['security']['default']['password']);

        $this->setTemplateVar( 'dbids',$dbids );

        // Vorausgewählte Datenbank-Id ermiteln
        $db = Session::getDatabase();
        if	( is_object($db) )
            // Datenbankverbindung ist noch in Sitzung, diese verwenden.
            $this->setTemplateVar('dbid',$db->id);
        elseif  ( isset($_COOKIE['or_dbid']) && isset($dbids[$_COOKIE['or_dbid']]) )
            // DB-Id aus dem Cookie lesen.
            $this->setTemplateVar('dbid',$_COOKIE['or_dbid'] );
        elseif  ( ! empty($conf['database-default']['default-id'])  && isset($dbids[$conf['database-default']['default-id']]))
            // Default-Datenbankverbindung ist konfiguriert und vorhanden.
            $this->setTemplateVar('dbid',$conf['database-default']['default-id']);
        elseif  ( count($dbids) > 0)
            // Datenbankverbindungen sind vorhanden, wir nehmen die erste.
            $this->setTemplateVar('dbid',array_keys($dbids)[0]);
        else
            // Keine Datenbankverbindung vorhanden. Fallback:
            $this->setTemplateVar('dbid','');


        // Den Benutzernamen aus dem Client-Zertifikat lesen und in die Loginmaske eintragen.
        $ssl_user_var = $conf['security']['ssl']['client_cert_dn_env'];
        if	( !empty($ssl_user_var) )
        {
            $username = getenv( $ssl_user_var );

            if	( empty($username) )
            {
                // Nothing to do.
                // if user has no valid client cert he could not access this form.
            }
            else {

                // Benutzername ist in Eingabemaske unver�nderlich
                $this->setTemplateVar('force_username',true);
                $this->setTemplateVar('login_name'    ,$username);
            }

        }

        $this->setTemplateVar('objectid'  ,$this->getRequestVar('objectid'  ,OR_FILTER_NUMBER) );
        $this->setTemplateVar('projectid' ,$this->getRequestVar('projectid' ,OR_FILTER_NUMBER) );
        $this->setTemplateVar('modelid'   ,$this->getRequestVar('modelid'   ,OR_FILTER_NUMBER) );
        $this->setTemplateVar('languageid',$this->getRequestVar('languageid',OR_FILTER_NUMBER) );

        $this->setTemplateVar('register'     ,$conf['login'   ]['register' ]);
        $this->setTemplateVar('send_password',$conf['login'   ]['send_password']);

        // Versuchen, einen Benutzernamen zu ermitteln, der im Eingabeformular vorausgewählt wird.
        $modules = explode(',',$conf['security']['modules']['preselect']);

        $username = '';
        foreach( $modules as $module)
        {
            Logger::debug('Preselecting module: '.$module);
            $moduleClass = $module.'Auth';
            /** @var \Auth $auth */
            $auth = new $moduleClass;
            $username = $auth->username();

            if	( !empty($username) )
            {
                Logger::debug('Preselecting User '.$username);
                break; // Benutzername gefunden.
            }
        }

        $this->setTemplateVar('login_name',$username);
    }



    /**
	 * Anzeigen der Loginmaske.
	 *
	 * Es wird nur die Loginmaske angezeigt.
	 * Hier nie "304 not modified" setzen, da sonst keine
	 * Login-Fehlermeldung erscheinen kann
	 */
	function openidView()
	{
		global $conf;

		foreach( $conf['database'] as $dbname=>$dbconf )
		{
			if	( is_array($dbconf) && $dbconf['enabled'] )
				$dbids[$dbname] = array('key'  =>$dbname,
				                        'value'=>Text::maxLength($dbconf['description']),
				                        'title'=>$dbconf['description'].(isset($dbconf['host'])?' ('.$dbconf['host'].')':'') );
		}

		$openid_provider = array();
		foreach( explode(',',$conf['security']['openid']['provider']['name']) as $provider )
			$openid_provider[$provider] = config('security','openid','provider.'.$provider.'.name');
		$this->setTemplateVar('openid_providers',$openid_provider);
		$this->setTemplateVar('openid_user_identity',config('security','openid','user_identity'));
		//$this->setTemplateVar('openid_provider','identity');


		if	( empty($dbids) )
			$this->addNotice('','','no_database_configuration',OR_NOTICE_WARN);

		if	( !isset($_COOKIE['or_username']) )
			$this->setTemplateVar('login_name',$_COOKIE['or_username']);
		else
			$this->setTemplateVar('login_name',$conf['security']['default']['username']);

		$this->setTemplateVar( 'dbids',$dbids );

		$db = Session::getDatabase();
		if	( is_object($db) )
			$this->setTemplateVar('actdbid',$db->id);
		else
			$this->setTemplateVar('actdbid',$conf['database']['default']);

		$this->setTemplateVar('objectid'  ,$this->getRequestVar('objectid'  ,OR_FILTER_NUMBER) );
		$this->setTemplateVar('projectid' ,$this->getRequestVar('projectid' ,OR_FILTER_NUMBER) );
		$this->setTemplateVar('modelid'   ,$this->getRequestVar('modelid'   ,OR_FILTER_NUMBER) );
		$this->setTemplateVar('languageid',$this->getRequestVar('languageid',OR_FILTER_NUMBER) );

	}



    /**
	 * Erzeugt ein Projekt-Auswahlmenue.
	 */
	function projectmenu()
	{
		$user = Session::getUser();
		
		if	( $user->mustChangePassword ) 
		{
			$this->addNotice( 'user',$user->name,'PASSWORD_TIMEOUT','warn' );
			$this->callSubAction( 'changepassword' ); // Zwang, das Kennwort zu ?ndern.
		}
		

		// Diese Seite gilt pro Sitzung. 
		$this->lastModified( $user->loginDate );

		// Projekte ermitteln
		$projects = $user->projects;

		$list     = array();
		
		foreach( $projects as $id=>$name )
		{
			$p = array();
			$p['url' ] = Html::url('index','project',$id);
			$p['name'] = $name;
			$p['id'  ] = $id;

			$tmpProject = new Project( $id );
			$p['defaultmodelid'   ] = $tmpProject->getDefaultModelId();
			$p['defaultlanguageid'] = $tmpProject->getDefaultLanguageId();
			$p['models'           ] = $tmpProject->getModels();
			$p['languages'        ] = $tmpProject->getLanguages();
			
			$list[] = $p;
		}

		$this->setTemplateVar('projects',$list);
		
		if	( empty($list) )
		{
			// Kein Projekt vorhanden. Eine Hinweismeldung ausgeben.
			if	( $this->userIsAdmin() )
				// Administratoren bekommen bescheid, dass sie ein Projekt anlegen sollen
				$this->addNotice('','','ADMIN_NO_PROJECTS_AVAILABLE',OR_NOTICE_WARN);
			else
				// Normale Benutzer erhalten eine Meldung, dass kein Projekt zur Verf?gung steht
				$this->addNotice('','','NO_PROJECTS_AVAILABLE',OR_NOTICE_WARN);
		}
		
	}



	/**
	 * Erzeugt eine Anwendungsliste.
	 */
	function applications()
	{
		global $conf;
		
		// Diese Seite gilt pro Sitzung. 
		$user       = Session::getUser();
		$userGroups = $user->getGroups();
		$this->lastModified( $user->loginDate );

		// Applikationen ermitteln
		$list = array();
		foreach( $conf['applications'] as $id=>$app )
		{
			if	( !is_array($app) )
				continue;
				
			if	( isset($app['group']) )
				if	( !in_array($app['group'],$userGroups) )
					continue; // Keine Berechtigung, da Benutzer nicht in Gruppe vorhanden.
					
			$p = array();
			$p['url']         = $app['url'];
			$p['description'] = @$app['description'];
			if	( isset($app['param']) )
			{
				$p['url'] .= strpos($p['url'],'?')!==false?'&':'?';
				$p['url'] .= $app['param'].'='.session_id();
			}
			$p['name'] = $app['name'];
			
			$list[] = $p;
		}


		$this->setTemplateVar('applications',$list);
	}

	


	/**
	 * Open-Id Login, ?berpr?fen der Anmeldung.<br>
	 * Spezifikation: http://openid.net/specs/openid-authentication-1_1.html<br>
	 * Kapitel "4.4. check_authentication"<br>
	 * <br>
	 * Im 2. Schritt (Mode "id_res") erfolgte ein Redirect vom Open-Id Provider an OpenRat zur?ck.<br>
	 * Wir befinden uns nun im darauf folgenden Request des Browsers.<br>
	 * <br>
	 * Es muss noch beim OpenId-Provider die Best?tigung eingeholt werden, danach ist der
	 * Benutzer angemeldet.<br>
	 */
	public function openidloginView()
	{
		global $conf;
		$openId = Session::get('openid');

		if	( !$openId->checkAuthentication() )
		{
			throw new \SecurityException('OpenId-Login failed' );
			die();
			$this->addNotice('user',$openId->user,'LOGIN_OPENID_FAILED',OR_NOTICE_ERROR,array('name'=>$openId->user),array($openId->error) );
			$this->addValidationError('openid_url','');
			$this->callSubAction('showlogin');
			return;
		}
		
		//Html::debug($openId);
		
		// Anmeldung wurde mit "is_valid:true" best?tigt.
		// Der Benutzer ist jetzt eingeloggt.
		$username = $openId->getUserFromIdentiy();
		
		Logger::debug("OpenId-Login successful for $username");
		
		if	( empty($username) )
		{
			// Es konnte kein Benutzername ermittelt werden.
			throw new \SecurityException('no username supplied by openid provider' );
			die();
			$this->addNotice('user',$username,'LOGIN_OPENID_FAILED','error',array('name'=>$username) );
			$this->addValidationError('openid_url','');
			$this->callSubAction('showlogin');
			return;
		}
		
		$user = User::loadWithName( $username );
		
		if	( $user->userid <=0)
		{
			// Benutzer ist (noch) nicht vorhanden.
			if	( $conf['security']['openid']['add'])  // Anlegen?
			{
				$user->name     = $username;
				$user->add();

				$user->mail     = @$openId->info['email'];
				$user->fullname = @$openId->info['fullname'];
				$user->save();  // Um E-Mail zu speichern (wird bei add() nicht gemacht)
			}
			else
			{
				Logger::debug("OpenId-Login failed for $username");
				// Benutzer ist nicht in Benutzertabelle vorhanden (und angelegt werden soll er auch nicht).
				throw new \SecurityException('user',$username,'LOGIN_OPENID_FAILED','error',array('name'=>$username) );
				die();
				
				$this->addNotice('user',$username,'LOGIN_OPENID_FAILED','error',array('name'=>$username) );
				$this->addValidationError('openid_url','');
				return;
			}
		}
		else
		{
			// Benutzer ist bereits vorhanden.
			if	( @$conf['security']['openid']['update_user'])
			{
				$user->fullname = @$openId->info['fullname'];
				$user->mail     = @$openId->info['email'];
				$user->save();
			}
		}

		Logger::info("User login successful: ".$username);
		$user->setCurrent();  // Benutzer ist jetzt in der Sitzung.
		
		$this->setStyle( $user->style );

		$server = Http::getServer();
		Logger::debug("Redirecting to $server");
		header('Location: '.slashify($server) );
		exit();
	}
	

	/**
	 * Login.
	 */
	function openidPost()
	{
		global $conf;

		$this->checkForDb();
		Session::setUser('');
		
		if	( $conf['login']['nologin'] )
			throw new \SecurityException('login disabled');

		$openid_user   = $this->getRequestVar('openid_url'    );
		$loginName     = $this->getRequestVar('login_name'    ,OR_FILTER_ALPHANUM);
		$loginPassword = $this->getRequestVar('login_password',OR_FILTER_ALPHANUM);
		$newPassword1  = $this->getRequestVar('password1'     ,OR_FILTER_ALPHANUM);
		$newPassword2  = $this->getRequestVar('password2'     ,OR_FILTER_ALPHANUM);
		
		// Cookie setzen
		$this->setCookie('or_username',$loginName );
		
		// Login mit Open-Id.
		if	( $this->hasRequestVar('openid_provider') && ($this->getRequestVar('openid_provider') != 'identity' || !empty($openid_user)) )
		{
			$openId = new OpenId($this->getRequestVar('openid_provider'),$openid_user);
			
			if	( ! $openId->login() )
			{
				$this->addNotice('user',$openid_user,'LOGIN_OPENID_FAILED','error',array('name'=>$openid_user),array($openId->error) );
				$this->addValidationError('openid_url','');
				$this->callSubAction('showlogin');
				return;
			}
			
			Session::set('openid',$openId);
			$this->redirect( $openId->getRedirectUrl() );
			return;
		}
	}


    /**
     * Synchronisiert die bisherigen Gruppen des Benutzers mit den Gruppen, die sich aus der Authentifzierung ergeben haben.
     *
     * @param $user User Benutzerobjekt
     * @param $groups array $groups Einfaches Array von Gruppennamen.
     */
	private function checkGroups($user, $groups)
	{
		if	( $groups == null )
			return;

		$oldGroups = $user->getGroups();
		
		foreach( $oldGroups as $id=>$name)
		{
			if	( !in_array($name,$groups) )
				$user->delGroup($id);
		}
		
		foreach( $groups as $name)
		{
			if	( ! in_array($name,$oldGroups))
			{
				try
				{
					$group = Group::loadWithName( $name );
					$user->addGroup($group->groupid);
				}
				catch (ObjectNotFoundException $e)
				{
					// Gruppe fehlt. Anlegen?
					if	( config('ldap','authorize','auto_add' ) )
					{
						// Die Gruppe in der OpenRat-Datenbank hinzufuegen.
						$g = new Group();
						$g->name = $group;
						$g->add(); // Gruppe hinzufuegen
						$user->addGroup($g->groupid); // Und Gruppe dem Benutzer hinzufuegen.
					}
					
				}
			}
		}
	}

	
	/**
	 * Login.
	 * Zuerst wird die Datenbankverbindung aufgebaut und falls notwendig, aktualisiert.
	 */
	function loginPost()
	{
		global $conf;

        Logger::info("DBID: ".$this->getRequestVar('dbid'));
		if	( $this->hasRequestVar('dbid'))
		{
			$dbid = $this->getRequestVar('dbid');
			
			if   ( !is_array($conf['database'][$dbid]) )
			    $this->addValidationError('dbid');

            $this->updateDatabase($dbid); // Updating...
		}
		
		$this->checkForDb();
		
		Session::setUser(''); // Altes Login entfernen.
		
		if	( $conf['login']['nologin'] )
			throw new \SecurityException('login disabled');

		$loginName     = $this->getRequestVar('login_name'    ,OR_FILTER_ALPHANUM);
		$loginPassword = $this->getRequestVar('login_password',OR_FILTER_ALPHANUM);
		$newPassword1  = $this->getRequestVar('password1'     ,OR_FILTER_ALPHANUM);
		$newPassword2  = $this->getRequestVar('password2'     ,OR_FILTER_ALPHANUM);
		$token         = $this->getRequestVar('user_token'    ,OR_FILTER_ALPHANUM);

		// Der Benutzer hat zwar ein richtiges Kennwort eingegeben, aber dieses ist abgelaufen.
		// Wir versuchen hier, das neue zu setzen (sofern eingegeben).
		if	( empty($newPassword1) )
		{
			// Kein neues Kennwort,
			// nichts zu tun...
		}
		else
		{
			$auth = new InternalAuth();
			
			if	( $auth->login($loginName, $loginPassword,$token) || $auth->mustChangePassword )
			{
				if	( $newPassword1 != $newPassword2 )
				{
					$this->addValidationError('password1','PASSWORDS_DO_NOT_MATCH');
					$this->addValidationError('password2','');
					return;
				}
				elseif	( strlen($newPassword1) < $conf['security']['password']['min_length'] )
				{
					$this->addValidationError('password1','PASSWORD_MINLENGTH',array('minlength'=>$conf['security']['password']['min_length']));
					$this->addValidationError('password2','');
					return;
				}
				else
				{
					// Kennwoerter identisch und lang genug.
					$user = User::loadWithName($loginName);
					$user->setPassword( $newPassword1,true );
					
					// Das neue gesetzte Kennwort für die weitere Authentifizierung benutzen.
					$loginPassword = $newPassword1;
				}
			}
			else
			{
				// Anmeldung gescheitert.
				$this->addNotice('user',$loginName,'LOGIN_FAILED','error',array('name'=>$loginName) );
				$this->addValidationError('login_name'    ,'');
				$this->addValidationError('login_password','');
				return;
			}
		}
		
		// Cookie setzen
		$this->setCookie('or_username',$loginName );
		$this->setCookie('or_dbid'    ,$this->getRequestVar('dbid'));

		// Authentifzierungs-Module.
		$modules = explode(',',$conf['security']['modules']['authenticate']);
		
		$loginOk            = false;
		$mustChangePassword = false;
		$tokenFailed        = false;
		$groups             = null;
		$lastModule         = null;
		
		// Jedes Authentifizierungsmodul durchlaufen, bis ein Login erfolgreich ist.
		foreach( $modules as $module)
		{
			$moduleClass = $module.'Auth';
			$auth        = new $moduleClass;
			Logger::info('Trying to login with module '.$moduleClass);
			$loginStatus = $auth->login( $loginName,$loginPassword, $token );
			$loginOk     = $loginStatus === true || $loginStatus === OR_AUTH_STATUS_SUCCESS;
			
			if   ( $loginStatus === OR_AUTH_STATUS_PW_EXPIRED )
				$mustChangePassword = true;
			if   ( $loginStatus === OR_AUTH_STATUS_TOKEN_NEEDED )
				$tokenFailed = true;
				
			if	( $loginOk )
			{
				Logger::info('Login successful for '.$loginName);
				$lastModule = $module;
				
				if	( isset($auth->groups ) )
					$groups = $auth->groups;
					
				break; // Login erfolgreich, erstes Modul gewinnt.
			}
		}
		
		/*
		$loginOk = $this->checkLogin( $loginName,
		                              $loginPassword,
		                              $newPassword1,
		                              $newPassword2 );
		*/
		
		
		if	( $loginOk )
		{
			
			try
			{
				// Benutzer über den Benutzernamen laden.
				$user = User::loadWithName($loginName);
				$user->loginModuleName = $lastModule;
// 				Session::setUser($user);
                $user->setCurrent();
                
                if ($user->passwordAlgo != Password::bestAlgoAvailable() )
                    // Re-Hash the password with a better hash algo.
                    $user->setPassword($loginPassword);
                
			}
			catch( ObjectNotFoundException $ex )
			{
				// Benutzer wurde zwar authentifiziert, ist aber in der
				// internen Datenbank nicht vorhanden
				if	( $conf['security']['newuser']['autoadd'] )
				{
					// Neue Benutzer in die interne Datenbank uebernehmen.
					$user = new User();
					$user->name     = $loginName;
					$user->fullname = $loginName;
					$user->add();
					$user->save();
				}
				else
				{
	 				// Benutzer soll nicht angelegt werden.
					// Daher ist die Anmeldung hier gescheitert.
					$loginOk = false;
				}				
			}			
		}
		
		Password::delay();
		
	    $ip = getenv("REMOTE_ADDR");
		
		if	( !$loginOk )
		{
			// Anmeldung nicht erfolgreich
			
			Logger::debug("Login failed for user '$loginName' from IP $ip");
			
			if	( $tokenFailed )
			{
				// Token falsch.
				$this->addNotice('user',$loginName,'LOGIN_FAILED_TOKEN_FAILED','error' );
				$this->addValidationError('user_token','');
			}
			elseif	( $mustChangePassword )
			{
				// Anmeldung gescheitert, Benutzer muss Kennwort ?ndern.
				$this->addNotice('user',$loginName,'LOGIN_FAILED_MUSTCHANGEPASSWORD','error' );
				$this->addValidationError('password1','');
				$this->addValidationError('password2','');
			}
			else
			{
				// Anmeldung gescheitert.
				$this->addNotice('user',$loginName,'LOGIN_FAILED','error',array('name'=>$loginName) );
				$this->addValidationError('login_name'    ,'');
				$this->addValidationError('login_password','');
			}

			
			//$this->callSubAction('login');
			return;
		}
		else
		{
		    
			Logger::debug("Login successful for user '$loginName' from IP $ip");

			$this->checkGroups( $user, $groups );	

			if	( $this->hasRequestVar('remember') )
			{
				// Cookie setzen
				$this->setCookie('or_username',$user->name         );
                $this->setCookie('or_token'   ,$user->loginToken() );
			}
				
			// Anmeldung erfolgreich.
			if	( config('security','renew_session_login') )
				$this->recreateSession();
			
			$this->addNotice('user',$user->name,'LOGIN_OK',OR_NOTICE_OK,array('name'=>$user->fullname));
			
			$this->setStyle( $user->style ); // Benutzer-Style setzen

            $config = Session::getConfig();
            $language = new \language\Language();
            $config['language'] = $language->getLanguage($user->language);
            $config['language']['language_code'] = $user->language;
            Session::setConfig( $config );

			
			
			// Entscheiden, welche Perspektive als erstes angezeigt werden soll.
			
			$allProjects = Project::getAllProjects();
		}
		
	}


	/**
	 * Benutzer meldet sich ab.
	 */
	function logoutPost()
	{
		global $conf;
		
		$user = Session::getUser();
		if	( is_object($user) )
			$this->setTemplateVar('login_username',$user->name);
		
		if	( config('security','renew_session_logout') )
			$this->recreateSession();

		session_unset();
		
		if	( @$conf['theme']['compiler']['compile_at_logout'] )
		{
			foreach( $conf['action'] as $actionName => $actionConfig )
			{
				foreach( $actionConfig as $subActionName=>$subaction )
				{
					if	( is_array($subaction) &&
						  !isset($subaction['goto'  ]) && 
						  !isset($subaction['direct']) &&
						  !isset($subaction['action']) &&
						  !isset($subaction['async' ]) &&
						  !isset($subaction['alias' ]) &&
						  $subActionName != 'menu'            )
					{
						$engine = new template_engine\TemplateEngine();
						$engine->compile( strtolower(str_replace('Action','',$actionName)).'/'.$subActionName);
					}
				}
			}
		}
		
		// Login-Token löschen:
		// Wenn der Benutzer sich abmelden will, dann soll auch die automatische
		// Anmeldung deaktiviert werden.
        $this->setCookie('or_token'   ,null );
		
		// Umleiten auf eine definierte URL.s
		$redirect_url = @$conf['security']['logout']['redirect_url'];

		if	( !empty($redirect_url) )
		{
			$this->redirect($redirect_url);
		}

		// Style zurücksetzen.
		// Der Style des Benutzers koennte auch stehen bleiben. Aber dann gäbe es Rückschlüsse darauf, wer zuletzt angemeldet war (Sicherheit!).
		$this->setStyle( config('interface','style','default') );
	}

	
	
	/**
	 * Benutzer meldet sich ab.
	 */
	function logoutView()
	{
	}
	

	/**
	 * Ausgeben von maschinenlesbaren Benutzerinformationen.
	 * 
	 * Diese Funktion dient dem Single-Signon f?r fremde Anwendungen, welche
	 * die Benutzerinformationen des angemeldeten Benutzers aus dieser
	 * Anwendung auslesen k?nnen.
	 */
	function userinfo()
	{
		$user = Session::getUser();
		$info = array('username'   => $user->name,
		              'fullname'   => $user->fullname,
		              'mail'       => $user->mail,
		              'telephone'  => $user->tel,
		              'style'      => $user->style,
		              'admin'      => $user->isAdmin?'true':'false',
		              'ldap'       => $user->ldap_dn,
		              'groups'     => implode(',',$user->getGroups()),
		              'description'=> $user->desc
		             );
		        
		// Wenn der HTTP-Parameter "xml" vorhanden ist, dann geben wir die
		// Informationen per XML aus.     
		if	( $this->hasRequestVar('xml') )
		{
			header('Content-Type: text/xml');
			echo '<userinfo>';
			foreach( $info as $n=>$i )
				echo '<'.$n.'>'.$i.'</'.$n.'>'."\n";
			echo '</userinfo>';
			
		}
		
		// Sonst normale Textausgabe im INI-Datei-Format.
		else
		{
			header('Content-Type: text/plain');
			foreach( $info as $n=>$i )
				echo $n.'="'.$i."\"\n";
		}
		
		exit; // Fertig.
	}
	
	
	function project()
	{
		$user = Session::getUser();
		if   ( ! is_object($user) )
		{
			$this->callSubAction('show');
			return;
		}

		$this->evaluateRequestVars( array('projectid'=>$this->getRequestId()) );
		
		Session::setUser( $user );
	}


	function object()
	{
		$user = Session::getUser();
		if   ( ! is_object($user) )
		{
			$this->callSubAction('show');
			return;
		}
		
		$this->evaluateRequestVars( array('objectid'=>$this->getRequestId()) );

		Session::setUser( $user );
	}


	function language()
	{
		$user = Session::getUser();
		if   ( ! is_object($user) )
		{
			$this->callSubAction('show');
			return;
		}
		
		$this->evaluateRequestVars( array(REQ_PARAM_LANGUAGE_ID=>$this->getRequestId()) );
	}


	function model()
	{
		$user = Session::getUser();
		if   ( ! is_object($user) )
		{
			$this->callSubAction('show');
			return;
		}
		
		$this->evaluateRequestVars( array(REQ_PARAM_MODEL_ID=>$this->getRequestId()) );

		$user     = Session::getUser();
	}
	

	/**
	 * Auswerten der Request-Variablen.
	 *
	 * @param Array $add
	 */
	function evaluateRequestVars( $add = array() )
	{
	}


	function showtree()
	{
		Session::set('showtree',true );
	}
		

	function hidetree()
	{
		Session::set('showtree',false );
	}
		

	function switchuser()
	{
		$user = Session::getUser();
		
		if	( ! $user->isAdmin )
			throw new \SecurityException("Switching the user is only possible for admins.");
		
		$this->recreateSession();
		
		$newUser = new User( $this->getRequestId() );
		$newUser->load();
		
		$newUser->setCurrent();
	}
	
	
	function show()
	{
		global $conf;
		global $PHP_AUTH_USER;
		global $PHP_AUTH_PW;

		$user = Session::getUser();
		// Gast-Login
		if   ( ! is_object($user) )
		{
			if	( $conf['security']['guest']['enable'] )
			{
				$this->setDefaultDb();
				$username = $conf['security']['guest']['user'];
				$user = User::loadWithName($username);
				if	( $user->userid > 0 )
					$user->setCurrent();
				else
				{
					Logger::warn('Guest login failed, user not found: '.$username);
					$this->addNotice('user',$username,'LOGIN_FAILED',OR_NOTICE_WARN,array('name'=>$username) );
					$user = null;
				}
			}
		}
		
		if   ( ! is_object($user) )
		{
			switch( $conf['security']['login']['type'] )
			{
					
				// Authorization ueber HTTP
				//
				case 'http':
					$ok = false;
		
				    if	( isset($_SERVER['PHP_AUTH_USER']) )
				    {
				    	$this->setDefaultDb();
						$ok = $this->checkLogin( $_SERVER['PHP_AUTH_USER'],$_SERVER['PHP_AUTH_PW'] );
				    }
				    
					if	( ! $ok )
					{
						header( 'WWW-Authenticate: Basic realm="'.OR_TITLE.' - '.lang('HTTP_REALM').'"' );
						header( 'HTTP/1.0 401 Unauthorized' );
						echo 'Authorization Required!';
						exit;
					}
					break;
					
				case 'form':
					// Benutzer ist nicht angemeldet
					$this->callSubAction( 'showlogin' ); // Anzeigen der Login-Maske
					return;
					break;
					
				default:
					throw new \LogicException('Unknown auth-type: '.$conf['security']['login']['type'].'. Please check the configuration setting /security/login/type' );
			}
		}
		
		if	( $user->mustChangePassword ) 
		{
			$this->addNotice( 'user',$user->name,'PASSWORD_TIMEOUT','warn' );
			$this->callSubAction( 'changepassword' ); // Zwang, das Kennwort zu ?ndern.
		}

		// Seite ?ndert sich nur 1x pro Session
		$this->lastModified( $user->loginDate );

	}



	function checkMenu( $name )
	{
		global $conf;
		
		switch( $name )
		{
			case 'applications':
				// Men?punkt "Anwendungen" wird nur angezeigt, wenn weitere Anwendungen
				// konfiguriert sind.
				return count(@$conf['applications']) > 0;

			case 'register': // Registrierung
				// Nur, wenn aktiviert und gegen eigene Datenbank authentisiert wird.
				return @$conf['login']['register'] && @$conf['security']['auth']['type'] == 'database';

			case 'password': // Kennwort vergessen
				// Nur, wenn aktiviert und gegen eigene Datenbank authentisiert wird.
				// Deaktiviert, falls LDAP-Lookup aktiviert ist.
				return @$conf['login']['send_password'] && @$conf['security']['auth']['type'] == 'database'
				                                        && !@$conf['security']['auth']['userdn'];
				
			case 'administration':
				// "Administration" nat?rlich nur f?r Administratoren.
				return $this->userIsAdmin();

			case 'login':
				return !@$conf['login']['nologin'];
				
			case 'logout':
				return true;
				
			case 'projectmenu':
				return true;
				
			default:
				return false;
		}	
	}
	
	
	/**
	 * Maske anzeigen, um Benutzer zu registrieren.
	 */
	public function registerView()
	{
		
	}

	
	/**
	 * Registriercode erzeugen und per E-Mail dem Benutzer mitteilen.
	 * Maske anzeigen, damit Benuter Registriercode anzeigen kann.
	 */
	public function registercodeView()
	{
		global $conf;
		foreach( $conf['database'] as $dbname=>$dbconf )
		{
			if	( is_array($dbconf) && $dbconf['enabled'] )
				$dbids[$dbname] = $dbconf['description'];
		}

		$this->setTemplateVar( 'dbids',$dbids );
		
		$db = Session::getDatabase();
		if	( is_object($db) )
			$this->setTemplateVar('actdbid',$db->id);
		else
			$this->setTemplateVar('actdbid',$conf['database']['default']);
		
		
		
	}

	
	
	public function registerPost()
	{
		global $conf;

		Session::set('registerMail',$this->getRequestVar('mail') );
		
			srand ((double)microtime()*1000003);
		$registerCode = rand();
		
		Session::set('registerCode',$registerCode                );

		$email_address = $this->getRequestVar('mail',OR_FILTER_MAIL);
		
		if	( ! Mail::checkAddress($email_address) )
		{
			$this->addValidationError('mail');
			return;
		}
		
		// E-Mail and die eingegebene Adresse verschicken
		$mail = new Mail($email_address,
		                 'register_commit_code','register_commit_code');
		$mail->setVar('code',$registerCode); // Registrierungscode als Text-Variable
		
		if	( $mail->send() )
		{
			$this->addNotice('','','mail_sent',OR_NOTICE_OK);
		}
		else
		{
			$this->addNotice('','','mail_not_sent',OR_NOTICE_ERROR,array(),$mail->error);
			return;
		}
	}

	
	/**
	 * Benutzerregistierung.
	 * Benutzer hat Best?tigungscode erhalten und eingegeben.
	 */
	function registercodePost()
	{
		global $conf;
		$this->checkForDb();

		$origRegisterCode  = Session::get('registerCode');
		$inputRegisterCode = $this->getRequestVar('code');
		
		if	( $origRegisterCode != $inputRegisterCode )
		{
			// Best?tigungscode stimmt nicht.
			$this->addValidationError('code','code_not_match');
			return;
		}

		// Best?tigungscode stimmt ?berein.
		// Neuen Benutzer anlegen.
			
		if	( !$this->hasRequestVar('username') )
		{
			$this->addValidationError('username');
			return;
		}
		
		$user = User::loadWithName( $this->getRequestVar('username') );
		if	( $user->isValid() )
		{
			$this->addValidationError('username','USER_ALREADY_IN_DATABASE');
			return;
		}
		
		if	( strlen($this->getRequestVar('password')) < $conf['security']['password']['min_length'] )
		{
			$this->addValidationError('password','password_minlength',array('minlength'=>$conf['security']['password']['min_length']));
			return;
		}
		
		$newUser = new User();
		$newUser->name = $this->getRequestVar('username');
		$newUser->add();
			
		$newUser->mail     = Session::get('registerMail');
		$newUser->save();
			
		$newUser->setPassword( $this->getRequestVar('password'),true );
			
		$this->addNotice('user',$newUser->name,'user_added','ok');
	}



	/**
	 * Vergessenes Kennwort zusenden lassen.
	 */
	function passwordView()
	{
		// TODO: Attribut "Password" abfragen
		foreach( config('database') as $dbname=>$dbconf )
		{
		    $dbconf = $dbconf + config('database-default','defaults');
			if	( $dbconf['enabled'] )
				$dbids[$dbname] = $dbconf['description'];
		}

		$this->setTemplateVar( 'dbids',$dbids );
		
		
		$db = Session::getDatabase();
		
		if	( is_object($db) )
			$this->setTemplateVar('actdbid',$db->id);
		else
			$this->setTemplateVar('actdbid',config('database-default','default-id'));		
	}	
	
	
	/*
	function changepassword()
	{
	}
	*/
	
	
	/*
	function setnewpassword()
	{
		$oldPw  = $this->getRequestVar('password_old'  );
		$newPw1 = $this->getRequestVar('password_new_1');
		$newPw2 = $this->getRequestVar('password_new_2');
		
		if	( $newPw1 == $newPw2 )
		{
			// Aktuellen Benutzer aus der Sitzung ermitteln
			$user = $this->getUserFromSession();
			
			// Altes Kennwort pr?fen.
			$ok = $user->checkPassword( $oldPw );
			
			if	( $ok )  // Altes Kennwort ist ok.
			{
				$user->setPassword( $newPw1 ); // Setze neues Kennwort
				$user->mustChangePassword = false;
				Session::setUser($user);
				$this->addNotice('user',$user->name,'password_set','ok');
			}
			else
			{
				// Altes Kennwort falsch.
				$this->addNotice('user',$user->name,'password_error','error');
			}
		}
		else
		{
			// Beide neuen Kennw?rter stimmen nicht ?berein
			$this->addNotice('user',$user->name,'passwords_not_match','error');
		}
	}
	*/
	
	
	/**
	 * Einen Kennwort-Anforderungscode an den Benutzer senden.
	 */
	function passwordPost()
	{
		if	( !$this->hasRequestVar('username') )
		{
			$this->addValidationError('username');
			return;
		}
		
		$this->checkForDb();

		$user = User::loadWithName( $this->getRequestVar("username") );
		//		Html::debug($user);
		Password::delay();
		if	( $user->isValid() )
		{
			srand ((double)microtime()*1000003);
			$code = rand();
			$this->setSessionVar("password_commit_code",$code);
			
			$eMail = new Mail( $user->mail,'password_commit_code' );
			$eMail->setVar('name',$user->getName());
			$eMail->setVar('code',$code);
			if	( $eMail->send() )
				$this->addNotice('user',$user->getName(),'mail_sent',OR_NOTICE_OK);
			else
				$this->addNotice('user',$user->getName(),'mail_not_sent',OR_NOTICE_ERROR,array(),$eMail->error);
			
		}
		else
		{
			//$this->addNotice('','user','username_not_found');
			// Trotzdem vort?uschen, eine E-Mail zu senden, damit die G?ltigkeit
			// eines Benutzernamens nicht von au?en gepr?ft werden kann.
			// 
			$this->addNotice('user',$this->getRequestVar("username"),'mail_sent');

		}
		
		$this->setSessionVar("password_commit_name",$user->name);
	}

	
	
	/**
	 * Anzeige Formular zum Eingeben des Kennwort-Codes.
	 *
	 */
	function passwordcodeView()
	{
		
	}
	
	
	/**
	 * Neues Kennwort erzeugen und dem Benutzer zusenden.
	 */
	function passwordcodePost()
	{
		$username = $this->getSessionVar("password_commit_name");

		if	( $this->getRequestVar("code")=='' ||
			  $this->getSessionVar("password_commit_code") != $this->getRequestVar("code") )
		{
			$this->addValidationError('code','PASSWORDCODE_NOT_MATCH');
		  	return;
		}
		
		$user  = User::loadWithName( $username );
			
		if	( !$user->isValid() )
		{
			// Benutzer konnte nicht geladen werden.
			$this->addNotice('user',$username,'error',OR_NOTICE_ERROR);
			return;
		}
		
		$newPw = User::createPassword(); // Neues Kennwort erzeugen.
		
		$eMail = new Mail( $user->mail,'password_new' );
		$eMail->setVar('name'    ,$user->getName());
		$eMail->setVar('password',$newPw          );

		if	( $eMail->send() )
		{
			$user->setPassword( $newPw, false ); // Kennwort muss beim n?. Login ge?ndert werden.
			$this->addNotice('user',$username,'mail_sent',OR_NOTICE_OK);
		}
		else
		{
			// Sollte eigentlich nicht vorkommen, da der Benutzer ja auch schon den
			// Code per E-Mail erhalten hat.
			$this->addNotice('user',$username,'error',OR_NOTICE_ERROR,array(),$eMail->error);
		}
	}
	

	/**
	 * Erzeugt eine neue Sitzung.
	 */
	function recreateSession()
	{
		
		// PHP < 4.3.2 kennt die Funktion session_regenerate_id() nicht.
		if	( version_compare(phpversion(),"4.3.2","<") )
		{
			$randlen = 32;
			$randval = "0123456789abcdefghijklmnopqrstuvwxyz";
			$newid   = "";
			for ($i = 1; $i <= $randlen; $i++)
			{
				$newid .= substr($randval, rand(0,(strlen($randval) - 1)), 1);
			}
			session_id( $newid );
		}
		elseif( version_compare(phpversion(),"4.3.2","==") )
		{
			session_regenerate_id();
			
			// Bug in PHP 4.3.2: Session-Cookie wird nicht neu gesetzt.
			if ( ini_get("session.use_cookies") )
                $this->setCookie( session_name(),session_id() );
		}
		elseif	( version_compare(phpversion(),"5.1.0",">") )
		{
			session_regenerate_id(true);
		}
		else
		{
			// 5.1.0 > PHP >= 4.3.3
		}
	}
	
	
	function licenseView()
	{
		$software = array();
		
		$software[] = array('name'   =>'OpenRat Content Management System',
		                    'url'    =>'http://www.openrat.de/',
		                    'license'=>'GPL v2');
		$software[] = array('name'   =>'jQuery Core Javascript Framework',
		                    'url'    =>'http://jquery.com/',
		                    'license'=>'MPL, GPL v2');
		$software[] = array('name'   =>'jQuery UI Javascript Framework',
		                    'url'    =>'http://jqueryui.com/',
		                    'license'=>'MPL, GPL v2');
		$software[] = array('name'   =>'GeSHi - Generic Syntax Highlighter',
		                    'url'    =>'http://qbnz.com/highlighter/',
		                    'license'=>'GPL v2');
		$software[] = array('name'   =>'TAR file format',
		                    'url'    =>'http://www.phpclasses.org/package/529',
		                    'license'=>'LGPL');
		$software[] = array('name'   =>'JSON file format',
		                    'url'    =>'http://pear.php.net/pepr/pepr-proposal-show.php?id=198',
		                    'license'=>'BSD');
		
		$this->setTemplateVar('software',$software);



        $this->setTemplateVar('time'     ,date('r')     );
        $this->setTemplateVar('os'       ,php_uname('s') );
        $this->setTemplateVar('release'  ,php_uname('r') );
        $this->setTemplateVar('machine'  ,php_uname('m') );
        $this->setTemplateVar('version' , phpversion()          );

        $this->setTemplateVar('cms_name'    , Conf()->subset('application')->get('name'    ) );
        $this->setTemplateVar('cms_version' , Conf()->subset('application')->get('version' ) );
        $this->setTemplateVar('cms_operator', Conf()->subset('application')->get('operator') );

        $user = Session::getUser();
        if   ( !empty($user) )
        {
            $this->setTemplateVar('user_login'   , $user->loginDate );
            $this->setTemplateVar('user_name'    , $user->name      );
            $this->setTemplateVar('user_fullname', $user->fullname  );
        }

    }
	
	
	function pingView()
	{
		echo "1";
	}

    /**
     * Updating the database.
     *
     * @param $dbid integer
     * @throws OpenRatException
     */
    private function updateDatabase($dbid)
    {
        try {
            $adminDbConfig = Conf()->subset('database')->subset($dbid);

            if ( !$adminDbConfig->is('auto_update')) {

                Logger::warn("Auto-Update is disabled");
                return;
            }

            $adminDb = new Database( config('database',$dbid), true);
            $adminDb->id = $dbid;
        } catch (Exception $e) {

            throw new OpenRatException('DATABASE_ERROR_CONNECTION', $e->getMessage());
        }

        $updater = new DbUpdate();
        $updater->update($adminDb);

        // Try to close the PDO connection. PDO doc:
        // To close the connection, you need to destroy the object by ensuring that all
        // remaining references to it are deleted—you do this by assigning NULL to the variable that holds the object.
        // If you don't do this explicitly, PHP will automatically close the connection when your script ends.
        $adminDb = null;
        unset($adminDb);
    }


    public function showView() {
        $this->nextSubAction('login');
    }
}


?>