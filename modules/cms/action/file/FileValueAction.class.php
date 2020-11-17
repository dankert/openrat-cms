<?php
namespace cms\action\file;
use cms\action\FileAction;
use cms\action\Method;


class FileValueAction extends FileAction implements Method {
    public function view() {
		// MIME-Types aus Datei lesen
		//$this->setTemplateVars( $this->file->getProperties() );
		//$this->setTemplateVar('value',$this->file->loadValue());
    }


    public function post() {
    }
}
