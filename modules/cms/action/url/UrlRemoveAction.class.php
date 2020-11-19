<?php
namespace cms\action\url;
use cms\action\Action;
use cms\action\Method;
use cms\action\UrlAction;
use language\Messages;


class UrlRemoveAction extends UrlAction implements Method {

    public function view() {
        $this->setTemplateVar( 'name',$this->url->filename );
    }

    public function post() {

		$this->url->delete();
		$this->addNoticeFor($this->url,Messages::DELETED);
    }
}
