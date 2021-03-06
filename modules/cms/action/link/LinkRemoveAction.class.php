<?php
namespace cms\action\link;
use cms\action\Action;
use cms\action\LinkAction;
use cms\action\Method;
use cms\model\Permission;
use language\Messages;


class LinkRemoveAction extends LinkAction implements Method {

	public function getRequiredPermission() {
		return Permission::ACL_DELETE;
	}


	public function view() {
        $this->setTemplateVar( 'name',$this->link->filename );
    }

    public function post() {
        $this->link->delete();
		$this->addNoticeFor( $this->link, Messages::DELETED );
    }
}
