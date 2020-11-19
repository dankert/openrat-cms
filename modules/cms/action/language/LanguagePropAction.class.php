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
		if	( $this->hasRequestVar('name') )
		{
			$this->language->name    = $this->getRequestVar('name'   );
			$this->language->isoCode = $this->getRequestVar('isocode');
		}
		else
		{
			$countries = Configuration::subset('countries');
			$iso = $this->getRequestVar('isocode');
			$this->language->name    = $countries->get($iso,$iso);
			$this->language->isoCode = strtolower( $iso );
		}

		if  ( $this->hasRequestVar('is_default') )
		    $this->language->setDefault();
		
		$this->language->save();

        $this->addNoticeFor($this->language,Messages::DONE);
    }
}
