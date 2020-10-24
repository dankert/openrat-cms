<?php

namespace util;
/**
 * Created by PhpStorm.
 * User: dankert
 * Date: 22.12.18
 * Time: 21:36
 */
class ArrayUtils
{

	public static function getSubArray($array, $keys)
	{

		$a = $array;
		foreach ($keys as $k) {
			if (!isset($a[$k]))
				return array();

			if (!is_array($a[$k]))
				return array();

			$a = $a[$k];
		}

		return $a;
	}


	public static function getSubValue($array, $keys)
	{

		$a = $array;
		foreach ($keys as $k) {
			if (!isset($a[$k]))
				return null;

			$a = $a[$k];
		}

		return $a;
	}




	/**
	 * Make a dry flat array.
	 *
	 * @param $arr
	 * @param $padChar
	 * @param int $depth
	 * @return array
	 */
	public static function dryFlattenArray($arr, $padChar = '  ', $depth = 0)
	{
		$new = array();

		foreach ($arr as $key => $val) {
			if (is_array($val)) {
				$new[] = [
					'key'  => str_repeat($padChar, $depth).$key,
					'value'=> ''
				];
				$new = array_merge($new,self::dryFlattenArray($val, $padChar, $depth + 1));
			} else
				$new[] = [
					'key'  => str_repeat($padChar, $depth).$key,
					'value'=> $val
				];
		}
		return $new;
	}
}