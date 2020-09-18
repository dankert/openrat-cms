<?php

namespace util;

class Url {

	public $scheme;
	public $host;
	public $port;
	public $user;
	public $pass;
	public $path;
	public $query;
	public $fragment;

	function __construct( $url = null ) {

		if   ( !empty($url) )
			$this->parseUrl($url);
	}


	public function parseUrl( $url ) {
		foreach ( parse_url($url) as $key=>$value )
			$this->$key = $value;
	}


	public function __toString()
	{
		$scheme   = !empty($this->scheme) ? $this->scheme . '://' : '';

		if   ( empty($scheme) )
			$scheme = 'file:/';

		$host     = !empty($this->host    ) ? $this->host : '';
		$port     = !empty($this->port    ) ? ':' . $this->port : '';
		$user     = !empty($this->user    ) ? $this->user : '';
		$pass     = !empty($this->pass    ) ? ':' . $this->pass  : '';
		$pass     = ($user || $pass)        ? "$pass@" : '';
		$path     = !empty($this->path    ) ? $this->path : '';
		$query    = !empty($this->query   ) ? '?' . $this->query    : '';
		$fragment = !empty($this->fragment) ? '#' . $this->fragment : '';

		return "$scheme$user$pass$host$port$path$query$fragment";
	}

}