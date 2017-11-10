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
	 * @param filename Dateiname der Datei, die erstellt werden soll.
	 */
	public function compile( $tplName = '')
	{
	    require_once( OR_THEMES_DIR."default/include/html/Component.class.".PHP_EXT );
	    
		try {
    		if	( empty($tplName) )
    			$tplName = $this->tplName;
    		
    		global $conf;
    		$confCompiler = $conf['theme']['compiler'];
    		
    		$srcXmlFilename = 'themes/default/templates/'.$tplName.'.tpl.src.xml';
    
    		
    		if ( is_file($srcXmlFilename) )
    			$srcFilename = $srcXmlFilename;
    		else
    			// Wenn Vorlage (noch) nicht existiert
    			throw new LogicException( "Template not found: $tplName" );
    
    		$filename = FileUtils::getTempDir().'/'.'or.cache.tpl.'.str_replace('/', '.',$tplName).'.tpl.'.PHP_EXT;
    		
    		// Wenn Vorlage gaendert wurde, dann Umwandlung erneut ausf�hren.		
    		if	( $confCompiler['cache'] && is_file($filename) && filemtime($srcFilename) <= filemtime($filename))
    			return;
    			
    		if	( is_file($filename) && !is_writable($filename) )
    			throw new LogicException("File is read-only: $filename");
    
    		Logger::debug("Compile template: ".$srcFilename.' to '.$filename);
    			
    		// Vorlage und Zieldatei oeffnen
    		$document = $this->loadDocument( $srcFilename );
    		
    		// Wir legen erstmal eine temporaere Datei an.
    		// Falls ein Fehler auftritt, ist nur die temporaere Datei defekt.
    		$tmpFilename = $filename.'.tmp';
    		$outFile = @fopen($tmpFilename,'w');
    
    		if	( !is_resource($outFile) )
    			throw new LogicException( "Template $tplName: Unable to open file for writing: $filename" );
    
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
    
    			if	($type == 'complete' || $type == 'open')
    				$attributes = $this->checkAttributes($tag,$attributes);
    				
    			if ( $type == 'open' )
    			    $this->copyFileContents( $tag, true, $tag.'/'.$tag.'-begin',$outFile,$attributes,++$depth );
    			elseif ( $type == 'complete' )
    			{
    			    $this->copyFileContents( $tag, true, $tag.'/'.$tag.'-begin',$outFile,$attributes,++$depth   );
    			    $this->copyFileContents( $tag, false, $tag.'/'.$tag.'-end'  ,$outFile,array()    ,  $depth-- );
    			}
    			elseif ( $type == 'close' )
    			     $this->copyFileContents( $tag, false, $tag.'/'.$tag.'-end'  ,$outFile,array(),$depth-- );
    		}
    
    		fclose($outFile);
    		
    		rename($tmpFilename,$filename);
    
    		// CHMOD ausfuehren.
    		if	( !empty($confCompiler['chmod']))
    			if	( !@chmod($filename,octdec($confCompiler['chmod'])) )
    			    throw new InvalidArgumentException( "Template {$this->tplName} failed to compile: CHMOD '{$confCompiler['chmod']}' failed on file {$filename}." );
    			
		}
		catch( Exception $e)
		{
		    throw new LogicException("Template $tplName failed to compile", 0, $e);
		}
	}
	
	

	private function attributeValueOpenPHP($value)
	{
		$erg = $this->attributeValue($value);
		
		// Für statische Texte muss kein PHP-Abschnitt geoeffnet werden.
		if	(substr($erg,0,1) == "'" && strpos($erg,'$')===FALSE ) 
			return substr($erg,1,-1);
		else
			return '<'.'?php echo '.$erg.' ?>';
	}
	
	
	
	private function attributeValue( $value )
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
			case 'function':
				return $invert.$value.'()';
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
				throw new LogicException("Unknown type '$type' in attribute. Allowed: var|function|method|text|size|property|message|messagevar|arrayvar|config or none");
		}
	}
	
	
	
	/**
	 * Eine Komponente wird in die neue Vorlagedatei kopiert.
	 */
	private function copyFileContents( $tag, $begin, $infile,$outFileHandler,$attr,$depth )
	{
		global $conf;
		$hash = $depth;
		
		$className     = ucfirst($tag);
		$classFilename = OR_THEMES_DIR.$conf['interface']['theme']."/include/html/$tag/$className.class.".PHP_EXT;
		
		if    ( is_file($classFilename))
		{
		    require_once( $classFilename);
		    
		    $className .= 'Component';
		    $component = new $className();
		    ob_start();
		    if    ( $begin )
		      $component->begin($attr);
		    else
		        $component->end();
		    
		    $src = ob_get_contents();
		    ob_end_clean();
		    fwrite( $outFileHandler,"\n<!-- Component $tag ".($begin?'beginn':'ennd')." -->\n".$src."\n<!-- End -->\n" );
		    
		    return;
		}
		else
		{
		    
    		$inFileName = OR_THEMES_DIR.$conf['interface']['theme'].'/include/html/'.$infile.'.inc.'.PHP_EXT;
    		if	( !is_file($inFileName) )
    			if	( count($attr)==0 )
    				return;
    			else
    				// Baustein nicht vorhanden, Abbbruch.
    				throw new LogicException("Compile failed, Component $infile not found." );
    
    		if	( DEVELOPMENT )
    			fwrite( $outFileHandler,"<!-- Compiling $infile @ ".date('r')." -->" );
    		
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
    			if  ( strpos($line,'#SET-LINEBREAK-ON')!==FALSE )
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
    			// Ignoriere Kommentarzeilen
    			if	( in_array(substr(rtrim($line),-3),array('-->',' */') ) )
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
		}
	}
	
	
	
	/**
	 * Diese Funktion pr�ft, ob die Attribute zu einem Element g�ltig sind.<br>
	 * Falls ein ung�ltiges Attribut oder ein ung�ltiger Wert entdeckt wird,
	 * so wird das Skript abgebrochen.
	 * @return �berpr�fte und mit Default-Werten angereicherte Attribute
	 */
	private function checkAttributes( $cmd,$attr )
	{
		global $conf;
		$elements = parse_ini_file( OR_THEMES_DIR.$conf['interface']['theme'].'/include/elements.ini.'.PHP_EXT);

		if	( !isset($elements[$cmd]) )
			throw new InvalidArgumentException("Parser error, unknown element $cmd. Allowed: "+implode(',',array_keys($elements)) );
			
		$checkedAttr = array();

		// Schleife �ber alle Attribute.		
		foreach( explode(',',$elements[$cmd]) as $al )
		{
			$al=trim($al);
			if	( $al=='')
				continue; // Leeres Attribut... nicht zu gebrauchen.
			
		    $rpos = strrpos($al,':');
		    if  ($rpos===FALSE)
		    {
		        $a = $al;
		        $default = null;
		    }
		    else
		    {
		        $a = substr($al,0,$rpos);
		        $default = substr($al,$rpos+1);
		    }
			if	( is_string($default))
				$default = str_replace('COMMA',',',$default); // Komma in Default-Werten ersetzen.

			if	( isset($attr[$a]))
				$checkedAttr[$a]=$attr[$a]; // Attribut ist bereits vorhanden, alles ok.
			elseif	( $default=='*') // Pflichtfeld!
				throw new InvalidArgumentException( "Template {$this->tplName} failed to compile: Element {$cmd} needs the required attribute {$a}" );
			elseif	( !is_null($default) )
					$checkedAttr[$a]=$default;
			else
				;

			unset( $attr[$a] ); // Damit am Ende das Ursprungsarray leer wird.
		}
	
		unset( $attr['xmlns'             ]);
		unset( $attr['xmlns:xsi'         ]);
		unset( $attr['xsi:schemaLocation']);
		
		if	( count($attr) > 0 )
		{
		    throw new InvalidArgumentException( "Template {$this->tplName} failed to compile: Unknown attributes '[".implode(',',array_keys($attr))."]' in element $cmd. Allowed attributes are: {$elements[$cmd]}"  );
		}
		
		return $checkedAttr;
			
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