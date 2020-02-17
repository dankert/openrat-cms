<?php


namespace modules\template_engine;


use template_engine\components\Expression;

class CMSElement extends HtmlElement
{

	/*
	public function getAttribute($name)
	{
		$e = new Expression( parent::getAttribute($name) );
		return $e->getHTMLValue();
	}*/



	public function __construct( $name )
	{
		parent::__construct( $name );
	}

}