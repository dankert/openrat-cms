<?php
namespace cms\action\url;
use cms\action\Method;
use cms\action\UrlAction;


class UrlEditAction extends UrlAction implements Method {
    public function view() {
		$this->setTemplateVars( $this->url->getProperties() );

		// Typ der Verknuepfung
		$this->setTemplateVar('type'            ,$this->url->getType()     );
		$this->setTemplateVar('url'             ,$this->url->url           );
    }
    public function post() {
    }
}
