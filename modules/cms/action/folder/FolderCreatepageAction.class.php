<?php
namespace cms\action\folder;
use cms\action\Action;
use cms\action\FolderAction;
use cms\action\Method;
use cms\model\BaseObject;
use cms\model\Page;
use cms\model\Permission;
use cms\model\Project;
use language\Messages;
use util\exception\ValidationException;


class FolderCreatepageAction extends FolderAction implements Method {

	public function getRequiredPermission() {
		return Permission::ACL_CREATE_PAGE;
	}



	public function view() {
        $project = new Project( $this->folder->projectid );

        $all_templates = $project->getTemplates();
		$this->setTemplateVar('templates' ,$all_templates          );
		$this->setTemplateVar('objectid'  ,$this->folder->objectid );

		if	( count($all_templates) == 0 )
			$this->addWarningFor($this->folder,Messages::NO_TEMPLATES_AVAILABLE );
    }


    public function post() {
		$name    = $this->request->getText('name'   );
		$filename    = $this->request->getText('filename'   );
		$description = $this->request->getText('description');

		$page = new Page();
		$page->filename   = BaseObject::urlify( $name );
		$page->templateid = $this->request->getRequiredNumber('templateid');

		$page->parentid   = $this->folder->objectid;
		$page->projectid  = $this->folder->projectid;


		$page->persist();
		$page->setNameForAllLanguages( $name,$description );

		$this->addNoticeFor( $page, Messages::ADDED );
		$this->setTemplateVar('objectid',$page->objectid);

		$this->folder->setTimestamp();
    }
}
