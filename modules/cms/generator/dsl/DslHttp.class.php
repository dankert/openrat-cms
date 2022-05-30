<?php

namespace cms\generator\dsl;

use dsl\context\DslObject;
use util\Http;
use util\json\JSON;

class DslHttp implements DslObject
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