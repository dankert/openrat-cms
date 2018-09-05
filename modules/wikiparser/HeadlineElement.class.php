<?php

/**
 * @author $Author$
 * @version $Revision$
 * @package openrat.text
 */
class HeadlineElement extends AbstractElement
{
	var $level = 1;



	/**
	 * Konstruktor.
	 */
	function __construct( $level=1 )
	{
		$this->level = $level;
	}

	
	
	function getText()
	{
		$name = '';
		foreach( $this->children as $child )
		{
			if	( strtolower(get_class($child))=='textelement')
			{
				$name .= $child->text;
			}
		}

		return $name;
	}



	function getName()
	{
		$name = strtolower( $this->getText() );
		
//		return urlencode( $name );
		$gueltig = 'abcdefghijklmnopqrstuvwxyz0123456789.-_';
		$tmp = strtr($name, $gueltig, str_repeat('#', strlen($gueltig)));
		$name = str_replace('.','',strtr($name, $tmp, str_repeat('.', strlen($tmp))));

		return $name;
	}
}

?>