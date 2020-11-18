<?php

namespace cms\auth;

use cms\action\Action;
use cms\auth\Auth;
use cms\base\Configuration;
use cms\base\DB;
use cms\base\Startup;
use cms\model\Text;
use database\Database;
use cms\model\User;
use logger\Logger;
use util\Cookie;
use security\Password;
use \util\exception\ObjectNotFoundException;
use util\Session;
use util\text\TextMessage;

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
		if ( Cookie::has(Action::COOKIE_TOKEN) &&
			 Cookie::has(Action::COOKIE_DB_ID)    ) {
			try {
				list($selector, $token) = array_pad(explode('.', Cookie::get(Action::COOKIE_TOKEN)), 2, '');
				$dbid = Cookie::get( Action::COOKIE_DB_ID );

				$dbConfig = Configuration::subset('database');

				if (!$dbConfig->has($dbid)) {

					Logger::info( TextMessage::create('Unknown DB-Id for token-login: ${0}',[$dbid]) );
					return null;
				}

				$dbConfig = $dbConfig->subset($dbid);


				$key = 'read'; // Only reading in database.

				$db = new Database($dbConfig->merge( $dbConfig->subset($key) )->getConfig());
				$db->id = $dbid;
				$db->start();

				$stmt = $db->sql(<<<SQL
                    SELECT userid,{{user}}.name as username,token,token_algo FROM {{auth}}
                       LEFT JOIN {{user}} ON {{auth}}.userid = {{user}}.id
                    WHERE selector = {selector} AND expires > {now}
SQL
				);
				$stmt->setString('selector', $selector);
				$stmt->setInt   ('now'     , Startup::getStartTime() );

				$auth = $stmt->getRow();
				$db->disconnect();


				if ($auth) {
					$this->makeDBWritable( $dbid ); // FIXME: This is a hack, how to do this better?
					// serial was found.
					$username = $auth['username'];
					$userid   = $auth['userid'  ];
					$user     = new User( $userid );

					if (Password::check($token, $auth['token'], $auth['token_algo'])) {
						Cookie::set(Action::COOKIE_TOKEN   ,$user->createNewLoginTokenForSerial($selector) );
						DB::get()->commit();
						return $username;
					}
					else {
						// serial match but token mismatched.
						// this means, the token was used on another device before, probably stolen.
						Logger::warn( TextMessage::create('Possible breakin-attempt detected for user ${0}',[$username]));
						$user->deleteAllLoginTokens(); // Disable all token logins for this user.
						Cookie::set(Action::COOKIE_TOKEN ); // Delete token cookie

						// we must not reset the password here, because the thief might not have it.

						return null;
					}
				} else {
					// The serial is not found, maybe expired.
					// There is nothing we should do here.
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
		return null;
	}

	protected function makeDBWritable( $dbid ) {

		$dbConfig = Configuration::subset(['database',$dbid]);

		$key = 'write';
		$db = new Database($dbConfig->merge( $dbConfig->subset($key) )->getConfig());
		$db->id = $dbid;
		$db->start();

		Session::setDatabase( $db );
	}
}