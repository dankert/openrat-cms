<?php
namespace cms\action\object;
use cms\action\Action;
use cms\action\Method;
use cms\action\ObjectAction;
use cms\model\Acl;
use cms\model\BaseObject;
use util\Http;

class ObjectDelaclAction extends ObjectAction implements Method {
    public function view() {
    }
    public function post() {
		$acl = new Acl($this->getRequestVar('aclid'));
		$acl->load();

		// Nachschauen, ob der Benutzer ueberhaupt berechtigt ist, an
		// diesem Objekt die ACLs zu aendern.
		$o = new BaseObject( $acl->objectid );

		if	( !$o->hasRight( Acl::ACL_GRANT ) )
			Http::notAuthorized('no grant rights'); // Da wollte uns wohl einer vereimern.

		$acl->delete(); // Weg mit der ACL
		
		$this->addNotice('', 0, '', 'DELETED', Action::NOTICE_OK);
    }
}
