<?php

namespace cms\action;

use cms\model\Permission;
use cms\model\BaseObject;
use cms\model\File;
use cms\model\Folder;
use cms\model\Group;
use cms\model\Language;
use cms\model\Link;
use cms\model\Page;
use cms\model\Project;
use cms\model\User;
use language\Messages;
use util\ArrayUtils;
use util\exception\SecurityException;
use util\exception\ValidationException;
use util\Http;
use util\Session;


/**
 * Basis-Action-Klasse zum Bearbeiten des Basis-Objektes.
 * @author Jan Dankert
 */

class ObjectAction extends BaseAction
{
	private $objectid;

    /**
     * @var BaseObject
     */
	protected $baseObject;

	public function __construct()
    {
        parent::__construct();

    }


	/**
	 * Should be overwritten by subclasses.
	 *
	 * @return int Permission-flag.
	 */
    public function getRequiredPermission() {
		return Permission::ACL_READ;
	}


    public function init()
    {
		$baseObject = new BaseObject( $this->request->getId() );
		$baseObject->objectLoad();

		$this->setBaseObject( $baseObject );

	}


	protected function setBaseObject( $baseObject ) {

		$this->baseObject = $baseObject;
	}


    /**
     * Stellt fest, ob der angemeldete Benutzer Projekt-Admin ist.
     * Dies ist der Fall, wenn der Benutzer PROP-Rechte im Root-Folder hat.
     * @return bool|int
     */
    protected function userIsProjectAdmin() {

	    $project = new Project( $this->baseObject->projectid );
	    $rootFolder = new Folder( $project->getRootObjectId() );

	    return $rootFolder->hasRight(Permission::ACL_PROP);
    }


    /**
	 * Checks if the current user has sufficient rights.
	 *
	 * If not, an exception is thrown.
	 *
     * @return bool
     */
    public function checkAccess() {

		$requiredPermission = $this->getRequiredPermission();

		if   ( ! $this->baseObject->hasRight($requiredPermission) )
	    	throw new SecurityException('User has insufficient permissions ('.$requiredPermission.')' );
    }
}