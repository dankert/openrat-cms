<?php


namespace dsl\context;

use dsl\standard\Helper;

class BaseScriptableObject implements Scriptable
{
	/**
	 * Standard String representation of a Scriptable Object.
	 * This object becomes "Stringable".
	 * This string may be used in userscripts, if the object is used as a string, maybe by mistake.
	 *
	 * This method may be overwritten by subclasses.
	 *
	 * @return string
	 */
	public function __toString()
	{
		return "Script object";
	}


	/**
	 * a useful help function which outputs all properties and methods of this objects.
	 *
	 * @return string a short info about this object
	 */
	public function help()
	{
		return Helper::getHelp($this);
	}


	public function getClass() {
		return get_class($this);
	}

	public function values() {
		return array_values(get_object_vars($this));
	}
	public function keys() {
		return array_keys(get_object_vars($this));
	}
}