<?php


namespace util\text;


class Converter
{
	public static function toCamelCase($string) {
		$string = str_replace('-', ' ', $string);
		$string = str_replace('_', ' ', $string);
		$string = ucwords(strtolower($string));
		$string = str_replace(' ', '', $string);
		$string = lcfirst($string);

		return $string;
	}


	public static function camelToUnderscore($string, $us = "-") {

		return strtolower(preg_replace(
			'/(?<=\d)(?=[A-Za-z])|(?<=[A-Za-z])(?=\d)|(?<=[a-z])(?=[A-Z])/', $us, $string));
	}
}