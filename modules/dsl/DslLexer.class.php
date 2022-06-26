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
		'new'      => DslToken::T_NEW,
		'throw'    => DslToken::T_THROW,
	];

	const UNUSED_KEYWORDS = [
		'null',
		'true',
		'false',
		'implements',
		'interface',
		'package',
		'private',
		'protected',
		'public',
		'static',
		'in',
		'do',
		'new',
		'try',
		'this',
		'case',
		'void',
		'with',
		'enum',
		'while',
		'break',
		'catch',
		'throw',
		'yield',
		'class',
		'super',
		'typeof',
		'delete',
		'switch',
		'export',
		'import',
		'default',
		'finally',
		'extends',
		'continue',
		'debugger',
		'instanceof',
		];
	/**
	 * @param $code
	 * @return array(DslToken)
	 */
	public function tokenize( $code ) {

		//echo "Code: <pre>".$code."</pre>";

		$line = 1;

		// mb_str_split only available since PHP 7.4
		$chars = str_split($code);

		while( true ) {
			$char = array_shift($chars);

			if   ( $char == null )
				break;

			if   ( ( $char == ' ' ))
				continue;

			if   ( ( $char == "\n" )) {
				$line++;
				continue;
			}

			// Text
			if   ( $char == '"' || $char == "'" ) {
				$textEncloser = $char;
				$value = '';
				while( true ) {
					$char = array_shift($chars);
					if   ( $char == "\n")
						throw new DslParserException("Unclosed string",$line);
					if   ( $char == '\\') {
						$char = array_shift($chars);
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
				$nextChar = array_shift($chars);
				if   ( $nextChar == '/' ) { // Comment after "//"

					while( true ) {
						$c = array_shift($chars);
						if ($c == "\n")
							$line++;
						if ($c == "\n" || $c == null )
							continue 2;
					}

				}
				elseif   ( $nextChar == '*' ) { // Comment after "/*"

					$lastChar = null;
					while( true ) {
						$c = array_shift($chars);
						if   ( $c == null )
							break 2;
						if ($c == "\n")
							$line++;
						if   ( $lastChar == '*' && $c == '/')
							continue 2;
						$lastChar = $c;
						continue;
					}

				}
				else {
					array_unshift($chars,$nextChar); // this is no comment
				}
			}

			// String
			if   ( ( $char >= 'a' && $char <= 'z') ||
				   ( $char >= 'A' && $char <= 'Z') ||
				   $char == '_'                    ||
				   $char == '$' ) {
				$value = $char;
				while( true ) {
					$char = array_shift( $chars );
					if   ( ( $char >= 'a' && $char <= 'z') ||
						( $char >= 'A' && $char <= 'Z') ||
						( $char >= '0' && $char <= '9') ||
						$char == '_'                    ||
						$char == '$' ) {
						$value .= $char;
					} else {
						$type = DslToken::T_STRING;

						if   ( array_key_exists($value,self::UNUSED_KEYWORDS ) )
							throw new DslParserException( 'use of reserved word \''.$value.'\' is not allowed.');

						if   ( array_key_exists($value,self::KEYWORDS ) )
							$type = self::KEYWORDS[$value]; // it is a keyword

						$this->addToken( $line,$type,$value );
						array_unshift($chars,$char);
						break;
					}
				}
				continue;
			}

			// Numbers
			if   ( $char >= '0' && $char <= '9' ) {
				$value = $char;
				while( true ) {
					$char = array_shift( $chars );
					if   ( ( $char >= '0' && $char <= '9') ||
						$char == '.' || $char == '_' ) {
						$value .= $char;
					} else {
						$this->addToken( $line,DslToken::T_NUMBER,str_replace('_','',$value ));
						array_unshift($chars,$char);
						break;
					}
				}
				continue;
			}

			$operatorChars = ['>','<','+' ,'-','/' ,'*','=','|','&',',','.' ];
			if   ( in_array($char,$operatorChars)) {

				$value = $char;
				while( true ) {
					$char = array_shift( $chars );
					if   ( in_array($char,$operatorChars) ) {
						$value .= $char;
					} else {
						$type = DslToken::T_OPERATOR;
						$this->addToken( $line,$type,$value );
						array_unshift($chars,$char);
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

			elseif   ( $char == '(' ) {
				if  ( end( $this->token)->type == DslToken::T_STRING)
					// if string is followed by "(" it is a function or a function call
					$this->addToken( $line, DslToken::T_OPERATOR,'$'); // function call
				$this->addToken( $line,DslToken::T_BRACKET_OPEN,$char);
			}
			elseif   ( $char == ')' ) {
				if (end($this->token)->type == DslToken::T_BRACKET_OPEN)
					// if there is an empty parenthesis, make it contain something, otherwise the shunting yard algo will fail.
					$this->addToken($line, DslToken::T_NONE ); //
				$this->addToken($line, DslToken::T_BRACKET_CLOSE, $char);
			}
			elseif   ( $char == '{' )
				$this->addToken( $line,DslToken::T_BLOCK_BEGIN,$char);
			elseif   ( $char == '}' )
				$this->addToken( $line,DslToken::T_BLOCK_END,$char);
			else {
				throw new DslParserException('Unknown character \''.$char.'\'',$line);
			}
		}


		return $this->token;
	}

	private function addToken(int $line, $type, $value=null)
	{
		$this->token[] = new DslToken( $line, $type, $value );
	}


}