<?php


namespace template_engine\element;


class XMLFormatter
{
	private $depth;
	private $indent;

	/**
	 * XMLFormatter constructor.
	 * @param $indent
	 */
	public function __construct($indent)
	{
		$this->depth = 0;
		$this->indent = $indent;
	}


	public function deeper() {
		$deeper = clone $this;
		$deeper->depth+=1;
		return $deeper;
	}

	public function getIndentation() {
		if   ( $this->depth && $this->indent )
			return "\n".str_repeat($this->indent,$this->depth );
		else
			return '';
	}

	public function getIndentationOnClose() {
		if   ( $this->indent )
			return "\n".str_repeat($this->indent,$this->depth );
		else
			return '';
	}
}