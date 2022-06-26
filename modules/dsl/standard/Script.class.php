<?php

namespace dsl\standard;

use dsl\ast\DslStatement;
use dsl\context\BaseScriptableObject;
use dsl\DslToken;

class Script  extends BaseScriptableObject
{
	/**
	 * @var DslToken[]
	 */
	private $tokens;

	/**
	 * @var DslStatement
	 */
	private $ast;

	/**
	 * @param $tokens DslToken[]
	 * @param $ast DslStatement
	 */
	public function __construct($tokens, $ast )
	{
		$this->tokens = $tokens;
		$this->ast    = $ast;
	}

	public function getToken()
	{
		return implode("\n",$this->tokens);
	}


	public function getSource()
	{
		$line   = 0;
		$source = '';

		foreach( $this->tokens as $token ) {

			$source .= ($line != $token->lineNumber ? "\n" . str_pad($token->lineNumber, 4, '0', STR_PAD_LEFT).': ' : '') . $token->value;
			$line = $token->lineNumber;
		}

		return $source."\n";
	}


	public function getSyntaxTree()
	{
		return print_r($this->ast,true);
	}

	public function __toString()
	{
		return "Script Info, call help() for help.";
	}

	/**
	 * @return string
	 */
	public function help()
	{
		return Helper::getHelp($this);
	}
}