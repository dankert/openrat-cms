<?php
namespace cms\action\url;
use cms\action\Action;
use cms\action\Method;
use cms\action\UrlAction;
use cms\model\Permission;
use language\Messages;


class UrlRemoveAction extends UrlAction implements Method {

	public function getRequiredPermission() {
		return Permission::ACL_DELETE;
	}


	public function view() {
        $this->setTemplateVar( 'name',$this->url->filename );
    }

    public function post() {

		$this->url->delete();
		$this->addNoticeFor($this->url,Messages::DELETED);
    }
}
