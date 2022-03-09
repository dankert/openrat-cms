<?php
namespace cms\action\profile;
use cms\action\Method;
use cms\action\ProfileAction;
use cms\base\Configuration;
use cms\base\Startup;
use language\Language;
use language\Messages;
use security\Base2n;
use util\Session;

class ProfileEditAction extends ProfileAction implements Method {
    public function view() {
	    $issuer  = urlencode(Configuration::subset('application')->get('operator',Startup::TITLE));
	    $account = $this->user->name.'@'.$_SERVER['SERVER_NAME'];
	    
	    $base32 = new Base2n(5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567', FALSE, TRUE, TRUE);
	    $secret = $base32->encode(hex2bin($this->user->otpSecret));
	    $counter = $this->user->hotpCount;
	    
	    $this->setTemplateVars( $this->user->getProperties() );

		$this->setTemplateVar( 'allstyles',$this->user->getAvailableStyles() );
		
		$this->setTemplateVar('timezone_list',array_combine(timezone_identifiers_list(),timezone_identifiers_list()) );
		
		$languageList = [];

		foreach( Messages::$AVAILABLE_LANGUAGES as $languageIsoCode)
		{
			$language = (new Language)->getLanguage($languageIsoCode);
			$label    = $language[ Messages::SELF_NAME ];
		    $languageList[ $languageIsoCode ] = $label;
		}
		$this->setTemplateVar('language_list',$languageList );
		
		$this->setTemplateVars(
		    $this->user->getProperties() +
		    array('totpSecretUrl' => "otpauth://totp/{$issuer}:{$account}?secret={$secret}&issuer={$issuer}",
		    'hotpSecretUrl' => "otpauth://hotp/{$issuer}:{$account}?secret={$secret}&issuer={$issuer}&counter={$counter}"
		    )
		);
		
		
    }


	/**
	 * Saving the user profile.
	 *
	 * @return void
	 */
    public function post() {

		$this->request->handleText('fullname',function($value) {
			$this->user->fullname = $value;
		});

		$this->request->handleText('tel',function($value) {
			$this->user->tel = $value;
		});

		$this->request->handleText('desc',function($value) {
			$this->user->desc = $value;
		});

		$this->request->handleText('style',function($value) {
			$this->user->style = $value;
		});

		$this->request->handleText('language',function($value) {
			$this->user->language = $value;
			$this->setLanguage($value); // Change language immediately
		});

		$this->request->handleText('timezone',function($value) {
			$this->user->timezone = $value;
		});

		$this->request->handleBoolDefaultFalse('hotp',function($value) {
			$this->user->hotp = $value;
		});

		$this->request->handleBoolDefaultFalse('totp',function($value) {
			$this->user->totp = $value;
		});

		// Overwrite user in session with new settings.
		Session::setUser( $this->user );
		
		$this->user->persist();
		$this->addNoticeFor( $this->user,Messages::SAVED);
    }
}
