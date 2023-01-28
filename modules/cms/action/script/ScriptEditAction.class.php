<?php
namespace cms\action\script;
use cms\action\Method;
use cms\action\ScriptAction;


class ScriptEditAction extends ScriptAction implements Method {

    public function view() {
		$this->setTemplateVar( 'source',$this->script->loadValue() );
    }


	public function post()
	{
	}
}
