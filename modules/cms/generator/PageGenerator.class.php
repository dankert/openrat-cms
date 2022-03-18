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
	 * wird von generate() aufgerufen.

	 * @param $page Page page
	 * @return array
	 * @throws GeneratorException
	 */
	protected function generatePageElements( $page )
	{
		$values = array();

		$elements = $page->getTemplate()->getElements();

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
		// Setzen der 'locale', damit sprachabhängige Systemausgaben (wie z.B. die
		// Ausgabe von strftime()) in der korrekten Sprache dargestellt werden.
		$language = new Language($this->context->languageId);
		$language->load();

		$language->setCurrentLocale();

		$page = new Page( $this->context->objectId );
		$page->load();

		$tplGenerator = new TemplateGenerator( $page->templateid,$this->context->modelId, $this->context->scheme );

		$pageValues = $this->generatePageElements( $page ); // generating the value of all page elements.

		// Template should have access to the page properties.
		// Template should have access to the settings of this node object.
		$data = [];
		$data['_page'         ] = $page->getProperties()   ;
		$data['_localsettings'] = $page->getSettings()     ;
		$data['_settings'     ] = $page->getTotalSettings();

		foreach( $page->getTemplate()->getElements() as $elementId=>$element )
			$data[ $element->name ] = $pageValues[$elementId];

		return $tplGenerator->generateValue( $data );
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

		$publishConfig = Configuration::subset('publish');
		$format = $publishConfig->get('format','{filename}{language_sep}{language}{type_sep}{type}');
		$format = str_replace('{filename}',$page->filename,$format );

		$allLanguages = $project->getLanguageIds();
		$allModels    = $project->getModelIds();

		$withLanguage = count($allLanguages) > 1 || $publishConfig->get('filename_language','auto'   ) == 'always';
		$withModel    = count($allModels   ) > 1 || $publishConfig->get('filename_type'    ,'always' ) == 'always';

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

		$languageSep = $languagePart? $publishConfig->get('language_sep','.') :'';
		$typeSep     = $typePart    ? $publishConfig->get('type_sep'    ,'.') :'';

		$format = str_replace('{language}'    ,$languagePart ,$format );
		$format = str_replace('{language_sep}',$languageSep  ,$format );
		$format = str_replace('{type}'        ,$typePart     ,$format );
		$format = str_replace('{type_sep}'    ,$typeSep      ,$format );

		return $page->path().'/'.$format;
	}



	public function getMimeType()
	{
		$page = new Page( $this->context->sourceObjectId );
		$page->load();
		$templateModel = new TemplateModel( $page->templateid,$this->context->modelId );
		$templateModel->load();

		return $templateModel->mimeType();
	}
}