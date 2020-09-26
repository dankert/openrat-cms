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
	// For now we are only supporting HTML rendering.
	public $renderType = 'html';

	public $config = array();
	public $request;

	private $srcFilename;
	private $debug = false;

	const CSS_PREFIX = 'or-';

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
		$writtenBytes = file_put_contents( $filename,'<?php if (!defined(\'OR_TITLE\')) exit(); ?>' );

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
			echo $e->getTraceAsString();
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
		if   ( $element->namespaceURI == 'http://www.openrat.de/template')
			return $this->processCMSElement( $element, $depth );
		elseif   ( $element->namespaceURI == 'http://www.w3.org/1999/xhtml')
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
     * Führt das gewünschte Template aus und schreibt das Ergebnis auf die Standardausgabe.
     *
     * In Development-Mode the template is compiled.
     *
     * @param $srcFile string Quelldateiname des Templates (im XML-Format)
     * @param $outputData array Ausgabedaten
     */
    public function executeTemplate($srcFile, $outputData)
    {
        // Converting filename: '/path/file.src.xml' => '/path/file.php'.
        $templateFile = dirname( $srcFile ).'/'.substr( basename($srcFile),0,strpos( basename($srcFile),'.')).'.php';

        // In development mode, we are compiling every template on the fly.
        if (DEVELOPMENT && false /*use dedicated template compiler in update.html */) {

            // Compile the template.
            // From a XML source file we are generating a PHP file.
            try
            {
                $this->compile($srcFile, $templateFile);
                unset($te);
            } catch (Exception $e) {
                throw new DomainException("Compilation failed for Template '$srcFile'.", 0, $e);
            }

        }

		// Spätestens jetzt muss das Template vorhanden sein.
        if (!is_file($templateFile))
            throw new LogicException("Template file '$templateFile' was not found.");

		if   ( DEVELOPMENT )
			// save a few bytes in production mode ;)
			header("X-CMS-Template-File: " . $templateFile);

		// Übertragen der Ausgabe-Variablen in den aktuellen Kontext
        //
        extract($outputData);

        // Include the template
        require_once($templateFile);
    }

}

