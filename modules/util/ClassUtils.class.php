<?php

namespace util;
/**
 * Class ClassUtils
 * @author Jan Dankert
 */
class ClassUtils
{

	public static function getSimpleClassName($object): string
	{
		if (!is_object($object))
			return 'NotAnObject';

		return self::getSimple( get_class($object) );
	}

	public static function getSimple(string $classname): string
	{
		if ($pos = strrpos($classname, '\\'))
			return substr($classname, $pos + 1);
		else
			return $classname;
	}
}