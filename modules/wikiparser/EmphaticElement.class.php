<?php

/**
 * @author $Author$
 * @version $Revision$
 * @package openrat.text
 */
class EmphaticElement extends AbstractElement
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