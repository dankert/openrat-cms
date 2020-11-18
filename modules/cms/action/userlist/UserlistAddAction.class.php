<?php
namespace cms\action\userlist;
use cms\action\Method;
use cms\action\RequestParams;
use cms\action\UserlistAction;
use cms\model\User;
use language\Messages;
use util\exception\ValidationException;

/**
 * Adding a new user.
 *
 * @package cms\action\userlist
 */
class UserlistAddAction extends UserlistAction implements Method {
    public function view() {
    }
    public function post( ) {
		$name = $this->getRequestVar('name');
		$name = $this->request->cleanText($name,RequestParams::FILTER_ALPHANUM);

		$user = User::loadWithName($name,User::AUTH_TYPE_INTERNAL);

		if   ( !empty($user) )
			throw new ValidationException( 'name',Messages::USER_ALREADY_IN_DATABASE);

		$user = new User();
		$user->name = $name;
		$user->persist();
		$this->addNoticeFor($user, Messages::ADDED);
    }
}
