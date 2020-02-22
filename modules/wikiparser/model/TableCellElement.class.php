<?php

namespace wikiparser\model;

use wikiparser\model\AbstractElement;

/**
 * @author $Author$
 * @version $Revision$
 * @package openrat.text
 */
class TableCellElement extends AbstractElement
{
	var $rowSpan = 1;
	var $colSpan = 1;
	var $isHeading = false;
}

?>