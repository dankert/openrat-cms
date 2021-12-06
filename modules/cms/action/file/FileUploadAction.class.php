<?php

namespace cms\action\file;

use cms\action\FileAction;
use cms\action\Method;
use cms\model\BaseObject;
use cms\model\Permission;
use language\Messages;
use util\Upload;


class FileUploadAction extends FileAction implements Method {

	public function getRequiredPermission() {
		return Permission::ACL_WRITE;
	}


	public function view() {
    }


    public function post() {

		// File was uploaded.
		$upload = new Upload('file');

		try
		{
			$upload->processUpload();
		}
		catch( \Exception $e )
		{
			// technical error.
			throw new \RuntimeException('Exception while processing the upload: '.$e->getMessage(), 0, $e);
		}

		$this->file->filename  = $upload->filename;
		$this->file->extension = $upload->extension;
		$this->file->size      = $upload->size;
		$this->file->persist();

		$this->file->value = $upload->value;
		$this->file->saveValue();

		$this->addNoticeFor( $this->file, Messages::SAVED );
    }
}
