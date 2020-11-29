<?php


namespace cms\auth;


use cms\base\Configuration;
use logger\Logger;

/**
 * Executes multiple authentication modules.
 */
class AuthRunner
{
	/**
	 * Executes the callback with all modules of this section
	 *
	 * @param $section string a configuration setting under security/modules which must contain an array of strings
	 * @param $callback callable anonymous function with a auth module as first parameter
	 * @param $emptyResult mixed if the callback returns this value, the next value is executed.
	 * @return mixed
	 */
	protected static function getModulesFor($section, $callback, $emptyResult )
	{
		$securityConfig = Configuration::subset('security');

		$modules = $securityConfig->subset($section )->get('modules',[]);

		foreach ($modules as $module) {

			$moduleClass = Auth::NS . '\\' . $module . 'Auth';

			if (!class_exists($moduleClass)) {
				throw new \LogicException('module is not available: ' . $moduleClass );
			}

			/** @var \cms\auth\Auth $auth */
			$auth = new $moduleClass;
			$result = $callback( $auth );

			if  ( $result != $emptyResult )
				return $result;

			// next module.
		}

		return $emptyResult;
	}


	/**
	 * Search for a username in all modules of this section.
	 *
	 * @param $section
	 * @return string username of null (if none found)
	 */
	public static function getUsername( $section ) {

		return self::getModulesFor(/**
		 * @param $auth Auth
		 */ $section, function($auth) {
			$username = $auth->username();

			if ($username)
				Logger::debug('Preselecting User ' . $username . ' from ' . get_class($auth) );

			return $username;
		},null);
	}


	/**
	 * Makes an autorization through all modules of this section.
	 *
	 * @param $section
	 * @param $user
	 * @param $password
	 * @param $token
	 * @return int a bitmask of Auth::STATUS_*
	 */
	public static function checkLogin( $section, $user,$password,$token ) {

		return self::getModulesFor($section, /**
		 * @param $auth Auth
		 * @return null|boolean|int
		 */ function($auth) use ($token, $password, $user) {
				Logger::info('Trying to login with module '.get_class($auth));

				return $auth->login($user,$password,$token);
			}, Auth::STATUS_FAILED
		);
	}
}