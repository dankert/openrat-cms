<?php
namespace cms\action\pageelement;
use cms\action\Method;
use cms\action\PageelementAction;
use cms\model\Acl;
use language\Messages;
use LogicException;
use util\exception\SecurityException;

class PageelementReleaseAction extends PageelementAction implements Method {
    public function view() {
    }
    public function post() {
		$this->value->objectid   = $this->page->objectid;
		$this->value->pageid     = $this->page->pageid;
		$this->value->page       = $this->page;
		$this->value->element    = &$this->element;
		$this->value->elementid  = $this->element->elementid;
		$this->value->element->load();

        $this->value->valueid = intval($this->getRequestVar('valueid'));
        $this->value->loadWithId();

        if	( $this->value->pageid != $this->page->pageid )
            throw new LogicException( 'cannot release, bad page' );

        // Pruefen, ob Berechtigung zum Freigeben besteht
        if	( !$this->page->hasRight(Acl::ACL_RELEASE) )
            throw new SecurityException( 'Cannot release','no right' );

        // Inhalt freigeben
        $this->value->release();

        $this->addNoticeFor($this->value, Messages::PAGEELEMENT_RELEASED );
    }
}
