<?php

namespace util\ui\minifier;

class JSMinifier extends AbstractMinifier
{
	const FLAG_IMPORT_MIN_JS            = 1;
	const FLAG_REMOVE_MULTILINE_COMMENT = 2;
	const FLAG_REMOVE_BLANK_LINES       = 4;
	const FLAG_REMOVE_LINE_COMMENTS     = 8;
	const FLAG_REMOVE_WHITESPACE        = 16;
	const FLAG_REMOVE_LINEBREAK         = 32;
	const FLAG_REMOVE_TABS              = 64;
	const FLAG_REMOVE_INDENTING_SPACES  = 128;


	public function linkToSourcemap($sourcemap)
	{
		return "# sourceMappingURL=$sourcemap";
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
				if   ( $nextChar == '/' && $this->hasFlag(self::FLAG_REMOVE_LINE_COMMENTS )) {
					// single-line comment
					while(true) {
						$nextChar = array_shift( $chars );
						if   ( $nextChar == "\n" ) {
							array_unshift($chars,$nextChar);
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
							if ( ! $this->hasFlag(self::FLAG_REMOVE_LINEBREAK ))
								$buffer .= $nextChar; // leave line-break as it is.
							$sourceLine++;
						}
						elseif   ( $nextChar == "*" ) {
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
					// it's not a comment.
					array_unshift($chars,$nextChar);
					$buffer .= $char;
				}
			}
			elseif ($char == "\t" &&  $this->hasFlag(self::FLAG_REMOVE_TABS)) {
				;
			}
			elseif ($char == "\r" &&  $this->hasFlag(self::FLAG_REMOVE_LINEBREAK)) {
				;
			}
			elseif ($char == "\n" &&  $this->hasFlag(self::FLAG_REMOVE_LINEBREAK)) {
				;
			} else {
				$buffer .= $char;
			}

			// Strip indenting space.
			if	( $char == "\n" && $this->hasFlag( self::FLAG_REMOVE_INDENTING_SPACES )) {
				while(true) {
					$nextChar = array_shift($chars);
					if ($nextChar == " ") {
						; // it's a blank, so we want to remove it.
					}
					else {
						array_unshift($chars,$nextChar);
						break;
					}

				}
			}

		}

		// Change the link in import statements, it should point to the minified version
		if   ( $this->hasFlag( self::FLAG_IMPORT_MIN_JS ))
			$buffer = preg_replace('/^(import\s+\S+\s+from\s+"?\'?\S+)\.js/m','${1}.min.js',$buffer);
		$this->addCompressedContent($buffer);
	}
}