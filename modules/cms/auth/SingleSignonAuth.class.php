<?php

namespace cms\auth;

/**
 * Single-Signon-Authentifizierung.
 *
 * @author dankert
 */
class SingleSignonAuth implements Auth
{
	public function username()
	{
		return null;
	}


	/**
	 * Ueberpruefen des Kennwortes ist über Ident nicht möglich.
	 */
	public function login($user, $password, $token)
	{
		return Auth::STATUS_FAILED;;
	}
}

