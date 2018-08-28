<?php


namespace template_engine;
use DomainException;
use Exception;
use LogicException;
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
	    // Imports the base class of all component types.
		require_once (dirname(__FILE__).'/../components/'.$this->renderType.'/Component.class.' . PHP_EXT);
		
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
			
			if (! is_resource($outFile))
				throw new \LogicException("Template '$srcXmlFilename': Unable to open file for writing: '$filename'");
			
			$openCmd = array();
			$depth = 0;
			$components = array();

			$document = $this->parseIncludes( $document, dirname($srcXmlFilename) );
			
			foreach ($document as $element)
			{
				// Initialisieren der m�glichen Element-Inhalte
				$type = '';
				$attributes = array();
				$value = '';
				$tag = '';

				// Setzt: $tag, $attributes, $value, $type
				extract($element);
				
				if ($type == 'open' || $type == 'complete')
				{
					$depth ++;
					
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
					
					foreach ($attributes as $prop => $value)
					{
					    // Aus String 'true' und 'false' typechtes Boolean machen.
                        // Sonst wäre 'false'==true!
                        if ($value == 'false') $value = false;
                        if ($value == 'true') $value = true;

						$component->$prop = $value;
					}
					// $component->depth = $depth;
					
					$components[$depth] = $component;
					fwrite($outFile, "\n".str_repeat("\t",$depth));
					fwrite($outFile, $component->getBegin());
				}
				
				if ($type == 'close' || $type == 'complete')
				{
					$component = $components[$depth];
					fwrite($outFile, "\n".str_repeat("\t",$depth));
					fwrite($outFile, $component->getEnd());
					unset($components[$depth]); // Cleanup
					
					$depth --;
				}
			}
			
			fclose($outFile);
			
			// CHMOD ausfuehren.
			if (! empty($confCompiler['chmod']))
				if (! @chmod($filename, octdec($confCompiler['chmod'])))
					throw new \InvalidArgumentException("Template {$srcXmlFilename} failed to compile: CHMOD '{$confCompiler['chmod']}' failed on file {$filename}.");
		}
		catch (\Exception $e)
		{
			throw new \LogicException("Template '$srcXmlFilename' failed to compile", 0, $e);
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
	        throw new LogicException("File '$filename' was not found.'");

		$index = array();
		$vals  = array();
		$p = xml_parser_create();
		xml_parser_set_option ( $p, XML_OPTION_CASE_FOLDING,false );
		xml_parser_set_option ( $p, XML_OPTION_SKIP_WHITE,false );
		xml_parse_into_struct($p, implode('',file($filename)), $vals, $index);
		xml_parser_free($p);
		
		return $vals;
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
        if (DEVELOPMENT) {

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


    /**
     * @param $document array
     * @param $includePath
     * @return array
     */
    private function parseIncludes($document, $includePath )
    {
        $newDocument = array();

        foreach ($document as $element) {
            // Initialisieren der m�glichen Element-Inhalte
            $type = '';
            $attributes = array();
            $value = '';
            $tag = '';

            // Setzt: $tag, $attributes, $value, $type
            extract($element);

            if ($tag == 'include') {
                if ($type == 'complete' || $type == 'open') {

                    $includeDocument = $this->loadDocument($includePath . '/' . $attributes['file'] . '.inc.xml');
                    $newDocument = array_merge($newDocument,$includeDocument);

                }
            }
            else
            {
                $newDocument[] = $element;
            }
        }

        return $newDocument;
    }
}

?>