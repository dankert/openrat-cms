<?php
namespace cms\action\pageelement;
use cms\action\Method;
use cms\action\PageelementAction;
use cms\model\Acl;
use util\exception\SecurityException;

class PageelementPubAction extends PageelementAction implements Method {
    public function view() {
    }
    public function post() {
		if	( !$this->page->hasRight( Acl::ACL_PUBLISH ) )
            throw new SecurityException( 'no right for publish' );

		$this->publishPage();
    }
}
