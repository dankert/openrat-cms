<?php


namespace util\json;

require(__DIR__.'/../JSON.class.php');

/**
 * JSON Wrapper.
 */
class JSON
{
	public static function encode($jsonObj) {

		if (function_exists('json_encode'))
		{
			// Native Methode ist schneller..
			if ( version_compare(PHP_VERSION, '5.5', '>=' ) )
				$jsonOptions = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK | JSON_PARTIAL_OUTPUT_ON_ERROR;
			else
				$jsonOptions = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK;

			return json_encode($jsonObj, $jsonOptions);
		}
		else
		{
			// Fallback, falls json_encode() nicht existiert...
			$json = new \JSON();
			return $json->encode($jsonObj);
		}

	}
	public static function decode($jsonText) {

		if (!function_exists('json_decode')) {
			return json_decode( $jsonText );
		} else {
			$json = new \JSON();
			return $json->decode($jsonText);
		}
	}
}