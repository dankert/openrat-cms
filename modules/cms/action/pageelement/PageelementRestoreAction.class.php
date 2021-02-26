<?php
namespace cms\action\pageelement;
use cms\action\Action;
use cms\action\Method;
use cms\action\PageelementAction;
use cms\model\Element;
use language\Messages;

class PageelementRestoreAction extends PageelementAction implements Method {

    public function view() {
    }

    public function post() {
        $this->value->valueid = $this->request->getText('valueid');
        $this->value->loadWithId();
        $this->value->element = new Element( $this->value->elementid );

        if	( $this->value->pageid != $this->page->pageid )
            throw new \LogicException( 'Cannot find value','page-id does not match' );

        // Pruefen, ob Berechtigung zum Freigeben besteht
        //$this->value->release = $this->page->hasRight(Acl::ACL_RELEASE);
        $this->value->release = false;

        // Inhalt wieder herstellen, in dem er neu gespeichert wird.
        $this->value->add();

		$this->addNoticeFor( $this->pageelement,Messages::PAGEELEMENT_USE_FROM_ARCHIVE );
    }
}
