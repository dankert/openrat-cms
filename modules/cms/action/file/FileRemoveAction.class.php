<?php
namespace cms\action\file;
use cms\action\FileAction;
use cms\action\Method;
use cms\model\Permission;
use language\Messages;


/**
 * Removing a file.
 */
class FileRemoveAction extends FileAction implements Method {

	public function getRequiredPermission() {
		return Permission::ACL_DELETE;
	}


	public function view() {
        $this->setTemplateVar( 'name',$this->file->filename );
    }


    public function post() {

		$this->file->delete();
		$this->addNoticeFor( $this->file, Messages::DELETED);
    }
}
