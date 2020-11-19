<?php
namespace cms\action\template;
use cms\action\Action;
use cms\action\Method;
use cms\action\TemplateAction;
use language\Messages;


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
			return;
		}
		else
		{
			$this->template->name = $this->getRequestVar('name');
			$this->template->save();
			$this->addNoticeFor($this->template,Messages::SAVED);
		}
    }
}
