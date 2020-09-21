<?php


namespace cms\generator;


use cms\model\File;

class FileGenerator extends BaseGenerator
{


	public function __construct($fileContext )
	{
		$this->context = $fileContext;
	}

	protected function generate()
	{
		$file = new File( $this->context->sourceObjectId );
		return $file->loadValue();
	}

	public function getPublicFilename()
	{
		$file = new File( $this->context->sourceObjectId );
		return $file->filename();
	}
}