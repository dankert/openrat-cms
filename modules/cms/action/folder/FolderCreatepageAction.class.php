<?php
namespace cms\action\folder;
use cms\action\Action;
use cms\action\FolderAction;
use cms\action\Method;
use cms\model\BaseObject;
use cms\model\Page;
use cms\model\Project;
use language\Messages;


class FolderCreatepageAction extends FolderAction implements Method {


    public function view() {
        $project = new Project( $this->folder->projectid );

        $all_templates = $project->getTemplates();
		$this->setTemplateVar('templates' ,$all_templates          );
		$this->setTemplateVar('objectid'  ,$this->folder->objectid );

		if	( count($all_templates) == 0 )
			$this->addNotice('folder', 0, $this->folder->name, 'NO_TEMPLATES_AVAILABLE', Action::NOTICE_WARN);
    }


    public function post() {
		$name    = $this->getRequestVar('name'   );
		$filename    = $this->getRequestVar('filename'   );
		$description = $this->getRequestVar('description');

		$page = new Page();
		$page->filename   = BaseObject::urlify( $name );
		$page->templateid = $this->getRequestVar('templateid');
		$page->parentid   = $this->folder->objectid;
		$page->projectid  = $this->folder->projectid;


		$page->persist();
		$page->setNameForAllLanguages( $name,$description );

		$this->addNoticeFor( $page, Messages::ADDED );
		$this->setTemplateVar('objectid',$page->objectid);

		$this->folder->setTimestamp();
    }
}
