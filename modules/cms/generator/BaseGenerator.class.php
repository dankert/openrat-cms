<?php


namespace cms\generator;


use util\cache\Cache;
use util\cache\FileCache;


/**
 * Base class for generators.
 *
 * @package cms\generator
 */
abstract class BaseGenerator implements Generator
{
	/**
	 * @var BaseContext
	 */
	protected $context;

	/**
	 * Every generator has a cache for its value.
	 * @return Cache
	 */
	public function getCache() {

		return new FileCache( $this->context->getCacheKey(),function() {
			return $this->generate();
		}, 0 );
	}


	/**
	 * Generates a value.
	 *
	 * @return mixed
	 */
	protected abstract function generate();


	/**
	 * Calculates the MIME-Type
	 *
	 * @return string
	 */
	public abstract  function getMimeType();
}