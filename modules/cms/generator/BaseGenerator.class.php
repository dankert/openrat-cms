<?php


namespace cms\generator;


use util\cache\FileCache;

abstract class BaseGenerator implements Generator
{
	/**
	 * @var BaseContext
	 */
	protected $context;

	public function getCache() {

		return new FileCache( $this->context->getCacheKey(),function() {
			return $this->generate();
		}, 0 );
	}

	protected abstract function generate();
}