<?php


namespace cms\generator\filter;


use util\JSqueeze;

class JavascriptMinifierFilter extends AbstractFilter
{
	public $singleLine = true;
	public $keepImportantComments = true;
	public $specialVarRx = false;

	public function filter( $value )
	{
		$jz = new JSqueeze();
		return $jz->squeeze( $value, (bool)$this->singleLine, (bool)$this->keepImportantComments, (bool)$this->specialVarRx );
	}
}