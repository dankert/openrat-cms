<?php

namespace template_engine\components\html\component_insert;

use template_engine\components\html\Component;
use template_engine\element\CMSElement;

class InsertComponent extends Component
{
	public $name;
	public $url;
	public $function;
	
	public function createElement()
	{
		if	( $this->function )
		{
			// JS-Function einbinden
			$script = new CMSElement('script');
			$script->addAttribute('type','text/javascript')->addAttribute('name','JavaScript');
			$script->content( $this->function.'();' );

			return $script;
		}
		elseif	( $this->url )
		{
			// IFrame
			$iframe = new CMSElement('iframe');
			if	( $this->name )
				$iframe->addAttribute('name', $this->name);
			if	( $this->url )
				$iframe->addAttribute('src' ,$this->url);

			return $iframe;
		}
		else
			return null;
	}
}
