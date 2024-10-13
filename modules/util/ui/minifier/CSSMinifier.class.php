<?php

namespace util\ui\minifier;

class CSSMinifier extends AbstractMinifier
{
	const FLAG_REMOVE_MULTILINE_COMMENT = 2;
	const FLAG_REMOVE_BLANK_LINES       = 4;
	const FLAG_REMOVE_LINE_COMMENTS     = 8;
	const FLAG_REMOVE_WHITESPACE        = 16;
	const FLAG_REMOVE_LINEBREAK         = 32;
	const FLAG_REMOVE_TABS              = 64;
	const FLAG_REMOVE_SUPERFLOUS_SPACES = 128;

	const REPLACER = [
		self::FLAG_REMOVE_MULTILINE_COMMENT => ["/\/\*[\s\S]*?\*\//"           , ''               ],
		self::FLAG_REMOVE_LINE_COMMENTS     => ["/^(.*)\/\/.*$/m"              ,'${1}'            ],
		self::FLAG_REMOVE_BLANK_LINES       => ['/^\n+|^[\t\s]*\n+/m'          , ''               ],
		self::FLAG_REMOVE_WHITESPACE        => ['/^\s*(.*)\s*$/m'              ,'${1}'            ],
		self::FLAG_REMOVE_LINEBREAK         => ['/\n/'                         ,''                ],
		self::FLAG_REMOVE_TABS              => ['/\t/'                         ,''                ],
		self::FLAG_REMOVE_SUPERFLOUS_SPACES => ['/\s{2,}7'                     ,' '               ],
	];


	public function linkToSourcemap($sourcemap)
	{
		return "/*# sourceMappingURL=$sourcemap */";
	}


	protected function compress($chars)
	{
		$sourceLine = 1;
		$sourcePos  = 1;
		$buffer     = '';
		while( true ) {
			if   ( empty( $chars ) )
				break;

			$char = array_shift( $chars );

			if ($char == '/') {
				$nextChar = array_shift( $chars );
				if   ( $nextChar == '/' && $this->hasFlag( self::FLAG_REMOVE_LINE_COMMENTS )) {
					// single-line comment
					while(true) {
						$nextChar = array_shift( $chars );
						if   ( $nextChar == "\n" ) {
							$sourceLine++;
							break;
						}
					}
				}
				elseif   ( $nextChar == '*'  && $this->hasFlag( self::FLAG_REMOVE_MULTILINE_COMMENT)) {
					// multi-line comment
					while(true) {
						$nextChar = array_shift( $chars );
						if   ( $nextChar == "\n" ) {
							if ( ! $this->hasFlag( self::FLAG_REMOVE_LINEBREAK) )
								$buffer .= $nextChar;
						}
						if   ( $nextChar == "*" ) {
							$nextChar = array_shift( $chars );
							if   ( $nextChar == "/" )
								break;
							else
								// it's not the end of the multiline comment.
								array_unshift($chars,$nextChar);
						}
					}
				}
				else {
					array_unshift($chars,$nextChar);
					$buffer .= $char;
				}
			}
			elseif ($char == "\t" &&  $this->hasFlag(self::FLAG_REMOVE_TABS)) {
				;
			}
			elseif ($char == "\r" &&  $this->hasFlag( self::FLAG_REMOVE_LINEBREAK)) {
				;
			}
			elseif ($char == "\n" &&  $this->hasFlag( self::FLAG_REMOVE_LINEBREAK)) {
				;
			}
			elseif ($char == " " && substr($buffer,-1,1)==' ' &&  $this->hasFlag(self::FLAG_REMOVE_SUPERFLOUS_SPACES)) {
				;
			} else {
				$buffer .= $char;
			}
		}

		if   ( $this->hasFlag(self::FLAG_REMOVE_LINE_COMMENTS ))
			$buffer = preg_replace('/^(@import\s+\S+)\.less/m','${1}.min.css',$buffer);

		$this->addCompressedContent($buffer);
	}
}