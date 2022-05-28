<?php

namespace dsl\ast;

use dsl\DslParserException;
use dsl\DslRuntimeException;
use dsl\DslToken;

class DslAssignment implements DslStatement
{
	private $target = [];
	private $value;

	/**
	 * DslAssignment constructor.
	 * @param $target DslToken[]
	 * @param $value DslToken[]
	 * @throws DslParserException
	 */
	public function __construct( $target, $value )
	{
		echo "<h5>Assignment:</h5><pre>"; var_export( $target ); var_export($value); echo "</pre>";

		if   ( sizeof( $target ) != 1 )
			throw new DslParserException('Assignment only possible for variables.');

		$this->target = new DslVariable( $target[0]->value );
		$this->value  = new DslExpression( $value  );
	}

	/**
	 * @param array $context
	 * @return mixed|void
	 * @throws DslRuntimeException
	 */
	public function execute( & $context ) {

		$value = $this->value->execute( $context );

		if   ( ! array_key_exists( $this->target->name,$context ) )
			throw new DslRuntimeException('variable \''.$this->target->name.'\' does not exist');

		$context[ $this->target->name ] = $value;
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