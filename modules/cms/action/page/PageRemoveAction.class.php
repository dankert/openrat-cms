<?php
namespace cms\action\page;
use cms\action\Method;
use cms\action\PageAction;
use language\Messages;

class PageRemoveAction extends PageAction implements Method {

	public function view() {
        $this->setTemplateVar( 'name',$this->page->filename );
    }

    public function post() {
        $this->page->delete();
		$this->addNoticeFor( $this->page,Messages::DELETED);
    }
}
