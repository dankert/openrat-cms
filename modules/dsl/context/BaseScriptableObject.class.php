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
}