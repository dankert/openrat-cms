<?php


namespace cms\generator;


use cms\generator\filter\AbstractFilter;
use cms\model\File;
use logger\Logger;
use util\exception\GeneratorException;

class FileGenerator extends BaseGenerator
{


	public function __construct($fileContext )
	{
		$this->context = $fileContext;
	}

	protected function generate()
	{
		$file = new File( $this->context->sourceObjectId );
		$file->load();
		return $this->filterValue( $file );
	}

	public function getPublicFilename()
	{
		$file = new File( $this->context->sourceObjectId );
		$file->load();

		$filename = $file->filename();

		if   ( $file->extension )
			$filename .= '.'.$file->extension;

		return $filename;
	}


	/**
	 * @param $file File
	 * @return string
	 */
	private function filterValue($file )
	{
		$value = $file->loadValue();

		foreach(\util\ArrayUtils::getSubArray($file->getTotalSettings(), array( 'filter')) as $filterEntry )
		{
			$filterName = @$filterEntry['name'];
			$extension  = @$filterEntry['extension'];

			if   ( $extension && strtolower($extension) != strtolower($file->getRealExtension()) )
				continue; // File extension does not match

			$filterType = $this->context->scheme==Producer::SCHEME_PUBLIC?'public':'preview';

			$onPublish = (array) @$filterEntry['on'];
			if ( ! $onPublish || in_array('all',$onPublish ) )
				$onPublish = ['edit','public','preview','show'];

			if   ( $onPublish && ! in_array($filterType,$onPublish))
				continue; // Publish type does not match

			$parameter = (array) @$filterEntry['parameter'];

			$filterClassNameWithNS = 'cms\\publish\\filter\\' . $filterName.'Filter';

			if   ( !class_exists( $filterClassNameWithNS ) ) {
				Logger::warn("Filter '$filterName' does not exist.");
				continue;
			}

			/** @var AbstractFilter $filter */
			$filter = new $filterClassNameWithNS();

			// Copy filter configuration to filter instance.
			foreach( $parameter as $name=>$value) {
				if   ( property_exists($filter,$name))
					$filter->$name = $value;
			}


			// Execute the filter.
			Logger::debug("Filtering '$file->filename' with filter '$filterName'.");

			try {

				$value = $filter->filter( $value );
			} catch( \Exception $e ) {
				// Filter has some undefined error.
				Logger::warn( $e->getTraceAsString() );
				throw new GeneratorException('Could not generate file '.$file->objectid.'. Filter '.$filterName.' has an error.', $e );
			}
		}

		return $value;

	}

}