<?php


namespace util;
use Spyc;

/**
 * YAML Wrapper for the Spyc implementation of a YAML-Parser.
 */
class YAML
{
	/**
	 * Load a string of YAML into a PHP array statically.
	 *
	 * The load method, when supplied with a YAML string, will do its best
	 * to convert YAML in a string into a PHP array.  Pretty simple.
	 * @param $string
	 * @return array
	 */
	public static function parse($string)
	{
		return Spyc::YAMLLoadString($string);
	}

	/**
	 * Dump YAML from PHP array statically
	 *
	 * The dump method, when supplied with an array, will do its best
	 * to convert the array into friendly YAML.  Pretty simple.  Feel free to
	 * save the returned string as nothing.yaml and pass it around.
	 *
	 * Oh, and you can decide how big the indent is and what the wordwrap
	 * for folding is.  Pretty cool -- just pass in 'false' for either if
	 * you want to use the default.
	 *
	 * Indent's default is 2 spaces, wordwrap's default is 40 characters.  And
	 * you can turn off wordwrap by passing in 0.
	 *
	 * @access public
	 * @param array|\stdClass $array PHP array
	 * @param int $indent Pass in false to use the default, which is 2
	 * @param int $wordwrap Pass in 0 for no wordwrap, false for default (40)
	 * @param bool $no_opening_dashes Do not start YAML file with "---\n"
	 * @return string
	 */
	public static function dump($array, $indent = false, $wordwrap = false, $no_opening_dashes = true)
	{
		return Spyc::YAMLDump($array, $indent, $wordwrap, $no_opening_dashes);
	}
}