<?php

namespace cms\generator\dsl;

use cms\model\BaseObject;
use dsl\context\DslObject as DslContextObject;

class DslObject implements DslContextObject
{
	private $object;

	public $id;

	/**
	 * DslPage constructor.
	 * @param BaseObject $object
	 */
	public function __construct($object)
	{
		$this->object = $object;

		$this->id = $object->getId();
	}

}