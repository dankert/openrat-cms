<?php

namespace template_engine\components;

use modules\template_engine\PHPBlockElement;

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
