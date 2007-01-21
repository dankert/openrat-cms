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
			$user->loadProjects();
			//$user->loadRights();
			$user->setCurrent();
			$user->loginDate = time();
			Session::setUser( $user );
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

//		$this->setTemplateVar('logo'         ,$conf['login'   ]['logo'    ] );
//		$this->setTemplateVar('logo_url'     ,$conf['login'   ]['logo_url'] );
//		$this->setTemplateVar('motd'         ,$conf['login'   ]['motd'    ] );
//		$this->setTemplateVar('readonly'     ,$conf['security']['readonly'] );
//		$this->setTemplateVar('nologin'      ,$conf['login'   ]['nologin' ] );
//		$this->setTemplateVar('nopublish'    ,$conf['security']['nopublish']);
		$this->setTemplateVar('register'     ,$conf['login'   ]['register' ]);
		$this->setTemplateVar('send_password',$conf['login'   ]['send_password']);
		$this->setTemplateVar('loginmessage',$this->getSessionVar('loginmessage'));
		$this->setSessionVar('loginmessage','');
	}

	function projectmenu()
	{
		$user     = Session::getUser();
		
		if	( $user->mustChangePassword ) 
		{
			$this->addNotice( 'user',$user->name,'PASSWORD_TIMEOUT','warn' );
			$this->callSubAction( 'changepassword' ); // Zwang, das Kennwort zu ändern.
		}
		
		
		$projects = $user->projects;

		$this->lastModified( $user->loginDate );

		// Administrator sieht Administrationsbereich
//		if   ( $user->isAdmin )
//			$projects = array("-1"=>lang('GLOBAL_ADMINISTRATION')) +  $projects;

		// Projekte ermitteln

		$list = array();
		foreach( $projects as $id=>$name )
		{
			$list[$id]         = array();
			$list[$id]['url' ] = Html::url('index','project',$id);
			$list[$id]['name'] = $name;
		}
		$this->setTemplateVar('el',$list);
	}


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

		$loginName     = $this->getRequestVar('login_name'    );
		$loginPassword = $this->getRequestVar('login_password');
		$newPassword1  = $this->getRequestVar('password1');
		$newPassword2  = $this->getRequestVar('password2');

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
			
			$language = new Language( $project->getDefaultLanguageId() );
			$language->load();
			Session::setProjectLanguage( $language );
	
			$model = new Model( $project->getDefaultModelId() );
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
		
		$language = new Language( $project->getDefaultLanguageId() );
		$language->load();
		Session::setProjectLanguage( $language );

		$model = new Model( $project->getDefaultModelId() );
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
						header( 'WWW-Authenticate: Basic realm="OpenRat Content Management System - Login"' );
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