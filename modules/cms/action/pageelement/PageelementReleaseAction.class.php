<?php
namespace cms\action\pageelement;
use cms\action\Method;
use cms\action\PageelementAction;
use cms\model\Permission;
use cms\model\Value;
use language\Messages;
use LogicException;
use util\exception\SecurityException;

class PageelementReleaseAction extends PageelementAction implements Method {


	protected function getRequiredPagePermission()
	{
		return Permission::ACL_RELEASE;
	}


    public function post() {

		$valueId = $this->request->getRequiredNumber('valueid');

		$this->ensureValueIdIsInAnyContent( $valueId );

		$value = new Value();
		$value->valueid = $valueId;
		$value->loadWithId( $value->valueid );

		// Restore value.
		$value->valueid = null;
		$value->publish = true;
		$value->persist();

		$this->addNoticeFor( $this->template,Messages::PAGEELEMENT_RELEASED );
    }
}
