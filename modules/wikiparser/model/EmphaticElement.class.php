<?php

namespace wikiparser\model;

use wikiparser\model\AbstractElement;

/**
 * @author $Author$
 * @version $Revision$
 * @package openrat.text
 */
class EmphaticElement extends AbstractElement
{
	function render($type)
	{
		switch ($type) {
			case 'html':
				return '<p>' . $this->value . '</p>';
			default:
				return $this->value;
		}
	}
}

?>