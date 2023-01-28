<?php
namespace cms\action\folder;
use cms\action\FolderAction;
use cms\action\Method;
use cms\model\BaseObject;
use cms\model\Permission;
use cms\model\Script;
use cms\model\Text;
use language\Messages;
use util\exception\ValidationException;
use util\Http;
use util\Upload;


class FolderCreatescriptAction extends FolderAction implements Method {
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

		$script   = new Script();
		$script->parentid  = $this->folder->objectid;
		$script->projectid = $this->folder->projectid;

		$this->request->handleText('text',function($value) use ($script) {
			$script->filename  = $this->request->getRequiredText('filename' );
			$script->extension = $this->request->getRequiredText('extension');
			$script->value     = $this->request->getRequiredText('text'     );
			$script->size      = strlen( $script->value );
		});


		$script->persist(); // Datei hinzufuegen
		$script->setNameForAllLanguages( $name,$description );

		$this->addNoticeFor($script, Messages::ADDED);
		$this->setTemplateVar('objectid',$script->objectid);

		$this->folder->setTimestamp();
	}
}
