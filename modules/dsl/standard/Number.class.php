<?php


namespace dsl\standard;


use dsl\context\BaseScriptableObject;

class Number extends BaseScriptableObject
{
	private $value;

	public $MAX_SAFE_INTEGER = PHP_INT_MAX;
	public $MIN_SAFE_INTEGER = PHP_INT_MIN;

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


	public function __invoke( $value )
	{
		return new Number( $value );
	}

	public function parseFloat( $num )
	{
		return floatval($num );
	}

	public function parseInt( $num )
	{
		return intval($num);
	}

	public function toFixed( $digits )
	{
		return number_format($this->value,$digits);
	}

	public function valueOf( $val )
	{
		return new Number( $val );
	}

	public function toNumber() {
		return $this->value;
	}

}