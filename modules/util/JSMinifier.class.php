<?php

namespace util;

class JSMinifier
{
	const FLAG_IMPORT_MIN_JS            = 1;
	const FLAG_REMOVE_MULTILINE_COMMENT = 2;
	const FLAG_REMOVE_BLANK_LINES       = 4;
	const FLAG_REMOVE_LINE_COMMENTS     = 8;
	const FLAG_REMOVE_WHITESPACE        = 16;
	const FLAG_REMOVE_LINEBREAK         = 32;
	const FLAG_REMOVE_TABS              = 64;
	const FLAG_REMOVE_SUPERFLOUS_SPACES = 128;
	const FLAG_ALL                      = 255;

	const REPLACER = [
		self::FLAG_REMOVE_MULTILINE_COMMENT => ["/\/\*[\s\S]*?\*\//"           , ''               ],
		self::FLAG_REMOVE_LINE_COMMENTS     => ["/^(.*)\/\/.*$/m"              ,'${1}'            ],
		self::FLAG_REMOVE_BLANK_LINES       => ['/^\n+|^[\t\s]*\n+/m'          , ''               ],
		self::FLAG_IMPORT_MIN_JS            => ['/^(import.*from.*)\.js(.*)$/m','${1}.min.js${2}' ],
		self::FLAG_REMOVE_WHITESPACE        => ['/^\s*(.*)\s*$/m'              ,'${1}'            ],
		self::FLAG_REMOVE_LINEBREAK         => ['/\n/'                         ,''                ],
		self::FLAG_REMOVE_TABS              => ['/\t/'                         ,''                ],
		self::FLAG_REMOVE_SUPERFLOUS_SPACES => ['/\s{2,}7'                     ,' '               ],
	];

	/**
	 * Which flags are enabled?
	 * @var int
	 */
	public $config = self::FLAG_ALL;

	public function __construct( $flags = null )
	{
		if   ( $flags )
			$this->config = $flags;
	}


	public function minify( $code ) {
		foreach( self::REPLACER as $flag => $replacer )
			if   ( $this->config & $flag ) {
				list( $replace, $with ) = $replacer;
				$code = preg_replace( $replace, $with, $code );
			}
		return $code;
	}
}