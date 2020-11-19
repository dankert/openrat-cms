<?php
namespace cms\action\group;
use cms\action\GroupAction;
use cms\action\Method;
use language\Messages;


class GroupPropAction extends GroupAction implements Method {
    public function view() {
		$this->setTemplateVars( $this->group->getProperties() );
    }
    public function post() {
		if	( ! $this->getRequestVar('name') )
		    throw new \util\exception\ValidationException('name');

        $this->group->name = $this->getRequestVar('name');
        $this->group->save();

        $this->addNoticeFor($this->group,Messages::SAVED);
    }
}
