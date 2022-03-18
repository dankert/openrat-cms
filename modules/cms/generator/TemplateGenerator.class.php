<?php


namespace cms\generator;


use cms\base\Configuration;
use cms\generator\PageContext;
use cms\model\File;
use cms\model\Folder;
use cms\model\Language;
use cms\model\Page;
use cms\model\Project;
use cms\model\Template;
use cms\model\TemplateModel;
use cms\model\Value;
use logger\Logger;
use util\exception\GeneratorException;
use util\Mustache;
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

		if ( DEVELOPMENT )
			Logger::trace( 'generating template with data: '.print_r($data,true) );

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
			// Should we throw it to the caller?
			// No, because it is not a technical error. So let's only log it.
			Logger::warn("Template rendering failed: ".$e->getMessage() );
			return $e->getMessage();
		}
		$src = $mustache->render( $data );

		// now we have the fully generated source.

		// should we do a UTF-8-escaping here?
		// Default should be off, because if you are fully using utf-8 (you should do), this is unnecessary.
		if	( Configuration::subset('publish' )->is('escape_8bit_characters') )
			if	( substr($this->mimeType(),-4) == 'html' )
			{
				/*
				 *
				$src = htmlentities($src,ENT_NOQUOTES,'UTF-8');
				$src = str_replace('&lt;' , '<', $src);
				$src = str_replace('&gt;' , '>', $src);
				$src = str_replace('&amp;', '&', $src);
				 */
				$src = translateutf8tohtml($src);
			}

		return $src;
	}


	public function getMimeType()
	{
		$templateModel = new TemplateModel( $this->templateId,$this->modelId );
		$templateModel->load();

		return $templateModel->mimeType();
	}
}