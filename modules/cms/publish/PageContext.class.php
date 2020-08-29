<?php


namespace cms\publish;


/**
 * The page context, necessary for generating and publishing a page.
 */
class PageContext
{

	/**
	 * The source page, links are generated from the view of this page.
	 * @var int
	 */
	public $sourceObjectId;

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

	public function __construct( $sourceObjectId = null )
	{
		$this->sourceObjectId = $sourceObjectId;
	}
}