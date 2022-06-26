<?php

namespace dsl\standard;

use dsl\ast\DslStatement;
use dsl\context\DslObject;
use dsl\DslToken;

class Script implements DslObject
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


	public function getSyntaxTree()
	{
		return print_r($this->ast,true);
	}
}