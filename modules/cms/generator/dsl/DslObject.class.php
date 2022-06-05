<?php

namespace cms\generator\dsl;

use cms\model\BaseObject;
use cms\model\Folder;
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


	public function getTypeName() {

		return $this->object->getType();
	}

	public function getNameForLanguage( $languageid ) {

		return $this->object->getNameForLanguage( $languageid )->getProperties();
	}

	public function getDefaultName() {

		return $this->object->getDefaultName()->getProperties();
	}

	public function parent() {

		if   ( $this->object->parentid == null )
			return null;

		return new DslFolder( new Folder( $this->object->parentid ) );
	}

}