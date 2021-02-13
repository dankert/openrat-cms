<?php
namespace cms\action\language;
use cms\action\LanguageAction;
use cms\action\Method;

class LanguageEditAction extends LanguageAction implements Method {

    public function view() {
		$this->setTemplateVars( $this->language->getProperties() );
    }

    public function post() {
    }
}
