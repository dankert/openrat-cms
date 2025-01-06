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
class UserDeltokenAction extends UserAction implements Method {

    public function post() {

		$this->user->deleteToken( $this->request->getRequiredNumber('tokenid') );
		$this->addNoticeFor($this->user,Messages::DELETED);
    }
}
