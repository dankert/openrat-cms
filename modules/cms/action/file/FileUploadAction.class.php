<?php

namespace cms\action\file;

use cms\action\FileAction;
use cms\action\Method;
use cms\model\Permission;


class FileUploadAction extends FileAction implements Method {

	public function getRequiredPermission() {
		return Permission::ACL_WRITE;
	}


	public function view() {
    }


    public function post() {
    }
}
