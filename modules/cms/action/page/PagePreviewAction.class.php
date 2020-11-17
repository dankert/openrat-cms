<?php
namespace cms\action\page;
use cms\action\Method;
use cms\action\PageAction;
use cms\action\RequestParams;
use util\Html;

class PagePreviewAction extends PageAction implements Method {
    public function view() {
	    $this->setModelAndLanguage();

		$this->setTemplateVar('preview_url',Html::url('page','show',$this->page->objectid,array(RequestParams::PARAM_LANGUAGE_ID=>$this->page->getProject()->getDefaultLanguageId(),RequestParams::PARAM_MODEL_ID=>$this->page->getProject()->getDefaultModelId()) ) );
    }
    public function post() {
    }
}
