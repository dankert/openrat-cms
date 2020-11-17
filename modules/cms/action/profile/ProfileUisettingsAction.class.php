<?php
namespace cms\action\profile;
use cms\action\Method;
use cms\action\ProfileAction;
use cms\base\Configuration;


class ProfileUisettingsAction extends ProfileAction implements Method {
    public function view() {

		$this->setTemplateVar('settings',Configuration::Conf()->get('ui') );
    }
    public function post() {
    }
}
