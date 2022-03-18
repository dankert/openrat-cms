<?php
namespace cms\action\page;
use cms\action\Method;
use cms\action\PageAction;
use cms\generator\PageContext;
use cms\generator\PageGenerator;
use cms\generator\Producer;
use cms\model\Project;

class PageSrcAction extends PageAction  {
    public function view() {
		$project = new Project( $this->page->projectid );
		$this->setModelAndLanguage();

		$pageContext = $this->createPageContext( Producer::SCHEME_PUBLIC );
		$generator   = new PageGenerator( $pageContext );

		$this->setTemplateVar('src',$generator->getCache()->get() );
    }
}
