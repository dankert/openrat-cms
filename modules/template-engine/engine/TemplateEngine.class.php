<?php


namespace template_engine;
use DomainException;
use Exception;
use LogicException;
use SimpleXMLElement;
use \template_engine\components\Component;

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
	public $renderType = 'html';

	public $config = array();
	public $request;

	private $srcFilename;
	private $debug = false;


    /**
	 * Erzeugt einen Templateparser.
	 */
	public function __construct()
	{
	}

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

	    // Imports the base class of all component types.
		require_once (dirname(__FILE__).'/../components/'.$this->renderType.'/Component.class.' . PHP_EXT);
		require_once (dirname(__FILE__).'/../components/'.$this->renderType.'/HtmlComponent.class.' . PHP_EXT);
		require_once (dirname(__FILE__).'/../components/'.$this->renderType.'/FieldComponent.class.' . PHP_EXT);

		try
		{
			$confCompiler = $this->config;
			
			if (is_file($srcXmlFilename))
				$srcFilename = $srcXmlFilename;
			else
				// Wenn Vorlage (noch) nicht existiert
				throw new \LogicException("Template not found: $srcXmlFilename");
			
			$filename = $tplOutName;
			
			// Wenn Vorlage gaendert wurde, dann Umwandlung erneut ausf�hren.
			if (false && is_file($filename) && filemtime($srcFilename) <= filemtime($filename))
				return;
			
			if (is_file($filename) && ! is_writable($filename))
				throw new \LogicException("Template output file is read-only: $filename");
			
			// Vorlage und Zieldatei oeffnen
			$document = $this->loadDocument($srcFilename);
			
			$outFile = @fopen($filename, 'w');
            fwrite($outFile, '<?php if (!defined(\'OR_TITLE\')) die(\'Forbidden\'); ?>');

			if (! is_resource($outFile))
				throw new \LogicException("Template '$srcXmlFilename': Unable to open file for writing: '$filename'");
			
			$this->processElement( $document, $outFile );

			fclose($outFile);
			
			// CHMOD ausfuehren.
			if (! empty($confCompiler['chmod']))
				if (! @chmod($filename, octdec($confCompiler['chmod'])))
					throw new \InvalidArgumentException("Template {$srcXmlFilename} failed to compile: CHMOD '{$confCompiler['chmod']}' failed on file {$filename}.");
		}
		catch (\Exception $e)
		{
			echo $e->getTraceAsString();
			throw new \LogicException("Template '$srcXmlFilename' failed to compile", 0, $e);
		}
	}


	/**
	 * @param SimpleXMLElement $element
	 * @param resource $outFile
	 * @param int $depth
	 */
	private function processElement( $element, $outFile, $depth = 0 ) {

		$attributes = iterator_to_array($element->attributes());
		$tag        = $element->getName();

		if   ( $tag == 'include') {

			$element    = $this->loadDocument(dirname($this->srcFilename ) . '/' . $attributes['file'] . '.inc.xml');
			$attributes = iterator_to_array( $element->attributes() );
			$tag        = $element->getName();
		}

		$className = ucfirst($tag);
		$classFilename = dirname(__FILE__).'/../components/'.$this->renderType."/$tag/$className.class." . PHP_EXT;

		if (!is_file($classFilename))
			throw new \LogicException("Component Class File '$classFilename' does not exist." );

		require_once ($classFilename);

		$className = 'template_engine\components\\'.$className .'Component';
		/* @var $component Component */
		$component = new $className();
		$component->setDepth($depth);
		$component->request = $this->request;

		foreach ($attributes as $attributeName => $attributeValue)
		{
			settype($attributeValue,'string');
			// Aus String 'true' und 'false' typechtes Boolean machen.
			// Sonst wäre 'false'==true!
			if ($attributeValue == 'false') $attributeValue = false;
			if ($attributeValue == 'true') $attributeValue = true;

			$component->$attributeName = $attributeValue;
		}

		$output = $component->getBegin();
		if($this->debug) $output = '<!-- Begin '.$tag.' -->'.$output;

		if ($output) {
			$prepend = ($depth>=0?"\n":'').str_repeat("\t",$depth);
			fwrite($outFile, $prepend.$output);
		}

		foreach( $element->children() as $child ) {
			$this->processElement($child,$outFile,$depth+1);
		}

		$output = $component->getEnd();
		if($this->debug) $output = $output.'<!-- End '.$tag.' -->';
		if   ( $output ) {
			$prepend = "\n".str_repeat("\t",$depth);
			fwrite($outFile, $prepend.$output);
		}

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
	 */
	private function loadXmlDocument( $filename )
	{
	    if (!is_file($filename))
	        throw new LogicException("XML file '$filename' was not found.'");

		return new SimpleXMLElement( implode('',file($filename)) );
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
            #header("X-CMS-Template-File: " . $templateFile);
        }

        // Spätestens jetzt muss das Template vorhanden sein.
        if (!is_file($templateFile))
            throw new LogicException("Template file '$templateFile' was not found.");

        // Übertragen der Ausgabe-Variablen in den aktuellen Kontext
        //
        extract($outputData);

        // Einbinden des Templates
        require_once($templateFile);

    }

}

