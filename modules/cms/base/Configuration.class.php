<?php

namespace cms\base;

use configuration\Config;
use util\Session;

class Configuration {

	/*
 * Liest einen Schluessel aus der Konfiguration
 *
 * @return String, leer falls Schluessel nicht vorhanden
 */
	public static function config($part1 = null, $part2 = null, $part3 = null, $part4 = null)
	{
		$conf = self::getConfig();

		if ($part1 == null)
			return new Config($conf);

		if ($part2 == null)
			if (isset($conf[$part1]))
				return $conf[$part1];
			else
				return '';

		if ($part3 == null)
			if (isset($conf[$part1][$part2]))
				return $conf[$part1][$part2];
			else
				return '';

		if ($part4 == null)
			if (isset($conf[$part1][$part2][$part3]))
				return $conf[$part1][$part2][$part3];
			else
				return '';

		if (isset($conf[$part1][$part2][$part3][$part4]))
			return $conf[$part1][$part2][$part3][$part4];
		else
			return '';
	}


	/**
	 * @return Config
	 */
	public static function Conf()
	{

		return new Config(self::getConfig() );

	}


	/**
	 * Gives the subset with this key.
	 * @param $key subset key
	 * @return Config
	 */
	public static function subset( $key ) {
		return self::Conf()->subset($key);
	}

	private static function getConfig()
	{
		return Session::getConfig();
	}

}
