<?php
namespace cms\action\template;
use cms\action\Action;
use cms\action\Method;
use cms\action\PageelementAction;
use cms\action\TemplateAction;
use cms\model\Content;
use cms\model\Element;
use cms\model\Permission;
use cms\model\Project;
use cms\model\TemplateModel;
use cms\model\Value;
use language\Messages;
use util\exception\SecurityException;

class TemplateRestoreAction extends TemplateAction implements Method {

	public function getRequiredPermission()
	{
		return Permission::ACL_WRITE;
	}


	public function view() {
	}

	public function post() {

		$valueId = $this->request->getRequiredNumber('valueid');

		$this->ensureValueIdIsInAnyTemplate( $valueId );

		$value = new Value();
		$value->valueid = $valueId;
		$value->loadWithId( $value->valueid );

		// Restore value.
		$value->valueid = null;
		$value->publish = false;
		$value->persist();

		$this->addNoticeFor( $this->template,Messages::PAGEELEMENT_USE_FROM_ARCHIVE );
    }
}
