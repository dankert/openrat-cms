<?php

namespace cms\action;

use cms\model\Permission;
use cms\model\Folder;
use cms\model\Project;
use cms\model\Tag;
use util\exception\SecurityException;

/**
 * Tag.
 *
 * @author Jan Dankert
 */
class TagAction extends BaseAction
{
    /**
     * @var Tag
     */
	protected $tag;


	function __construct()
	{
        parent::__construct();
    }


    public function init()
    {
		$this->tag = new Tag( $this->request->getId() );
		$this->tag->load();

		if   ( ! $this->userMayReadProject() ) {
			throw new SecurityException();
		}
	}



	/**
	 * Stellt fest, ob der angemeldete Benutzer Projekt-Admin ist.
	 * Dies ist der Fall, wenn der Benutzer PROP-Rechte im Root-Folder hat.
	 * @return bool|int
	 */
	protected function userMayReadProject() {

		$project = Project::create( $this->tag->projectid );
		$rootFolder = new Folder( $project->getRootObjectId() );

		return $rootFolder->hasRight(Permission::ACL_READ);
	}





	/**
	 * User must be an administrator.
	 */
	public function checkAccess() {
		if   ( ! $this->userMayReadProject() )
			throw new SecurityException();
	}

}