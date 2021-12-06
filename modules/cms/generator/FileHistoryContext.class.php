<?php


namespace cms\generator;



/**
 * The file history context, necessary for generating and publishing a file.
 */
class FileHistoryContext extends BaseContext
{
	public $sourceObjectId;

	/**
	 * value id.
	 *
	 * @var int
	 */
	public $valueId;

	/**
	 * FileHistoryContext constructor.
	 *
	 * @param $sourceObjectId
	 * @param $valueId
	 */
	public function __construct($sourceObjectId,$valueId )
	{
		$this->sourceObjectId = $sourceObjectId;
		$this->valueId        = $valueId;
		$this->scheme = Producer::SCHEME_PREVIEW;
	}

	public function getCacheKey()
	{
		return [
			'filehistory',
			$this->sourceObjectId,
			$this->valueId
		];
	}


	public function getObjectId()
	{
		return $this->sourceObjectId;
	}
}