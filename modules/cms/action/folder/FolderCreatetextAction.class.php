<?php
namespace cms\action\folder;
use cms\action\FolderAction;
use cms\action\Method;
use cms\model\BaseObject;
use cms\model\Permission;
use cms\model\Text;
use language\Messages;
use util\exception\ValidationException;
use util\Http;
use util\Upload;


class FolderCreatetextAction extends FolderAction implements Method {
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

		$name        = $this->request->getText('name'       );
		$description = $this->request->getText('description');

		$text   = new Text();
		$text->parentid  = $this->folder->objectid;
		$text->projectid = $this->folder->projectid;

		// Die neue Datei wird über eine URL geladen und dann im CMS gespeichert.
		$this->request->handleText('url', function($url) use ($text)
		{
			$http = new Http();
			$http->setUrl( $url );

			$ok = $http->request();

			if	( !$ok )
			{
				//$this->addNotice($http->error);
				// TODO: What to do with $http->error ?
				throw new ValidationException('url',Messages::COMMON_VALIDATION_ERROR);
			}

			$text->filename  = BaseObject::urlify( basename($url) );
			$text->size      = strlen($http->body);
			$text->value     = $http->body;
		});

		$this->request->handleText('text',function($value) use ($text) {
			$text->filename  = $this->request->getRequiredText('filename' );
			$text->extension = $this->request->getRequiredText('extension');
			$text->value     = $this->request->getRequiredText('text'     );
			$text->size      = strlen( $text->value );
		});

		$upload = new Upload();

		if   ( $upload->isAvailable() ) {

			try
			{
				$upload->processUpload();
			}
			catch( \Exception $e )
			{
				// TODO: make a UIException?
				throw $e;
			}

			$text->filename  = BaseObject::urlify( $upload->filename );
			$text->extension = $upload->extension;
			$text->size      = $upload->size;

			$text->value     = $upload->value;
		}

		$text->persist(); // Datei hinzufuegen
        $text->setNameForAllLanguages( $name,$description );

		$this->addNoticeFor($text, Messages::ADDED);
		$this->setTemplateVar('objectid',$text->objectid);

		$this->folder->setTimestamp();
    }
}
