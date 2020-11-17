<?php
namespace cms\action\template;
use cms\action\Action;
use cms\action\Method;
use cms\action\TemplateAction;


class TemplateRemoveAction extends TemplateAction implements Method {
    public function view() {
		$this->setTemplateVar('name',$this->template->name);
    }
    public function post() {
		if   ( $this->getRequestVar('delete') != '' )
		{
			$this->template->delete();
			$this->addNotice('template', 0, $this->template->name, 'DELETED', Action::NOTICE_OK);
		}
		else
		{
			$this->addNotice('template', 0, $this->template->name, 'CANCELED', Action::NOTICE_WARN);
		}
    }
}
