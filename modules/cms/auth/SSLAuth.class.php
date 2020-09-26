<?php

namespace cms\auth;

use cms\auth\Auth;

/**
 * Authentifizierung ueber ein SSL-Zertifikat.
 *
 * @author dankert
 */
class SSLAuth implements Auth
{
	public function username()
	{
		$conf = \cms\base\Configuration::config('security', 'ssl');
		if (isset($_SERVER[\cms\base\Configuration::config('security', 'ssl', 'client_cert_dn_env')]))
			return $_SERVER[\cms\base\Configuration::config('security', 'ssl', 'client_cert_dn_env')];
	}


	/**
	 * Ueberpruefen des Kennwortes ist nicht möglich.
	 */
	public function login($user, $password, $token)
	{
		return false;
	}
}

?>