<?php
namespace cms\action\page;
use cms\action\Method;
use cms\action\PageAction;
use cms\action\RequestParams;
use cms\generator\link\PreviewLink;
use cms\generator\PageContext;
use cms\generator\Producer;
use util\Html;

class PagePreviewAction extends PageAction {


	/**
	 * Calculates the URL for the page preview
	 */
    public function view() {

	    $this->setModelAndLanguage();

		$linkFormat = new PreviewLink( $this->createPageContext(Producer::SCHEME_PREVIEW)  );
		$this->setTemplateVar('preview_url',$linkFormat->linkToObject($this->page,$this->page) );
    }

}
