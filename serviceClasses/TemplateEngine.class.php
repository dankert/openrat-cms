<?php
#
#  OpenRat Content Management System
#  Copyright (C) 2002-2009 Jan Dankert, jandankert@jandankert.de
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
 * @author Jan Dankert
 * @package openrat.services
 */
class TemplateEngine
{
	var $actualTagName   = '';
	
	/**
	 * Name Template.
	 *
	 * @var String
	 */
	var $tplName;

	/**
	 * Erzeugt einen Templateparser.
	 *
	 * @param String $tplName Name des Templates, das umgewandelt werden soll.
	 */
	function TemplateEngine( $tplName='' )
	{
		$this->tplName = $tplName;
	}

	
	/**
	 * Wandelt eine Vorlage um
	 * @param filename Dateiname der Datei, die erstellt werden soll.
	 */
	function compile( $tplName = '')
	{
		if	( empty($tplName) )
			$tplName = $this->tplName;
		
		global $conf;
		$srcOrmlFilename = 'themes/default/templates/'.$tplName.'.tpl.src.'.PHP_EXT;
		$srcXmlFilename = 'themes/default/templates/'.$tplName.'.tpl.src.xml';
		
		if	( is_file($srcOrmlFilename) )
			$srcFilename = $srcOrmlFilename;
		elseif ( is_file($srcXmlFilename) )
			$srcFilename = $srcXmlFilename;
		else
			// Wenn Vorlage (noch) nicht existiert
			die( get_class($this).': Template not found: "'.$tplName.'"' );
					
		$filename = 'themes/default/pages/html/'.$tplName.'.tpl.'.PHP_EXT;
		
		// Wenn Vorlage gaendert wurde, dann Umwandlung erneut ausf�hren.		
		if	( $conf['theme']['compiler']['cache'] && is_file($filename) && filemtime($srcFilename) <= filemtime($filename))
			return;
			
		if	( is_file($filename) && !is_writable($filename) )
			die( get_class($this).': File is read-only: '.$filename);

		Logger::debug("Compile template: ".$srcFilename.' to '.$filename);
			
		// Vorlage und Zieldatei oeffnen
		$document = $this->loadDocument( $srcFilename );
		
		// Prüfen, ob Zielverzeichnis existiert, falls nicht: Anlegen.
		if	( ! is_dir(dirname($filename)) )
		{
			$rc = mkdir( dirname($filename) );
			if	( ! $rc )
				Http::serverError('Unable to create directory: '.dirname($filename));
		}
		
		$outFile = @fopen($filename,'w');

		if	( !is_resource($outFile) )
			Http::serverError( get_class($this).': Unable to open file for writing: '.$filename);

		$openCmd = array();
		$depth   = 0;
		
		foreach( $document as $line )
		{
			// Initialisieren der m�glichen Element-Inhalte
			$type       = '';
			$attributes = array();
			$value      = '';
			$tag        = '';


			// Setzt: $tag, $attributes, $value, $type
			extract( $line );

			$this->actualTagName   = $tag;
			
			if	($type == 'complete' || $type == 'open')
				$attributes = $this->checkAttributes($tag,$attributes);
				
			if ( $type == 'open' )
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

		// CHMOD ausf�hren.
		if	( !empty($conf['theme']['compiler']['chmod']))
			if	( !@chmod($filename,octdec($conf['theme']['compiler']['chmod'])) )
				die( "CHMOD failed on file ".$filename );
	}
	
	

	function getElementValue( $elFilename,$attributes )
	{
		extract($attributes);
		require($elFilename);
		return $value;
	}
	
	

	function attributeValueOpenPHP($value)
	{
		$erg = $this->attributeValue($value);
		
		return '<'.'?php echo '.$erg.' ?>';
		
		// TODO: F�r statische Texte muesste kein PHP-Abschnitt geoeffnet werden
		/*
		if	(substr($value,0,5) == 'text:' || strpos($value,':')===FALSE ) 
			return $erg;
		else
			return '<'.'?php '.$erg.' ?>';
		*/
	}
	
	
	
	function attributeValue( $value )
	{
		$parts = explode( ':', $value, 2 );

		if	( count($parts) < 2 )
		$parts = array('',$value);
		
		list( $type,$value ) = $parts;
		
		$invert = '';
		if	( substr($type,0,1)=='!' )
		{
			$type = substr($type,1);
			$invert = '! ';
		}
		
		switch( $type )
		{
			case 'var':
				return $invert.'$'.$value;
			case 'text':
			case '':
				// Sonderf�lle f�r die Attributwerte "true" und "false".
				// Hinweis: Die Zeichenkette "false" entspricht in PHP true.
				// Siehe http://de.php.net/manual/de/language.types.boolean.php
				if	( $value == 'true' || $value == 'false' )
					return $value;
				else
					// macht aus "text1{var}text2" => "text1".$var."text2"
					return "'".preg_replace('/{(\w+)\}/','\'.$\\1.\'',$value)."'";
			case 'method':
				return $invert.'$this->'.$value.'()';
			case 'size':
				return '@count($'.$value.')';
			case 'property':
				return $invert.'$this->'.$value;
			case 'message':
//				return 'lang('."'".$value."'".')';
					// macht aus "text1{var}text2" => "text1".$var."text2"
				return 'lang('."'".preg_replace('/{(\w+)\}/','\'.$\\1.\'',$value)."'".')';
			case 'messagevar':
				return 'lang($'.$value.')';
			case 'mode':
				return $invert.'$mode=="'.$value.'"';
			case 'arrayvar':
				list($arr,$key) = explode(':',$value.':none');
				return $invert.'@$'.$arr.'['.$key.']';
			case 'config':
				$config_parts = explode('/',$value);
				return $invert.'@$conf['."'".implode("'".']'.'['."'",$config_parts)."'".']';
				
			default:
				Http::serverError( get_class($this).': Unknown type "'.$type.'" in attribute. Allowed: var|method|property|message|messagevar|config or none');
			}
	}
	
	
	
	/**
	 * Ein Baustein wird in die neue Vorlagedatei kopiert. 
	 */
	function copyFileContents( $infile,$outFileHandler,$attr,$depth )
	{
		global $conf;
		$hash = $depth;
		
		$inFileName = OR_THEMES_DIR.$conf['interface']['theme'].'/include/html/'.$infile.'.inc.'.PHP_EXT;
		$elFileName = OR_THEMES_DIR.$conf['interface']['theme'].'/include/html/'.$infile.'.el.' .PHP_EXT;
		if	( !is_file($inFileName) )
			if	( count($attr)==0 )
				return;
			else
				// Baustein nicht vorhanden, Abbbruch.
				die( get_class($this).': Compile failed, file not found: '.$inFileName );

		$values = array();
		foreach( $attr as $attrName=>$attrValue )
		{
			$values[] = "'".$attrName."'=>".$this->attributeValue($attrValue);
		}
		
		// Variablen $attr_* setzen
		if	( count($attr) > 0 )
		{
			fwrite( $outFileHandler,'<?php ');
			foreach( $attr as $attrName=>$attrValue )
				fwrite( $outFileHandler,'$a'.$hash.'_'.$attrName."=".$this->attributeValue($attrValue).';');
			fwrite( $outFileHandler,' ?>');
		}
			
		$file   = file( $inFileName );
		$ignore = false;
		$linebreaks = true;
		
		foreach( $file as $line )
		{
			// Ignoriere Zeilen, die fuer ein nicht vorhandenes Attribut gelten.
			if  ( strpos($line,'#IF-ATTR')!==FALSE )
			{
				$found = false;
				foreach( $attr as $attrName=>$attrValue )
				{
					if  ( strpos($line,'#IF-ATTR '.$attrName.'#')!==FALSE )
						$found = true;
					if  ( strpos($line,'#IF-ATTR-VALUE '.$attrName.':'.$attrValue.'#')!==FALSE )
						$found = true;
				}
				if	( ! $found )
					$ignore = true;
			}
			// Nach einem IF-Block ertmal alles wieder anzeigen.
			if  ( strpos($line,'#END-IF')!==FALSE )
			{
				$ignore = false;
			}
			
			if  ( strpos($line,'#ELSE')!==FALSE )
			{
				$ignore = !$ignore;
			}

			// Zeilenumbr�che nicht setzen.
			if  ( strpos($line,'#SET-LINEBREAK-OFF')!==FALSE )
				$linebreaks = false;

			// Zeilenumbr�che setzen.
			if  ( strpos($line,'#SET-LINEBREAK-OFF')!==FALSE )
				$linebreaks = true;
				
			// Ignoriere Zeilen, die zu ignorieren sind (logisch).
			// Dies sind Blöcke, die nur fuer ein Attribut gueltig sind, welches
			// aber nicht gesetzt ist.
			if	( $ignore )
				continue;
			
			// Ignoriere Leerzeilen
			if	( strlen(trim($line)) == 0)
				continue;
			// Ignoriere Kommentarzeilen
			if	( in_array(substr(ltrim($line),0,2),array('//','/*','<!') ) || substr(ltrim($line),0,1) == '#')
				continue;

			if	( !$linebreaks )
				$line = rtrim($line);
				
			// Die Variablen "$attr_*" muessen pro Ebene eindeutig sein, daher wird an den
			// Variablennamen die Tiefe angehangen.
			$line = str_replace('$attr_','$a'.$hash.'_',$line);
			
			foreach( $attr as $attrName=>$attrValue )
				$line = str_replace('%'.$attrName.'%',$this->attributeValueOpenPHP($attrValue),$line);
			
			
			fwrite( $outFileHandler,$line );
		}
		
		// Variablen $attr_* entfernen.
		$unset_attr = array();
		foreach( $attr as $attrName=>$attrValue )
			$unset_attr[] = '$a'.$hash.'_'.$attrName;
			
		if	( count($unset_attr) > 0 )
			fwrite( $outFileHandler,'<?php unset('.implode(',',$unset_attr).') ?>');

		if	( is_file($elFileName) )
		{
			fwrite( $outFileHandler, $this->getElementValue( $elFileName,$attr) );
		}
	}
	
	
	
	/**
	 * Diese Funktion pr�ft, ob die Attribute zu einem Element g�ltig sind.<br>
	 * Falls ein ung�ltiges Attribut oder ein ung�ltiger Wert entdeckt wird,
	 * so wird das Skript abgebrochen.
	 * @return �berpr�fte und mit Default-Werten angereicherte Attribute
	 */
	function checkAttributes( $cmd,$attr )
	{
		global $conf;
		$elements = parse_ini_file( OR_THEMES_DIR.$conf['interface']['theme'].'/include/elements.ini.'.PHP_EXT);

		if	( !isset($elements[$cmd]) )
			Http::serverError( get_class($this).': Parser error, unknown element "'.$cmd.'". Allowed: '.implode(',',array_keys($elements)) );
			
		$checkedAttr = array();

		// Schleife �ber alle Attribute.		
		foreach( explode(',',$elements[$cmd]) as $al )
		{
			$al=trim($al);
			if	( $al=='')
				continue; // Leeres Attribut... nicht zu gebrauchen.
			
				
			$pair = explode(':',$al,2);
			if	( count($pair) == 1 ) $pair[] = null;
			list($a,$default) = $pair;
			
			if	( is_string($default))
				$default = str_replace('COMMA',',',$default); // Komma in Default-Werten ersetzen.

			if	( isset($attr[$a]))
				$checkedAttr[$a]=$attr[$a]; // Attribut ist bereits vorhanden, alles ok.
			elseif	( $default=='*') // Pflichtfeld!
				die( get_class($this).': Element "'.$cmd.'" needs the required attribute "'.$a.'"' );
			elseif	( !is_null($default) )
					$checkedAttr[$a]=$default;
			else
				;

			unset( $attr[$a] ); // Damit am Ende das Urprungsarray leer wird.
		}
		
		if	( count($attr) > 0 )
		{
			foreach($attr as $name=>$value)
				Http::serverError( get_class($this).': Unknown attribute "'.$name.'" in element "'.$cmd.'". Allowed: '.$elements[$cmd]."\n" );
		}
		
		return $checkedAttr;
			
	}
	
	
	/**
	 * Diese Funktion l�dt die passende Vorlagedatei.
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

		$openCmd = array();
		
		foreach( file($filename) as $line )
		{
			$indent = strlen($line)-strlen(ltrim($line));  // Einzugstiefe
			$line   = trim($line);                         // Inhalt der Zeile ohne Einzug

			if	( empty($line) )  // Leerzeilen in Vorlage
			{
				continue;
			}
			
			if	( substr($line,0,1)=='#' || substr($line,0,2)=='//')
				continue;
					
			$openCmdCopy = $openCmd;
			krsort($openCmdCopy);
			foreach($openCmdCopy as $idx=>$ccmd)
			{
				if	( $idx >= $indent )
				{
					$vals[] = array( 'tag'        =>$ccmd,
					                 'type'       =>'close',
					                 'value'      =>'',
					                 'attributes' => array(),
					                 'level'      => $indent ); 
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

		// Am Ende der Datei alle offenen Tags schlie�en
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