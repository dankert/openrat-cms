<?php


namespace template_engine\components;


use cms\template_engine\SimpleAttribute;
use modules\template_engine\Value;

class ConditionalAttribute extends SimpleAttribute
{
	protected $condition;

	/**
	 * ConditionalAttribute constructor.
	 * @param $condition
	 * @param $name
	 * @param $value
	 */
	public function __construct($condition,$name,$value)
	{
		$this->condition = $condition;
		parent::__construct($name,$value);
	}


	public function render()
	{
		return '<?php if('.(new Value($this->condition))->render(Value::CONTEXT_PHP).'){ ?>'.parent::render().'<?php } ?>';
	}
}