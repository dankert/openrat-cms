<?php
namespace cms\action\modellist;
use cms\action\Method;
use cms\action\ModellistAction;

class ModellistEditAction extends ModellistAction implements Method {
    public function view() {
		$this->nextSubAction('show');
    }

    public function post() {
    }
}
