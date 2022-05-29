<?php

namespace dsl\ast;

use dsl\DslRuntimeException;

class DslSequence implements DslStatement
{
	public $left;
	public $right;


	/**
	 * DslSequence constructor.
	 * @param $left
	 * @param $right
	 */
	public function __construct($left, $right)
	{
		$this->left  = $left;
		$this->right = $right;
	}


	public function execute( & $context ) {

		// Creating a sequence
		$left  = $this->left->execute( $context );
		$right = $this->right->execute( $context );

		// cast to array
		if   ( !is_array( $left ) )  $left  = [$left ];
		if   ( !is_array( $right) )  $right = [$right];

		return array_merge( $left,$right);
	}

	public function parse($tokens)
	{
	}
}