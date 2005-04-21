<?php
// $Id$
// ---------------------------------------------------------------------------
// OpenRat Content Management System
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


/**
 * Login-Formular
 *
 * @author $Author$
 * @version $Revision$
 * @package openrat.forms
 */

class LoginForm extends AbstractForm
{
	var $login_name;
	var $login_password;

	
	function validate()
	{
		if	( $this->login_name == '' )
			$this->addError('login_name','LOGIN_ERROR_LOGIN_NAME_REQUIRED');

		if	( $this->login_password == '' )
			$this->addError('login_password','LOGIN_ERROR_LOGIN_PASSWORD_REQUIRED');
	}
}

?>