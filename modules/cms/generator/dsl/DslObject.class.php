<?php

namespace cms\generator\dsl;

use cms\model\BaseObject;
use cms\model\Folder;
use cms\model\Page;
use dsl\context\BaseScriptableObject;

class DslObject extends BaseScriptableObject
{
	private $object;

	public $id;
	public $type;
	public $name;

	/**
	 * DslPage constructor.
	 * @param BaseObject $object
	 */
	public function __construct($object)
	{
		$this->object = $object;

		$this->id   = $object->getId();
		$this->type = $object->getType();
		$this->name = $this->getDefaultName();
	}


	public function getTypeName() {

		return $this->object->getType();
	}

	public function filename() {

		return $this->object->filename();
	}

	public function getNameForLanguage( $languageid ) {

		return $this->object->getNameForLanguage( $languageid )->getProperties();
	}

	public function getDefaultName() {

		return $this->object->getDefaultName()->getName();
	}

	public function parent() {

		if   ( $this->object->parentid == null )
			return null;

		return new DslObject( new Folder( $this->object->parentid ) );
	}


	public function children() {
		if   ( $this->object->isFolder )
		{
			$folder = new Folder( $this->object->objectid );

			return array_map( function($child) {
				return new DslObject($child);
			},
				$folder->getObjects());
		} else {
			return [];
		}
	}



	/**
	 * @return DslTemplate
	 * @throws \util\exception\ObjectNotFoundException
	 */
	public function getTemplate() {
		if   ( $this->object->isPage )
		{
			$page = new Page( $this->object->objectid );
			return new DslTemplate( $page->getTemplate() );
		} else {
			return null;
		}
	}


	public function __toString()
	{
		return "Object:".$this->id;
	}



	public function getValue( $elementName ) {
		// TODO
		return ;
	}



	/**
	 * @return array
	 * @throws \util\exception\ObjectNotFoundException
	 */
	public function elements() {
		if   ( $this->object->isPage )
		{
			$page = new Page( $this->object->objectid );
			return $page->getElementIds();
		} else {
			return null;
		}
	}

}