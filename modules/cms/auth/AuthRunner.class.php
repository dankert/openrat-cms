<?php


namespace cms\auth;


use cms\base\Configuration;
use logger\Logger;

class AuthRunner
{
	protected static function getModulesFor($section, $callback )
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

			if  ( $result )
				return $result;

			// next module.
		}

		return null;
	}


	public static function getUsername( $section ) {

		return self::getModulesFor(/**
		 * @param $auth Auth
		 */ $section, function($auth) {
			$username = $auth->username();

			if ($username)
				Logger::debug('Preselecting User ' . $username . ' from ' . get_class($auth) );

			return $username;
		});
	}


	public static function checkLogin( $section, $user,$password,$token ) {

		return self::getModulesFor($section, /**
		 * @param $auth Auth
		 * @return null|boolean|int
		 */ function($auth) use ($token, $password, $user) {
				Logger::info('Trying to login with module '.get_class($auth));

				return $auth->login($user,$password,$token);
			}
		);
	}
}