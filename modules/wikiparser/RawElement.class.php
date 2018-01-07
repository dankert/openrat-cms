<?php

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
    function __construct($t='' )
	{
		$this->src = $t;
	}
}

?>