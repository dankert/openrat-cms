<?php
namespace cms\action\template;
use cms\action\Action;
use cms\action\Method;
use cms\action\TemplateAction;
use language\Messages;


class TemplatePropAction extends TemplateAction implements Method {


    public function view() {

		$this->setTemplateVar('name'     , $this->template->name    );
		$this->setTemplateVar('publish'  , $this->template->publish );
    }


    public function post() {

		$this->template->name    = $this->request->getRequiredText('name');
		$this->template->publish = $this->request->has('publish');
		$this->template->save();

		$this->addNoticeFor($this->template,Messages::SAVED);
    }
}
