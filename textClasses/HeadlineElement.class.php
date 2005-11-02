<?php

/**
 * @author $Author$
 * @version $Revision$
 * @package openrat.text
 */
class HeadlineElement extends AbstractElement
{
	/**
	 * Konstruktor.
	 */
	function HeadlineElement( $level=1 )
	{
		$this->level = $level;
	}
	
	var $level = 1;
}

?>