<?php
namespace cms\action\template;
use cms\action\Method;
use cms\action\TemplateAction;
use cms\generator\PageContext;
use cms\generator\PageGenerator;
use cms\generator\Producer;
use cms\generator\Publisher;
use cms\generator\PublishOrder;
use cms\model\Permission;
use cms\model\Page;
use cms\model\Project;
use language\Messages;
use util\Session;


class TemplatePubAction extends TemplateAction implements Method {
    public function view() {

    }
    public function post() {

    	$project = Project::create( $this->template->projectid );

    	$languageIds = $project->getLanguageIds();
    	$modelIds    = $project->getModelIds();

		$objectIds = $this->template->getDependentObjectIds();

		Session::close();

		$publisher = new Publisher( $this->template->projectid );

		foreach( $objectIds as $pageId ) {

			$page = new Page( $pageId );
			$page->load();
			$page->setPublishedTimestamp();

			foreach( $modelIds as $modelId ) {
				foreach( $languageIds as $languageId ) {
					$pageContext = new PageContext( $pageId, Producer::SCHEME_PUBLIC );
					$pageContext->modelId    = $modelId;
					$pageContext->languageId = $languageId;

					$pageGenerator = new PageGenerator( $pageContext );

					$publisher->addOrderForPublishing( new PublishOrder( $pageGenerator->getCache()->load()->getFilename(),$pageGenerator->getPublicFilename(), $page->lastchangeDate ) );
				}
			}
		}

		$publisher->publish();

		$this->addNoticeFor( $this->template,Messages::PUBLISHED,[],
			implode("\n",$publisher->getDestinationFilenames() ) );
    }
}
