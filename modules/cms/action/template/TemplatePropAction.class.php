<?php
namespace cms\action\template;
use cms\action\Method;
use cms\action\TemplateAction;
use language\Messages;


class TemplatePropAction extends TemplateAction implements Method {


    public function view() {

		$this->setTemplateVar('name'     , $this->template->name    );
		$this->setTemplateVar('publish'  , $this->template->publish );
    }


    public function post() {

		$this->request->handleText('name',function($value) {
			$this->template->name = $value;
		});

		$this->template->publish = $this->request->isTrue('publish');
		$this->template->save();

		$this->addNoticeFor($this->template,Messages::SAVED);
    }
}
