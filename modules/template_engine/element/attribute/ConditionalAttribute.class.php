<?php


namespace template_engine\element\attribute;


use template_engine\element\attribute\SimpleAttribute;
use template_engine\element\Value;

/**
 * A conditional attribute is an attribute whose existence depends on a condition.
 * The condition would normally be an PHP expression.
*/
class ConditionalAttribute extends SimpleAttribute
{
/** The condition must be an valid PHP expression.
    */
	protected $condition;

	/**
	 * ConditionalAttribute constructor.
	 * @param $condition must be a valid PHP expression
	 * @param $name name of attribute
	 * @param $value value
	 */
	public function __construct($condition,$name,$value)
	{
		$this->condition = $condition;
		parent::__construct($name,$value);
	}


    /**
    * Rendering of the value.
    * the value is wrapped into the conditional PHP expression.
    */
	public function render()
	{
		return '<?php if('.$this->condition.'){ ?>'.parent::render().'<?php } ?>';
	}
}