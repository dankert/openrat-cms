<?php

namespace template_engine\components\html;

use cms\action\RequestParams;
use template_engine\element\Element;
use template_engine\engine\TemplateContext;

/**
 * Base class for all components.
 *
 * @package template_engine\components\html
 */
abstract class Component
{
	/**
	 * Contains child components.
	 * 
	 * @var array
	 */
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
     * @var TemplateContext
     */
    public $context;

	/**
	 * @var Element
	 */
    private $element;

	/**
	 * If a component is generating a tree of elements, then this element is the
	 * element, which is getting the elements, which sub-components are creating.
	 * Sublasses should set this element if necessary.
	 *
	 * @var Element
	 */
    protected $adoptiveElement;

    public function __construct()
	{
	}

	final public function getDepth()
	{
		return $this->depth;
	}

	final public function setDepth($depth)
	{
		$this->depth = $depth;
	}

	/**
	 * Every component must generate a single element or a tree of elements.
	 * Sublasses must overwrite this method.
	 *
	 * @return Element
	 */
	public abstract function createElement();

	final public function init()
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
	final public function getElement()
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
