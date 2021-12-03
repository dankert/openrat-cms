<?php
namespace cms\action\projectlist;
use cms\action\Action;
use cms\action\Method;
use cms\action\ProjectlistAction;
use cms\model\BaseObject;
use cms\model\Permission;
use cms\model\Project;

class ProjectlistHistoryAction extends ProjectlistAction implements Method {


	/**
	 * History of a project.
	 */
	public function view() {

		$result = Project::getAllLastChanges();

		// Permission check
		$result = array_filter( $result, function( $object ) {
			$baseObject = new BaseObject($object['objectid']);
			return $baseObject->hasRight( Permission::ACL_READ );
		});

		$this->setTemplateVar('timeline', $result);
    }


    public function post() {
		throw new \BadMethodCallException();
    }


	/**
	 * Check permission. This is allowed to all users.
	 * @return bool true
	 */
	function checkAccess()
	{
		return true;
	}
}
