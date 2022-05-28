<?php

namespace dsl\ast;

use dsl\DslParserException;
use dsl\DslToken;

class DslStatementList implements DslStatement
{
	private $statements = [];

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
		foreach ($this->statements as $statement)
			$statement->execute($context);
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

					$functionParameter = $this->getGroup($tokens);
					$functionBlock = $this->getBlock($tokens);

					$this->statements[] = new DslFunction($name,$functionParameter, $functionBlock);
					break;

				case DslToken::T_IF:
					$condition = $this->getGroup($tokens);
					$positiveBlock = $this->getStatementOrBlock($tokens);
					$nextToken = array_shift($tokens);
					if ($nextToken->type == DslToken::T_ELSE) {
						$negativeBlock = $this->getStatementOrBlock($tokens);
					} else {
						$negativeBlock = [];
						array_unshift($tokens, $nextToken);
					}
					$this->statements[] = new DslIf($condition, $positiveBlock, $negativeBlock);
					break;

				case DslToken::T_LET:
					$statementTokens = $this->getSingleStatement( $tokens );
					$nextToken = array_shift($statementTokens );
					if ($nextToken->type != DslToken::T_STRING)
						throw new DslParserException('only variables may be initialized', $token->lineNumber);
					$name = $nextToken->value;

					$nextToken = array_shift($statementTokens);
					if   ( $nextToken == null )
						$value = null;
					elseif ($nextToken->type == DslToken::T_OPERATOR && $nextToken->value == '=')
						$value = $statementTokens;
					else
						throw new DslParserException('Unexpected token in initialisation', $token->lineNumber);

					$this->statements[] = new DslInitialisation( $name, $value );
					break;

				case DslToken::T_FOR:
					$forGroup = $this->getGroup();
					$forBlock = $this->getStatementOrBlock();

					$this->statements[] = new DslFor( $forGroup, $forBlock );
					break;

				case DslToken::T_NEW:
					throw new DslParserException("new makes no sense without an assignment");
				case DslToken::T_RETURN:
					$returnTokens = $this->getSingleStatement( $tokens );
					$this->statements[] = new DslReturn( $returnTokens );
					break;

				case DslToken::T_TEXT:
				case DslToken::T_STRING:
					array_unshift( $tokens, $token );
					$statementTokens = $this->getSingleStatement( $tokens );

					// we have to look if it is an assignment.
					$assignmentTokens = [];
					$expressionTokens = [];
					foreach ( $statementTokens as $t ) {
						if   ( $t->type == DslToken::T_OPERATOR && $t->value == '=' ) {
							$assignmentTokens = $expressionTokens;
							$expressionTokens = [];
							continue;
						}

						$expressionTokens[] = $t;
					}

					if   ( $assignmentTokens )
						$this->statements[] = new DslAssignment( $assignmentTokens, $expressionTokens );
					else
						$this->statements[] = new DslExpression( $expressionTokens );
					break;

				default:
					throw new DslParserException('Unknown token of type '+ $token->type );
			}

		}

	}


	/**
	 *
	 * @param $tokens DslToken[]
	 * @return DslToken[]
	 * @throws DslParserException
	 */
	private function getGroup(&$tokens)
	{
		$groupTokens = [];
		$depth = 0;

		$nextToken = array_shift($tokens);
		if ($nextToken == null)
			throw new DslParserException('Unexpecting end, missing closing group');
		if ($nextToken->type != DslToken::T_BRACKET_OPEN)
			throw new DslParserException('Expecting parenthesis', $nextToken->lineNumber);

		while (true) {
			$nextToken = array_shift($tokens);
			if ($nextToken->type == null)
				throw new DslParserException('Unclosed parenthesis', $nextToken->lineNumber);
			if ($nextToken->type == DslToken::T_BRACKET_OPEN)
				$depth += 1;
			if ($nextToken->type == DslToken::T_BRACKET_CLOSE)
				if ($depth == 0)
					return $groupTokens;
				else
					$depth--;

			$groupTokens[] = $nextToken;
		}
	}

	/**
	 *
	 * @param $tokens DslToken[]
	 * @return DslToken[]
	 * @throws DslParserException
	 */
	private function getBlock(&$tokens)
	{
		$blockTokens = [];
		$depth = 0;

		$nextToken = array_shift($tokens);
		if ($nextToken->type != DslToken::T_BLOCK_BEGIN)
			throw new DslParserException('Expecting block', $nextToken->lineNumber);

		while (true) {
			$nextToken = array_shift($tokens);
			if ($nextToken->type == null)
				throw new DslParserException('Unclosed block', $nextToken->lineNumber);
			if ($nextToken->type == DslToken::T_BLOCK_BEGIN)
				$depth += 1;
			if ($nextToken->type == DslToken::T_BLOCK_END)
				if ($depth == 0)
					return $blockTokens;
				else
					$depth--;

			$blockTokens[] = $nextToken;
		}
	}

	/**
	 *
	 * @param $tokens DslToken[]
	 * @return DslToken[]
	 * @throws DslParserException
	 */
	private function getStatementOrBlock(&$tokens)
	{
		if (!$tokens)
			return [];

		$firstToken = $tokens[0];
		if ($firstToken->type == DslToken::T_BLOCK_BEGIN)
			return $this->getBlock($tokens);
		else
			return $this->getSingleStatement($tokens);
	}


	/**
	 * parse single statement
	 *
	 * @param $tokens DslToken[]
	 * @return DslToken[]
	 * @throws DslParserException
	 */
	private function getSingleStatement(&$tokens)
	{
		//echo "<h3>Statement:</h3><pre>"; var_dump( $tokens ); echo "</pre>";

		$depth = 0;
		$statementTokens = [];
		while (true) {
			$nextToken = array_shift($tokens);
			if ($nextToken == null)
				throw new DslParserException('unrecognized statement');

			if ($depth == 0 && $nextToken->type == DslToken::T_STATEMENT_END)
				return $statementTokens;

			if ($nextToken->type == DslToken::T_BLOCK_BEGIN)
				$depth++;
			if ($nextToken->type == DslToken::T_BLOCK_END)
				$depth--;
			if ($depth < 0)
				throw new DslParserException('Unexpected closing block', $nextToken->lineNumber);

			$statementTokens[] = $nextToken;
		}
	}

}