<?php

namespace cms\auth;

use cms\auth\Auth;
use util\Http;

/**
 * HTTP-Authentifzierung.
 *
 * Das vom Benutzer eingegebene Kennwort wird gegen eine HTTP-Adresse
 * geprüft, bei der HTTP-Auth aktiviert ist.
 *
 * @author Jan Dankert
 */
class HttpAuth implements Auth
{

	/**
	 * Dieses Loginmodul kann keinen Namen feststellen.
	 */
	public function username()
	{
		return null;
	}


	/**
	 * Ueberpruefen des Kennwortes.
	 *
	 * Das Kennwort wird gegen einen HTTP-Server geprüft.
	 */
	public function login($user, $password, $token)
	{
		global $conf;

		$http = new Http($conf['security']['http']['url']);
		$http->method = 'HEAD';
		$http->setBasicAuthentication($this->name, $password);

		$ok = $http->request();

		return $ok;
	}
}

?>