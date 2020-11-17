<?php
namespace cms\action\login;
use cms\action\LoginAction;
use cms\action\Method;
use cms\base\Configuration;
use language\Messages;
use util\Session;


class LoginLogoutAction extends LoginAction implements Method {
    public function view() {
		// There is no view for this action.
    }
    public function post() {
		if	( Configuration::subset('security')->is('renew_session_logout',false) )
			$this->recreateSession();

        // Reading the login token cookie
        list( $selector,$token ) = array_pad( explode('.',@$_COOKIE['or_token']),2,'');

        // Logout forces the removal of all login tokens
		if   ( $selector )
		    $this->currentUser->deleteLoginToken( $selector );

		// Cookie mit Logintoken löschen.
        $this->setCookie('or_token'   ,null );

        Session::setUser(null);

        $this->addNoticeFor( $this->currentUser, Messages::LOGOUT_OK );
    }
}
