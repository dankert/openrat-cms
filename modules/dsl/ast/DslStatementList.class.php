<?php

namespace dsl\ast;

use dsl\DslParserException;
use dsl\DslToken;

class DslStatementList extends DslElement implements DslStatement
{
	private $statements = [];

	private $functions = [];

	public function __construct($tokenList)
	{
		$this->parse($tokenList);
	}

	/**
	 * @param $tokens DslToken[]
	 * @throws DslParserException
	 */
	public function parse($tokens)
	{
		$this->parseTokens($tokens);
	}

	public function execute( & $context)
	{
		// Auto hoisting for functions: Add functions to context.
		$context = array_merge( $context, $this->functions );

		foreach ($this->statements as $statement) {

			$value = $statement->execute($context);

			if ($statement instanceof DslReturn)
				return $value; // Return to the caller
		}

		return null;
	}



	/**
	 * @param $tokens DslToken[]
	 * @throws DslParserException
	 */
	public function parseTokens($tokens)
	{
		while (true) {
			$token = array_shift($tokens);

			if   ( ! $token )
				return;

			switch ($token->type) {

				case DslToken::T_STATEMENT_END:
					// maybe an empty statement?
					break;

				case DslToken::T_OPERATOR:
					throw new DslParserException('Unexpected operator', $token->lineNumber);
				case DslToken::T_BRACKET_CLOSE:
					throw new DslParserException('Unexpected closing group', $token->lineNumber);
				case DslToken::T_BLOCK_END:
					throw new DslParserException('Unexpected ending of an block', $token->lineNumber);
				case DslToken::T_NEGATION:
					throw new DslParserException('Unexpected negation', $token->lineNumber);
				case DslToken::T_DOT:
					throw new DslParserException('Unexpected dot', $token->lineNumber);

				case DslToken::T_FUNCTION:

					$nameToken = array_shift( $tokens );
					if ($nameToken->type != DslToken::T_STRING)
						throw new DslParserException('function must have a name', $token->lineNumber);
					$name = $nameToken->value;

					$functionCallOp    = array_shift($tokens);
					if   ( $functionCallOp->type != DslToken::T_OPERATOR || $functionCallOp->value != '$' )
						throw new DslParserException('function \''.$name.'\' must have a function signature');

					$functionParameter = $this->getGroup($tokens);
					$functionBlock     = $this->getBlock($tokens);

					$this->functions[ $name ] = new DslFunction( $functionParameter, $functionBlock );

					break;

				case DslToken::T_IF:
					$condition = $this->getGroup($tokens);
					$positiveBlock = $this->getStatementOrBlock($tokens);
					$nextToken = array_shift($tokens);
					if ($nextToken && $nextToken->type == DslToken::T_ELSE) {
						$negativeBlock = $this->getStatementOrBlock($tokens);
					} else {
						$negativeBlock = [];
						array_unshift($tokens, $nextToken);
					}
					$this->statements[] = new DslIf($condition, $positiveBlock, $negativeBlock);
					break;

				case DslToken::T_LET:
					break;

				case DslToken::T_FOR:
					$forGroup = $this->getGroup( $tokens );
					$forBlock = $this->getStatementOrBlock( $tokens );

					//echo "<h5>Forgroup:</h5><pre>"; var_export( $forGroup); echo "</pre>";

					$varName = array_shift( $forGroup );
					if   ( $varName == null || $varName->type != DslToken::T_STRING )
						throw new DslParserException('for loop variable missing');
					$ofName = array_shift( $forGroup );
					if   ( $ofName == null || $ofName->type != DslToken::T_STRING || strtolower($ofName->value) != 'of' )
						throw new DslParserException('missing \'of\' in for loop');

					$this->statements[] = new DslFor( $varName->value, $forGroup, $forBlock );
					break;

				case DslToken::T_RETURN:
					$returnTokens = $this->getSingleStatement( $tokens );
					$this->statements[] = new DslReturn( $returnTokens );
					break;

				case DslToken::T_THROW:
					$returnTokens = $this->getSingleStatement($tokens );
					$this->statements[] = new DslThrow( $returnTokens );
					break;

				case DslToken::T_TEXT:
				case DslToken::T_STRING:
					array_unshift( $tokens, $token );
					$statementTokens = $this->getSingleStatement( $tokens );

					$this->statements[] = new DslExpression( $statementTokens );
					break;

				default:
					throw new DslParserException('Unknown token of type '.$token->type,$token->lineNumber );
			}

		}

	}


}