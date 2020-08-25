<?php

namespace cms\action;

use cms\model\User;
use cms\model\Project;
use cms\model\Value;
use cms\model\Element;
use cms\model\Page;
use cms\model\BaseObject;
use cms\model\Language;
use cms\model\Model;


use database\Database;
use util\Http;
use logger\Logger;
use \security\Password;
use util\Session;
use util\Html;
use util\Mail;

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


if	( !defined('PROJECTID_ADMIN') )
	define('PROJECTID_ADMIN',-1);

/**
 * Action-Klasse fuer die Start-Action
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 * @deprecated
 */

class StartAction extends BaseAction
{
	public $security = Action::SECURITY_USER;
	
	var $mustChangePassword = false;
	
	function setDb( $dbid )
	{
		global $conf;

		if	( !isset($conf['database'][$dbid] ))
			throw new \LogicException( 'unknown DB-Id: '.$dbid );
			
		$db = db_connection();
		if	( is_object($db) )
		{
			$db->rollback();
		}

		$db = new Database( $conf['database'][$dbid] );
		$db->id = $dbid;
		$db->start();
		Session::setDatabase( $db );
	}



	function checkForDb()
	{
		global $conf;
		$dbid = $this->getRequestVar('dbid'); 

		if	( $dbid != '' )
			$this->setDb( $dbid );
	}



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



	function checkLogin( $name,$pw,$pw1,$pw2 )
	{
		Logger::debug( "login user $name" );
	
		global $conf;
		global $SESS;
	
		unset( $SESS['user'] );	
	
		
		$db = db_connection();
		
		if	( !$db->available )
		{
			$this->addNotice('database',$db->conf['description'],'DATABASE_CONNECTION_ERROR',OR_NOTICE_ERROR,array(),array('Database Error: '.$db->error));
			$this->callSubAction('showlogin');
			return false;
		}
		
		$ip = getenv("REMOTE_ADDR");
	
		$user = new User();
		$user->name = $name;
		
		$ok = $user->checkPassword( $pw );
		
		$this->mustChangePassword = $user->mustChangePassword;
		
		if	( $this->mustChangePassword )
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
				// Kennw�rter identisch und lang genug.
				$user->setPassword( $pw1,true );
				
				// Das neue Kennwort ist gesetzt, die Anmeldung ist also doch noch gelungen. 
				$ok = true;
				$this->mustChangePassword = false;
				$user->mustChangePassword = false;
			}
		}
		
		// Falls Login erfolgreich
		if  ( $ok )
		{
			// Login war erfolgreich!
			$user->load();
			$user->setCurrent();
			Logger::info( 'login successful' );

			return true;
		}
		else
		{
			Logger::info( "login for user $name failed" );

			return false;
		}
	}



	/**
	 * Anzeigen der Loginmaske.
	 *
	 * Es wird nur die Loginmaske angezeigt.
	 * Hier nie "304 not modified" setzen, da sonst keine
	 * Login-Fehlermeldung erscheinen kann
	 */
	function loginView()
	{
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
				throw new \util\exception\SecurityException( 'no authorization data (no auth-id)');
				
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
					throw new \util\exception\SecurityException('auth failed');
				$treffer=0;
				if	( !preg_match($sso['username_regexp'],$html,$treffer) )
					throw new \util\exception\SecurityException('auth failed');
				if	( !isset($treffer[1]) )
					throw new \util\exception\SecurityException('authorization failed');
					
				$username = $treffer[1];
				
//				Html::debug( $treffer );
				$this->setDefaultDb();

				$user = User::loadWithName( $username );
				
				if	( ! $user->isValid( ))
					throw new \util\exception\SecurityException('authorization failed: user not found: '.$username);
					
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
				throw new \util\exception\SecurityException( 'no username in client certificate ('.$ssl_user_var.') (or there is no client certificate...?)' );
			
			$this->setDefaultDb();

			$user = User::loadWithName( $username );

			if	( !$user->isValid() )
				throw new \LogicException( 'unknown username: '.$username );

			$user->setCurrent();

			$this->callSubAction('show');
		}
		
		foreach( $conf['database'] as $dbname=>$dbconf )
		{
			if	( is_array($dbconf) && $dbconf['enabled'] )
				$dbids[$dbname] = array('key'  =>$dbname,
				                        'value'=>Text::maxLength($dbconf['description']),
				                        'title'=>$dbconf['description'].' ('.$dbconf['host'].')' );
		}
		
		$openid_provider = array();
		foreach( explode(',',$conf['security']['openid']['provider']) as $provider )
			$openid_provider[$provider] = config('security','openid','provider.'.$provider.'.name');
		$this->setTemplateVar('openid_providers',$openid_provider);
		$this->setTemplateVar('openid_user_identity',config('security','openid','user_identity'));
		//$this->setTemplateVar('openid_provider','identity');

		
		if	( empty($dbids) )
			$this->addNotice('','','no_database_configuration',OR_NOTICE_WARN);
		
		if	( !isset($this->templateVars['login_name']) && isset($_COOKIE['or_username']) )
			$this->setTemplateVar('login_name',$_COOKIE['or_username']);
		
		if	( !isset($this->templateVars['login_name']) )
			$this->setTemplateVar('login_name',@$conf['security']['default']['username']);

		if	( $this->templateVars['login_name']== @$conf['security']['default']['username'])
			$this->setTemplateVar('login_password',@$conf['security']['default']['password']);

		$this->setTemplateVar( 'dbids',$dbids );
		
		$db = Session::getDatabase();
		if	( is_object($db) )
			$this->setTemplateVar('actdbid',$db->id);
		elseif( isset($this->templateVars['actid']) )
			;
		else
			$this->setTemplateVar('actdbid',$conf['database']['default']);


		// Den Benutzernamen aus dem Client-Zertifikat lesen und in die Loginmaske eintragen. 
		$ssl_user_var = $conf['security']['ssl']['user_var'];
		if	( !empty($ssl_user_var) )
		{
			$username = getenv( $ssl_user_var );

			if	( empty($username) )
			{
				echo lang('ERROR_LOGIN_BROKEN_SSL_CERT');
				Logger::warn( 'no username in SSL client certificate (var='.$ssl_user_var.').' );
				exit;
			}
			
			// Benutzername ist in Eingabemaske unveränderlich
			$this->setTemplateVar('force_username',$username);
		}

		$this->setTemplateVar('objectid'  ,$this->getRequestVar('objectid'  ,OR_FILTER_NUMBER) );
		$this->setTemplateVar('projectid' ,$this->getRequestVar('projectid' ,OR_FILTER_NUMBER) );
		$this->setTemplateVar('modelid'   ,$this->getRequestVar('modelid'   ,OR_FILTER_NUMBER) );
		$this->setTemplateVar('languageid',$this->getRequestVar('languageid',OR_FILTER_NUMBER) );
				
		$this->setTemplateVar('register'     ,$conf['login'   ]['register' ]);
		$this->setTemplateVar('send_password',$conf['login'   ]['send_password']);
	}



	/**
	 * Setzt die neue Projekt-Id und lädt die Workbench neu.
	 * 
	 */
	public function projectmenuPost()
	{
		
		$this->evaluateRequestVars( array('projectid'=>$this->getRequestId()) );
	}
	
	
	/**
	 * Erzeugt ein Projekt-Auswahlmenue.
	 */
	public function projectmenuView()
	{
		$user = Session::getUser();
		
		if	( $user->mustChangePassword ) 
		{
			$this->addNotice( 'user',$user->name,'PASSWORD_TIMEOUT','warn' );
			$this->callSubAction( 'changepassword' ); // Zwang, das Kennwort zu �ndern.
		}
		

		// Diese Seite gilt pro Sitzung. 
		//$this->lastModified( $user->loginDate );

		// Projekte ermitteln
		$projects = $user->getReadableProjects(); 
		
		$list     = array();
		
		foreach( $projects as $id=>$name )
		{
			$p = array();
			$p['url' ] = Html::url('start','project',$id);
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
				// Normale Benutzer erhalten eine Meldung, dass kein Projekt zur Verf�gung steht
				$this->addNotice('','','NO_PROJECTS_AVAILABLE',OR_NOTICE_WARN);
		}
		
		//$this->metaValues();
	}



	/**
	 * Erzeugt eine Anwendungsliste.
	 */
	public function applicationsView()
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
	 * Open-Id Login, �berpr�fen der Anmeldung.<br>
	 * Spezifikation: http://openid.net/specs/openid-authentication-1_1.html<br>
	 * Kapitel "4.4. check_authentication"<br>
	 * <br>
	 * Im 2. Schritt (Mode "id_res") erfolgte ein Redirect vom Open-Id Provider an OpenRat zur�ck.<br>
	 * Wir befinden uns nun im darauf folgenden Request des Browsers.<br>
	 * <br>
	 * Es muss noch beim OpenId-Provider die Best�tigung eingeholt werden, danach ist der
	 * Benutzer angemeldet.<br>
	 */
	function openid()
	{
		global $conf;
		$openId = Session::get('openid');

		if	( !$openId->checkAuthentication() )
		{
			$this->addNotice('user',$openId->user,'LOGIN_OPENID_FAILED',OR_NOTICE_ERROR,array('name'=>$openId->user),array($openId->error) );
			$this->addValidationError('openid_url','');
			$this->callSubAction('showlogin');
			return;
		}
		
		//Html::debug($openId);
		
		// Anmeldung wurde mit "is_valid:true" best�tigt.
		// Der Benutzer ist jetzt eingeloggt.
		$username = $openId->getUserFromIdentiy();
		
		if	( empty($username) )
		{
			// Es konnte kein Benutzername ermittelt werden.
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

				$user->mail     = $openId->info['email'];
				$user->fullname = $openId->info['fullname'];
				$user->save();  // Um E-Mail zu speichern (wird bei add() nicht gemacht)
			}
			else
			{
				// Benutzer ist nicht in Benutzertabelle vorhanden (und angelegt werden soll er auch nicht).
				$this->addNotice('user',$username,'LOGIN_OPENID_FAILED','error',array('name'=>$username) );
				$this->addValidationError('openid_url','');
				$this->callSubAction('showlogin');
				return;
			}
		}
		else
		{
			// Benutzer ist bereits vorhanden.
			if	( @$conf['security']['openid']['update_user'])
			{
				$user->fullname = $openId->info['fullname'];
				$user->mail     = $openId->info['email'];
				$user->save();
			}
		}

		$user->setCurrent();  // Benutzer ist jetzt in der Sitzung.
	}
	

	/**
	 * Login.
	 */
	function loginPost()
	{
		global $conf;

		$this->checkForDb();
		Session::setUser('');
		
		if	( $conf['login']['nologin'] )
			throw new \util\exception\SecurityException('login disabled');

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
			$openId->redirect();
		}
		

		// Ermitteln, ob der Baum angezeigt werden soll
		// Ist die Breite zu klein, dann wird der Baum nicht angezeigt
		Session::set('showtree',intval($this->getRequestVar('screenwidth')) > $conf['interface']['min_width'] );

		$loginOk = $this->checkLogin( $loginName,
		                              $loginPassword,
		                              $newPassword1,
		                              $newPassword2 );

		usleep(hexdec(Password::randomHexString(1))); // delay: 0-255 ms
		
		if	( !$loginOk )
		{
			
			if	( $this->mustChangePassword )
			{
				// Anmeldung gescheitert, Benutzer muss Kennwort �ndern.
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

			Logger::debug("Login failed for user '$loginName'");
			
			$this->callSubAction('login');
			return;
		}
		else
		{
			Logger::debug("Login successful for user '$loginName'");
			
			// Anmeldung erfolgreich.
			if	( config('security','renew_session_login') )
				$this->recreateSession();
			
			$user = Session::getUser();
			$this->addNotice('user',$user->name,'LOGIN_OK',OR_NOTICE_OK,array('name'=>$user->fullname));
		}
		
		// Benutzer ist angemeldet
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
						  !isset($subaction['alias' ]) &&
						  $subActionName != 'menu'            )
					{
						$engine = new template_engine\TemplateEngine();
						$engine->compile( strtolower(str_replace('Action','',$actionName)).'/'.$subActionName);
					}
				}
			}
		}
		
		// Umleiten auf eine definierte URL.s
		$redirect_url = @$conf['security']['logout']['redirect_url'];

		if	( !empty($redirect_url) )
		{
			header('Location: '.$redirect_url);
			exit;
		}
	}

	
	
	/**
	 * Benutzer meldet sich ab.
	 */
	function logoutView()
	{
	}
	

	/**
	 * Ausw�hlen der Administration.
	 */
	function administrationPost()
	{
	}
	
	
	
	/**
	 * Auswaehlen des Benutzer-Profiles.
	 */
	function profilePost()
	{
	}
	
	
	
	/**
	 * Auswaehlen der Startseite.
	 */
	function startPost()
	{
	}
	
	
	
	/**
	 * Ausgeben von maschinenlesbaren Benutzerinformationen.
	 * 
	 * Diese Funktion dient dem Single-Signon f�r fremde Anwendungen, welche
	 * die Benutzerinformationen des angemeldeten Benutzers aus dieser
	 * Anwendung auslesen k�nnen.
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


	function languagePost()
	{
		$user = Session::getUser();
		if   ( ! is_object($user) )
		{
			throw new \LogicException('No user in session');
			return;
		}
		
		$this->evaluateRequestVars( array(REQ_PARAM_LANGUAGE_ID=>$this->getRequestId()) );
	}


	function modelPost()
	{
		$user = Session::getUser();
		if   ( ! is_object($user) )
		{
			$this->callSubAction('show');
			return;
		}
		
		$this->evaluateRequestVars( array(REQ_PARAM_MODEL_ID=>$this->getRequestId()) );
	}
	

	/**
	 * Auswerten der Request-Variablen.
	 */
	private function evaluateRequestVars( $add = array() )
	{
	}


	function switchuser()
	{
		$user = Session::getUser();
		
		if	( ! $user->isAdmin )
			throw new \util\exception\SecurityException("");
		
		$this->recreateSession();
		
		$newUser = new User( $this->getRequestId() );
		$newUser->load();
		
		$newUser->setCurrent();
	}
	
	
	function showView()
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
			$this->callSubAction( 'changepassword' ); // Zwang, das Kennwort zu �ndern.
		}

		// Seite �ndert sich nur 1x pro Session
		$this->lastModified( $user->loginDate );

		$this->metaValues();
	}



	function checkMenu( $name )
	{
		global $conf;
		
		switch( $name )
		{
			case 'applications':
				// Men�punkt "Anwendungen" wird nur angezeigt, wenn weitere Anwendungen
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
				// "Administration" nat�rlich nur f�r Administratoren.
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
	function register()
	{
		
	}

	
	/**
	 * Registriercode erzeugen und per E-Mail dem Benutzer mitteilen.
	 * Maske anzeigen, damit Benuter Registriercode anzeigen kann.
	 */
	public function registercode()
	{
		$email_address = $this->getRequestVar('mail','mail');
		
		if	( ! Mail::checkAddress($email_address) )
		{
			$this->addValidationError('mail');
			$this->setTemplateVar('mail',$email_address);
			$this->callSubAction('register');
			return;
		}
		
		
		srand ((double)microtime()*1000003);
		$registerCode = rand();
		
		Session::set('registerCode',$registerCode                );
					
		// E-Mail and die eingegebene Adresse verschicken
		$mail = new Mail($email_address,
		                 'register_commit_code');
		$mail->setVar('code',$registerCode); // Registrierungscode als Text-Variable
		
		if	( $mail->send() )
		{
			$this->addNotice('','','mail_sent',OR_NOTICE_OK);
		}
		else
		{
			$this->addNotice('','','mail_not_sent',OR_NOTICE_ERROR,array(),$mail->error);
			$this->callSubAction('register');
			return;
		}
	}

	
	
	public function registeruserdata()
	{
		global $conf;

		Session::set('registerMail',$this->getRequestVar('mail') );
		// TODO: Attribut "Password" abfragen
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

	
	/**
	 * Benutzerregistierung.
	 * Benutzer hat Best�tigungscode erhalten und eingegeben.
	 */
	public function registercommit()
	{
		global $conf;
		$this->checkForDb();

		$origRegisterCode  = Session::get('registerCode');
		$inputRegisterCode = $this->getRequestVar('code');
		
		if	( $origRegisterCode != $inputRegisterCode )
		{
			// Best�tigungscode stimmt nicht.
			$this->addValidationError('code','code_not_match');
			$this->callSubAction('registeruserdata');
			return;
		}

		// Best�tigungscode stimmt �berein.
		// Neuen Benutzer anlegen.
			
		if	( !$this->hasRequestVar('username') )
		{
			$this->addValidationError('username');
			$this->callSubAction('registeruserdata');
			return;
		}
		
		$user = User::loadWithName( $this->getRequestVar('username') );
		if	( $user->isValid() )
		{
			$this->addValidationError('username','USER_ALREADY_IN_DATABASE');
			$this->callSubAction('registeruserdata');
			return;
		}
		
		if	( strlen($this->getRequestVar('password')) < $conf['security']['password']['min_length'] )
		{
			$this->addValidationError('password','password_minlength',array('minlength'=>$conf['security']['password']['min_length']));
			$this->callSubAction('registeruserdata');
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
	public function password()
	{
		global $conf;
		
		// TODO: Attribut "Password" abfragen
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
			
			// Altes Kennwort pr�fen.
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
			// Beide neuen Kennw�rter stimmen nicht �berein
			$this->addNotice('user',$user->name,'passwords_not_match','error');
		}
	}
	*/
	
	
	/**
	 * Einen Kennwort-Anforderungscode an den Benutzer senden.
	 */
	public function passwordcode()
	{
		if	( !$this->hasRequestVar('username') )
		{
			$this->addValidationError('username');
			$this->callSubAction('password');
			return;
		}
		
		$this->checkForDb();

		$user = User::loadWithName( $this->getRequestVar("username") );

		Password::delay();
		
		//		Html::debug($user);
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
			// Trotzdem vort�uschen, eine E-Mail zu senden, damit die G�ltigkeit
			// eines Benutzernamens nicht von au�en gepr�ft werden kann.
			// 
			$this->addNotice('user',$this->getRequestVar("username"),'mail_sent');
		}
		
		$this->setSessionVar("password_commit_name",$user->name);
	}

	
	
	/**
	 * Anzeige Formular zum Eingeben des Kennwort-Codes.
	 *
	 */
	public function passwordinputcode()
	{
		
	}
	
	
	/**
	 * Neues Kennwort erzeugen und dem Benutzer zusenden.
	 */
	public function passwordcommit()
	{
		$username = $this->getSessionVar("password_commit_name");

		if	( $this->getRequestVar("code")=='' ||
			  $this->getSessionVar("password_commit_code") != $this->getRequestVar("code") )
		{
			$this->addValidationError('code','PASSWORDCODE_NOT_MATCH');
			$this->callSubAction('passwordinputcode');
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
			$user->setPassword( $newPw, false ); // Kennwort muss beim n�. Login ge�ndert werden.
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
	private function recreateSession()
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

	


	
	
	/**
	 * Ermittelt die letzten Änderungen, die durch den aktuellen Benutzer im aktuellen Projekt gemacht worden sind.
	 */
	public function userprojecttimelineView()
	{
		//$project = Session::getProject();
		//$result = $project->getMyLastChanges();
		$result = array();
		
		$this->setTemplateVar('timeline', $result);
	}


}


?>