<?php


namespace cms\generator;


use cms\base\Configuration;
use cms\generator\dsl\CMSDslInterpreter;
use cms\generator\dsl\DslPage;
use cms\model\File;
use cms\model\Project;
use cms\model\Template;
use cms\model\TemplateModel;
use dsl\DslException;
use dsl\DslTemplate;
use dsl\standard\Data;
use http\Exception\InvalidArgumentException;
use logger\Logger;
use util\exception\GeneratorException;
use util\exception\ObjectNotFoundException;
use util\Mustache;
use util\Text;
use util\text\TextMessage;


class TemplateGenerator
{

	private $templateId;
	private $modelId;
	private $scheme;

	public function __construct($templateId, $modelId, $scheme )
	{
		$this->templateId = $templateId;
		$this->modelId = $modelId;
		$this->scheme = $scheme;
	}


	/**
	 * Generates the template content.
	 *
	 * @param $data array values
	 * @return String Inhalt
	 * @throws GeneratorException|ObjectNotFoundException
	 */
	public function generateValue( $data )
	{
		$template = new Template( $this->templateId );
		$template->load();

		// Get a List with ElementId->ElementName
		$elements = array_map(function($element) {
			return $element->name;
		},$template->getElements() );

		$templatemodel = new TemplateModel( $template->templateid, $this->modelId );
		if   ( $this->scheme == Producer::SCHEME_PREVIEW )
			$templatemodel->load();
		else
			$templatemodel->loadForPublic();

		$src = $templatemodel->src;

		// No we are collecting the data and are fixing some old stuff.
		if ( DEVELOPMENT )
			Logger::trace( 'generating template with data: '.print_r($data,true) );

		switch( $templatemodel->getFormat() ) {
			case TemplateModel::FORMAT_MUSTACHE_TEMPLATE:
				foreach( $elements as $elementId=>$elementName )
				{
					// The following code is for old template values:

					// convert {{<id>}} to {{<name>}}
					$src = str_replace( '{{'.$elementId.'}}','{{'.$elementName.'}}',$src );

					$src = str_replace( '{{IFNOTEMPTY:'.$elementId.':BEGIN}}','{{#'.$elementName.'}}',$src );
					$src = str_replace( '{{IFNOTEMPTY:'.$elementId.':END}}'  ,'{{/'.$elementName.'}}',$src );
					$src = str_replace( '{{IFEMPTY:'   .$elementId.':BEGIN}}','{{^'.$elementName.'}}',$src );
					$src = str_replace( '{{IFEMPTY:'   .$elementId.':END}}'  ,'{{/'.$elementName.'}}',$src );

					$src = str_replace( '{{->'.$elementId.'}}','',$src );
				}

				// Now we have collected all data, lets call the template engine:

				$mustache = new Mustache();
				$mustache->escape = null; // No HTML escaping, this is the job of this CMS ;)
				$mustache->partialLoader = function( $name ) use ($template) {

					if   ( substr($name,0,5) == 'file:') {
						$fileid = intval( substr($name,5) );
						$file = new File( $fileid );
						return $file->loadValue();
					}


					$project       = Project::create( $template->projectid );
					$templateid    = array_search($name,$project->getTemplates() );

					if   ( ! $templateid )
						throw new \InvalidArgumentException( TextMessage::create('template ${name} not found',['name'=>$name]) );

					if   ( $templateid == $template->templateid )
						throw new \InvalidArgumentException('Template recursion detected on template-id '.$templateid);


					$templatemodel = new TemplateModel( $templateid, $this->modelId );
					$templatemodel->load();

					return $templatemodel->src;
				};

				try {
					$mustache->parse($src);
				} catch (\Exception $e) {

					return new GeneratorException("Mustache template rendering failed:\n".$e->getMessage());
				}
				$src = $mustache->render( $data );
				break;


			case TemplateModel::FORMAT_RATSCRIPT_TEMPLATE:
				try {
					$templateParser = new DslTemplate();
					$templateParser->parseTemplate($src);

					$src= $templateParser->script;

				} catch (DslException $e) {
					throw new GeneratorException('Parsing of Script-Template failed',$e);
				}

				// here is intentionally no "break" statement!
				// The generated source will be executed in the next case.


			case TemplateModel::FORMAT_RATSCRIPT:
				try {

					$executor = new CMSDslInterpreter();
					$executor->addContext( $data );
					$executor->addContext( [ 'data' => new Data($data)] );

					$executor->runCode($src);

					// Ausgabe ermitteln.
					$src = $executor->getOutput();
				} catch (DslException $e) {
					Logger::warn($e);
					throw new GeneratorException("Error in script:\n".Text::makeLineNumbers($src),$e );
				}
				break;

			default:
				throw new InvalidArgumentException('Format of template source is unknown: '.$templatemodel->getFormat() );
		}



		// should we do a UTF-8-escaping here?
		// Default should be off, because if you are fully using utf-8 (you should do), this is unnecessary.
		if	( Configuration::subset('publish' )->is('escape_8bit_characters') )
			if	( substr($this->getMimeType(),-4) == 'html' )
				$src = Text::translateutf8tohtml($src);

		return $src;
	}


	/**
	 * @return String
	 */
	public function getMimeType()
	{
		// A MIME type has two parts: a type and a subtype. They are separated by a slash (/)
		$templateModel = new TemplateModel( $this->templateId,$this->modelId );
		$templateModel->load();

		return $templateModel->mimeType();
	}
}