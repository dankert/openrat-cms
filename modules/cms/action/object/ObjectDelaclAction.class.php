<?php
namespace cms\action\object;
use cms\action\Action;
use cms\action\Method;
use cms\action\ObjectAction;
use cms\model\Permission;
use cms\model\BaseObject;
use language\Messages;
use util\Http;

class ObjectDelaclAction extends ObjectAction implements Method {

	public function getRequiredPermission()
	{
		return Permission::ACL_GRANT;
	}

    public function view() {
    }
    public function post() {
		$permission = new Permission($this->request->getText('aclid'));
		$permission->load();

		// Nachschauen, ob der Benutzer ueberhaupt berechtigt ist, an
		// diesem Objekt die ACLs zu aendern.
		$o = new BaseObject( $permission->objectid );
		$o->load();

		if	( !$o->hasRight( Permission::ACL_GRANT ) )
			Http::notAuthorized('no grant rights'); // Da wollte uns wohl einer vereimern.

		$permission->delete(); // Weg mit der ACL
		
		$this->addNoticeFor( $o,Messages::DELETED );
    }
}
