<?php

namespace cms\generator\dsl;

use cms\base\Startup;
use dsl\context\DslObject;

class DslSystem implements DslObject
{
	/**
	 * application version
	 * @var string
	 */
	public  $version;

	/**
	 * application name
	 * @var string
	 */
	public  $name;
	/**
	 * build date
	 * @var null
	 */
	private $build;
	/**
	 * api version
	 * @var string
	 */
	private $api;
	/**
	 * runtime
	 * @var string
	 */
	private $runtime;
	/**
	 * Operating system
	 * @var string
	 */
	private $os;

	public function __construct()
	{
		$this->version = Startup::VERSION;
		$this->build  = Startup::DATE;
		$this->name = Startup::TITLE;
		$this->api = Startup::API_LEVEL;
		$this->runtime = PHP_VERSION;
		$this->os = PHP_OS;
	}

	public function now() { return new DslDate(); }
	public function env( $name ) { if   ( substr($name,0,8) == 'CMS_DSL_')   return getenv($name); else return null; }
}