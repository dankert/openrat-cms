<?php


namespace template_engine\element;


class HtmlElement extends Element
{
	private $styleClasses = [];

	/**
	 * Auto-escaping the content.
	 *
	 * @var bool
	 */
	private $escape = true;


	public function addStyleClass( $clazz ) {
		$this->styleClasses[] = $clazz;
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

		// Only "void elements" are self-closable, see
		// https://html.spec.whatwg.org/multipage/syntax.html#void-elements
		if   ( in_array($name,['area','base','br','col','embed','hr','img','input','link','meta','param','source','track','wbr']))
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