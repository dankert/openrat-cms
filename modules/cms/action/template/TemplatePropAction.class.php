<?php
namespace cms\action\template;
use cms\action\Action;
use cms\action\Method;
use cms\action\TemplateAction;


class TemplatePropAction extends TemplateAction implements Method {

    public function view() {
		$this->setTemplateVar('name'     , $this->template->name       );
		$this->setTemplateVar('extension','' );
		$this->setTemplateVar('mime_type','' );
    }
    public function post() {

		if	($this->getRequestVar('name') == "")
		{
			$this->addValidationError('name');
			$this->callSubAction('name');
			return;
		}
		else
		{
			$this->template->name = $this->getRequestVar('name');
			$this->template->save();
			$this->addNotice('template', 0, $this->template->name, 'SAVED', Action::NOTICE_OK);
		}
    }
}
