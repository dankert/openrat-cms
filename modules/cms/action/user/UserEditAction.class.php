<?php
namespace cms\action\user;
use cms\action\Method;
use cms\action\UserAction;
use cms\base\Configuration;
use cms\base\Startup;
use cms\model\Group;
use security\Base2n;
use security\Password;


class UserEditAction extends UserAction implements Method {
    public function view() {
		$this->setTemplateVars( $this->user->getProperties() );

		$gravatarConfig = Configuration::subset(['interface','gravatar'] );
		

		if	( $gravatarConfig->is('enabled',true) &&  $this->user->mail )
		{
			$url = 'http://www.gravatar.com/avatar/'.md5($this->user->mail).'?';

			$url .= '&s='.$gravatarConfig->get('size'   ,80 );
			$url .= '&d='.$gravatarConfig->get('default',404);
			$url .= '&r='.$gravatarConfig->get('rating' ,'g');

			$this->setTemplateVar( 'image', $url );
		} else {
			$this->setTemplateVar( 'image', 'about:blank' );
		}

		$effectiveGroups = $this->user->getEffectiveGroups();

		$this->setTemplateVar( 'groups', array_map( function($groupid ) {
			$group = new Group( $groupid );
			$group->load();
			return $group->name;
		},array_combine($effectiveGroups,$effectiveGroups) ) );


		$issuer  = urlencode(Configuration::subset('application')->get('operator',Startup::TITLE));
        $account = $this->user->name.'@'.$_SERVER['SERVER_NAME'];

        $base32 = new Base2n(5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567', FALSE, TRUE, TRUE);
        $secret = $base32->encode(@hex2bin($this->user->otpSecret));

        $counter = $this->user->hotpCount;

        $this->setTemplateVar('totpSecretUrl',"otpauth://totp/{$issuer}:{$account}?secret={$secret}&issuer={$issuer}");
		$this->setTemplateVar('hotpSecretUrl',"otpauth://hotp/{$issuer}:{$account}?secret={$secret}&issuer={$issuer}&counter={$counter}");
		$this->setTemplateVar('totpToken'    , Password::getTOTPCode($this->user->otpSecret));
    }


    public function post() {
    }
}
