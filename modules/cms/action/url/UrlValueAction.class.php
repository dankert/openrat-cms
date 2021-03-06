<?php
namespace cms\action\url;
use cms\action\Method;
use cms\action\UrlAction;
use cms\model\Permission;
use language\Messages;


class UrlValueAction extends UrlAction implements Method {

	public function getRequiredPermission() {
		return Permission::ACL_WRITE;
	}


	public function view() {
		$this->setTemplateVars( $this->url->getProperties() );

		// Typ der Verknuepfung
		$this->setTemplateVar('type'            ,$this->url->getType()     );
		$this->setTemplateVar('url'             ,$this->url->url           );
    }


    public function post() {
        $this->url->url = $this->request->getText('url');
        $this->url->save();

        $this->addNoticeFor( $this->url,Messages::SAVED );
    }
}
