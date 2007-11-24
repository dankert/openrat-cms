<?php

/**
 * @author $Author$
 * @version $Revision$
 * @package openrat.text
 */
class RawElement extends AbstractElement
{
	var $src = '';
	
	function RawElement( $t='' )
	{
		$this->src = $t;
	}
}

?>