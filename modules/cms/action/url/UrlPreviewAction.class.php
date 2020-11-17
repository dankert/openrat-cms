<?php
namespace cms\action\url;
use cms\action\Method;
use cms\action\UrlAction;


class UrlPreviewAction extends UrlAction implements Method {
    public function view() {
        $this->setTemplateVar('preview_url',$this->url->url );
    }
    public function post() {
    }
}
