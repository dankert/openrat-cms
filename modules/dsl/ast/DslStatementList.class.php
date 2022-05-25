<?php

namespace dsl\ast;

use dsl\DslToken;

class DslStatementList implements DslStatement
{
	private $statements = [];

	public function parse( $tokens ) {


		$tokens = array_reverse( $tokens,true );

		//echo "Token 2: <pre>"; var_dump( $tokens ); echo "</pre>";
		
		
		$tokensPerStatement = [];
		$depth = 0;

		while( true ) {
			$token = array_pop( $tokens );

			if   ( $token == null ) {
				$this->createStatementFromTokens( $tokensPerStatement );
				break;
			}

			$tokensPerStatement[] = $token;
			
			if ( $token->type == DslToken::T_BRACKET_OPEN )
				$depth++;
			if ( $token->type == DslToken::T_BRACKET_CLOSE )
				$depth--;
			if ( $token->type == DslToken::T_BLOCK_BEGIN )
				$depth++;
			if ( $token->type == DslToken::T_BLOCK_END )
				$depth--;
				
			if  ( $depth == 0 && $token->type === DslToken::T_STATEMENT_END ) {

				$this->createStatementFromTokens( $tokensPerStatement );
				$tokensPerStatement = [];
			}
		}

	}

	public function execute($context)
	{
		foreach( $this->statements as $statement )
			$statement->execute( $context );
	}

	private function createStatementFromTokens( $tokensPerStatement )
	{
		if   ( ! $tokensPerStatement )
			return;

		$tokensPerStatement = array_reverse( $tokensPerStatement,true);

		$firstToken = array_pop( $tokensPerStatement );
		$statement = null;

		if   ( $firstToken->type == DslToken::T_LET )
			$statement = new DslInitialisation();

		elseif   ( $firstToken->type == DslToken::T_RETURN )
			$statement = new DslReturn();

		elseif   ( $firstToken->type == DslToken::T_FUNCTION )
			$statement = new DslFunction();

		elseif   ( $firstToken->type == DslToken::T_IF )
			$statement = new DslIf();

		elseif   ( $firstToken->type == DslToken::T_FOR )
			$statement = new DslFor();

		else {
			array_push( $tokensPerStatement,$firstToken );
			$statement = new DslAssignment();
		}

		if  ( $statement ) {
			$statement->parse( $tokensPerStatement );
			$this->statements[] = $statement;
		}
	}
}