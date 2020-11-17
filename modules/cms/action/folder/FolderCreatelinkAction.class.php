<?php
namespace cms\action\folder;
use cms\action\FolderAction;
use cms\action\Method;
use cms\model\BaseObject;
use cms\model\Link;
use language\Messages;


class FolderCreatelinkAction extends FolderAction implements Method {


	public function view() {
		$this->setTemplateVar('objectid'  ,$this->folder->objectid );
    }


    public function post() {
        $name        = $this->getRequestVar('name');
        $description = $this->getRequestVar('description');

		$link = new Link();
		$link->filename       = BaseObject::urlify( $name );
		$link->parentid       = $this->folder->objectid;

		$link->linkedObjectId = $this->getRequestVar('targetobjectid');
		$link->projectid      = $this->folder->projectid;

		$link->add();
		$link->setNameForAllLanguages( $name,$description );

		$this->addNoticeFor( $link, Messages::ADDED);
		$this->setTemplateVar('objectid',$link->objectid);

        $this->folder->setTimestamp();
    }
}
