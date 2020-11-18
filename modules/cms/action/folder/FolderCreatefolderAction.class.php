<?php
namespace cms\action\folder;
use cms\action\FolderAction;
use cms\action\Method;
use cms\model\BaseObject;
use cms\model\Folder;
use language\Messages;


class FolderCreatefolderAction extends FolderAction implements Method {
    public function view() {
		$this->setTemplateVar('objectid'  ,$this->folder->objectid   );
		$this->setTemplateVar('languageid',$this->folder->languageid );
    }


    public function post() {
		$name        = $this->getRequestVar('name');
		$description = $this->getRequestVar('description');

		$f = new Folder();
		$f->projectid  = $this->folder->projectid;
		$f->languageid = $this->folder->languageid;
		$f->name       = $name;
		$f->filename   = BaseObject::urlify( $name );
		$f->desc       = $description;
		$f->parentid   = $this->folder->objectid;

		$f->persist();
		$f->setNameForAllLanguages( $name,$description );

		$this->addNoticeFor($f, Messages::ADDED);
		// Die neue Folder-Id (wichtig für API-Aufrufe).
		$this->setTemplateVar('objectid',$f->objectid);

		$this->folder->setTimestamp(); // Zeitstempel setzen.
    }
}
