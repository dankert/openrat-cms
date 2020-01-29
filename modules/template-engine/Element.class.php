<?php


namespace modules\template_engine;


class Element
{
	private $name;
	private $attributes = [];
	private $content    = '';
	private $selfClosing    = true;

	public function __construct( $name )
	{
		$this->name = $name;
	}

	public function content( $content )
	{
		$this->content = $content;
		return $this;
	}

	public function getBegin() {

		return '<'.$this->name.array_reduce( array_keys($this->attributes),function($carry,$key){return $carry.' '.$key.'="'.htmlspecialchars($this->attributes[$key]).'"';},'').(($this->selfClosing && !$this->content)?' /':'').'>'.$this->content;
	}


	public function getEnd() {
		if   ( $this->selfClosing && !$this->content)
			return '';
		else
			return '</'.$this->name.'>';
	}

	public function attr($key,$value) {
		$this->attributes[$key] = $value;
		return $this;
	}

	public function selfClosing($selfClosing) {
		$this->selfClosing = boolval($selfClosing);
		return $this;
	}
}