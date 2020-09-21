<?php


namespace cms\generator;


abstract class BaseContext
{
	public $scheme;

	public abstract function getCacheKey();
}