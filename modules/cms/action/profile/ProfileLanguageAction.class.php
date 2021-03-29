<?php
namespace cms\action\profile;
use cms\action\Method;
use cms\action\ProfileAction;
use cms\base\Configuration;

class ProfileLanguageAction extends ProfileAction implements Method {

    public function view() {

    	$this->setTemplateVar('language',Configuration::Conf()->get('language') );
    }
    public function post() {
    }

	public function checkAccess() {
		return true;
	}
}
