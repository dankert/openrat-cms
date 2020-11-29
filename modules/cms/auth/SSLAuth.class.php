<?php

namespace cms\auth;

use cms\base\Configuration;

/**
 * Authentifizierung ueber ein SSL-Zertifikat.
 *
 * @author dankert
 */
class SSLAuth implements Auth
{
	public function username()
	{
		$envName = Configuration::subset(['security', 'ssl'] )->get('client_cert_dn_env','SSL_CLIENT_S_DN_CN');

		$dn = @$_SERVER[ $envName ];

		if   ( $dn )
			return $dn;

		return null;
	}


	/**
	 * Ueberpruefen des Kennwortes ist nicht möglich.
	 */
	public function login($user, $password, $token)
	{
		return ( $this->username() == $user ) ? Auth::STATUS_SUCCESS : Auth::STATUS_FAILED;;
	}
}

