<?php

namespace util;
/**
 * Class ClassUtils
 * @author Jan Dankert
 */
class ClassUtils
{

	public static function getSimpleClassName($object)
	{
		if (!is_object($object))
			return 'NotAnObject';

		$classname = get_class($object);
		if ($pos = strrpos($classname, '\\')) return substr($classname, $pos + 1);
		return $pos;
	}
}