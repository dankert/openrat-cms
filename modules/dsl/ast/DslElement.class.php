<?php

namespace dsl\ast;

use dsl\DslParserException;
use dsl\DslToken;

class DslElement
{

	/**
	 *
	 * @param $tokens DslToken[]
	 * @return DslToken[]
	 * @throws DslParserException
	 */
	protected function getGroup(&$tokens)
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
			if ($nextToken == null)
				throw new DslParserException('Unclosed parenthesis');
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
	protected function getBlock(&$tokens)
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
	protected function getStatementOrBlock(&$tokens)
	{
		if (!$tokens)
			return [];

		$firstToken = $tokens[0];
		if ($firstToken->type == DslToken::T_BLOCK_BEGIN)
			return $this->getBlock($tokens);
		else
			return $this->getSingleStatement($tokens,true);
	}


	/**
	 * Gets the first single statement out of the tokens.
	 *
	 * @param $tokens DslToken[]
	 * @return DslToken[]
	 * @throws DslParserException
	 */
	protected function getSingleStatement(&$tokens, $withEnd = false)
	{
		$depth = 0;
		$statementTokens = [];
		while (true) {
			$nextToken = array_shift($tokens);
			if ($nextToken == null)
				var_export( $statementTokens );
			if ($nextToken == null)
				throw new DslParserException('unrecognized statement');

			if ($depth == 0 && $nextToken->type == DslToken::T_STATEMENT_END) {
				if   ( $withEnd )
					$statementTokens[] = $nextToken;
				return $statementTokens;
			}

			if ($nextToken->type == DslToken::T_BLOCK_BEGIN)
				$depth++;
			if ($nextToken->type == DslToken::T_BLOCK_END)
				$depth--;
			if ($depth < 0)
				throw new DslParserException('Unexpected closing block', $nextToken->lineNumber);

			$statementTokens[] = $nextToken;
		}
	}


	/**
	 * Split tokens on comma separator.
	 *
	 * @param DslToken[] $functionParameter
	 * @return DslToken[][]
	 */
	protected function splitByComma($functionParameter)
	{
		$parts = [];
		$act   = [];
		foreach ( $functionParameter as $token ) {

			if   ( $token->type == DslToken::T_OPERATOR && $token->value == ',' ) {
				$parts[] = $act;
				$act     = []; // Cleanup
				continue;
			}

			$act[] = $token;
		}

		if   ( $act )
			$parts[] = $act;

		return $parts;
	}
}