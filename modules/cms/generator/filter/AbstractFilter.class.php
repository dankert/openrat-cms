<?php


namespace cms\generator\filter;

use cms\generator\BaseContext;

abstract class AbstractFilter implements Filter
{
	/**
	 * @var BaseContext
	 */
	public $context;

	public abstract function filter( $value );
}