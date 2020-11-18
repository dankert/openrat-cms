<?php
namespace cms\action\user;
use cms\action\Method;
use cms\action\UserAction;
use cms\base\Configuration;
use cms\base\Startup;
use language\Messages;
use security\Base2n;
use security\Password;

/**
 * Shows the login tokens of this user.
 *
 * @package cms\action\user
 */
class UserAdvancedAction extends UserAction implements Method {

    public function view() {
	    $token = $this->user->getLoginTokens();

		$this->setTemplateVar( 'token', $token );
    }

    public function post() {
    }
}
