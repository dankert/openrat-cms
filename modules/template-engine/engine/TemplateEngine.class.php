<?php


namespace template_engine;
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
	
	/**
	 * Name Template.
	 *
	 * @var String
	 */
	private $tplFileName;

	/**
	 * Erzeugt einen Templateparser.
	 *
	 * @param String $tplName Name des Templates, das umgewandelt werden soll.
	 */
	public function TemplateEngine( $tplFileName='' )
	{
		$this->tplFileName = $tplFileName;
	}

	/**
	 * Wandelt eine Vorlage um
	 * 
	 * @param
	 *        	filename Dateiname der Datei, die erstellt werden soll.
	 */
	public function compile($srcXmlFilename = '',$tplOutName = '')
	{
		require_once (dirname(__FILE__).'/../components/'.$this->renderType.'/Component.class.' . PHP_EXT);
		
		try
		{
			if (empty($srcFilename))
				$srcFilename = $this->tplFileName;
			
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
				throw new \LogicException("File is read-only: $filename");
			
			// Vorlage und Zieldatei oeffnen
			$document = $this->loadDocument($srcFilename);
			
			$outFile = @fopen($filename, 'w');
			
			if (! is_resource($outFile))
				throw new \LogicException("Template '$srcXmlFilename': Unable to open file for writing: '$filename'");
			
			$openCmd = array();
			$depth = 0;
			$components = array();
			
			foreach ($document as $line)
			{
				// Initialisieren der m�glichen Element-Inhalte
				$type = '';
				$attributes = array();
				$value = '';
				$tag = '';
				
				// Setzt: $tag, $attributes, $value, $type
				extract($line);
				
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
					
					foreach ($attributes as $prop => $value)
					{
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
					throw new \InvalidArgumentException("Template {$this->tplFileName} failed to compile: CHMOD '{$confCompiler['chmod']}' failed on file {$filename}.");
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
		$index = array();
		$vals  = array();
		$p = xml_parser_create();
		xml_parser_set_option ( $p, XML_OPTION_CASE_FOLDING,false );
		xml_parser_set_option ( $p, XML_OPTION_SKIP_WHITE,false );
		xml_parse_into_struct($p, implode('',file($filename)), $vals, $index);
		xml_parser_free($p);
		
		return $vals;
	}
}

?>