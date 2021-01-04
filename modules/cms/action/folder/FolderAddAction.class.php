<?php
namespace cms\action\folder;
use cms\action\FolderAction;
use cms\action\Method;
use cms\model\Permission;


class FolderAddAction extends FolderAction implements Method {

	public function view() {
		$this->setTemplateVar('mayCreateFolder',$this->folder->hasRight( Permission::ACL_CREATE_FOLDER ) );
		$this->setTemplateVar('mayCreateFile'  ,$this->folder->hasRight( Permission::ACL_CREATE_FILE   ) );
		$this->setTemplateVar('mayCreateText'  ,$this->folder->hasRight( Permission::ACL_CREATE_FILE   ) );
		$this->setTemplateVar('mayCreateImage' ,$this->folder->hasRight( Permission::ACL_CREATE_FILE   ) );
		$this->setTemplateVar('mayCreatePage'  ,$this->folder->hasRight( Permission::ACL_CREATE_PAGE   ) );
		$this->setTemplateVar('mayCreateUrl'   ,$this->folder->hasRight( Permission::ACL_CREATE_LINK   ) );
		$this->setTemplateVar('mayCreateLink'  ,$this->folder->hasRight( Permission::ACL_CREATE_LINK   ) );

	}

    public function post() {
    }
}
