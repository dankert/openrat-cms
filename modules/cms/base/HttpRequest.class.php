<?php


namespace modules\cms\base;


class HttpRequest
{

	public static function isPost() {

		return $_SERVER['REQUEST_METHOD'] == 'POST';
	}

	public static function getToken() {
		return $_REQUEST['REQUEST_METHOD'] == 'POST';
	}
}