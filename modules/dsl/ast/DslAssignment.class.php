<?php

namespace dsl\ast;

use dsl\DslToken;

class DslAssignment implements DslStatement
{
	private $target = [];
	private $value;

	public function execute( $context ) {

		// todo make assignment to target
		$this->value->execute( $context );
	}

	public function parse($tokens)
	{
		//echo "<h2>Assignment-Parser</h2><pre>"; var_dump( $tokens ); echo "</pre>";
		$this->target = new DslExpression();
		$this->value  = new DslExpression();

		$assignmentOperatorFound = false;
		$targetToken = [];
		$valueToken  = [];

		foreach( $tokens as $token ) {

			if   ( $token->type == DslToken::T_OPERATOR && in_array($token->value,['=','+='.'-=']) ) {
				$assignmentOperatorFound = true;
				continue;
			}

			if   ( ! $assignmentOperatorFound )
				$targetToken[] = $token;
			else
				$valueToken[] = $token;
		}

		if  ( $assignmentOperatorFound ) {
			$this->target->parse( $targetToken );
			$this->value ->parse( $valueToken );
		} else 	{
			$this->value->parse( $targetToken );
			$this->target = null;
		}
	}
}