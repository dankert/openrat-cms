<?php
namespace cms\action\login;
use cms\action\LoginAction;
use cms\action\Method;
use util\Session;


class LoginUserinfoAction extends LoginAction implements Method {

    public function view() {
		$user = $this->currentUser;

		$info = array('username'   => $user->name,
		              'fullname'   => $user->fullname,
		              'mail'       => $user->mail,
		              'telephone'  => $user->tel,
		              'style'      => $user->style,
		              'admin'      => $user->isAdmin,
		              'groups'     => implode(',',$user->getGroups()),
		              'description'=> $user->desc
		             );
		        
		$this->setTemplateVar('userinfo',$info);
    }


    public function post() {
    }
}
