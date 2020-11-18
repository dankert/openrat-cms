<?php

namespace cms\auth;

use cms\action\Action;
use cms\auth\Auth;

/**
 * Using the username from a cookie.
 *
 * @author dankert
 */
class CookieAuth implements Auth
{
	public function username()
	{
		if (isset($_COOKIE[ Action::COOKIE_USERNAME ]))
			return $_COOKIE[ Action::COOKIE_USERNAME ];
		else
			return null;
	}


	/**
	 * Ueberpruefen des Kennwortes ist über Ident nicht möglich.
	 */
	public function login($user, $password, $token)
	{
		return false;
	}

}

