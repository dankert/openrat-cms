<?php
namespace cms\action\languagelist;
use cms\action\LanguagelistAction;
use cms\action\Method;


class LanguagelistEditAction extends LanguagelistAction implements Method {
    public function view() {
		$this->nextSubAction('show');
    }
    public function post() {
    }
}
