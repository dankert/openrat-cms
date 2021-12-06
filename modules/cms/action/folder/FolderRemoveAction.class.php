<?php
namespace cms\action\folder;
use cms\action\FolderAction;
use cms\action\Method;
use cms\model\Permission;
use language\Messages;
use util\exception\ValidationException;


class FolderRemoveAction extends FolderAction implements Method {

	public function getRequiredPermission() {
		return Permission::ACL_DELETE;
	}


	public function view() {
        $this->setTemplateVar( 'name',$this->folder->filename );
        $this->setTemplateVar( 'hasChildren', $this->folder->hasChildren() );
    }


    public function post() {

		if   ( $this->folder->isRoot() )
			// Could not delete the root folder on user request.
			throw new ValidationException("parent",Messages::FOLDER_ROOT);

		if  ( $this->request->has( 'withChildren'))
            $this->folder->deleteAll();  // Delete with children
        else
            if   ( $this->folder->hasChildren() )
                throw new ValidationException("withChildren",Messages::CONTAINS_CHILDREN);
            else
                $this->folder->delete();  // Only delete current folder.

        $this->addNoticeFor($this->folder, Messages::DELETED);
    }
}
