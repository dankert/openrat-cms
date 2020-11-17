<?php
namespace cms\action\file;
use cms\action\FileAction;
use cms\action\Method;
use util\Html;


class FilePreviewAction extends FileAction implements Method {

    public function view() {
		$url = Html::url($this->file->getType(),'show',$this->file->objectid );
		$this->setTemplateVar('preview_url',$url );
    }

    public function post() {
    }
}
