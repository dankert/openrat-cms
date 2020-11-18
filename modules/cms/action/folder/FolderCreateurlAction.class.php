<?php
namespace cms\action\folder;
use cms\action\FolderAction;
use cms\action\Method;
use cms\model\BaseObject;
use cms\model\Url;
use language\Messages;


class FolderCreateurlAction extends FolderAction implements Method {
    public function view() {
    }
    public function post() {
		$description = $this->getRequestVar('description');
        $filename    = $this->getRequestVar('filename'   );
        $name        = $this->getRequestVar('name'   );

		$url = new Url();
		$url->filename       = BaseObject::urlify( $name );
		$url->parentid       = $this->folder->objectid;
		$url->projectid      = $this->folder->projectid;

		$url->url            = $this->getRequestVar('url');

		$url->persist();
		$url->setNameForAllLanguages( $name,$description );

		$this->addNoticeFor( $url, Messages::ADDED );
		$this->setTemplateVar('objectid',$url->objectid);

		$this->folder->setTimestamp();
    }
}
