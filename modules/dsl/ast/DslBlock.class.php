<?php

namespace dsl\ast;

use dsl\DslParserException;
use dsl\DslToken;

class DslBlock implements DslStatement
{
	private $statements;

	public function execute( & $context)
	{
		foreach( $this->statements as $statement )
			$statement->execute( $context );
	}


	/**
	 * @throws DslParserException
	 */
	public function parse($tokens)
	{
		$lastTokens = [];
		$depth = 0;

		foreach( $tokens as $token )  {

			if ( $token->type == DslToken::T_BLOCK_BEGIN ) {
				$depth++;
				if   ( $depth == 1 ) {
					$statements = new DslStatementList();
					$statements->parse( $lastTokens );
					$this->statements[] = $statements;
					$lastTokens = [];
					continue;
				}
			}

			if ( $token->type == DslToken::T_BLOCK_END ) {
				$depth--;

				if   ( $depth < 0 )
					throw new DslParserException('Unmatched closing block',$token->lineNumber);

				if   ( $depth == 0 ) {
					$block = new DslBlock();
					$block->parse($lastTokens);
					$this->statements[] = $block;
					$lastTokens = []; // clear
					continue;
				}
			}

			$lastTokens[] = $token;
		}
		if   ( $depth > 0 )
			throw new DslParserException('Unclosed block at the end');

		$statements = new DslStatementList();
		$statements->parse( $lastTokens );
		$this->statements[] = $statements;
	}
}