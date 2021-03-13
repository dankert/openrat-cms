<?php


namespace cms\generator;


use cms\generator\link\PreviewLink;
use cms\generator\link\PublicLink;

abstract class BaseContext
{
	/**
	 * Scheme,
	 * one of PREVIEW or PUBLIC.
	 * @var int
	 */
	public $scheme;

	public abstract function getCacheKey();

	public abstract function getObjectId();

	public function getLinkScheme() {

		switch( $this->scheme ) {
			case Producer::SCHEME_PREVIEW:
				return new PreviewLink( $this );
			case Producer::SCHEME_PUBLIC:
				return new PublicLink( $this );
			default:
				return null;
		}
	}

}