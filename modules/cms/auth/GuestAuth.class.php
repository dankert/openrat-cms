<?php

namespace cms\auth;

use cms\auth\Auth;
use cms\base\Configuration;

/**
 * Authentifizierung als Gast-User.
 *
 * Falls konfiguriert, wird der Gast-Benutzer voreingestellt.
 *
 * @author dankert
 */
class GuestAuth implements Auth
{
	public function username()
	{
		$guestConf = Configuration::subset(['security','guest']);

		if ($guestConf->is('enable',true))
			return $guestConf->get('user');
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

?>