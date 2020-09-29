<?php

namespace cms\action;

use cms\model\User;
use language\Messages;
use util\exception\ValidationException;

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
 * Action-Klasse zum Bearbeiten eines Benutzers
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */
class UserlistAction extends BaseAction
{
	public $security = Action::SECURITY_ADMIN;
	
	function __construct()
	{
        parent::__construct();
	}


	function showView()
	{
		$list = array();

		foreach( User::getAllUsers() as $user )
		{
			$list[$user->userid]        = $user->getProperties();
			$list[$user->userid]['id' ] = $user->userid;
		}
		$this->setTemplateVar('el',$list);
	}	
		

	/**
	 * Eigenschaften des Benutzers anzeigen
	 */
	function editView()
	{
		$this->nextSubAction('show');
	}


	
		function addView()
	{
	}


	/**
	 * @param $name name of the new user.
	 */
	public function addPost( $name )
	{
		$name = $this->request->cleanText($name,RequestParams::FILTER_ALPHANUM);

		$user = User::loadWithName($name);

		if   ( !empty($user) )
			throw new ValidationException( 'name',Messages::USER_ALREADY_IN_DATABASE);

		$user = new User();
		$user->add( $name );
		$this->addNoticeFor($user, Messages::ADDED);
	}


	
				
}