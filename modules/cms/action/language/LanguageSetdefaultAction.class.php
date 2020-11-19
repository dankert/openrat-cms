<?php
namespace cms\action\language;
use cms\action\Action;
use cms\action\LanguageAction;
use cms\action\Method;
use language\Messages;


class LanguageSetdefaultAction extends LanguageAction implements Method {
    public function view() {
    }
    public function post() {
		$this->language->setDefault();

        $this->addNoticeFor($this->language,Messages::DONE);
    }
}
