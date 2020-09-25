<?php


namespace util\json;

require(__DIR__.'/../JSON.class.php');

/**
 * JSON Wrapper.
 */
class JSON
{
	public function encode($var) {
		$json = new \JSON();
		return $json->encode($var);
	}
	public function decode($var) {
		$json = new \JSON();
		return $json->decode($var);
	}
}