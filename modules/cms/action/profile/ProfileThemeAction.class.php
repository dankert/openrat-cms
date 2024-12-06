<?php
namespace cms\action\profile;
use cms\action\Method;
use cms\action\ProfileAction;
use cms\base\Configuration;
use cms\base\Startup;
use language\Language;
use language\Messages;
use security\Base2n;
use util\Request;

class ProfileThemeAction extends ProfileAction implements Method {
    public function view() {

	    $this->setTemplateVars( $this->user->getProperties() );

		$this->setTemplateVar( 'allstyles',$this->user->getAvailableStyles() );
		
    }


	/**
	 * Saving the user profile.
	 *
	 * @return void
	 */
    public function post() {


		$this->request->handleText('style',function($value) {
			$this->user->style = $value;
		});

		// Overwrite user in session with new settings.
		Request::setUser( $this->user );

		$this->user->persist();
		$this->addNoticeFor( $this->user,Messages::SAVED);
    }
}
