<?php
#
#  DaCMS Content Management System
#  Copyright (C) 2002 Jan Dankert, jandankert@jandankert.de
#
#  This program is free software; you can redistribute it and/or
#  modify it under the terms of the GNU General Public License
#  as published by the Free Software Foundation; either version 2
#  of the License, or (at your option) any later version.
#
#  This program is distributed in the hope that it will be useful,
#  but WITHOUT ANY WARRANTY; without even the implied warranty of
#  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#  GNU General Public License for more details.
#
#  You should have received a copy of the GNU General Public License
#  along with this program; if not, write to the Free Software
#  Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
#

/**
 * Wandelt eine Vorlage in ein PHP-Skript um.
 * 
 * Die Vorlage wird gesparst, Elemente werden geladen und in die Zieldatei kopiert.
 * 
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class TemplateEngine
{
	/**
	 * Wandelt eine Vorlage um
	 * @param filename Dateiname der Datei, die erstellt werden soll.
	 */
	function compile( $tplName )
	{
		global $conf;
		$srcOrmlFilename = 'themes/default/templates/'.$tplName.'.tpl.src.'.PHP_EXT;
		$srcXmlFilename = 'themes/default/templates/'.$tplName.'.tpl.src.xml';
		
		if	( is_file($srcOrmlFilename) )
			$srcFilename = $srcOrmlFilename;
		elseif ( is_file($srcXmlFilename) )
			$srcFilename = $srcXmlFilename;
		else
			// Wenn Vorlage (noch) nicht existiert
			die( 'Template not found: '.$tplName );
					
		$filename = 'themes/default/pages/html/'.$tplName.'.tpl.'.PHP_EXT;
		
		// Wenn Vorlage gaendert wurde, dann Umwandlung erneut ausführen.		
		if	( $conf['theme']['compiler']['cache'] && is_file($filename) && filemtime($srcFilename) <= filemtime($filename))
			return;
			
		if	( is_file($filename) && !is_writable($filename) )
			die( 'could not open file for writing: '.$filename);

		Logger::debug("Compile template: ".$srcFilename.' to '.$filename);
			
		// Vorlage und Zieldatei oeffnen
		$document = $this->loadDocument( $srcFilename );
		$outFile = fopen($filename,'w');

		if	( !is_resource($outFile) )
			die( 'could not open file for writing: '.$filename);

		$raw     = false;
		$openCmd = array();
		$depth   = 0;
		
		foreach( $document as $line )
		{
			// Initialisieren der möglichen Element-Inhalte
			$type       = '';
			$attributes = array();
			$value      = '';
			$tag        = '';


			// Setzt: $tag, $attributes, $value, $type
			extract( $line );
			
			if	($type == 'complete' || $type == 'open')
				$attributes = $this->checkAttributes($tag,$attributes);
				
			if	( $tag == 'raw' )
				fwrite( $outFile,$value."\n");
			elseif ( $type == 'open' )
				$this->copyFileContents( $tag,$outFile,$attributes,++$depth );
			elseif ( $type == 'complete' )
			{
				$this->copyFileContents( $tag       ,$outFile,$attributes,$depth+1 );
				$this->copyFileContents( $tag.'-end',$outFile,array()    ,$depth+1 );
			}
			elseif ( $type == 'close' )
				$this->copyFileContents( $tag.'-end',$outFile,array(),--$depth );
		}

		fclose($outFile);
	}
	
	

	function getElementValue( $elFilename,$attributes )
	{
		extract($attributes);
		require($elFilename);
		return $value;
	}
	
	
	
	function attributeValue( $value )
	{
		$parts = explode( ':', $value, 2 );
		if	( count($parts) == 2 )
		{
			list( $type,$value ) = $parts;
			switch( $type )
			{
				case 'var':
					return '$'.$value;
				case '':
					return "'".$value."'";
				case 'method':
					return '$this->'.$value.'()';
				case 'property':
					return '$this->'.$value;
				case 'message':
					return 'lang('."'".$value."'".')';
				case 'config':
					$config_parts = explode('/',$value);
					return '$conf['."'".implode("'".']'.'['."'",$config_parts)."'".']';
					
				default:
					die('unknown type in attribute value: '.$type);
			}
		}
		else
		{
			return "'".$value."'";
		}
	}
	
	
	
	/**
	 * Ein Baustein wird in die neue Vorlagedatei kopiert. 
	 */
	function copyFileContents( $infile,$outFileHandler,$attr,$depth )
	{
		//		$hash = crc32($depth);
		$hash = $depth;
		global $conf;
//		Logger::debug("Inserting template command: ".$infile);
		$inFileName = OR_THEMES_DIR.$conf['interface']['theme'].'/include/html/'.$infile.'.inc.'.PHP_EXT;
		$elFileName = OR_THEMES_DIR.$conf['interface']['theme'].'/include/html/'.$infile.'.el.' .PHP_EXT;
		if	( !is_file($inFileName) )
			if	( count($attr)==0 )
				return;
			else
				// Baustein nicht vorhanden, Abbbruch.
				die( 'compile failed, file not found: '.$inFileName );

		$values = array();
		foreach( $attr as $attrName=>$attrValue )
		{
			$values[] = "'".$attrName."'=>".$this->attributeValue($attrValue);
		}
//		fwrite( $outFileHandler,'<?php /* source: '.$inFileName.' - compile time: '.date('r').' */ ?'.'>');
		fwrite( $outFileHandler,'<?php $attr'.$hash.' = array('.implode(',',$values).') ?>');
		
		foreach( $attr as $attrName=>$attrValue )
			
			fwrite( $outFileHandler,'<?php $attr'.$hash.'_'.$attrName."=".$this->attributeValue($attrValue)." ?>");
//		foreach( $attr as $attrName=>$attrValue )
//			fwrite( $outFileHandler,'<?php $'.$attrName."='".$attrValue."' ? >");

		$file = file( $inFileName );
		foreach( $file as $line )
		{
//			echo $attr.$hash;
			$line = str_replace('$attr','$attr'.$hash,$line);
//			echo '<pre>';
//			echo htmlentities($line);
//			echo '</pre>';
			//fwrite( $outFileHandler,rtrim($line)."\n" );
			fwrite( $outFileHandler,$line );
		}
		fwrite( $outFileHandler,'<?php unset($attr'.$hash.') ?>');
		foreach( $attr as $attrName=>$attrValue )
			fwrite( $outFileHandler,'<?php unset($attr'.$hash.'_'.$attrName.') ?>');
//		foreach( $attr as $attrName=>$attrValue )
//			fwrite( $outFileHandler,'<?php unset($'.$attrName.') ? >');

		if	( is_file($elFileName) )
		{
			fwrite( $outFileHandler, $this->getElementValue( $elFileName,$attr) );
		}
	}
	
	
	
	/**
	 * Diese Funktion prüft, ob die Attribute zu einem Element gültig sind.<br>
	 * Falls ein ungültiges Attribut oder ein ungültiger Wert entdeckt wird,
	 * so wird das Skript abgebrochen.
	 * @return Überprüfte und mit Default-Werten angereicherte Attribute
	 */
	function checkAttributes( $cmd,$attr )
	{
		global $conf;
		$elements = parse_ini_file( OR_THEMES_DIR.$conf['interface']['theme'].'/include/elements.ini.'.PHP_EXT);

		if	( !isset($elements[$cmd]) )
			die( 'parser error: unknown element: '.$cmd );
			
		$checkedAttr = array();
		
		foreach( explode(',',$elements[$cmd]) as $al )
		{
			$al=trim($al);
			if	( $al=='')
				continue;
				
			list($a,$default) = explode(':',$al,2) + array('','');
			$default = str_replace('COMMA',',',$default); // Komma in Default-Werten ersetzen.
			if	( isset($attr[$a]))
				$checkedAttr[$a]=$attr[$a];
			else
				if	( $default=='*')
					die( 'required attribute not found, element= '.$cmd.', attribute='.$a );
				else
					if	( !empty($default) )
						$checkedAttr[$a]=$default;
			unset( $attr[$a] );
			
			// Sonderfälle für die Attributwerte "true" und "false".
			// Hinweis: Die Zeichenkette "false" entspricht in PHP true.
			// Siehe http://de.php.net/manual/de/language.types.boolean.php
			if	( isset($checkedAttr[$a]))
			{
				if	( $checkedAttr[$a] == 'true')
					$checkedAttr[$a] = true;
				elseif	( $checkedAttr[$a] == 'false')
					$checkedAttr[$a] = false;
			}
		}
		
		if	( count($attr) > 0 )
		{
			foreach($attr as $name=>$value)
				die( 'unknown attribute, element= '.$cmd.', attribute='.$name.', known attributes='.$elements[$cmd] );
		}
		
		return $checkedAttr;
			
	}
	
	
	/**
	 * Diese Funktion lädt die passende Vorlagedatei.
	 */
	function loadDocument( $filename )
	{
		if	( substr($filename,-4)=='.xml')
			return $this->loadXmlDocument( $filename );
		else
			return $this->loadOrmlDocument( $filename );
	}


	/**
	 * Laden und Parsen eines XML-Dokumentes.
	 */
	function loadXmlDocument( $filename )
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


	/**
	 * Laden und Parsen eines Dokumentes im Openrat-eigenem Format.<br>
	 * ("ORML"=Openrat Meta Language)
	 */
	function loadOrmlDocument( $filename )
	{
		$vals  = array();

		$raw     = false;
		$openCmd = array();
		
		foreach( file($filename) as $line )
		{
			$indent = strlen($line)-strlen(ltrim($line));  // Einzugstiefe
			$line   = trim($line);                         // Inhalt der Zeile ohne Einzug

			if	( empty($line) )  // Leerzeilen in Vorlage
			{
				continue;
			}
			
			// Im RAW-Modus wird die Vorlage einfach unbesehen kopiert.
			if	( $line == 'RAW' )
			{
				$raw = true;
				continue;
			} 
			if	( $line == 'END' )
			{
				$raw = false;
				continue;
			}
			
			// Kommentarzeilen
			if	( !$raw)
				if	( substr($line,0,1)=='#' || substr($line,0,2)=='//')
					continue;
					
			if	( $raw)
			{
				$vals[] = array( 'tag'=>'raw',
				                 'type'=>'close',
				                 'value'=>$line,
				                 'attributes'=>array(),
				                 'level'=>$indent ); 
				continue;
			}


			$openCmdCopy = $openCmd;
			krsort($openCmdCopy);
			foreach($openCmdCopy as $idx=>$ccmd)
			{
				if	( $idx >= $indent )
				{
					$vals[] = array( 'tag'=>$ccmd,
					                 'type'=>'close',
					                 'value'=>'',
					                 'attributes'=>array(),
					                 'level'=>$indent ); 
					unset($openCmd[$idx]);
				}
			}

			// Zeile parsen
			$li = explode(' ',$line);
			$attr = array();
			foreach( $li as $nr=>$part )
			{
				if	($nr==0)
					$cmd = $part;
				else
				{
					$el = explode(':',$part,2);
					if	( count($el) < 2 )
						die( 'parser error in line: '.$line );
						
					list($a,$b) = $el;
					$attr[$a]=$b;
				}
				
			}
			// $cmd  => enthaelt das Kommando
			// $attr => enthaelt die Attribute
			
			$openCmd[$indent]=$cmd;

			$vals[] = array( 'tag'=>$cmd,
			                 'type'=>'open',
			                 'value'=>'',
			                 'attributes'=>$attr,
			                 'level'=>$indent ); 
		}

		// Am Ende der Datei alle offenen Tags schließen
		$openCmdCopy = $openCmd;
		krsort($openCmdCopy);
		foreach($openCmdCopy as $idx=>$ccmd)
		{
			$vals[] = array( 'tag'=>$ccmd,
			                 'type'=>'close',
			                 'value'=>'',
			                 'attributes'=>array(),
			                 'level'=>$indent ); 
			
			unset($openCmd[$idx]);
		}

		
		return $vals;
	}
}

?>