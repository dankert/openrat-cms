<?php
namespace cms\action\page;
use cms\action\Method;
use cms\action\PageAction;
use cms\generator\PageContext;
use cms\generator\PageGenerator;
use cms\generator\Producer;
use cms\model\Project;

class PageSrcAction extends PageAction implements Method {
    public function view() {
		$project = new Project( $this->page->projectid );
		$this->setModelAndLanguage();

		$pageContext = new PageContext( $this->page->objectid,Producer::SCHEME_PUBLIC);
		$pageContext->languageId = $project->getDefaultLanguageId();
		$pageContext->modelId    = $project->getDefaultModelId();

		$generator = new PageGenerator( $pageContext );

		$this->setTemplateVar('src',$generator->getCache()->get() );
    }
    public function post() {
    }
}
