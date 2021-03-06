<?php
namespace cms\action\folder;
use cms\action\FolderAction;
use cms\action\Method;
use cms\model\BaseObject;
use cms\model\Link;
use cms\model\Permission;
use language\Messages;


class FolderCreatelinkAction extends FolderAction implements Method {

	public function getRequiredPermission() {
		return Permission::ACL_CREATE_LINK;
	}



	public function view() {
		$this->setTemplateVar('objectid'  ,$this->folder->objectid );
    }


    public function post() {
        $name        = $this->request->getText('name');
        $description = $this->request->getText('description');

		$link = new Link();
		$link->filename       = BaseObject::urlify( $name );
		$link->parentid       = $this->folder->objectid;

		$link->linkedObjectId = $this->request->getText('targetobjectid');
		$link->projectid      = $this->folder->projectid;

		$link->persist();
		$link->setNameForAllLanguages( $name,$description );

		$this->addNoticeFor( $link, Messages::ADDED);
		$this->setTemplateVar('objectid',$link->objectid);

        $this->folder->setTimestamp();
    }
}
