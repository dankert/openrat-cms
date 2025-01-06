<?php
namespace cms\action\user;
use cms\action\Method;
use cms\action\UserAction;
use cms\base\Configuration;
use cms\base\Startup;
use language\Messages;
use security\Base2n;
use security\Password;
use util\Browser;
use util\exception\UIException;
use util\exception\ValidationException;
use util\Session;

/**
 * Shows the login tokens of this user.
 *
 * @package cms\action\user
 */
class UserAddtokenAction extends UserAction implements Method {

    public function view() {

		// Creating a new random API token
		$newToken =
			// Token: Selector+Token
			Password::randomHexString(24).
			'.'.
			Password::randomHexString(24);


		$this->setTemplateVar('apitoken',$newToken         );
		$this->setTemplateVar('apitokenHeader','Authorization: API '.$newToken );

		$browser = new Browser();
		$this->setTemplateVar('platform',$browser->platform);
		$this->setTemplateVar('name'    ,$browser->name    );
		// Default: expires in 30 days
		$this->setTemplateVar('expires' ,date('Y-m-d',time()+(30*24*60*60))  );
    }

    public function post() {

		$newToken = $this->request->getRequiredText('apitoken');
		$name     = $this->request->getText('name'    );
		$platform = $this->request->getText('platform');
		$expires  = strtotime($this->request->getText('expires' ));

		list($selector,$token)=explode('.',$newToken);

		$this->user->addApiToken( $selector,$token,$platform,$name,$expires );
		$this->addNoticeFor($this->user,Messages::ADDED);
    }
}
