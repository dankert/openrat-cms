<?php
namespace cms\action\folder;
use cms\action\FolderAction;
use cms\action\Method;
use cms\model\BaseObject;
use cms\model\File;
use cms\model\Permission;
use language\Messages;
use util\exception\ValidationException;
use util\Http;
use util\Upload;


class FolderCreatefileAction extends FolderAction implements Method {
	public function getRequiredPermission() {
		return Permission::ACL_CREATE_FILE;
	}

	public function view() {
		// Maximale Dateigroesse.
		$maxSizeBytes = $this->maxFileSize();
		$this->setTemplateVar('max_size' ,($maxSizeBytes/1024).' KB' );
		$this->setTemplateVar('maxlength',$maxSizeBytes );

		$this->setTemplateVar('objectid',$this->folder->objectid );
    }


    public function post() {
		$type        = $this->request->getText('type'       );
		$name        = $this->request->getText('name'       );
		$filename    = $this->request->getText('filename'   );
		$description = $this->request->getText('description');

		$file   = new File();

		// Die neue Datei wird über eine URL geladen und dann im CMS gespeichert.
		if	( $url = $this->request->getText('url') )
		{
			$http = new Http();
			$http->setUrl( $url );

			$ok = $http->request();

			if	( !$ok )
			{
				$this->addWarningFor( $this->folder,Messages::COMMON_VALIDATION_ERROR,[],$http->error);
				throw new ValidationException( 'url' );
			}

			$file->filename  = BaseObject::urlify( $name );
			$file->size      = strlen($http->body);
			$file->value     = $http->body;
			$file->parentid  = $this->folder->objectid;
            $file->projectid = $this->folder->projectid;
		}
        elseif	( $value = $this->request->getText('value') )
        {
            // New file is inserted.
            $file->filename  = BaseObject::urlify( $filename );
            $file->value     = $value;
            $file->size      = strlen($file->value);
            $file->parentid  = $this->folder->objectid;
            $file->projectid = $this->folder->projectid;
        }
		else
		{
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

                //throw new \ValidationException( $upload->parameterName );
            }

			$file->filename  = BaseObject::urlify( $upload->filename );
            $file->extension = $upload->extension;
            $file->size      = $upload->size;
            $file->parentid  = $this->folder->objectid;
            $file->projectid = $this->folder->projectid;

            $file->value     = $upload->value;
		}

		$file->persist(); // Datei hinzufuegen
        $file->setNameForAllLanguages( $name,$description );

		$this->addNoticeFor( $file, Messages::ADDED );
		$this->setTemplateVar('objectid',$file->objectid);

		$this->folder->setTimestamp();
    }
}
