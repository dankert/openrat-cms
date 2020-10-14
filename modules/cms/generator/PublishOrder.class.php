<?php


namespace cms\generator;


/**
 * An order for publishing a file.
 */
class PublishOrder
{
	public $localFilename;
	public $destinationFilename;
	public $fileTime;

	/**
	 * PublishOrder constructor.
	 *
	 * @param $localFilename
	 * @param $destinationFilename
	 * @param $fileTime
	 */
	public function __construct($localFilename, $destinationFilename, $fileTime)
	{
		$this->localFilename = $localFilename;
		$this->destinationFilename = $destinationFilename;
		$this->fileTime = $fileTime;
	}


}