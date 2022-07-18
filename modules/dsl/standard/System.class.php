<?php

namespace dsl\standard;

use dsl\context\BaseScriptableObject;

/**
 * System information.
 *
 * @package dsl\standard
 */
class System extends BaseScriptableObject
{
	/**
	 * runtime
	 * @var string
	 */
	public $version;

	/**
	 * Operating system
	 * @var string
	 */
	public $os;

	public function __construct()
	{
		$this->version = PHP_VERSION;
		$this->os      = PHP_OS;
	}

	/**
	 * @param $name
	 * @return array|false|string
	 */
	public function env( $name ) {

		return getenv( 'SCRIPTBOX_'.$name );
	}
}