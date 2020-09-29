<?php

namespace cms\auth;

use cms\auth\Auth;
use database\Database;
use cms\model\User;
use logger\Logger;
use \util\exception\ObjectNotFoundException;

/**
 * Authentifizierung mit einem Login-Token.
 *
 * @author dankert
 */
class RememberAuth implements Auth
{
	/**
	 * @return null
	 */
	public function username()
	{
		// Ermittelt den Benutzernamen aus den Login-Cookies.
		if (isset($_COOKIE['or_token']) &&
			isset($_COOKIE['or_dbid'])) {
			try {
				list($selector, $token) = array_pad(explode('.', $_COOKIE['or_token']), 2, '');
				$dbid = $_COOKIE['or_dbid'];

				$dbConfig = \cms\base\Configuration::config()->subset('database');

				if (!$dbConfig->has($dbid)) {

					Logger::info('unknown DB-Id for token-login: ' . Logger::sanitizeInput($dbid));
					return null;
				}

				$dbConfig = $dbConfig->subset($dbid);


				$key = 'read'; // Only reading in database.

				$db = new Database($dbConfig->subset($key)->getConfig() + $dbConfig->getConfig());
				$db->id = $dbid;
				$db->start();

				$stmt = $db->sql(<<<SQL
                    SELECT userid,{{user}}.name as username,token,token_algo FROM {{auth}}
                       LEFT JOIN {{user}} ON {{auth}}.userid = {{user}}.id
                    WHERE selector = {selector} AND expires > {now}
SQL
				);
				$stmt->setString('selector', $selector);
				$stmt->setInt('now', time());

				$auth = $stmt->getRow();

				if ($auth) {
					if (\security\Password::check($token, $auth['token'], $auth['token_algo']))
						return $auth['username'];
				}

			} catch (ObjectNotFoundException $e) {
				// Benutzer nicht gefunden.
			}
		}

		return null;
	}


	/**
	 * Ueberpruefen des Kennwortes ist über den Cookie nicht möglich.
	 */
	public function login($user, $password, $token)
	{
		return false;
	}
}

?>