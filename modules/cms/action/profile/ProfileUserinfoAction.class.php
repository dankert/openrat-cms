<?php
namespace cms\action\profile;
use cms\action\Method;
use cms\action\ProfileAction;
use cms\base\Configuration;
use util\Session;
use util\UIUtils;

class ProfileUserinfoAction extends ProfileAction implements Method {


    public function view() {

		$user = Session::getUser();

		$currentStyle = $this->getUserStyle($user);
		$this->setTemplateVar('style',$currentStyle);


		$defaultStyleConfig     = Configuration::Conf()->get('style-default',[]); // default style config
		$userStyleConfig = Configuration::subset('style')->get($currentStyle,[]); // user style config

		if ( $userStyleConfig )
			$defaultStyleConfig = array_merge($defaultStyleConfig, $userStyleConfig ); // Merging user style into default style
		else
			; // Unknown style name, we are ignoring this.

		// Theme base color for smartphones colorizing their status bar.
		$this->setTemplateVar('theme-color', UIUtils::getColorHexCode($defaultStyleConfig['title_background_color']));
    }


    public function post() {
    }
}
