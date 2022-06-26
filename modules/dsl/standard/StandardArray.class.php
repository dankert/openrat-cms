<?php
namespace dsl\standard;

use dsl\context\BaseScriptableObject;

class StandardArray extends BaseScriptableObject
{
	public function of() {

		return func_get_args();
	}


	public function __toString()
	{
		return "Arrays:Object";
	}

	/**
	 * @return string
	 */
	public function help()
	{
		return Helper::getHelp($this);
	}
}