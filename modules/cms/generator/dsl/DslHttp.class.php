<?php

namespace cms\generator\dsl;

use dsl\context\BaseScriptableObject;
use dsl\context\Scriptable;
use util\Http;
use util\json\JSON;

class DslHttp  extends BaseScriptableObject
{
	public function get( $url )
	{
		return $this->request('GET', $url );
	}

	public function post($url )
	{
		return $this->request('POST', $url );
	}

	private function request($method, $url ) {
		$http = new Http( $url );
		$http->method = $method;
		$http->request();
		return $http->body;
	}
}