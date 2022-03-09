<?php
namespace cms\action\text;
use cms\action\Method;
use cms\action\RequestParams;
use cms\action\TextAction;
use cms\model\Permission;
use language\Messages;


class TextValueAction extends TextAction implements Method {

	public function getRequiredPermission() {
		return Permission::ACL_WRITE;
	}


	public function view() {

		$this->setTemplateVar( 'text', $this->text->loadValue() );
    }

    public function post() {

		$this->text->value  = $this->request->getText('text');
		$this->text->public = $this->request->isTrue('release');
		$this->text->saveValue();

		$this->addNoticeFor($this->text,Messages::VALUE_SAVED);
		$this->text->setTimestamp();
    }
}
