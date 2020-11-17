<?php
namespace cms\action\folder;
use cms\action\FolderAction;
use cms\action\Method;


class FolderAddAction extends FolderAction implements Method {

    public function view() {
		$this->nextSubAction('create');
    }

    public function post() {
		$this->nextSubAction('create');
    }
}
