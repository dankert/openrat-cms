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
		
		$this->setTemplateVar('timezone_list',timezone_identifiers_list() );
		
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
    public function post() {
		$this->user->fullname = $this->request->getRequiredText('fullname');
		$this->user->tel      = $this->request->getText('tel'     );
		$this->user->desc     = $this->request->getText('desc'    );
		$this->user->style    = $this->request->getText('style'   );
		$this->user->language = $this->request->getText('language');
		$this->user->timezone = $this->request->getText('timezone');
		$this->user->hotp     = $this->request->has('hotp'    );
		$this->user->totp     = $this->request->has('totp'    );
		
		
		Session::setUser( $this->user );
		
		$this->user->persist();
		$this->addNoticeFor( $this->user,Messages::SAVED);

		
		// Ausgewählte Sprache sofort verwenden.
		$l = $this->request->getText('language');

		if   ( $l )
        	$this->setLanguage($l);
    }
}
