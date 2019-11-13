<?php


namespace cms\publish\filter;


use Less_Parser;

class LessFilter extends AbstractFilter
{
	public $sourceMap = false;
	public $indentation = '  ';
	public $compress = false;
	public $variables = array();

	public function filter($value)
	{
		$parser = new Less_Parser(array(
			'sourceMap' => $this->sourceMap,
			'indentation' => $this->indentation,
			'outputSourceFiles' => false,
			'compress' => (bool) $this->compress,
		));

		$parser->parse($value);

		$parser->modifyVars( (array) $this->variables );

		return $parser->getCss();
	}
}