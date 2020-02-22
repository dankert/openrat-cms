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


	public static function flattenArray($prefix, $arr, $split = '.')
	{
		$new = array();
		foreach ($arr as $key => $val) {
			if (is_array($val)) {
				$new[$prefix . $key] = '';

				$new += self::flattenArray($prefix . $key . $split, $val, $split);
			} else
				$new[$prefix . $key] = $val;
		}
		return $new;
	}


	/**
	 * Make a dry flat array.
	 *
	 * @param $arr
	 * @param int $depth
	 * @return array
	 */
	public static function indentedFlattenArray($arr, $padChar = '', $depth = 0)
	{
		$new = array();
		foreach ($arr as $key => $val) {
			if (is_array($val)) {

				$new[] = array('depth' => $depth, 'key' => $key, 'val' => '');
				$new += self::indentedFlattenArray($val, $padChar, $depth + 1);
			} else
				$new[] = array('depth' => $depth, 'key' => $key, 'val' => $val);
		}
		return $new;
	}


	/**
	 * Make a dry flat array.
	 *
	 * @param $arr
	 * @param $padChar
	 * @param int $depth
	 * @return array
	 */
	public static function dryFlattenArray($arr, $padChar = '', $depth = 0)
	{
		$new = array();
		foreach ($arr as $key => $val) {
			if (is_array($val)) {
				$new[str_repeat($padChar, $depth) . $key] = '';
				$new += self::dryFlattenArray($val, $padChar, $depth + 1);
			} else
				$new[str_repeat($padChar, $depth) . $key] = $val;
		}
		return $new;
	}
}