<?php
namespace cms\action\language;
use cms\action\Action;
use cms\action\LanguageAction;
use cms\action\Method;


class LanguageSetdefaultAction extends LanguageAction implements Method {
    public function view() {
    }
    public function post() {
		$this->language->setDefault();

        $this->addNotice('language', 0, $this->language->name, 'DONE', Action::NOTICE_OK);
    }
}
