<?php
namespace cms\action\pageelement;
use cms\action\Action;
use cms\action\Method;
use cms\action\PageelementAction;
use cms\model\Element;
use cms\model\Permission;
use cms\model\Value;
use language\Messages;

class PageelementRestoreAction extends PageelementAction implements Method {

	protected function getRequiredPagePermission()
	{
		return Permission::ACL_WRITE;
	}


    public function view() {
    }

    public function post() {
		$valueId = $this->request->getRequiredNumber('valueid');

		$this->ensureValueIdIsInAnyContent( $valueId );

		$value = new Value();
		$value->loadWithId( $valueId );

		// Restore value.
		$value->valueid = null;
		$value->publish = false;
		$value->persist();

		$this->addNoticeFor( $this->page,Messages::PAGEELEMENT_USE_FROM_ARCHIVE );

    }
}
