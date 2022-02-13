<?php


namespace cms\generator;


use cms\generator\filter\AbstractFilter;
use cms\model\File;
use cms\model\Value;
use logger\Logger;
use util\exception\GeneratorException;

class FileHistoryGenerator extends FileGenerator
{
	/**
	 * @param $fileContext FileHistoryContext
	 */
	public function __construct($fileContext )
	{
		parent::__construct( $fileContext );
	}


	/**
	 * Generate value in the wished version.
	 * @return string
	 */
	protected function generate()
	{
		$value = new Value();
		$value->loadWithId( $this->context->valueId);

		return $value->file; // Should we filter here?
	}


	/**
	 * Not useful: FileHistory will only be used in the preview.
	 * @return null
	 */
	public function getPublicFilename()
	{
		return null;
	}
}