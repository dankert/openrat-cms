<?php

namespace cms\auth;

use cms\auth\Auth;
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
		$conf = \cms\base\Configuration::rawConfig();

		$authDbConf = $conf['security']['authdb'];

		if (!$authDbConf['enable'])
			return false;

		$authdb = new Database($authDbConf);

		$sql = $authdb->sql($conf['security']['authdb']['sql']);
		$algo = $authdb->sql($conf['security']['authdb']['hash_algo']);
		$sql->setString('username', $user);
		$sql->setString('password', hash($algo, $password));
		$row = $sql->getRow();
		$ok = !empty($row);

		// noch nicht implementiert: $authdb->close();

		return $ok ? Auth::STATUS_SUCCESS : Auth::STATUS_FAILED;
	}

	public function username()
	{
		return null;
	}

}

?>