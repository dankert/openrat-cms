<?php
namespace cms\action\grouplist;
use cms\action\GrouplistAction;
use cms\action\Method;
use cms\model\Group;

class GrouplistShowAction extends GrouplistAction implements Method {
    public function view() {
		$list = array();

		foreach( Group::getAll() as $id=>$name )
		{
			$list[$id]         = array();
			$list[$id]['id'  ] = $id;
			$list[$id]['name'] = $name;
		}

		$this->setTemplateVar('el',	$list);
    }


    public function post() {
    }
}
