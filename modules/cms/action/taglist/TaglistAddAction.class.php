<?php
namespace cms\action\taglist;
use cms\action\Action;
use cms\action\Method;
use cms\action\ProjectlistAction;
use cms\action\TaglistAction;
use cms\base\Configuration;
use cms\model\Element;
use cms\model\Folder;
use cms\model\Language;
use cms\model\Model;
use cms\model\Page;
use cms\model\PageContent;
use cms\model\Permission;
use cms\model\Project;
use cms\model\Tag;
use cms\model\Template;
use cms\model\Text;
use cms\model\Value;
use configuration\Config;
use language\Messages;
use util\exception\SecurityException;

class TaglistAddAction extends TaglistAction implements Method {

    public function view() {

    }


	/**
	 * Add a new project.
	 */
    public function post() {

		$name = $this->request->getRequiredText('name');

		$tag = new Tag();
		$tag->name = $name;
		$tag->projectid = $this->project->projectid;
		$tag->persist();

		$this->addNoticeFor( $tag,Messages::ADDED );
    }

	public function checkAccess()
	{
		$rootFolder = new Folder( $this->project->getRootObjectId() );

		if   ( ! $rootFolder->hasRight(Permission::ACL_PROP) )
			throw new SecurityException();
	}
}
