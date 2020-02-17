<?php

namespace template_engine\components;

use modules\template_engine\CMSElement;
use modules\template_engine\HtmlElement;

class PartComponent extends Component
{
	public $class = '';
	public $id;
	
	public function createElement()
	{
		$element = (new CMSElement('div'))->selfClosing(false);

		foreach( explode(',',$this->class ) as $styleClass )
			$element->addStyleClass( $styleClass );
		
		if	( $this->id )
			$element->addAttribute('id',$this->id);
			
		return $element;
	}
	
}
