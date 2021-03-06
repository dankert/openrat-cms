<?php
namespace cms\action\project;
use cms\action\Action;
use cms\action\Method;
use cms\action\ProjectAction;
use cms\model\BaseObject;
use cms\model\Permission;

class ProjectHistoryAction extends ProjectAction implements Method {

	public $security = Action::SECURITY_GUEST;

	public function view() {
		$result = $this->project->getLastChanges();

		// Permission check
		$result = array_filter( $result, function( $object ) {
			$baseObject = new BaseObject($object['objectid']);
			return $baseObject->hasRight( Permission::ACL_READ );
		});

		$this->setTemplateVar('timeline', $result);
    }
    public function post() {
    }
}
