<?php


namespace template_engine;


use cms\base\Configuration;
use cms\base\Language;
use template_engine\mapper\Mapper;
use util\Text;

/**
 * A collection of methods, used by the templates.
 */
class Output
{
	/**
	 * Ersetzt alle Zeichen mit dem Ordinalwert > 127 mit einer HTML-Maskierung.
	 *
	 * @return String
	 */
	public static function encodeHtml($text)
	{
		return Text::translateutf8tohtml($text);
	}

	public static function escapeHtml($text)
	{
		return Text::translateutf8tohtml(htmlentities($text, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401 ));
	}

	/**
	 * Gets a localized message
	 * @param $key string message key
	 * @return string
	 */
	public static function lang($key) {
		return Language::lang($key);
	}


	/**
	 * Gets a configuraton value.
	 *
	 * Delegating to the Configuration.
	 *
	 * @param $keys array
	 * @return mixed
	 */
	public static function config( $keys ) {
		return Configuration::get( $keys );
	}

	public static function map( $mapper,$value ) {

		$mapperClassName = ucfirst($mapper).'Mapper';
		$class = "template_engine\\mapper\\$mapperClassName";
		/* @type $do Mapper */
		$mapper = new $class;
		return $mapper->map( $value );
	}
}