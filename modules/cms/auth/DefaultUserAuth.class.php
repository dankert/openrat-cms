<?php

namespace cms\auth;

use cms\base\Configuration;

/**
 * Gets the default user.
 * 
 * @author dankert
 */
class DefaultUserAuth implements Auth
{
	public function username()
	{
		return Configuration::subset( ['security','default'])->get('username');
	}


	/**
	 * Ueberpruefen des Kennwortes ist über Ident nicht möglich.
	 */
	public function login($user, $password, $token)
	{
		return Auth::STATUS_FAILED;
	}

}
