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
	 * get all enabled databases.
	 * @return Config[]
	 */
    protected function getAllEnabledDatabases() {

		return array_filter( Configuration::subset('database')->subsets(), function($dbConfig) {
			return $dbConfig->is('enabled',true);
		});

	}


	/**
	 * Gets a list of all databases.
	 * @return string[] list of databases.
	 */
	protected function getSelectableDatabases() {

		return array_map( function($dbconf) {
			// Getting the first not-null information about the connection.
			return array_values(array_filter( array(
				$dbconf->get('description'),
				$dbconf->get('name'  ),
				$dbconf->get('host'  ),
				$dbconf->get('driver'),
				$dbconf->get('type'  ),
				'unknown')))[0];

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


