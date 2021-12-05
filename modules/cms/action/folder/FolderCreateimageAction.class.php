<?php
namespace cms\action\folder;
use cms\action\FolderAction;
use cms\action\Method;
use cms\model\BaseObject;
use cms\model\Image;
use cms\model\Permission;
use language\Messages;
use util\exception\ValidationException;
use util\Http;
use util\Upload;


class FolderCreateimageAction extends FolderAction implements Method {
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

		$image       = new Image();

		// Die neue Datei wird über eine URL geladen und dann im CMS gespeichert.
		if	( $this->request->has('url') )
		{
			$url = $this->request->getText('url');
			$http = new Http();
			$http->setUrl( $url );

			$ok = $http->request();

			if	( !$ok )
			{
				$this->addWarningFor( $this->folder,Messages::COMMON_VALIDATION_ERROR,[],$http->error);
				throw new ValidationException( 'url' );
			}

			$image->filename  = BaseObject::urlify( basename($url) );
			$image->size      = strlen($http->body);
			$image->value     = $http->body;
			$image->parentid  = $this->folder->objectid;
		}
		else
		{
			$upload = new Upload();

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

            $image->filename  = BaseObject::urlify( $upload->filename );
            $image->extension = $upload->extension;
            $image->size      = $upload->size;
            $image->parentid  = $this->folder->objectid;
            $image->projectid = $this->folder->projectid;

            $image->value     = $upload->value;
		}

		$image->persist(); // Datei hinzufuegen
		$this->addNoticeFor( $image, Messages::ADDED );
        $image->setNameForAllLanguages( $name,$description );
		$this->setTemplateVar('objectid',$image->objectid);

		$this->folder->setTimestamp();
    }
}
