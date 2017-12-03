<?php
// OpenRat Content Management System
// Copyright (C) 2002-2009 Jan Dankert, jandankert@jandankert.de
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.

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
	 * Name Template.
	 *
	 * @var String
	 */
	private $tplName;

	/**
	 * Erzeugt einen Templateparser.
	 *
	 * @param String $tplName Name des Templates, das umgewandelt werden soll.
	 */
	public function TemplateEngine( $tplName='' )
	{
		$this->tplName = $tplName;
	}

	/**
	 * Wandelt eine Vorlage um
	 * 
	 * @param
	 *        	filename Dateiname der Datei, die erstellt werden soll.
	 */
	public function compile($tplName = '')
	{
		require_once (OR_THEMES_DIR . "default/include/html/Component.class." . PHP_EXT);
		
		try
		{
			if (empty($tplName))
				$tplName = $this->tplName;
			
			global $conf;
			$confCompiler = $conf['theme']['compiler'];
			
			$srcXmlFilename = 'themes/default/templates/' . $tplName . '.tpl.src.xml';
			
			if (is_file($srcXmlFilename))
				$srcFilename = $srcXmlFilename;
			else
				// Wenn Vorlage (noch) nicht existiert
				throw new LogicException("Template not found: $tplName");
			
			$filename = 'themes/default/templates/' . $tplName . '.tpl.out.'. PHP_EXT;
			
			// Wenn Vorlage gaendert wurde, dann Umwandlung erneut ausf�hren.
			if (false && is_file($filename) && filemtime($srcFilename) <= filemtime($filename))
				return;
			
			if (is_file($filename) && ! is_writable($filename))
				throw new LogicException("File is read-only: $filename");
			
			Logger::debug("Compile template: " . $srcFilename . ' to ' . $filename);
			
			// Vorlage und Zieldatei oeffnen
			$document = $this->loadDocument($srcFilename);
			
			$outFile = @fopen($filename, 'w');
			
			if (! is_resource($outFile))
				throw new LogicException("Template $tplName: Unable to open file for writing: $filename");
			
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
					$classFilename = OR_THEMES_DIR . $conf['interface']['theme'] . "/include/html/$tag/$className.class." . PHP_EXT;
					
					if (!is_file($classFilename))
						throw new LogicException("Component Class File '$classFilename' does not exist." );

					require_once ($classFilename);
					
					$className .= 'Component';
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
					throw new InvalidArgumentException("Template {$this->tplName} failed to compile: CHMOD '{$confCompiler['chmod']}' failed on file {$filename}.");
		}
		catch (Exception $e)
		{
			throw new LogicException("Template $tplName failed to compile", 0, $e);
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