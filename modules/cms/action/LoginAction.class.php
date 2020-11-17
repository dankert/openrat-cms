<?php

namespace cms\action;


use cms\auth\Auth;
use cms\auth\AuthRunner;
use cms\auth\InternalAuth;
use cms\base\Configuration;
use cms\base\DB;
use cms\base\Startup;
use cms\model\User;
use configuration\Config;
use Exception;
use language\Messages;
use logger\Logger;
use openid_connect\OpenIDConnectClient;
use security\Password;
use util\exception\ObjectNotFoundException;
use util\exception\SecurityException;
use util\exception\UIException;
use util\exception\ValidationException;
use util\Mail;
use util\Session;
use util\text\TextMessage;


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


/**
 * Action-Klasse fuer die Start-Action
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */

class LoginAction extends BaseAction
{
	public $security = Action::SECURITY_GUEST;


	public function __construct()
    {
        parent::__construct();
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
    protected function checkLogin($name, $pw, $pw1, $pw2 )
	{
		Logger::debug( "Login user: '$name'.'" );
	
		Session::setUser(null);
	
		
		$db = \cms\base\DB::get();
		
		if	( !is_object($db) )
		{
			$this->addNotice('database', 0, '', 'DATABASE_CONNECTION_ERROR', Action::NOTICE_ERROR, array(), array('no connection'));
			//$this->callSubAction('showlogin');
			return false;
		}
		
		if	( !$db->available )
		{
			$this->addNotice('database', 0, $db->conf['description'], 'DATABASE_CONNECTION_ERROR', Action::NOTICE_ERROR, array(), array('Database Error: ' . $db->error));
			//$this->callSubAction('showlogin');
			return false;
		}
		
		$ip = getenv("REMOTE_ADDR");
	
		$user = new User();
		$user->name = $name;
		
		$ok = $user->checkPassword( $pw );
		
		$mustChangePassword = $user->mustChangePassword;

		$passwordConfig = Configuration::subset(['security','password']);
		
		if	( $mustChangePassword )
		{
			// Der Benutzer hat zwar ein richtiges Kennwort eingegeben, aber dieses ist abgelaufen.
			// Wir versuchen hier, das neue zu setzen (sofern eingegeben).
			if	( empty($pw1) )
			{
			}
			elseif	( $pw1 != $pw2 )
			{
				$this->addValidationError('password1',Messages::PASSWORDS_DO_NOT_MATCH);
				$this->addValidationError('password2','');
			}
			elseif	( strlen($pw2) < $passwordConfig->get('min_length',10) )
			{
				$this->addValidationError('password1',Messages::PASSWORD_MINLENGTH,[
					'minlength'=>$passwordConfig->get('min_length',10)
				]);
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
			Logger::info( TextMessage::create('login failed for user ${name} from IP ${ip}',
				[
					'name' => $user->name,
					'ip'   => $ip
				]
			) );

			return false;
		}
	}


	/**
	 * get all enabled databases.
	 * @return Config[]
	 */
    protected function getAllEnabledDatabases() {

		return array_filter( Configuration::subset('database')->subsets(), function($dbConfig) {
			$dbConfig->is('enabled',true);
		});

	}


	/**
	 * Gets a list of all databases.
	 * @return string[] list of databases.
	 */
	protected function getSelectableDatabases() {

		return array_map( function($dbconf) {
			// Getting the first not-null information about the connection.
			return array_filter( array(
				$dbconf->get('description'),
				$dbconf->get('name'  ),
				$dbconf->get('host'  ),
				$dbconf->get('driver'),
				$dbconf->get('type'  ),
				'unknown'))[0];

		}, $this->getAllEnabledDatabases() );

	}





	/**
	 * Erzeugt eine Anwendungsliste.
     * TODO: unused at the moment
	 * @deprecated
	 */
	function applications()
	{
		$conf = Configuration::rawConfig();
		
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
	 * Erzeugt eine neue Sitzung.
	 */
	protected function recreateSession()
	{
		
        session_regenerate_id(true);
	}

}


