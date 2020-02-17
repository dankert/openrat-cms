<?php

namespace template_engine\components;

use modules\template_engine\CMSElement;

class UploadComponent extends Component
{
	public $size      = 40;
	public $name      = '';
	public $multiple  = false;
	public $class     = 'upload';
	public $maxlength = 0;

	public function createElement()
	{
		$input = new CMSElement('input');

		$input->selfClosing(true);
		$input->addStyleClass( $this->class );

		if	( $this->multiple )
			$input->addAttribute( 'multiple','multiple' );

		$input->addAttribute('id',REQUEST_ID.'_'.$this->name);
		$input->addAttribute('name',$this->name);
		$input->addAttribute('size',$this->size);

		if	( $this->maxlength )
			$input->addAttribute( 'maxlength',$this->maxlength );

		return $input;
	}
}