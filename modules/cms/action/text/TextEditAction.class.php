<?php
namespace cms\action\text;
use cms\action\Method;
use cms\action\TextAction;


class TextEditAction extends TextAction implements Method {

    public function view() {
		$this->setTemplateVar( 'source',$this->text->loadValue() );
    }


	public function post()
	{
	}
}
