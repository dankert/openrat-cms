<?php

namespace cms\generator\dsl;

use cms\base\Startup;
use dsl\context\BaseScriptableObject;

class DslCms  extends BaseScriptableObject
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
	public $build;
	/**
	 * api version
	 * @var string
	 */
	public $api;

	public function __construct()
	{
		$this->version = Startup::VERSION;
		$this->build  = Startup::DATE;
		$this->name = Startup::TITLE;
		$this->api = Startup::API_LEVEL;
	}


	/**
	 * @param $name
	 * @return array|false|string
	 */
	public function env( $name ) {

		return getenv('CMS_SCRIPT_'.$name);
	}
}