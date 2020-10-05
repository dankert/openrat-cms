<?php


namespace template_engine\element;


use template_engine\element\XMLFormatter;
use template_engine\element\attribute\SimpleAttribute;

class Element
{
	private $name;
	/**
	 * @var array
	 */
	protected $attributes = [];
	protected $content    = '';

	protected $selfClosing = false;

	/**
	 * @var array
	 */
	protected $children = [];


	/**
	 * @param $element Element
	 */
	public function asChildOf($element ) {
		$element->addChild($this);
		return $this;
	}

	public function addChild($child ) {

		if   ( is_array( $child ) )
			$this->children += $child;
		else
			$this->children[] = $child;

		return $this;
	}

	public function __construct( $name )
	{
		$this->name = $name;
	}

	protected function getAttributeValue($name ){
		return $this->attributes[$name]->render();
	}

	/**
	 * The textual content of the element.
	 *
	 * @param string $content
	 * @return $this
	 */
	public function content( $content )
	{
		$this->content = $content;
		return $this;
	}

	/**
	 * @param $format XMLFormatter
	 * @return string
	 */
	public function render($format ) {

		$this->selfClosing = $this->selfClosing && !$this->content && !$this->children;

		$content = $format->getIndentation();

		if   ( $this->name )
			$content .= '<'.$this->name.
				array_reduce( array_keys($this->attributes),function($carry,$key){return $carry.' '.$this->getAttributeValue($key);},'').(($this->selfClosing ?' /':'').'>');

		$content .= $this->getContent();

		$content .= $this->renderChildren( $format );

		if   ( $this->selfClosing )
			;
		else
			if   ( $this->name ) {
				$content .= $format->getIndentationOnClose();
				$content .= '</'.$this->name.'>';
			}

		return $content;
	}

	public function addAttribute($key, $value) {
		$this->attributes[] = new SimpleAttribute($key,$value);
		return $this;
	}

	public function selfClosing($selfClosing) {
		$this->selfClosing = boolval($selfClosing);
		return $this;
	}

	protected function getContent()
	{
		return $this->content;
	}

	/**
	 * @param $format XMLFormatter
	 * @return string
	 */
	protected function renderChildren($format )
	{
		$content = '';

		/** @var Element $child */
		foreach($this->children as $child ) {
			$content .= $child->render( $format->deeper() );
		}

		return $content;
	}
}


