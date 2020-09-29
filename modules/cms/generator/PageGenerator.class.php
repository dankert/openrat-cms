<?php


namespace cms\generator;


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


class PageGenerator extends BaseGenerator
{

	/**
	 * PageGenerator constructor.
	 * @param $pageContext PageContext
	 */
	public function __construct($pageContext )
	{
		$this->context = $pageContext;
	}



	/**
	 * Erzeugen der Inhalte zu allen Elementen dieser Seite
	 * wird von generate() aufgerufen
	 */
	protected function generatePageElements( $page )
	{
		$values = array();

		//if	( $this->publisher->isSimplePreview() )
		//	$elements = $this->getWritableElements();
		//else
			$elements = $page->getElements();

		foreach( $elements as $elementid=>$element )
		{
			// neues Inhaltobjekt erzeugen
			$valueContext = new ValueContext($this->context);
			$valueContext->elementid = $elementid;
			$valueGenerator = new ValueGenerator( $valueContext );
			try {
				$values[$elementid] = $valueGenerator->getCache()->get();
			} catch( \Exception $e ) {
				// Unrecoverable Error while generating the content.
				throw new GeneratorException('Could not generate Value',$e );
			}

		}

		return $values;
	}



	/**
	 * Erzeugen des Inhaltes der gesamten Seite.
	 *
	 * @return String Inhalt
	 */
	private function generatePageValue()
	{
		$conf = \cms\base\Configuration::rawConfig();

		// Setzen der 'locale', damit sprachabhängige Systemausgaben (wie z.B. die
		// Ausgabe von strftime()) in der korrekten Sprache dargestellt werden.
		$language = new Language($this->context->languageId);
		$language->load();

		$language->setCurrentLocale();

		$page = new Page( $this->context->sourceObjectId );
		$page->load();

		$template = new Template( $page->templateid );
		$template->load();

		$values = $this->generatePageElements( $page );

		// Get a List with ElementId->ElementName
		$elements = array_map(function($element) {
			return $element->name;
		},$page->getElements() );

		$templatemodel = new TemplateModel( $template->templateid, $this->context->modelId );
		$templatemodel->load();
		$src = $templatemodel->src;

		$data = array();

		// Template should have access to the page properties.
		// Template should have access to the settings of this node object.
		$data['_page'         ] = $page->getProperties()   ;
		$data['_localsettings'] = $page->getSettings()     ;
		$data['_settings'     ] = $page->getTotalSettings();

		// No we are collecting the data and are fixing some old stuff.

		foreach( $elements as $elementId=>$elementName )
		{
			$data[ $elementName ] = $values[$elementId];

			// The following code is for old template values:

			// convert {{<id>}} to {{<name>}}
			$src = str_replace( '{{'.$elementId.'}}','{{'.$elementName.'}}',$src );

			$src = str_replace( '{{IFNOTEMPTY:'.$elementId.':BEGIN}}','{{#'.$elementName.'}}',$src );
			$src = str_replace( '{{IFNOTEMPTY:'.$elementId.':END}}'  ,'{{/'.$elementName.'}}',$src );
			$src = str_replace( '{{IFEMPTY:'   .$elementId.':BEGIN}}','{{^'.$elementName.'}}',$src );
			$src = str_replace( '{{IFEMPTY:'   .$elementId.':END}}'  ,'{{/'.$elementName.'}}',$src );

			/*if   ( $this->icons )
				$src = str_replace( '{{->'.$elementId.'}}','<a href="javascript:parent.openNewAction(\''.$elementName.'\',\'pageelement\',\''.$this->objectid.'_'.$value->element->elementid.'\');" title="'.$value->element->desc.'"><img src="'.OR_THEMES_DIR.$conf['interface']['theme'].'/images/icon_el_'.$value->element->type.IMG_ICON_EXT.'" border="0" align="left"></a>',$src );
			else*/
				$src = str_replace( '{{->'.$elementId.'}}','',$src );
		}

		Logger::trace( 'pagedata: '.print_r($data,true) );

		// Now we have collected all data, lets call the template engine:

		$mustache = new Mustache();
		$mustache->escape = null; // No HTML escaping, this is the job of this CMS ;)
		$mustache->partialLoader = function( $name ) use ($page,$template) {

			if   ( substr($name,0,5) == 'file:') {
				$fileid = intval( substr($name,5) );
				$file = new File( $fileid );
				return $file->loadValue();
			}


			$project       = Project::create( $page->projectid );
			$templateid    = array_search($name,$project->getTemplates() );

			if   ( ! $templateid )
				throw new \InvalidArgumentException('template '.Logger::sanitizeInput($name).' not found');

			if   ( $templateid == $template->templateid )
				throw new \InvalidArgumentException('Template recursion detected on template-id '.$templateid);


			$templatemodel = new TemplateModel( $templateid, $this->context->modelId );
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
		if	( \cms\base\Configuration::config('publish','escape_8bit_characters') )
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

	protected function generate()
	{
		return $this->generatePageValue();
	}


	/**
	 * Creating the public filename of a page.
	 *
	 * @return string
	 * @throws \util\exception\ObjectNotFoundException
	 */
	public function getPublicFilename()
	{
		$page = new Page( $this->context->sourceObjectId );
		$page->load();

		$parentFolder = new Folder( $page->parentid );
		$parentFolder->load();

		$project = $page->getProject();
		$project->load();

		$format = \cms\base\Configuration::config('publish','format');
		$format = str_replace('{filename}',$page->filename,$format );

		$allLanguages = $project->getLanguageIds();
		$allModels    = $project->getModelIds();

		$withLanguage = count($allLanguages) > 1 || \cms\base\Configuration::config('publish','filename_language') == 'always';
		$withModel    = count($allModels   ) > 1 || \cms\base\Configuration::config('publish','filename_type'    ) == 'always';

		$languagePart = '';
		$typePart     = '';

		if	( $withLanguage  ) {
			$l = new Language( $this->context->languageId );
			$l->load();

			$languagePart = $l->isoCode;
		}

		if	( $withModel ) {
			$templateModel = new TemplateModel( $page->templateid, $this->context->modelId );
			$templateModel->load();

			$typePart = $templateModel->extension;
		}

		$languageSep = $languagePart?\cms\base\Configuration::config('publish','language_sep') :'';
		$typeSep     = $typePart    ?\cms\base\Configuration::config('publish','type_sep'    ) :'';

		$format = str_replace('{language}'    ,$languagePart ,$format );
		$format = str_replace('{language_sep}',$languageSep  ,$format );
		$format = str_replace('{type}'        ,$typePart     ,$format );
		$format = str_replace('{type_sep}'    ,$typeSep      ,$format );

		return $page->path().'/'.$format;
	}
}