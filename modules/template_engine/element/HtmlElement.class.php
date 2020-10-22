<?php


namespace template_engine\element;


use template_engine\AppInfo;
use template_engine\components\html\Component;

class HtmlElement extends Element
{
	/**
	 * HTML "void elements", these are self-closable.
	 * see HTML5 spec https://html.spec.whatwg.org/multipage/syntax.html#void-elements
	 * @var string[]
	 */
	private static $VOID_ELEMENTS = ['area','base','br','col','embed','hr','img','input','link','meta','param','source','track','wbr'];

	private $styleClasses = [];

	/**
	 * Auto-escaping the content.
	 *
	 * @var bool
	 */
	private $escape = true;


	/**
	 * Add one or more style classes to the element.
	 * @param string|array $classes
	 * @return $this
	 */
	public function addStyleClass( $classes ) {

		if   ( ! is_array($classes) )
			$classes = Component::splitByComma($classes);

		$classes = array_map( function($styleClass){
			return AppInfo::$styleClassPrefix.$styleClass;
		},$classes);

		$this->styleClasses = array_merge( $this->styleClasses, $classes );
		return $this;
	}


	public function setEscaping( $escape ) {
		$this->escape = $escape;
		return $this;
	}


	public function getAttributeValue($name)
	{
		return parent::getAttributeValue(htmlspecialchars($name));
	}


	public function __construct( $name )
	{
		parent::__construct( $name );

		// Only "void elements" are self-closable
		if   ( in_array($name,HtmlElement::$VOID_ELEMENTS))
			$this->selfClosing = true;
	}


	protected function getContent()
	{
		$context = $this->escape ? Value::CONTEXT_HTML : Value::CONTEXT_RAW;

		return (new Value(parent::getContent()))->render( $context );
	}


	public function render( $format )
	{
		if   ( $this->styleClasses )
			$this->addAttribute('class', implode(' ',$this->styleClasses) );

		return parent::render( $format );
	}

}