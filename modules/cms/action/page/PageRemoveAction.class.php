<?php
namespace cms\action\page;
use cms\action\Action;
use cms\action\Method;
use cms\action\PageAction;

class PageRemoveAction extends PageAction implements Method {
    public function view() {
        $this->setTemplateVar( 'name',$this->page->filename );
    }
    public function post() {
        if   ( $this->getRequestVar('delete') != '' )
        {
            $this->page->delete();
            $this->addNotice('page', 0, $this->page->filename, 'DELETED', Action::NOTICE_OK);
        }
        else
        {
            $this->addNotice('page', 0, $this->page->filename, 'CANCELED', Action::NOTICE_WARN);
        }
    }
}
