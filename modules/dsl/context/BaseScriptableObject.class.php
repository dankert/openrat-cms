<?php


namespace dsl\context;

use dsl\standard\Helper;

class BaseScriptableObject implements Scriptable
{

	public function __toString()
	{
		return "Script object";
	}

	public function help()
	{
		return Helper::getHelp($this);
	}
}