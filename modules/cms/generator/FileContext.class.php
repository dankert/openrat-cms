<?php


namespace cms\generator;



/**
 * The page context, necessary for generating and publishing a page.
 */
class FileContext extends BaseContext
{
	/**
	 * File id.
	 * @var int
	 */
	public $sourceObjectId;

	/**
	 * FileContext constructor.
	 * @param $sourceObjectId
	 */
	public function __construct($sourceObjectId,$scheme )
	{
		$this->sourceObjectId = $sourceObjectId;
		$this->scheme = $scheme;
	}

	public function getCacheKey()
	{
		return [
			$this->sourceObjectId,
			$this->scheme
		];
	}


	public function getObjectId()
	{
		return $this->sourceObjectId;
	}
}