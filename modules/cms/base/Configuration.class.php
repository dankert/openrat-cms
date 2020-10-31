<?php

namespace cms\base;

use configuration\Config;
use util\Session;

class Configuration {

	/**
	 * @return Config
	 */
	public static function Conf()
	{

		return new Config(self::getConfig() );

	}


	/**
	 * Gives the subset with this key.
	 * @param $key string|array subset key
	 * @return Config
	 */
	public static function subset( $key ) {
		return self::Conf()->subset($key);
	}

	private static function getConfig()
	{
		return Session::getConfig();
	}


	public static function rawConfig() {
		return self::getConfig();
	}


	/**
	 * @param $keys
	 */
	public static function get( $keys ) {

		settype($keys,'array');

		$value = self::getConfig();

		foreach( $keys as $key ) {
			if   ( is_array( $value ) ) {
				if   ( isset( $value[$key] ) )
					$value = $value[$key];
				else
					return null;;
			} else {
				return null;
			}
		}

		return $value;
	}

}
