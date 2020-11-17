<?php
namespace cms\action\group;
use cms\action\GroupAction;
use cms\action\Method;
use cms\model\Group;

class GroupListingAction extends GroupAction implements Method {
    public function view() {
		$list = array();

		foreach( Group::getAll() as $id=>$name )
		{
			$list[$id]         = array();
			$list[$id]['name'] = $name;
		}

		$this->setTemplateVar('el',	$list);
    }


    public function post() {
    }
}
