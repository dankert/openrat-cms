<?php


namespace cms\generator;


use cms\generator\dsl\DslCms;
use cms\generator\dsl\DslConsole;
use cms\generator\dsl\DslHttp;
use cms\generator\dsl\DslJson;
use cms\generator\dsl\DslObject;
use cms\generator\dsl\DslPageContext;
use cms\generator\dsl\DslProject;
use cms\generator\filter\AbstractFilter;
use cms\model\BaseObject;
use cms\model\File;
use cms\model\Value;
use dsl\DslException;
use dsl\executor\DslInterpreter;
use logger\Logger;
use util\exception\GeneratorException;
use util\Text;

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

		return $file->path().'/'.$filename;
	}


	/**
	 * @param $file File
	 * @return string
	 */
	protected function filterValue( $file )
	{
		$contentId = $file->contentid;

		$totalSettings = $file->getTotalSettings();
		$proxyFileId = @$totalSettings['proxy-file-id'];

		if   ( $proxyFileId ) {
			$proxyFile = new File( $proxyFileId ); // This is a proxy for another file.
			$proxyFile->load();
			$contentId = $proxyFile->contentid;
		}

		$v = new Value();
		$v->contentid = $contentId;

		if    ( $this->context->scheme == Producer::SCHEME_PREVIEW )
			$v->load();
		else
			$v->loadPublished();

		$value = $v->file;

		if   ( $file->isScript ) {
			$executor = new DslInterpreter(DslInterpreter::FLAG_THROW_ERROR + DslInterpreter::FLAG_SECURE );

			$executor->addContext( [
				'file'     => new DslObject( (new BaseObject($this->context->getObjectId()))->load() ),
				'project'  => new DslProject( (new BaseObject($this->context->getObjectId()))->load()->getProject() ),
				'console'  => new DslConsole(),
				'cms'      => new DslCms(),
				'http'     => new DslHttp(),
				'json'     => new DslJson(),
			]);

			try {
				$executor->runCode( $value );
				$value = $executor->getOutput();
			}
			catch( DslException $e ) {
				Logger::info($e);
				throw new GeneratorException('Script error in script'."\n".Text::makeLineNumbers($value),$e);
			}
		}

		foreach(\util\ArrayUtils::getSubArray($totalSettings, array( 'filter')) as $filterEntry )
		{
			$filterName = ucfirst(@$filterEntry['name']);
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

			$filterClassNameWithNS = 'cms\\generator\\filter\\' . $filterName.'Filter';

			if   ( !class_exists( $filterClassNameWithNS ) )
				throw new \LogicException("Filter '$filterName' does not exist.");

			/** @var AbstractFilter $filter */
			$filter = new $filterClassNameWithNS();
			$filter->context = $this->context;

			// Copy filter configuration to filter instance.
			foreach( $parameter as $parameterName=>$parameterValue) {
				if   ( property_exists($filter,$parameterName))
					$filter->$parameterName = $parameterValue;
				else
					throw new \LogicException("Filter '".$filterName."' has no property '".$parameterName );
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


	/**
	 * Calculates the MIME type of this file.
	 *
	 * @return string
	 */
	public function getMimeType()
	{
		$file = new File( $this->context->sourceObjectId );
		$file->load();
		$ext = strtolower( $file->getRealExtension() );

		$mimeType = File::getMimeType( $ext );

		return( $mimeType );
	}
}