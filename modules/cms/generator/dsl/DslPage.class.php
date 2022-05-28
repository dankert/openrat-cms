<?php

namespace cms\generator\dsl;

use dsl\context\DslObject;

class DslPage implements DslObject
{
	private $page;

	/**
	 * DslPage constructor.
	 * @param $page
	 */
	public function __construct($page)
	{
		$this->page = $page;
	}


	public function execute( $text )
	{
		echo $text;
	}
}