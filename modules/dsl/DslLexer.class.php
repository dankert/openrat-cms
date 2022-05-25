<?php
namespace dsl;

class DslLexer
{
	private $token = [];


	const KEYWORDS = [
		'function' => DslToken::T_FUNCTION,
		'for'      => DslToken::T_FOR,
		'if'       => DslToken::T_IF,
		'else'     => DslToken::T_ELSE,
		'let'      => DslToken::T_LET,
		'const'    => DslToken::T_LET,
		'var'      => DslToken::T_LET,
		'return'   => DslToken::T_RETURN,
	];

	/**
	 * @param $code
	 * @return array(DslToken)
	 */
	public function tokenize( $code ) {

		//echo "Code: <pre>".$code."</pre>";

		$line = 1;

		// mb_str_split only available since PHP 7.4
		$chars = array_reverse(str_split($code));

		while( true ) {
			$char = array_pop($chars);

			if   ( $char == null )
				break;

			if   ( ( $char == ' ' ))
				continue;

			if   ( ( $char == "\n" )) {
				//$this->addToken($line,DslToken::T_STATEMENT_END); // line-end is implicite end of statement
				// oh, not so good on "if" constructs.
				$line++;
				continue;
			}

			// Text
			if   ( $char == '"' || $char == "'" ) {
				$textEncloser = $char;
				$value = '';
				while( true ) {
					$char = array_pop($chars);
					if   ( $char == '\\') {
						$char = array_pop($chars);
						$value .= $char;
					}
					elseif ($char != $textEncloser) {
						$value .= $char;
						continue;
					} else {
						$this->addToken($line, DslToken::T_TEXT, $value);
						break;
					}
				}
				continue;
			}

			// Comments
			if   ( $char == '/' ) {
				$nextChar = array_pop($chars);
				if   ( $nextChar == '/' ) { // Comment after "//"

					while( true ) {
						$c = array_pop($chars);
						if ($c == "\n" || $c == null )
							continue 2;
					}

				}
				elseif   ( $nextChar == '*' ) { // Comment after "/*"

					$lastChar = null;
					while( true ) {
						$c = array_pop($chars);
						if   ( $c == null )
							break 2;
						if   ( $lastChar == '*' && $c == '/')
							continue 2;
						$lastChar = $c;
						continue;
					}

				}
				else {
					array_push($chars,$nextChar); // this is no comment
				}
			}

			// String
			if   ( ( $char >= 'a' && $char <= 'z') ||
				   ( $char >= 'A' && $char <= 'Z') ||
				   $char == '_'                    ||
				   $char == '$' ) {
				$value = $char;
				while( true ) {
					$char = array_pop( $chars );
					if   ( ( $char >= 'a' && $char <= 'z') ||
						( $char >= 'A' && $char <= 'Z') ||
						( $char >= '0' && $char <= '9') ||
						$char == '_'                    ||
						$char == '$' ) {
						$value .= $char;
					} else {
						$type = DslToken::T_STRING;

						if   ( array_key_exists($value,self::KEYWORDS ) )
							$type = self::KEYWORDS[$value]; // it is a keyword

						$this->addToken( $line,$type,$value );
						array_push($chars,$char);
						break;
					}
				}
				continue;
			}

			// Numbers
			if   ( $char >= '0' && $char <= '9') {
				$value = $char;
				while( true ) {
					$char = array_pop( $chars );
					if   ( ( $char >= '0' && $char <= '9') ||
						     $char == '.' ) {
						$value .= $char;
					} else {
						$this->addToken( $line,DslToken::T_NUMBER,$value );
						array_push($chars,$char);
						break;
					}
				}
				continue;
			}

			if   ( $char == '+' || $char == '-' || $char == '/' || $char == '*' || $char == '=' || $char == '|' || $char == '&' ) {

				$value = $char;
				while( true ) {
					$char = array_pop( $chars );
					if   ( $char == '+' || $char == '-' || $char == '/' || $char == '*' || $char == '='  || $char == '|' || $char == '&' ) {
						$value .= $char;
					} else {
						$type = DslToken::T_OPERATOR;
						$this->addToken( $line,$type,$value );
						array_push($chars,$char);
						continue 2;
					}
				}
				continue;
			}

			if   ( $char == "\r" )
				continue;
			elseif   ( $char == '!' )
				$this->addToken( $line,DslToken::T_NEGATION,$char);
			elseif   ( $char == ';' )
				$this->addToken( $line,DslToken::T_STATEMENT_END,$char);
			elseif   ( $char == '.' )
				$this->addToken( $line,DslToken::T_DOT,$char);
			elseif   ( $char == ',' )
				$this->addToken( $line,DslToken::T_COMMA,$char);
			elseif   ( $char == '(' )
				$this->addToken( $line,DslToken::T_BRACKET_OPEN,$char);
			elseif   ( $char == ')' )
				$this->addToken( $line,DslToken::T_BRACKET_CLOSE,$char);
			elseif   ( $char == '{' )
				$this->addToken( $line,DslToken::T_BLOCK_BEGIN,$char);
			elseif   ( $char == '}' )
				$this->addToken( $line,DslToken::T_BLOCK_END,$char);
			else {
				throw new \Exception('Unknown character \''.$char.'\' on line '.$line.'.');
			}
		}


		return $this->token;
	}

	private function addToken(int $line, $type, $value=null)
	{
		$this->token[] = new DslToken( $line, $type, $value );
	}


}