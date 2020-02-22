<?php


namespace template_engine\element\attribute;


use template_engine\element\attribute\SimpleAttribute;
use template_engine\element\Value;

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
		return '<?php if('.$this->condition.'){ ?>'.parent::render().'<?php } ?>';
	}
}