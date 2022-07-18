<?php
namespace dsl\standard;

use dsl\context\BaseScriptableObject;

class ArrayInstance extends BaseScriptableObject
{
	private $value;

	public $length = 0;

	/**
	 * StandardArray constructor.
	 * @param $value
	 */
	public function __construct($value=null)
	{
		$this->value = $value;
		if   ( $value )
			$this->length = sizeof( $this->value );
	}


	public function __toString()
	{
		return '['.implode(',',$this->value).']';
	}

	/**
	 * @return mixed
	 */
	protected function getValue()
	{
		return $this->value;
	}

	/**
	 * @return array|null
	 */
	public function getInternalValue()
	{
		return $this->value;
	}

	public function concat( $concat )
	{
		return new ArrayInstance( array_merge($this->value,(array)$concat));
	}
	public function fill( $value,$start,$count)
	{
		return array_fill( $value,$start,$count );
	}
	public function forEach( $func )
	{
		return array_walk( $this->value, $func );
	}
	public function includes( $search )
	{
		return array_search( $search, $this->value ) !== false;
	}
	public function indexOf( $search )
	{
		return array_search( $search, $this->value );
	}
	public function lastIndexOf( $search )
	{
		$found = array_keys( $this->value,$search );
		return end( $found );
	}
	public function isArray( $val )
	{
		return is_array( $val );
	}
	public function join( $split = ',' )
	{
			return implode( $split,$this->value );
	}
	public function keys()
	{
		return array_keys($this->value);
	}
	public function values() {
		return array_values($this->value);
	}
	public function pop()
	{
		return array_pop( $this->value );
	}
	public function push( $value )
	{
		return array_push( $this->value,$value );
	}
	public function reverse()
	{
		return array_reverse($this->value);
	}
	public function shift()
	{
		return array_shift( $this->value );
	}
	public function unshift($value)
	{
		return array_unshift( $this->value,$value );
	}
	public function slice($from,$end = null )
	{
		if   ( $end )
			return array_slice( $this->value,$from,$end-$from);
		else
			return array_slice( $this->value,$from);
	}
	public function sort()
	{
		return asort( $this->value );
	}
	public function get( $key )
	{
		return @$this->value[ $key ];
	}

}