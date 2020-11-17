<?php
namespace cms\action\folder;
use cms\action\FolderAction;
use cms\action\Method;
use util\Html;


class FolderPreviewAction extends FolderAction implements Method {
    public function view() {
		$this->setTemplateVar('preview_url',Html::url('folder','show',$this->folder->objectid,array('target'=>'none') ) );
    }


    public function post() {
    }
}
