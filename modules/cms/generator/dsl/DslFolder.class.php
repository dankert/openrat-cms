<?php

namespace cms\generator\dsl;

use cms\model\Folder;
use dsl\context\DslObject as DslContextObject;


class DslFolder extends DslObject implements DslContextObject
{
	/**
	 * @var Folder
	 */
	private $folder;

	/**
	 * DslPage constructor.
	 * @param Folder $folder
	 */
	public function __construct($folder)
	{
		$this->folder = $folder;

		parent::__construct( $folder );
	}

	public function children() {
		return array_map( function($object) {
			return new DslObject( $object );
		}, $this->folder->getObjects() );
	}
}