<?php
namespace cms\action\image;
use cms\action\ImageAction;
use cms\action\Method;
use util\Html;

class ImagePreviewAction extends ImageAction implements Method {
    public function view() {
       $this->setTemplateVar('url', Html::url('image','show',$this->image->objectid ) );

       parent::previewView();
    }
    public function post() {
    }
}
