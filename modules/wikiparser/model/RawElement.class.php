<?php

namespace wikiparser\model;

use wikiparser\model\AbstractElement;

/**
 * @author $Author$
 * @version $Revision$
 * @package openrat.text
 */
class RawElement extends AbstractElement
{
	var $src = '';

	/**
	 * RawElement constructor.
	 * @param string $t
	 */
	function __construct($t = '')
	{
		$this->src = $t;
	}
}

?>