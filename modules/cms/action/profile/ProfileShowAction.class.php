<?php
namespace cms\action\profile;
use cms\action\Method;
use cms\action\ProfileAction;

class ProfileShowAction extends ProfileAction implements Method {
    public function view() {

	    $this->setTemplateVars( $this->user->getProperties() );
    }


	/**
	 * @return void
	 */
    public function post() {

    }
}
