<?php
namespace cms\action\folder;
use cms\action\FolderAction;
use cms\action\Method;
use cms\model\Folder;
use cms\model\Project;


class FolderRootAction extends FolderAction implements Method {

    public function view() {
        $project = new Project($this->folder->projectid);
        $rootFolder = new Folder( $project->getRootObjectId() );
		$rootFolder->load();

		$this->setTemplateVar('rootfolderid'  ,$rootFolder->id  );
		$this->setTemplateVar('rootfoldername',$rootFolder->filename );
    }


    public function post() {
    }
}
