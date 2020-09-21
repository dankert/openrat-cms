<?php


namespace cms\generator;



use cms\generator\link\PreviewLink;
use cms\generator\link\PublicLink;

/**
 * The page context, necessary for generating and publishing a page.
 */
class PageContext extends BaseContext
{

	/**
	 * The source page, links are generated from the view of this page.
	 * @var int
	 */
	public $sourceObjectId;

	public $objectId;

	/**
	 * Language.
	 * @var int
	 */
	public $languageId;

	/**
	 * Model.
	 * @var int
	 */
	public $modelId;

	/**
	 * @var link\PreviewLink|link\PublicLink
	 */
	public $linkFormat;

	public function __construct($objectId, $scheme )
	{
		$this->objectId       = $objectId;
		$this->sourceObjectId = $objectId;
		$this->scheme         = $scheme;
	}

	public function getCacheKey()
	{
		return [
			$this->sourceObjectId,
			$this->languageId,
			$this->modelId,
			$this->scheme
		];
	}



	public function getLinkScheme() {

		switch( $this->scheme ) {
			case Producer::SCHEME_PREVIEW:
				return new PreviewLink();
			case Producer::SCHEME_PUBLIC:
				return new PublicLink();
			default:
				return null;
		}
	}

}