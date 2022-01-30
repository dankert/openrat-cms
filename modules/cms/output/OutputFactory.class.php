<?php

namespace cms\output;

use util\Http;

class OutputFactory {

	const OUTPUT_PHPARRAY     = 1;
	const OUTPUT_PHPSERIALIZE = 2;
	const OUTPUT_JSON         = 3;
	const OUTPUT_XML          = 4;
	const OUTPUT_YAML         = 5;
	const OUTPUT_HTML         = 6;
	const OUTPUT_PLAIN        = 7;


	/**
	 * Map 'output' request to output type.
	 */
	const MAP_OUTPUT = [
		'php-array' => self::OUTPUT_PHPARRAY,
		'php'       => self::OUTPUT_PHPSERIALIZE,
		'json'      => self::OUTPUT_JSON,
		'xml'       => self::OUTPUT_XML,
		'yaml'      => self::OUTPUT_YAML,
		'plain'     => self::OUTPUT_PLAIN
	];

	/**
	 * Map Accept-Header to Output type.
	 */
	const MAP_ACCEPT = [
		'application/php-array'      => self::OUTPUT_PHPARRAY,
		'application/php-serialized' => self::OUTPUT_PHPSERIALIZE,
		'application/json'           => self::OUTPUT_JSON,
		'application/xml'            => self::OUTPUT_XML,
		'application/yaml'           => self::OUTPUT_YAML,
		'text/html'                  => self::OUTPUT_HTML,
	];

	public static function createOutput() {

		switch ( self::discoverOutputType() ) {
			case self::OUTPUT_PHPARRAY:
				return new PHPArrayOutput();
			case self::OUTPUT_PHPSERIALIZE:
				return new PHPSerializeOutput();
			case self::OUTPUT_JSON:
				return new JsonOutput();
			// case self::
			//	return new HtmlPlainOutput();
			case self::OUTPUT_XML:
				return new XmlOutput();
			case self::OUTPUT_YAML:
				return new YamlOutput();
			case self::OUTPUT_PLAIN:
				return new PlainOutput();
			case self::OUTPUT_HTML:
			default:
				return new HtmlOutput();
		}
	}



	/**
	 * Discovering the output-type for this request
	 *
	 * @return int constant of self::OUTPUT_*
	 */
	private static function discoverOutputType()
	{
		$reqOutput = strtolower(@$_REQUEST['output']);

		// Try 1: Checking the 'output' request parameter.
		if   ( $reqOutput && array_key_exists( $reqOutput, self::MAP_OUTPUT ) )
			return self::MAP_OUTPUT[ $reqOutput ];

		// Try 2: Lets check the HTTP request headers
		foreach( Http::getAccept() as $acceptType )
			if   ( array_key_exists( $acceptType, self::MAP_ACCEPT ) )
				return self::MAP_ACCEPT[ $acceptType ];

		// Fallback
		return self::OUTPUT_HTML;
	}

}