<?php
namespace cms\action\text;
use cms\action\Method;
use cms\action\RequestParams;
use cms\action\TextAction;
use language\Messages;


class TextValueAction extends TextAction implements Method {
    public function view() {
		$this->setTemplateVar( 'text', $this->text->loadValue() );

		parent::valueView();
    }

    public function post() {
		$this->text->value = $this->getRequestVar('text', RequestParams::FILTER_RAW);
		$this->text->saveValue();

		$this->addNoticeFor($this->text,Messages::VALUE_SAVED);
		$this->text->setTimestamp();
    }
}
