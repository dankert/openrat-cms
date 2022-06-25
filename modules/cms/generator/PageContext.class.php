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

	/**
	 * The page which should be generated.
	 * @var int
	 */
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

	public function __construct($objectId, $scheme )
	{
		$this->objectId       = $objectId;
		$this->sourceObjectId = $objectId;
		$this->scheme         = $scheme;
	}

	public function getCacheKey()
	{
		return [
			$this->objectId,
			$this->languageId,
			$this->modelId,
			$this->scheme
		];
	}


	public function getObjectId()
	{
		return $this->sourceObjectId;
	}
}