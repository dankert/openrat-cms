<?php
namespace cms\action\language;
use cms\action\LanguageAction;
use cms\action\Method;


class LanguageRemoveAction extends LanguageAction implements Method {
    public function view() {
		$this->setTemplateVar('name'   ,$this->language->name   );
    }
    public function post() {
		if   ( $this->request->getText('confirm') == '1' )
			$this->language->delete();
    }
}
