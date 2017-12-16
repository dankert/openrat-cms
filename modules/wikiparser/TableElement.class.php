<?php

/**
 * @author $Author$
 * @version $Revision$
 * @package openrat.text
 */
class TableElement extends AbstractElement
{
	function render( $type )
	{
		switch( $type )
		{
			case 'html':
				return '<p>'.$this->value.'</p>';
			default:
				return $this->value;
		}
	}
}

?>