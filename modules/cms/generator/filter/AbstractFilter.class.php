<?php


namespace cms\generator\filter;

use modules\cms\generator\filter\Filter;

abstract class AbstractFilter implements Filter
{
	public abstract function filter( $value );
}