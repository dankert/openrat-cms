<?php

namespace template_engine\components\html\component_part;

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

		$element->addStyleClass( Component::splitByComma( $this->class ) );
		
		if	( $this->id )
			$element->addAttribute('id',$this->id);
			
		return $element;
	}
	
}
