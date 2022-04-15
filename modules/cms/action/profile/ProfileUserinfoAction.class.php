<?php
namespace cms\action\profile;
use cms\action\Method;
use cms\action\ProfileAction;
use cms\base\Configuration;
use cms\ui\themes\ThemeStyle;
use util\Session;
use util\UIUtils;

class ProfileUserinfoAction extends ProfileAction implements Method {


	/**
	 * Gets user information.
	 * If no user is logged in, default information will be returned.
	 *
	 * @return void
	 */
    public function view() {

		$user = $this->currentUser;

		$currentStyle = $this->getUserStyle($user);
		$this->setTemplateVar('style',$currentStyle);


		$themeStyle = new ThemeStyle( Configuration::subset('style')->get($currentStyle,[]) ); // user style config

		// Theme base color for smartphones colorizing their status bar.
		$this->setTemplateVar('theme-color', UIUtils::getColorHexCode($themeStyle->getThemeColor()));

		// Output all theme colors
		$this->setTemplateVar('theme'     , $themeStyle->getProperties() );
    }


    public function post() {
    }


	public function checkAccess() {
		return true;
	}
}
