<?php


namespace cms\generator\filter;

abstract class AbstractFilter implements Filter
{
	public abstract function filter( $value );
}