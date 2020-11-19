<?php
namespace cms\action\template;
use cms\action\Action;
use cms\action\Method;
use cms\action\TemplateAction;
use language\Messages;


class TemplateRemoveAction extends TemplateAction implements Method {
    public function view() {
		$this->setTemplateVar('name',$this->template->name);
    }
    public function post() {
		$this->template->delete();
		$this->addNoticeFor($this->template,Messages::DELETED);
    }
}
