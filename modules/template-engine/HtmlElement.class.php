<?php


namespace modules\template_engine;


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

	public function getBegin()
	{
		$this->addAttribute('class', implode(' ',$this->styleClasses) );
		return parent::getBegin();
	}


	public function __construct( $name )
	{
		parent::__construct( $name );
	}


	protected function getContent()
	{
		$context = $this->escape ? Value::CONTEXT_HTML : Value::CONTEXT_RAW;

		return (new Value(parent::getContent()))->render( $context );
	}


}