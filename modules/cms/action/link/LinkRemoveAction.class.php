<?php
namespace cms\action\link;
use cms\action\Action;
use cms\action\LinkAction;
use cms\action\Method;


class LinkRemoveAction extends LinkAction implements Method {
    public function view() {
        $this->setTemplateVar( 'name',$this->link->filename );
    }
    public function post() {
        if ($this->getRequestVar('delete') != '') {
            $this->link->delete();
            $this->addNotice('link', 0, $this->link->filename, 'DELETED', Action::NOTICE_OK);
        } else {
            $this->addNotice('link', 0, $this->link->filename, 'CANCELED', Action::NOTICE_WARN);
        }
    }
}
