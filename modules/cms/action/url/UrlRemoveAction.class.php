<?php
namespace cms\action\url;
use cms\action\Action;
use cms\action\Method;
use cms\action\UrlAction;


class UrlRemoveAction extends UrlAction implements Method {
    public function view() {
        $this->setTemplateVar( 'name',$this->url->filename );
    }
    public function post() {

        if   ( $this->getRequestVar('delete') != '' )
        {
            $this->url->delete();
            $this->addNotice('url', 0, $this->url->filename, 'DELETED', Action::NOTICE_OK);
        }
        else
        {
            $this->addNotice('url', 0, $this->url->filename, 'CANCELED', Action::NOTICE_WARN);
        }
    }
}
