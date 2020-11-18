<?php
namespace cms\action\user;
use cms\action\Method;
use cms\action\UserAction;
use cms\base\Configuration;
use cms\base\Startup;
use language\Messages;
use security\Base2n;
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
		    + array('totpToken'=>Password::getTOTPCode($this->user->otpSecret))
		);

		$this->setTemplateVar( 'allstyles',$this->user->getAvailableStyles() );
		
	    $this->setTemplateVar('timezone_list',timezone_identifiers_list() );
	    
        $languages = Messages::$AVAILABLE_LANGUAGES;
        foreach($languages as $id=>$name)
        {
            unset($languages[$id]);
            $languages[$name] = $name;
        }
        $this->setTemplateVar('language_list',$languages);
		        
    }

    public function post() {
		if	( ! $this->getRequestVar('name') )
            throw new \util\exception\ValidationException( 'name');

        // Benutzer speichern
        $this->user->name     = $this->getRequestVar('name'    );
        $this->user->fullname = $this->getRequestVar('fullname');
        $this->user->isAdmin  = $this->hasRequestVar('is_admin');
        $this->user->tel      = $this->getRequestVar('tel'     );
        $this->user->desc     = $this->getRequestVar('desc'    );
        $this->user->language = $this->getRequestVar('language');
        $this->user->timezone = $this->getRequestVar('timezone');
        $this->user->hotp     = $this->hasRequestVar('hotp'    );
        $this->user->totp     = $this->hasRequestVar('totp'    );

        if	( Configuration::get(['security','user','show_admin_mail']) )
            $this->user->mail = $this->getRequestVar('mail'    );

        $this->user->style    = $this->getRequestVar('style'   );

        $this->user->persist();
        $this->addNotice('user', 0, $this->user->name, 'SAVED', 'ok');
    }
}
