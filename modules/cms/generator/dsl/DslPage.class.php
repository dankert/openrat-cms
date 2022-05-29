<?php

namespace cms\generator\dsl;

use cms\model\Page;
use dsl\context\DslObject;

class DslPage implements DslObject
{
	private $page;

	public $id;

	/**
	 * DslPage constructor.
	 * @param Page $page
	 */
	public function __construct($page)
	{
		$this->page = $page;

		$this->id = $page->getId();
	}

	/**
	 * @return array
	 * @throws \util\exception\ObjectNotFoundException
	 */
	public function elements() {
		return $this->page->getElementIds();
	}

}