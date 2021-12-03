<?php


namespace util;


class ClassName
{
	protected $name;

	/**
	 * ClassName constructor.
	 * @param $className object|string
	 */
	public function __construct($className ) {

		if   ( is_object( $className ))
			$this->name = get_class( $className );
		else
			$this->name = $className;
	}

	/**
	 * get full class name.
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}


	public function dropNamespace()
	{
		if	( $pos = strrpos($this->name, '\\') )
			$this->name = substr($this->name, $pos + 1);

		return $this;
	}

	public function addNamespace( $namespace )
	{
		if   ( ! is_array( $namespace) )
			$namespace = [ $namespace ];
		$this->name = implode('\\',$namespace ) . '\\' . $this->name;

		return $this;
	}


	public function dropSuffix($suffix)
	{
		if   ( substr($this->name,-strlen($suffix),strlen($suffix)))
			$this->name = substr( $this->name,0,-(strlen($suffix)) );

		return $this;
	}


	public function get()
	{
		return $this->name;
	}


	public function getParent() {
		$this->name = get_parent_class( $this->name );

		return $this;
	}


	public function exists() {
		return $this->name !== FALSE && class_exists($this->name );
	}
}