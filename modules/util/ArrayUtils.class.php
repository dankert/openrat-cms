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


	/**
	 * Dives into an array and gets a value with a sub key.
	 * @param array $array
	 * @param array $keys
	 * @return mixed|null
	 */
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
	 * Maps an array to a new array.
	 * @param $callback callable callback, it is called with 3 parameters: the new array, key, value.
	 * @param $array array array which should be mapped
	 * @return array the new array
	 */
	public static function mapToNewArray($array, $callback) {
		$newArray = [];
		foreach( $array as $key => $value ) {
			$newArray += (array) call_user_func( $callback, $key, $value );
		}
		return $newArray;
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