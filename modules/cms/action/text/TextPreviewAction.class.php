<?php
namespace cms\action\text;
use cms\action\Method;
use cms\action\TextAction;


class TextPreviewAction extends TextAction implements Method {


    public function view()
	{
		$this->setTemplateVar('text', $this->text->loadValue());

		parent::previewView();
	}

    public function post() {
    }
}
