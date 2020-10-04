<?php

namespace template_engine\components\html;

use cms\action\RequestParams;
use template_engine\element\Element;

abstract class Component
{
	private $childComponents = [];
	private $depth;

	/**
	 * @param $component Component
	 */
	public function addChildComponent($component ) {
		if   ( $component )
			$this->childComponents[] = $component;
	}

    /**
     * @var RequestParams
     */
    public $request;

	/**
	 * @var Element
	 */
    private $element;

	/**
	 * @var Element
	 */
    protected $adoptiveElement;

    public function __construct()
	{
	}

	public function getDepth()
	{
		return $this->depth;
	}

	public function setDepth($depth)
	{
		$this->depth = $depth;
	}

	public function createElement() {
    	return null;
	}

	public function init()
	{
		$this->element = $this->createElement();

		// if there is no special adoptive element, lets use the root element.
		if   ( ! $this->adoptiveElement )
			$this->adoptiveElement = $this->element;
	}


	/**
	 * Gets the element with all child elements from all child components.
	 *
	 * @return Element
	 */
	public function getElement()
	{
		/** @var Component $childComponent */
		foreach ($this->childComponents as $childComponent )
			$this->adoptiveElement->addChild( $childComponent->getElement() );

		return $this->element;
	}



	/**
	 * Splits a text at the comma char and trims the parts.
	 *
	 * @param $text
	 * @return array
	 */
	public static function splitByComma($text)
	{
		$parts = explode(',',$text);
		return array_map( function($text) {
			return trim($text);
		},$parts);
	}


}
