<?php


namespace util\test;


class TestCase
{
	public function run() {

	}


	protected function assertEquals( $expected,$reality )
	{
		if   ( $expected != $reality )
			throw new \LogicException("Expected '$expected', but got '$reality'.");
	}

	protected function assertNotEmpty( $reality )
	{
		if   ( empty( $reality ) )
			throw new \LogicException("Expected not empty, but got '$reality'.");
	}

	protected function assertEmpty( $reality )
	{
		if   ( !empty( $reality ) )
			throw new \LogicException("Expected empty, but got '$reality'.");
	}

	protected function assertFalse( $reality )
	{
		if   ( $reality )
			throw new \LogicException("Expected FALSE, but got '$reality'.");
	}

	protected function assertTrue( $reality )
	{
		if   ( ! $reality )
			throw new \LogicException("Expected TRUE, but got '$reality'.");
	}

	protected function fail()
	{
		throw new \LogicException("This should not happen.");
	}
}