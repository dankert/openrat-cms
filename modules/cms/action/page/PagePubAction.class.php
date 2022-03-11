<?php
namespace cms\action\page;
use cms\action\Method;
use cms\action\PageAction;
use cms\generator\PageContext;
use cms\generator\PageGenerator;
use cms\generator\Producer;
use cms\generator\Publisher;
use cms\generator\PublishOrder;
use cms\model\Page;
use cms\model\Permission;
use cms\model\Template;
use language\Messages;
use util\exception\PublisherException;
use util\Session;

class PagePubAction extends PageAction implements Method {
	public function getRequiredPermission() {
		return Permission::ACL_PUBLISH;
	}

	public function view() {

	}
    public function post() {

		if	( !$this->page->hasRight( Permission::ACL_PUBLISH ) )
            throw new \util\exception\SecurityException( 'no right for publish' );

		$project = $this->page->getProject();

		$template = new Template( $this->page->templateid );
		$template->load();

		if   ( ! $template->publish ) {
			$this->addWarningFor( $this->page,Messages::NOPUBLISH );
			return;
		}

		// Nothing is written to the session from this point. so we should free the session.
		Session::close();

		$publisher = new Publisher( $project->projectid );

		foreach( $project->getModelIds() as $modelId ) {

			foreach( $project->getLanguageIds() as $languageId ) {

				$pageContext = new PageContext( $this->page->objectid, Producer::SCHEME_PUBLIC );
				$pageContext->modelId    = $modelId;
				$pageContext->languageId = $languageId;

				$pageGenerator = new PageGenerator( $pageContext );

				$publisher->addOrderForPublishing( new PublishOrder( $pageGenerator->getCache()->load()->getFilename(),$pageGenerator->getPublicFilename(), $this->page->lastchangeDate ) );
			}
		}

		try {
			$publisher->publish();
			$this->page->setPublishedTimestamp();

			$this->addNoticeFor( $this->page,
				'PUBLISHED',
				array(),
				implode("\n",$publisher->getDestinationFilenames() )
			);
		} catch( PublisherException $e ) {
			$this->addErrorFor( $this->page,Messages::PUBLISHED_ERROR,[],$e->getMessage() );
		}
    }
}
