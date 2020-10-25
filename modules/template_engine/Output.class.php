<?php


namespace template_engine;


use cms\base\Configuration;
use cms\base\Language;
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
		return Text::translateutf8tohtml(htmlentities($text));
	}

	/**
	 * Gets a localized message
	 * @param $key message key
	 * @return mixed|string
	 */
	public static function lang($key) {
		return Language::lang($key);
	}


	public static function config($part1 = null, $part2 = null, $part3 = null, $part4 = null) {
		return Configuration::config($part1,$part2,$part3,$part4);
	}
}