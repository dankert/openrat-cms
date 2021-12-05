<?php
namespace cms\action\folder;
use cms\action\FolderAction;
use cms\action\Method;
use cms\model\BaseObject;
use cms\model\Folder;
use cms\model\Permission;
use language\Messages;


class FolderCreatefolderAction extends FolderAction implements Method {
	public function getRequiredPermission() {
		return Permission::ACL_CREATE_FOLDER;
	}

	public function view() {
		$this->setTemplateVar('objectid'  ,$this->folder->objectid   );
    }


    public function post() {
		$name        = $this->request->getText('name');
		$description = $this->request->getText('description');

		$f = new Folder();
		$f->projectid  = $this->folder->projectid;
		$f->filename   = BaseObject::urlify( $name );
		$f->parentid   = $this->folder->objectid;

		$f->persist();
		$f->setNameForAllLanguages( $name,$description );

		$this->addNoticeFor($f, Messages::ADDED);
		// Die neue Folder-Id (wichtig für API-Aufrufe).
		$this->setTemplateVar('objectid',$f->objectid);

		$this->folder->setTimestamp(); // Zeitstempel setzen.
    }
}
