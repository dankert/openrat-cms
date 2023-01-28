<?php
namespace cms\action\script;
use cms\action\Method;
use cms\action\RequestParams;
use cms\action\ScriptAction;
use cms\action\TextAction;
use cms\model\Permission;
use language\Messages;


class ScriptValueAction extends ScriptAction implements Method {

	public function getRequiredPermission() {
		return Permission::ACL_WRITE;
	}


	public function view() {

		$this->setTemplateVar( 'text', $this->script->loadValue() );
    }

    public function post() {

		$this->script->value  = $this->request->getText('text');
		$this->script->public = $this->request->isTrue('release');
		$this->script->saveValue();

		$this->addNoticeFor($this->script,Messages::VALUE_SAVED);
		$this->script->setTimestamp();
    }
}
