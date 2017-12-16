<?php

/**
 * @author $Author$
 * @version $Revision$
 * @package openrat.text
 */
class TextElement extends AbstractElement
{
	var $text = '';
	
	function TextElement( $t='' )
	{
		$this->text = $t;
		
		$this->parseStyleClass();
		$this->parseTitleText();
	}
	
	
	function parseStyleClass()
	{
		$char1 = substr($this->text,0,1);
		if	( $char1 == "(" )
		{
			$pos2 = strpos($this->text,")",2);
			if	( $pos2 !== false )
			{
				$this->style = substr($this->text,1,$pos2-1);
				$this->text  = substr($this->text,$pos2+1);

				// Wenn kein Doppelpunkt in den Styleangaben vorkommt, dann
				// handelt es sich um einen Klassennamen.				
				if	( strpos($this->style,':') === false )
				{
					$this->class = $this->style;
					$this->style = '';
				}
			}
		}
	}



	function parseTitleText()
	{
		$char1 = substr($this->text,0,1);
		if	( $char1 == "'" )
		{
			$pos2 = strpos($this->text,"'",2);
			if	( $pos2 !== false )
			{
				$this->title = substr($this->text,1,$pos2-1);
				$this->text  = substr($this->text,$pos2+1);
			}
		}
	}

	
}

?>