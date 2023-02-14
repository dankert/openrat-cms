<?php

namespace cms\output;

use cms\action\RequestParams;
use util\Http;

class OutputFactory {

	const OUTPUT_PHPARRAY     = 1;
	const OUTPUT_PHPSERIALIZE = 2;
	const OUTPUT_JSON         = 3;
	const OUTPUT_XML          = 4;
	const OUTPUT_YAML         = 5;
	const OUTPUT_UI           = 6;
	const OUTPUT_PLAIN        = 7;
	const OUTPUT_CSS          = 8;
	const OUTPUT_PREVIEW      = 9;


	/**
	 * Map 'output' request to output type.
	 */
	const MAP_OUTPUT = [
		'php-array' => self::OUTPUT_PHPARRAY,
		'php'       => self::OUTPUT_PHPSERIALIZE,
		'json'      => self::OUTPUT_JSON,
		'xml'       => self::OUTPUT_XML,
		'yaml'      => self::OUTPUT_YAML,
		'plain'     => self::OUTPUT_PLAIN,
		'html'      => self::OUTPUT_UI,
		'css'       => self::OUTPUT_CSS,
		'preview'   => self::OUTPUT_PREVIEW,
	];

	/**
	 * Map Accept-Header to Output type.
	 */
	const MAP_ACCEPT = [
		'application/php-array'      => self::OUTPUT_PHPARRAY,
		'application/php-serialized' => self::OUTPUT_PHPSERIALIZE,
		'text/json'                  => self::OUTPUT_JSON,
		'application/json'           => self::OUTPUT_JSON,
		'text/xml'                   => self::OUTPUT_XML,
		'application/xml'            => self::OUTPUT_XML,
		'application/yaml'           => self::OUTPUT_YAML,
		'application/xhtml+xml'      => self::OUTPUT_UI,
		'text/html'                  => self::OUTPUT_UI,
		'text/css'                   => self::OUTPUT_CSS,
		//'*/*'                        => self::OUTPUT_HTML,
	];


	/**
	 * Creates the output driver.
	 *
	 * Dependent on the HTTP request a output driver will be selected.
	 *
	 * @return Output
	 */
	public static function createOutput() {

		switch ( self::discoverOutputType() ) {

			case self::OUTPUT_PHPARRAY:
				return new PHPArrayOutput();
			case self::OUTPUT_PHPSERIALIZE:
				return new PHPSerializeOutput();
			case self::OUTPUT_JSON:
				return new JsonOutput();
			case self::OUTPUT_XML:
				return new XmlOutput();
			case self::OUTPUT_YAML:
				return new YamlOutput();
			case self::OUTPUT_UI:
				return new UIOutput();
			case self::OUTPUT_CSS:
				return new CssOutput();
			case self::OUTPUT_PREVIEW:
				return new PreviewOutput();
			case self::OUTPUT_PLAIN:
			default:
				return new PlainOutput();
		}
	}



	/**
	 * Discovering the output-type for this request
	 *
	 * @return int constant of self::OUTPUT_*
	 */
	private static function discoverOutputType()
	{
		$reqOutput = strtolower(@$_REQUEST[RequestParams::PARAM_OUTPUT]);

		// Try 1: Checking the 'output' request parameter.
		if ($reqOutput) {
			if (!array_key_exists($reqOutput, self::MAP_OUTPUT)) {
				Http::notAcceptable();
				header('Content-Type: text/plain');
				echo "Accepted output types are: " . implode(",", array_keys(self::MAP_OUTPUT));
				exit;
			}

			return self::MAP_OUTPUT[$reqOutput];
		}

		// Try 2: Lets check the HTTP request "Accept" header.
		//print_r(Http::getAccept());
		foreach (Http::getAccept() as $acceptType)
			if (array_key_exists($acceptType, self::MAP_ACCEPT)) {
				header('Vary: Accept');
				return self::MAP_ACCEPT[$acceptType];
			}

		// Fallback
		Http::notAcceptable();
		header('Content-Type: text/plain');
		echo "Accepted types are: ".implode(",",array_keys(self::MAP_ACCEPT));
		exit;
	}

}