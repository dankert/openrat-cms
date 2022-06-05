<?php

namespace cms\generator\dsl;

use cms\model\Page;
use dsl\context\DslObject as DslContextObject;

class DslPage extends DslObject implements DslContextObject
{
	private $page;

	/**
	 * DslPage constructor.
	 * @param Page $page
	 */
	public function __construct($page)
	{
		$this->page = $page;
		parent::__construct( $page );
	}

	/**
	 * @return array
	 * @throws \util\exception\ObjectNotFoundException
	 */
	public function elements() {
		return $this->page->getElementIds();
	}

}