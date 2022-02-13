<?php


namespace cms\generator;



/**
 * The file history context, necessary for generating and publishing a file.
 */
class FileHistoryContext extends FileContext
{
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
		parent::__construct($sourceObjectId,Producer::SCHEME_PREVIEW);
		$this->valueId        = $valueId;
	}

	public function getCacheKey()
	{
		return array_merge( parent::getCacheKey(),['history',$this->valueId] );
	}
}