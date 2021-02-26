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
		$description = $this->request->getText('description');
        $filename    = $this->request->getText('filename'   );
        $name        = $this->request->getText('name'   );

		$url = new Url();
		$url->filename       = BaseObject::urlify( $name );
		$url->parentid       = $this->folder->objectid;
		$url->projectid      = $this->folder->projectid;

		$url->url            = $this->request->getText('url');

		$url->persist();
		$url->setNameForAllLanguages( $name,$description );

		$this->addNoticeFor( $url, Messages::ADDED );
		$this->setTemplateVar('objectid',$url->objectid);

		$this->folder->setTimestamp();
    }
}
