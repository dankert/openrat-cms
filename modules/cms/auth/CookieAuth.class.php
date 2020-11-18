<?php

namespace cms\auth;

use cms\action\Action;
use cms\auth\Auth;
use util\Cookie;

/**
 * Using the username from a cookie.
 *
 * @author dankert
 */
class CookieAuth implements Auth
{
	public function username()
	{
		return Cookie::get( Action::COOKIE_USERNAME,null );
	}


	/**
	 * Ueberpruefen des Kennwortes ist über Ident nicht möglich.
	 */
	public function login($user, $password, $token)
	{
		return false;
	}

}

