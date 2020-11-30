<?php

namespace cms\auth;

use cms\base\Configuration;
use database\Database;

/**
 * Authentifzierung über eine externe Datenbank.
 * @author dankert
 *
 */
class DatabaseAuth implements Auth
{

	/**
	 * Login.
	 */
	public function login($user, $password, $token)
	{
		$authDbConf = Configuration::subset(['security','authdb']);

		if (!$authDbConf->is('enable',true))
			return Auth::STATUS_FAILED;

		$authdb = new Database($authDbConf);

		$sql  = $authdb->sql($authDbConf->get('sql'));
		$algo = $authDbConf->get('hash_algo' );
		$sql->setString('username', $user);
		$sql->setString('password', hash($algo, $password));
		$row = $sql->getRow();

		$authdb->disconnect();

		return $row ? Auth::STATUS_SUCCESS : Auth::STATUS_FAILED;
	}

	public function username()
	{
		return null;
	}

}
