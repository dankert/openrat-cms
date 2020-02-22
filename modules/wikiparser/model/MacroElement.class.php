<?php

namespace wikiparser\model;

use wikiparser\model\AbstractElement;

/**
 * Darstellung eines Makros.
 *
 * Ein Makro hat einen Namen sowie n Attribute.
 *
 * @author Jan Dankert
 * @package openrat.text
 */
class MacroElement extends AbstractElement
{
	var $name;
	var $attributes = array();
}

?>