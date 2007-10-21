<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
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
// ---------------------------------------------------------------------------


define('PROJECTID_ADMIN',-1);

/**
 * Action-Klasse fuer die Start-Action
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */

class IndexAction extends Action
{
	var $mustChangePassword = false;
	
	function setDb( $dbid )
	{
		global $conf;

		if	( !isset($conf['database'][$dbid] ))
			die( 'unknown DB-Id: '.$dbid );

		$db = new DB( $conf['database'][$dbid] );
		$db->id = $dbid;
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
		global $conf;

		if	( !isset($conf['database']['default']) )
			die('default-database not set');

		$dbid = $conf['database']['default'];
		$this->setDb( $dbid );
	}



	function checkLogin( $name,$pw,$pw1,$pw2 )
	{
		Logger::debug( "login user $name" );
	
		global $conf;
		global $SESS;
	
		unset( $SESS['user'] );	
	
		
		$db = db_connection();
		
		$ip = getenv("REMOTE_ADDR");
	
		$user = new User();
		$user->name = $name;
		
		$ok = $user->checkPassword( $pw );
		
		$this->mustChangePassword = $user->mustChangePassword;
		
		if	( $this->mustChangePassword )
		{
			// Der Benutzer hat zwar ein richtiges Kennwort eingegeben, aber dieses ist abgelaufen.
			// Wir versuchen hier, das neue zu setzen (sofern eingegeben).
			if	( $pw1 == $pw2 && strlen($pw2) >= $conf['security']['password']['min_length'] )
			{
				// Kennwörter identisch und lang genug.
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
//			$user->loadProjects();
			//$user->loadRights();
			$user->setCurrent();
//			$user->loginDate = time();
//			Session::setUser( $user );
			Logger::info( 'login successful' );

			return true;
		}
		else
		{
			Logger::info( "login for user $name failed" );
			//$SESS['loginmessage'] = lang('USER_LOGIN_FAILED');

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
	function showlogin()
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
				die( 'no authorization data (no auth-id)');
				
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
					die('auth failed');
				$treffer=0;
				if	( !preg_match($sso['username_regexp'],$html,$treffer) )
					die('auth failed');
				if	( !isset($treffer[1]) )
					die('auth failed');
					
				$username = $treffer[1];
				
//				Html::debug( $treffer );
				$this->setDefaultDb();

				$user = User::loadWithName( $username );
				
				if	( ! $user->isValid( ))
					die('auth failed: user not found: '.$username);
					
				$user->setCurrent();

				$this->callSubAction('show');
			}
		}

		elseif	( $ssl_trust )
		{
			if	( empty($ssl_user_var) )
				die( 'please set environment variable name in ssl-configuration.' );

			$username = getenv( $ssl_user_var );

			if	( empty($username) )
				die( 'no username in client certificate ('.$ssl_user_var.') (or there is no client certificate...?)' );
			
			$this->setDefaultDb();

			$user = User::loadWithName( $username );

			if	( !$user->isValid() )
				die( 'unknown username: '.$username );

			$user->setCurrent();

			$this->callSubAction('show');
		}

		foreach( $conf['database'] as $dbname=>$dbconf )
		{
			if	( is_array($dbconf) && $dbconf['enabled'] )
				$dbids[$dbname] = $dbconf['comment'];
		}

		$this->setTemplateVar('login_name'    ,$conf['security']['default']['username']);
		$this->setTemplateVar('login_password',$conf['security']['default']['password']);

		$this->setTemplateVar( 'dbids',$dbids );
		
		$db = Session::getDatabase();
		if	( is_object($db) )
			$this->setTemplateVar('actdbid',$db->id);
		else
			$this->setTemplateVar('actdbid',$conf['database']['default']);

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
			
//			Html::debug($username);
			$this->setTemplateVar('force_username',$username);
		}

		$this->setTemplateVar('register'     ,$conf['login'   ]['register' ]);
		$this->setTemplateVar('send_password',$conf['login'   ]['send_password']);
		$this->setTemplateVar('loginmessage',$this->getSessionVar('loginmessage'));
		$this->setSessionVar('loginmessage','');
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
			$this->callSubAction( 'changepassword' ); // Zwang, das Kennwort zu ändern.
		}
		

		// Diese Seite gilt pro Sitzung. 
		$this->lastModified( $user->loginDate );

		// Projekte ermitteln
		$projects = $user->projects;

		$list = array();
		foreach( $projects as $id=>$name )
		{
			$p = array();
			$p['url' ] = Html::url('index','project',$id);
			$p['name'] = $name;
			$p['id'  ] = $id;

			$tmpProject = new Project( $id );
			$p['defaultmodelid'   ] = $tmpProject->getDefaultModelId();
			$p['defaultlanguageid'] = $tmpProject->getDefaultLanguageId();
			$p['models'   ] = $tmpProject->getModels();
			$p['languages'] = $tmpProject->getLanguages();
			
			$list[] = $p;
		}

		$this->setTemplateVar('projects',$list);
	}



	/**
	 * Erzeugt eine Anwendungsliste.
	 */
	function applications()
	{
		global $conf;
		
		// Diese Seite gilt pro Sitzung. 
		$user = Session::getUser();
		$this->lastModified( $user->loginDate );

		// Projekte ermitteln
		$list = array();
		foreach( $conf['applications'] as $id=>$app )
		{
			if	( !is_array($app) )
				continue;
				
			
			$p = array();
			$p['url']  = $app['url'];
			$p['url'] .= strpos($p['url'],'?')!==false?'&':'?';
			$p['url'] .= $app['param'].'='.session_id();
			$p['name'] = $app['name'];
			
			$list[] = $p;
		}

		$this->setTemplateVar('applications',$list);
	}



	/**
	 * Open-Id Login, Überprüfen der Anmeldung.<br>
	 * Spezifikation: http://openid.net/specs/openid-authentication-1_1.html<br>
	 * Kapitel "4.4. check_authentication"<br>
	 * <br>
	 * Im 2. Schritt (Mode "id_res") erfolgte ein Redirect vom Open-Id Provider an OpenRat zurück.<br>
	 * Wir befinden uns nun im darauf folgenden Request des Browsers.<br>
	 * <br>
	 * Es muss noch beim OpenId-Provider die Bestätigung eingeholt werden, danach ist der
	 * Benutzer angemeldet.<br>
	 */
	function openid()
	{
		global $REQ,
		       $conf;
		       
		$openid_user     = Session::get('openid_user'    );
		$openid_server   = Session::get('openid_server'  );
		$openid_delegate = Session::get('openid_delegate');
		$openid_handle   = Session::get('openid_handle'  );
		
		if	( $this->getRequestVar('openid_invalidate_handle') != $openid_handle )
		{
			$this->addNotice('user',$openid_user,'LOGIN_OPENID_FAILED','error',array('name'=>$openid_user),array('Association-Handle mismatch.') );
			$this->callSubAction('showlogin');
			return;
		}

//		if	( $this->getRequestVar('openid_identity') != $openid_delegate )
//		{
//			$this->addNotice('user',$openid_user,'LOGIN_OPENID_FAILED','error',array('name'=>$openid_user),array('Open-Id: Identity mismatch. Wrong identity:'.$this->getRequestVar('openid_identity')) );
//			$this->callSubAction('showlogin');
//			return;
//		}


		$params = array();
		
		foreach( $REQ as $request_key=>$request_value )
		{
			if	( substr($request_key,0,12)=='openid_sreg_' )
				$params['openid.sreg.'.substr($request_key,12) ] = $request_value;			
			elseif	( substr($request_key,0,7)=='openid_' )
				$params['openid.'.substr($request_key,7) ] = $request_value;			
		}
		$params['openid.mode'] = 'check_authentication';
		
		$checkRequest = new Http($openid_server);
		
		$checkRequest->method = 'POST'; // Spezifikation verlangt POST, auch wenn GET meistens trotzdem funktioniert.
		$checkRequest->requestParameter = $params;
		
		if	( ! $checkRequest->request() )
		{
			// Der HTTP-Request ging in die Hose.
			$this->addNotice('user',$openid_user,'LOGIN_OPENID_FAILED','error',array('name'=>$this->getRequestVar('login_name')),array($checkRequest->error) );
			$this->callSubAction('showlogin');
			return;
		}

		// Analyse der HTTP-Antwort, Parsen des BODYs.
		// Die Anmeldung ist bestätigt, wenn im BODY die Zeile "is_valid:true" vorhanden ist.
		// Siehe Spezifikation Kapitel 4.4.2
		$valid = null;
		foreach( explode("\n",$checkRequest->body) as $line )
		{
			$pair = explode(':',trim($line));
			if	(count($pair)==2 && strtolower($pair[0])=='is_valid')
				$valid = (strtolower($pair[1])=='true');
		}
		
		if	( is_null($valid) )
		{
			// Zeile nicht gefunden.
			$this->addNotice('user',$openid_user,'LOGIN_OPENID_FAILED','error',array('name'=>$openid_user),array_merge(array('Undefined Open-Id response: '),$response) );
			$this->callSubAction('showlogin');
			return;
		}
		elseif	( $valid )
		{
			// Anmeldung wurde mit "is_valid:true" bestätigt.
			// Der Benutzer ist jetzt eingeloggt.
			$openid_sreg_email    = $this->getRequestVar('openid_sreg_email'   );
			$openid_sreg_fullname = $this->getRequestVar('openid_sreg_fullname');
			$openid_sreg_nickname = $this->getRequestVar('openid_sreg_nickname');
			
			$user = User::loadWithName( $openid_user );
			
			if	( $user->userid <=0)
			{
				// Benutzer ist (noch) nicht vorhanden.
				if	( $conf['security']['openid']['add'])  // Anlegen?
				{
					$user->name     = $openid_user;
					$user->mail     = $openid_sreg_email;
					$user->fullname = $openid_sreg_fullname;
					$user->add();
					$user->save();  // Um E-Mail zu speichern (wird bei add() nicht gemacht)
				}
				else
				{
					// Benutzer ist nicht in Benutzertabelle vorhanden (und angelegt werden soll er auch nicht).
					$this->addNotice('user',$openid_user,'LOGIN_OPENID_FAILED','error',array('name'=>$openid_user) );
					$this->callSubAction('showlogin');
					return;
				}
			}

			$user->setCurrent();  // Benutzer ist jetzt in der Sitzung.
	
			return;
		}
		else
		{
			// Bestätigung wurde durch den OpenId-Provider abgelehnt.
			$this->addNotice('user',$openid_user,'LOGIN_OPENID_FAILED','error',array('name'=>$openid_user) );
			$this->callSubAction('showlogin');
			return;
		}
	}
	

	/**
	 * Login.
	 *
	 */
	function login()
	{
		global $conf;

//		$loginForm = new LoginForm();
//		$loginForm->validate();
//		$this->setTemplateVar('errors',$loginForm->getErrors() );
//		if	( $loginForm->hasErrors() )
//			$this->callSubAction('show');

		$this->checkForDb();
		Session::setUser('');
		
		if	( $conf['login']['nologin'] )
			die('login disabled');

		$openid_user   = $this->getRequestVar('openid_url'    );
		$loginName     = $this->getRequestVar('login_name'    );
		$loginPassword = $this->getRequestVar('login_password');
		$newPassword1  = $this->getRequestVar('password1'     );
		$newPassword2  = $this->getRequestVar('password2'     );
		
		// Login mit Open-Id.
		if	( !empty($openid_user) )
		{
			$openId = new OpenId($openid_user);
			
			if	( ! $openId->login() )
			{
				$this->addNotice('user',$openid_user,'LOGIN_OPENID_FAILED','error',array('name'=>$openid_user),array($openId->error) );
				$this->callSubAction('showlogin');
				return;
			}
			
			$openId->redirect();
			die('Unreachable Code.');
		}
		

		// Ermitteln, ob der Baum angezeigt werden soll
		// Ist die Breite zu klein, dann wird der Baum nicht angezeigt
		Session::set('showtree',intval($this->getRequestVar('screenwidth')) > $conf['interface']['min_width'] );

		$loginOk = $this->checkLogin( $loginName,
		                              $loginPassword,
		                              $newPassword1,
		                              $newPassword2 );
		                   
		if	( !$loginOk )
		{
			sleep(3);
			
			if	( $this->mustChangePassword )
				// Anmeldung gescheitert, Benutzer muss Kennwort ändern.
				$this->addNotice('user',$loginName,'LOGIN_FAILED_MUSTCHANGEPASSWORD','error' );
			else
				// Anmeldung gescheitert.
				$this->addNotice('user',$loginName,'LOGIN_FAILED','error',array('name'=>$this->getRequestVar('login_name')) );
				
			$this->callSubAction('showlogin');
		}
	}


	/**
	 * Benutzer meldet sich ab.
	 */
	function logout()
	{
		$user = Session::getUser();
		$this->setTemplateVar('login_username',$user->name);
		
		// Aus Sicherheitsgruenden die komplette Session deaktvieren
		session_unset();
	}


	/**
	 * Auswählen der Administration.
	 */
	function administration()
	{
		if	( !$this->userIsAdmin() )
			die(':P');
			
		Session::setProject( new Project(-1) );
	}
	
	
	
	/**
	 * Ausgeben von maschinenlesbaren Benutzerinformationen.
	 * 
	 * Diese Funktion dient dem Single-Signon für fremde Anwendungen, welche
	 * die Benutzerinformationen des angemeldeten Benutzers aus dieser
	 * Anwendung auslesen können.
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
		}

		if	( $this->getRequestId() != 0 )
			$project = new Project( $this->getRequestId() );
		else
			$project = new Project( $this->getRequestVar('projectid') );
		
		if	( $project->projectid != PROJECTID_ADMIN )
		{
			$project->load();
	
			Session::setProject( $project );
			
			$language = new Language( $this->hasRequestVar('languageid')?$this->getRequestVar('languageid'):$project->getDefaultLanguageId() );
			$language->load();
			Session::setProjectLanguage( $language );
	
			$model = new Model( $this->hasRequestVar('modelid')?$this->getRequestVar('modelid'):$project->getDefaultModelId() );
			$model->load();
			Session::setProjectModel( $model );
	
			$object = new Object( $project->getRootObjectId() );
			$object->objectLoadRaw();
			Session::setObject( $object );
	
			$user->loadRights( $project->projectid,$language->languageid );
			Session::setUser( $user );
		}
		else
		{
			Session::setProject( $project );
		}
	}


	function object()
	{
		$user = Session::getUser();
		if   ( ! is_object($user) )
		{
			$this->callSubAction('show');
		}

		$object = new Object( $this->getRequestId() );
		$object->objectLoadRaw();
		Session::setObject( $object );

		$project = new Project( $object->projectid );
		$project->load();
		Session::setProject( $project );
		
		$language = new Language( $this->hasRequestVar('languageid')?$this->getRequestVar('languageid'):$project->getDefaultLanguageId() );
		$language->load();
		Session::setProjectLanguage( $language );

		$model = new Model( $this->hasRequestVar('modelid')?$this->getRequestVar('modelid'):$project->getDefaultModelId() );
		$model->load();
		Session::setProjectModel( $model );
		
		$user->loadRights( $project->projectid,$language->languageid );
		Session::setUser( $user );
	}


	function language()
	{
		$language = new Language( $this->getRequestId() );
		$language->load();
		Session::setProjectLanguage( $language );

		$project = new Project( $language->projectid );
		$project->load();
		Session::setProject( $project );

		$model = Session::getProjectModel();
		if	( !is_object($model) )
		{
			$model = new Model( $project->getDefaultModelId() );
			$model->load();
			Session::setProjectModel( $model );
		}

		$object = new Object( $project->getRootObjectId() );
		$object->objectLoadRaw();
		Session::setObject( $object );

		$user = Session::getUser();
		$user->loadRights( $project->projectid,$language->languageid );
		Session::setUser( $user );
	}


	function model()
	{
		$model = new Model( $this->getRequestId() );
		$model->load();
		Session::setProjectModel( $model );

		$project = new Project( $model->projectid );
		$project->load();
		Session::setProject( $project );

		$language = Session::getProjectLanguage();
		if	( !is_object($language) || $language->projectid != $project->projectid )
		{
			$language = new Language( $project->getDefaultLanguageId() );
			$language->load();
			Session::setProjectLanguage( $language );
		}

		$object = new Object( $project->getRootObjectId() );
		$object->objectLoadRaw();
		Session::setObject( $object );

		$user = Session::getUser();
		$user->loadRights( $project->projectid,$language->languageid );
		Session::setUser( $user );
	}


	function showtree()
	{
		Session::set('showtree',true );
	}
		

	function hidetree()
	{
		Session::set('showtree',false );
	}
		

	function show()
	{
		global $conf;
		global $PHP_AUTH_USER;
		global $PHP_AUTH_PW;

		$user = Session::getUser();
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
					break;
					
				default:
					die('unknown auth-type: '.$conf['security']['login']['type'] );
			}
		}
		
		if	( $user->mustChangePassword ) 
		{
			$this->addNotice( 'user',$user->name,'PASSWORD_TIMEOUT','warn' );
			$this->callSubAction( 'changepassword' ); // Zwang, das Kennwort zu ändern.
		}

		// Seite ändert sich nur 1x pro Session
		$this->lastModified( $user->loginDate );

		$projectid  = intval( $this->getRequestVar('projectid' ) );
		$languageid = intval( $this->getRequestVar('languageid') );
		$objectid   = intval( $this->getRequestVar('objectid'  ) );

		$project = Session::getProject();

		if ( $project->projectid == PROJECTID_ADMIN )
		{
			$project->name = lang('GLOBAL_ADMINISTRATION');
			Session::setProject( $project );

			Session::setProjectLanguage( '' );
			Session::setProjectModel   ( '' );
			Session::setObject         ( '' );
		}

		$db      = Session::getDatabase();
		$this->setTemplateVar( 'title',$user->name.'@'.$project->name.' ('.$db->conf['comment'].')' );

		$object  = Session::getObject();

		if	( is_object($object) )
		{
			$this->setTemplateVar( 'frame_src_main',Html::url('main',$object->getType(),$object->objectid) );
		}
		elseif	( is_object($project) && $project->projectid == PROJECTID_ADMIN )
		{
			$this->setTemplateVar( 'frame_src_main',Html::url('main','project') );
		}
		else
		{
			$this->callSubAction( 'projectmenu' );
		}
		
		$this->setTemplateVar( 'frame_src_title'   ,Html::url( 'title'          ) );

		$this->setTemplateVar( 'show_tree',(Session::get('showtree')==true) );

		$this->setTemplateVar( 'frame_src_tree_menu' ,Html::url( 'treemenu'       ) );
		$this->setTemplateVar( 'frame_src_tree_title',Html::url( 'treetitle'      ) );
		$this->setTemplateVar( 'frame_src_tree'      ,Html::url( 'tree'    ,'load') );
		$this->setTemplateVar( 'frame_src_clipboard' ,Html::url( 'clipboard'      ) );
		$this->setTemplateVar( 'frame_src_border'    ,Html::url( 'border'         ) );
		$this->setTemplateVar( 'frame_src_background',Html::url( 'background'     ) );

		$this->setTemplateVar( 'tree_width',$conf['interface']['tree_width'] );
	}



	function checkMenu( $name )
	{
		global $conf;
		
		switch( $name )
		{
			// Menüpunkt "Anwendungen" wird nur angezeigt, wenn weitere Anwendungen
			// konfiguriert sind.
			case 'applications':
				return count($conf['applications']) > 0;

			case 'register':
				return $conf['login']['register'];

			case 'send_password':
				$conf['login']['send_password'];
				
			case 'administration':
				return $this->userIsAdmin();
				
			default:
				return true;
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
	function registercode()
	{
		global $conf;

		srand ((double)microtime()*1000003);
		$registerCode = rand();
		
		Session::set('registerCode',$registerCode                         );
		Session::set('registerMail',$this->getRequestVar('mail') );
					
		$mail = new Mail($this->getRequestVar('mail'),
		                 'register_commit_code','register_commit_code');
		$mail->setVar('code',$registerCode);
		$mail->send();


		// TODO: Attribut "Password" abfragen
		foreach( $conf['database'] as $dbname=>$dbconf )
		{
			if	( is_array($dbconf) && $dbconf['enabled'] )
				$dbids[$dbname] = $dbconf['comment'];
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
	 * Benutzer hat Bestätigungscode erhalten und eingegeben.
	 */
	function registercommit()
	{
		$this->checkForDb();

		$origRegisterCode  = Session::get('registerCode');
		$inputRegisterCode = $this->getRequestVar('code');
		
		if	( $origRegisterCode == $inputRegisterCode )
		{
			// Bestätigungscode stimmt überein.
			// Neuen Benutzer anlegen.	
			$newUser = new User();
			$newUser->name = $this->getRequestVar('username');
			$newUser->add();
			
			$newUser->mail     = Session::get('registerMail');
			$newUser->save();
			
			$newUser->setPassword( $this->getRequestVar('password'),true );
			
			$this->addNotice('user',$newUser->name,'user_added','ok');
		}
		else
		{
			// Bestätigungscode stimmt nicht.
			$this->addNotice('user',$newUser->name,'regcode_not_match','error');
		}
	}



	/**
	 * Vergessenes Kennwort zusenden lassen.
	 */
	function password()
	{
		global $conf;
		
		// TODO: Attribut "Password" abfragen
		foreach( $conf['database'] as $dbname=>$dbconf )
		{
			if	( is_array($dbconf) && $dbconf['enabled'] )
				$dbids[$dbname] = $dbconf['comment'];
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
			
			// Altes Kennwort prüfen.
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
			// Beide neuen Kennwörter stimmen nicht überein
			$this->addNotice('user',$user->name,'passwords_not_match','error');
		}
	}
	*/
	
	
	/**
	 * Einen Kennwort-Anforderungscode an den Benutzer senden.
	 */
	function passwordcode()
	{
		$this->checkForDb();

		$user = User::loadWithName( $this->getRequestVar("username") );
		//		Html::debug($user);
		if	( $user->userid > 0 )
		{
			srand ((double)microtime()*1000003);
			$code = rand();
			$this->setSessionVar("password_commit_code",$code);
			
			$eMail = new Mail( $user->mail,'password_commit_code','password_commit_code' );
			$eMail->setVar('name',$user->getName());
			$eMail->setVar('code',$code);
			$eMail->send();
			
			$this->addNotice('','user','mail_sent');
		}
		else
		{
			//$this->addNotice('','user','username_not_found');
			// Trotzdem vortäuschen, eine E-Mail zu senden, damit die Gültigkeit
			// eines Benutzernamens nicht von außen geprüft werden kann.
			// 
			$this->addNotice('','user','mail_sent');
			sleep(5);
		}
		
		$this->setSessionVar("password_commit_name",$user->name);
	}
	
	
	
	/**
	 * Neues Kennwort erzeugen und dem Benutzer zusenden.
	 */
	function passwordcommit()
	{
		$ok = $this->getSessionVar("password_commit_code") == $this->getRequestVar("code");
		
		if	( $ok )
		{
			$user = User::loadWithName( $this->getSessionVar("password_commit_name") );
			
			$newPw = User::createPassword();
			
			if	( intval($user->userid)!=0 )
			{
				$eMail = new Mail( $user->mail,'password_new','password_new' );
				$eMail->setVar('password',$newPw);
				$eMail->setVar('name',$user->getName());
				$eMail->send();
				
				$user->setPassword( $newPw, false );
				$this->addNotice('user','user','mail_sent','ok');
			}
			else
			{
				$this->addNotice('user','user','username_not_found','error');
			}
		}
		else
		{
			$this->addNotice('user','user','password_code_failure','error');
		}
	}
	
}


?>