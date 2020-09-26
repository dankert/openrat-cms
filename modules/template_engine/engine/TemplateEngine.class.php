<?php


namespace template_engine\engine;
use DomainException;
use DOMDocument;
use DOMElement;
use Exception;
use LogicException;
use template_engine\element\XMLFormatter;
use template_engine\element\PHPBlockElement;
use template_engine\components\html\Component;
use template_engine\components\html\NativeHtmlComponent;

/**
 * Wandelt eine Vorlage in ein PHP-Skript um.
 *
 * Die Vorlage wird gesparst, Elemente werden geladen und in die Zieldatei kopiert.
 *
 * @author Jan Dankert
 * @package openrat.services
 */
class TemplateEngine
{
	/**
	 * The OpenRat template namespace.
	 */
	const NS_OPENRAT_COMPONENT = 'http://www.openrat.de/template';

	/**
	 * HTML5 namespace.
	 */
	const NS_HTML5 = 'http://www.w3.org/1999/xhtml';

	// For now we are only supporting HTML rendering.
	public $renderType = 'html';

	public $config = array();
	public $request;

	private $srcFilename;

	const CSS_PREFIX = 'or-';

	const OUTPUT_ALIAS = 'O';

	/**
     * Compile the template.
     * From a XML source file we are generating a PHP file.
     *
     * @param $srcXmlFilename string Filename of template source
     * @param $tplOutName string Filename of template code
	 */
	public function compile($srcXmlFilename, $tplOutName )
	{
		$this->srcFilename = $srcXmlFilename;

		$filename = $tplOutName;

		if (is_file($filename) && ! is_writable($filename))
			throw new LogicException("Template output file is read-only: $filename");

		// The generated template should only be executable in our CMS environment (for security reasons).
		$writtenBytes = file_put_contents( $filename,'<?php defined(\'APP_STARTED\') || die(\'Forbidden\'); use \\template_engine\Output as '.self::OUTPUT_ALIAS.'; ?>' );

		if ( $writtenBytes === FALSE )
			throw new LogicException("Unable writing to output file: '$filename'");

		try
		{
			$confCompiler = $this->config;

			if (is_file($srcXmlFilename))
				$srcFilename = $srcXmlFilename;
			else
				// Wenn Vorlage (noch) nicht existiert
				throw new LogicException("Template not found: $srcXmlFilename");

			// Vorlage und Zieldatei oeffnen
			$document = $this->loadDocument($srcFilename);

			// creating a tree of components
			$rootComponent = $this->processElement( $document->documentElement );

			// converting the component tree to a element tree
			$rootElement = $rootComponent->getElement();

			$writtenBytes = file_put_contents( $filename, $rootElement->render( new XMLFormatter('  ')),FILE_APPEND );

			if ( $writtenBytes === FALSE )
				throw new LogicException("Unable writing to output file: '$filename'");

			// CHMOD ausfuehren.
			if ( @$confCompiler['chmod'] )
				if (! @chmod($filename, octdec($confCompiler['chmod'])))
					throw new \InvalidArgumentException("Template {$srcXmlFilename} failed to compile: CHMOD '{$confCompiler['chmod']}' failed on file {$filename}.");
		}
		catch (Exception $e)
		{
			throw new LogicException("Template '$srcXmlFilename' failed to compile", 0, $e);
		}
	}


	/**
	 * @param DOMElement $element
	 * @param int $depth
	 */
	private function processElement( $element, $depth = 0 ) {

		// Only process DOM Elements (ignoring Text, Comments, ...)
		if   ( $element->nodeType == XML_ELEMENT_NODE )
			;
		else
			return null;

		// The namespace decides what to do with this element:
		if   ( $element->namespaceURI == self::NS_OPENRAT_COMPONENT)
			return $this->processCMSElement( $element, $depth );
		elseif   ( $element->namespaceURI == self::NS_HTML5)
			return $this->processHTMLElement( $element, $depth );
		else
			throw new LogicException("Unknown Element ".$element->tagName.' in NS '.$element->namespaceURI );
	}



	private function processCMSElement(DOMElement $element, $depth)
	{
		$attributes = $element->attributes;
		$tag        = $element->localName;

		if   ( $tag == 'include') {

			$filename   = dirname($this->srcFilename) . '/' . $attributes['file']->value . '.inc.xml';
			if   ( ! is_file( $filename ))
				throw new LogicException('Includefile not found: '.$filename );

			$element    = $this->loadDocument($filename)->documentElement;
			$attributes = $element->attributes;
			$tag        = $element->localName;
		}

		$className = ucfirst($tag);
		$className = 'template_engine\components\\'.$className.'Component';

		if   ( !class_exists($className ))
			throw new LogicException("Component class ".$className.' does not exist');

		/* @var $component Component */
		$component = new $className();
		$component->setDepth($depth+1);
		$component->request = $this->request;

		foreach ($attributes as $attribute)
		{
			$attributeValue = $attribute->value;
			$attributeName  = $attribute->name;

			// Aus String 'true' und 'false' typechtes Boolean machen.
			// Sonst wäre 'false'==true!
			if ($attributeValue == 'false') $attributeValue = false;
			if ($attributeValue == 'true') $attributeValue = true;

			$component->$attributeName = $attributeValue;
		}

		$component->init();

		foreach( $element->childNodes as $child ) {
			$component->addChildComponent( $this->processElement( $child,$depth ) );
		}
		return $component;
	}


	/**
	 * Creates a new HTML element.
	 * @param $element DOMElement
	 * @param $depth
	 * @return NativeHtmlComponent
	 */
	private function processHTMLElement($element, $depth)
	{
		$component = new NativeHtmlComponent();

		$component->tag = $element->localName;
		$component->attributes = $element->attributes;
		$component->init();

		return $component;
	}

	/**
	 * Diese Funktion lädt die Vorlagedatei.
	 */
	private function loadDocument( $filename )
	{
		return $this->loadXmlDocument( $filename );
	}


	/**
	 * Laden und Parsen eines XML-Dokumentes.
	 *
	 * @return DOMDocument
	 */
	private function loadXmlDocument( $filename )
	{
	    if (!is_file($filename))
	        throw new LogicException("XML file '$filename' was not found.'");

		$document = new DOMDocument();
		$document->load( $filename );
		return $document;
	}


	/**
	 * Executes the required template and writes the output to standard-out..
	 *
	 * @param $templateFile string filename of template
	 * @param $outputData array output data
	 */
    public function executeTemplate($templateFile, $outputData)
    {
        if ( ! is_file($templateFile) )
            throw new LogicException("Template file '$templateFile' was not found.");

		if   ( DEVELOPMENT )
			// save a few bytes in production mode ;)
			header("X-CMS-Template-File: " . $templateFile);

		// Extracting all output data into the actual context
        extract($outputData);

        // Include the template
        require_once($templateFile);
    }

}

