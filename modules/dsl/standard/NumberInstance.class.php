<?php


namespace dsl\standard;


use dsl\context\BaseScriptableObject;

class NumberInstance extends BaseScriptableObject
{
	private $value;

	/**
	 * Number constructor.
	 * @param $value
	 */
	public function __construct($value=null)
	{
		$this->value = $value;
	}

	public function __toString()
	{
		return "" . $this->value;
	}


	public function toFixed( $digits )
	{
		return number_format($this->value,$digits);
	}

	public function toNumber() {
		return $this->value;
	}

}