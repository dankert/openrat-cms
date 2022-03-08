<?php
namespace cms\action\user;
use cms\action\Method;
use cms\action\UserAction;
use cms\base\Configuration;
use cms\base\Startup;
use language\Messages;
use security\Base2n;
use security\OTP;
use security\Password;


class UserPropAction extends UserAction implements Method {
    public function view() {
	    $issuer  = urlencode(Configuration::subset('application')->get('operator',Startup::TITLE));
	    $account = $this->user->name.'@'.$_SERVER['SERVER_NAME'];

	    $base32 = new Base2n(5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567', FALSE, TRUE, TRUE);
	    $secret = $base32->encode(@hex2bin($this->user->otpSecret));
	    
	    $counter = $this->user->hotpCount;
	    
		$this->setTemplateVars(
		    $this->user->getProperties() +
		    array('totpSecretUrl' => "otpauth://totp/{$issuer}:{$account}?secret={$secret}&issuer={$issuer}",
		          'hotpSecretUrl' => "otpauth://hotp/{$issuer}:{$account}?secret={$secret}&issuer={$issuer}&counter={$counter}"
		    )
		    + array('totpToken'=> OTP::getTOTPCode($this->user->otpSecret))
		);

		$this->setTemplateVar( 'allstyles',$this->user->getAvailableStyles() );
		
	    $this->setTemplateVar('timezone_list',array_combine(timezone_identifiers_list(),timezone_identifiers_list() ));
	    
        $languages = Messages::$AVAILABLE_LANGUAGES;
        foreach($languages as $id=>$name)
        {
            unset($languages[$id]);
            $languages[$name] = $name;
        }
        $this->setTemplateVar('language_list',$languages);
		        
    }


	/**
	 * Save the user properties.
	 */
    public function post() {

		$this->request->handleText('name', function($name) {
			$this->user->name = $name;
		} );

		$this->request->handleText('fullname', function($fullname) {
			$this->user->fullname = $fullname;
		});

		$this->request->handleBoolDefaultFalse('is_admin', function($isAdmin) {
			$this->user->isAdmin = $isAdmin;
		});

		$this->request->handleText( 'tel',function($tel) {
			$this->user->tel      = $tel;
		});

		$this->request->handleText( 'desc',function($desc) {
			$this->user->desc      = $desc;
		});

		$this->request->handleText( 'language',function($language) {
			$this->user->language      = $language;
		});

		$this->request->handleText( 'timezone',function($timezone) {
			$this->user->timezone      = $timezone;
		});

		$this->request->handleText( 'hotp',function($hotp) {
			$this->user->hotp      = $hotp;
		});

		$this->request->handleText( 'totp',function($value) {
			$this->user->totp      = $value;
		});

        if	( Configuration::get(['security','user','show_admin_mail']) )
			$this->request->handleText( 'mail',function($value) {
				$this->user->mail      = $value;
			});

		$this->request->handleText( 'style',function($value) {
			$this->user->style      = $value;
		});

        $this->user->persist();
        $this->addNoticeFor($this->user,Messages::SAVED);
    }
}
