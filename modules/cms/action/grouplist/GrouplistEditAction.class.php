<?php
namespace cms\action\grouplist;
use cms\action\GrouplistAction;
use cms\action\Method;


class GrouplistEditAction extends GrouplistAction implements Method {
    public function view() {
		$this->nextSubAction('show');
    }
    public function post() {
    }
}
