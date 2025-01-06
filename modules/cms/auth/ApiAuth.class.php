<?php

namespace cms\auth;

use cms\action\Action;
use cms\base\Configuration;
use cms\base\DB;
use cms\base\Startup;
use database\Database;
use cms\model\User;
use logger\Logger;
use util\Cookie;
use security\Password;
use \util\exception\ObjectNotFoundException;
use util\Request;
use util\Session;
use util\text\TextMessage;

/**
 * Authenticate with an API-Token.
 *
 * @author dankert
 */
class ApiAuth {
	/**
	 * @return null
	 */
	public function getUserIdFromToken( $selector,$token)
	{
		$stmt = DB::sql(<<<SQL
			SELECT userid,{{user}}.name as username,token,token_algo FROM {{auth}}
			   LEFT JOIN {{user}} ON {{auth}}.userid = {{user}}.id
			WHERE selector = {selector} AND expires > {now}
SQL
		);
		$stmt->setString('selector', $selector);
		$stmt->setInt   ('now'     , Startup::getStartTime() );

		$auth = $stmt->getRow();

		if ($auth) {
			// serial was found.
			$userid   = $auth['userid'  ];

			// Check the token
			if (Password::check($token, $auth['token'], $auth['token_algo'])) {
				return new User( $userid );
			}
			else {
				// Token mismatch.
				return null;
			}
		} else {
			// The serial is not found, maybe expired.
			// There is nothing we should do here.
			return null;
		}
	}
}