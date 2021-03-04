<?php
namespace cms\action\image;
use cms\action\ImageAction;
use cms\action\Method;
use util\Html;


class ImageEditAction extends ImageAction implements Method {

    public function view() {

		// MIME-Types aus Datei lesen
		$this->setTemplateVar( 'preview', Html::url('image','show',$this->image->objectid ) );
    }


	public function post()
	{
	}
}
