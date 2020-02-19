<?php


namespace cms\template_engine;


use modules\template_engine\Value;

class SimpleAttribute
{

	protected $name;
	protected $value;

	/**
	 * SimpleAttribute constructor.
	 * @param $name
	 * @param $value
	 */
	public function __construct($name, $value)
	{
		$this->name = $name;
		$this->value = $value;
	}


	public function render() {
		return $this->name.'="'.(new Value($this->value))->render(Value::CONTEXT_HTML).'"';
	}
}