<?php

namespace template_engine\components;

use cms\action\RequestParams;
use modules\template_engine\Element;

abstract class Component
{

	private $depth;

    /**
     * @var RequestParams
     */
    public $request;

	/**
	 * @var Element
	 */
    private $element;

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


	/**
	 * Gets the beginning of this component.
	 * @return string
	 */
	public function getBegin()
	{
		return $this->element->getBegin();
	}

	public function getEnd()
	{
		return $this->element->getEnd();
	}

	public function init()
	{
		$this->element = $this->createElement();

		if   ( $this->element)
			$this->element->selfClosing(false);
	}


	
}



?>