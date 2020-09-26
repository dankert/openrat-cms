<?php

namespace cms\auth;

use cms\auth\Auth;

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
		$conf = \cms\base\Configuration::rawConfig();
		$guestConf = $conf['security']['guest'];

		if ($guestConf['enable'])
			return $guestConf['user'];
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