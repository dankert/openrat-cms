<?php

namespace cms\auth;

use cms\auth\Auth;
use cms\base\Configuration;
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
		$http = new Http( Configuration::get(['security','http','url']));
		$http->method = 'HEAD';
		$http->setBasicAuthentication($user, $password);

		$ok = $http->request();

		return $ok;
	}
}
