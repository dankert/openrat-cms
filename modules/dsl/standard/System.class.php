<?php

namespace dsl\standard;

use dsl\context\BaseScriptableObject;

class System extends BaseScriptableObject
{
	/**
	 * runtime
	 * @var StandardString
	 */
	public $version;

	/**
	 * Operating system
	 * @var StandardString
	 */
	public $os;

	public function __construct()
	{
		$this->version = PHP_VERSION;
		$this->os      = PHP_OS;
	}

	/**
	 * @param $name
	 * @return array|false|StandardString
	 */
	public function env( $name ) {

		return getenv('SCRIPTBOX_'.$name);
	}
}