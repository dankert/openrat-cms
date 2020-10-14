<?php

namespace template_engine\components;

use template_engine\components\html\Component;
use template_engine\element\PHPBlockElement;

class UserComponent extends Component
{
	public $user;
	public $id;

	public function createElement()
	{
		$user = new PHPBlockElement();
		$user->beforeBlock = $user->includeResource( 'user/component-user.php');
		$user->inBlock = 'component_user('.$user->value($this->user).');';

		return $user;
	}
}
