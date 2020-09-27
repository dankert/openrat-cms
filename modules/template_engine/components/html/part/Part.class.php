<?php

namespace template_engine\components;

use template_engine\components\html\Component;
use template_engine\element\CMSElement;
use template_engine\element\HtmlElement;

class PartComponent extends Component
{
	public $class = '';
	public $id;
	public $tag = 'div';
	
	public function createElement()
	{
		$element = (new CMSElement($this->tag));

		foreach( explode(',',$this->class ) as $styleClass )
			$element->addStyleClass( $styleClass );
		
		if	( $this->id )
			$element->addAttribute('id',$this->id);
			
		return $element;
	}
	
}
