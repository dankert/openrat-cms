<?php
namespace cms\action\configuration;
use cms\action\ConfigurationAction;
use cms\action\Method;

class ConfigurationEditAction extends ConfigurationAction implements Method {
    public function view() {
		$this->nextSubAction('show');

    }
    public function post() {
    }
}
