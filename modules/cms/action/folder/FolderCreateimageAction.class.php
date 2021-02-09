<?php
namespace cms\action\folder;
use cms\action\FolderAction;
use cms\action\Method;
use cms\model\BaseObject;
use cms\model\Image;
use language\Messages;
use util\Http;
use util\Upload;


class FolderCreateimageAction extends FolderAction implements Method {
    public function view() {
		// Maximale Dateigroesse.
		$maxSizeBytes = $this->maxFileSize();
		$this->setTemplateVar('max_size' ,($maxSizeBytes/1024).' KB' );
		$this->setTemplateVar('maxlength',$maxSizeBytes );

		$this->setTemplateVar('objectid',$this->folder->objectid );
    }


    public function post() {
		$type        = $this->getRequestVar('type'       );
		$name        = $this->getRequestVar('name'       );
		$filename    = $this->getRequestVar('filename'   );
		$description = $this->getRequestVar('description');

		$image       = new Image();

		// Die neue Datei wird über eine URL geladen und dann im CMS gespeichert.
		if	( $this->hasRequestVar('url') )
		{
			$url = $this->getRequestVar('url');
			$http = new Http();
			$http->setUrl( $url );

			$ok = $http->request();

			if	( !$ok )
			{
				$this->addValidationError('url','COMMON_VALIDATION_ERROR',array(),$http->error);
				return;
			}

			$image->desc      = $description;
			$image->filename  = BaseObject::urlify( basename($url) );
			$image->name      = !empty($name)?$name:basename($url);
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

            $image->desc      = $description;
            $image->filename  = BaseObject::urlify( $upload->filename );
            $image->name      = !empty($name)?$name:$upload->filename;
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