<?php
namespace cms\action\search;
use cms\action\Method;
use cms\action\SearchAction;
use cms\model\User;
use util\Session;

class SearchEditAction extends SearchAction implements Method {
    public function view() {

		$user = Session::getUser();

		$this->setTemplateVar( 'users'     ,User::listAll() );
		$this->setTemplateVar( 'act_userid',$user->userid   );
    }


    public function post() {
    }
}
