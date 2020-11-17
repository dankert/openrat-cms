<?php
namespace cms\action\templatelist;
use cms\action\Method;
use cms\action\TemplatelistAction;

class TemplatelistEditAction extends TemplatelistAction implements Method {
    public function view() {
		$this->nextSubAction('show');
    }
    public function post() {
    }
}
