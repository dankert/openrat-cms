<?php
namespace cms\action\page;
use cms\action\Method;
use cms\action\PageAction;
use cms\action\RequestParams;
use util\Html;

class PagePreviewAction extends PageAction implements Method {


	/**
	 * Calculates the URL for the page preview
	 */
    public function view() {

	    $this->setModelAndLanguage();

		$this->setTemplateVar('preview_url',Html::url('page','show',$this->page->objectid,array(
			RequestParams::PARAM_OUTPUT      => 'preview',
			RequestParams::PARAM_LANGUAGE_ID => $this->page->getProject()->getDefaultLanguageId(),
			RequestParams::PARAM_MODEL_ID    => $this->page->getProject()->getDefaultModelId())   ) );
    }


    public function post() {
    }
}
