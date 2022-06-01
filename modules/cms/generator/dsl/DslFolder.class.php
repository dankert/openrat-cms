<?php

namespace cms\generator\dsl;

use cms\model\Folder;
use dsl\context\DslObject as DslContextObject;


class DslFolder implements DslContextObject
{
	/**
	 * @var Folder
	 */
	private $folder;

	public $id;

	/**
	 * DslPage constructor.
	 * @param Folder $folder
	 */
	public function __construct($folder)
	{
		$this->folder = $folder;

		$this->id = $folder->getId();
	}

	public function children() {
		return array_map( function($object) {
			return new DslObject( $object );
		}, $this->folder->getObjects() );
	}
}