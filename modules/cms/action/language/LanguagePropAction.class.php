<?php
namespace cms\action\language;
use cms\action\Action;
use cms\action\LanguageAction;
use cms\action\Method;
use cms\base\Configuration;
use language\Messages;


class LanguagePropAction extends LanguageAction implements Method {

    public function view() {
		$this->setTemplateVar('isocode'   ,$this->language->isoCode   );
		$this->setTemplateVar('name'      ,$this->language->name      );
		$this->setTemplateVar('is_default',$this->language->isDefault );
    }


    public function post() {

		if	( $name = $this->request->getText('name') )
		{
			$this->language->name    = $name;
			$this->language->isoCode = $this->request->getText('isocode');
		}
		else
		{
			$countries = Configuration::subset('countries');
			$iso = $this->request->getText('isocode');
			$this->language->name    = $countries->get($iso,$iso);
			$this->language->isoCode = strtolower( $iso );
		}

		if  ( $this->request->isTrue('is_default') )
		    $this->language->setDefault();
		
		$this->language->save();

        $this->addNoticeFor($this->language,Messages::DONE);
    }
}
