<?php

abstract class Component
{

	private $depth;
	
	public function getDepth()
	{
		return $this->depth;
	}

	public function setDepth($depth)
	{
		$this->depth = $depth;
	}

	/**
	 * Gets the beginning of this component.
	 * @return string
	 */
	public function getBegin()
	{
		ob_start();
		$this->begin();
		$src = ob_get_contents();
		ob_end_clean();
		return $src;
	}

	public function getEnd()
	{
		ob_start();
		$this->end();
		$src = ob_get_contents();
		ob_end_clean();
		return $src;
	}

	/**
	 * Outputs the beginning of this component.
	 */
	protected function begin()
	{}

	protected function end()
	{}
	
	
	protected function varname($value)
	{
		$erg = $this->value($value);
		
		// Für statische Texte muss kein PHP-Abschnitt geoeffnet werden.
		if	(substr($erg,0,1) == "'" && strpos($erg,'$')===FALSE )
			return substr($erg,1,-1);
		else
			return $erg;
	}
	
	
	
	protected function htmlvalue($value)
	{
		$erg = $this->value($value);
		
		// Für statische Texte muss kein PHP-Abschnitt geoeffnet werden.
		if	(substr($erg,0,1) == "'" && strpos($erg,'$')===FALSE )
			return substr($erg,1,-1);
		else
			return '<'.'?php echo '.$erg.' ?>';
	}
	
	
	
	protected function value( $value )
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
	

	protected function include( $file ) 
	{
		echo "include_once( OR_THEMES_DIR.'default/include/html/date/".$file."');";
		
	}
	
}

?>