<?php
namespace cms\action\pageelement;
use cms\action\Method;
use cms\action\PageelementAction;
use cms\generator\Producer;
use cms\generator\ValueGenerator;

class PageelementPreviewAction extends PageelementAction implements Method {
    public function view() {
		$valueGenerator = new ValueGenerator( $this->createValueContext( Producer::SCHEME_PREVIEW) );
		$this->setTemplateVar('preview' ,$valueGenerator->getCache()->get() );
    }
    public function post() {
    }
}
