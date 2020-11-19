<?php
namespace cms\action\login;
use cms\action\LoginAction;
use cms\action\Method;
use cms\action\RequestParams;
use cms\base\Configuration;
use cms\model\User;
use Exception;
use openid_connect\OpenIDConnectClient;
use util\Session;

/**
 * Authentication via OpenID-Connect.
 */
class LoginOidcAction extends LoginAction implements Method {


    public function view() {

    	if   ( $this->hasRequestVar("id")) {
			$providerName = $this->request->getRequestVar('id',RequestParams::FILTER_ALPHANUM);
			Session::set(Session::KEY_OIDC_PROVIDER,$providerName);
		}else {
			$providerName = Session::get( Session::KEY_OIDC_PROVIDER);
		}


    	$providerConfig = Configuration::subset(['security','oidc','provider',$providerName]);

    	$oidc = new OpenIDConnectClient();
    	$oidc->setProviderURL ( $providerConfig->get('url'          ));
    	$oidc->setIssuer      ( $providerConfig->get('url'          ));
    	$oidc->setClientID    ( $providerConfig->get('client_id'    ));
    	$oidc->setClientSecret( $providerConfig->get('client_secret'));

    	try {
			$oidc->authenticate();
			$subjectIdentifier = $oidc->requestUserInfo('sub');

			$user = User::loadWithName( $subjectIdentifier,User::AUTH_TYPE_OIDC,$providerName );

			if   ( ! $user ) {
				// Create user
				$user = new User();
				$user->name   = $subjectIdentifier;
				$user->type   = User::AUTH_TYPE_OIDC;
				$user->issuer = $providerName;
				$user->persist();

			}

			Session::setUser( $user );

		} catch( Exception $e) {
    		throw new \RuntimeException('OpenId-Connect authentication failed',0,$e);
		}

    	header( 'Location: ./');
    }


    public function post() {
    }
}
