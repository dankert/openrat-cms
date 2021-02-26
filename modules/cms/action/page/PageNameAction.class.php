<?php
namespace cms\action\page;
use cms\action\Method;
use cms\action\object\ObjectInfoAction;
use cms\action\object\ObjectNameAction;
use cms\action\PageAction;
use cms\model\BaseObject;
use cms\model\Project;
use language\Messages;

class PageNameAction extends PageAction implements Method {


    public function view() {

		$languageId = $this->request->getText('languageid');

		$name = $this->page->getNameForLanguage($languageId);

        $this->setTemplateVars( $name->getProperties() );

        $alias = $this->page->getAliasForLanguage( $languageId );

        $this->setTemplateVar( 'alias_filename', $alias->filename );
        $this->setTemplateVar( 'alias_folderid', $alias->parentid );

        $project = Project::create( $this->page->projectid );
        $this->setTemplateVar( 'folders' , $project->getAllFlatFolders() );
    }


    public function post() {

		$parentAction = new ObjectNameAction();
		$parentAction->request = $this->request;
		$parentAction->init();
		$parentAction->post(); // Save name and description

        $alias = $this->page->getAliasForLanguage( $this->request->getLanguageId() );

        $alias->filename = BaseObject::urlify( $this->request->getText( 'alias_filename') );
        $alias->parentid = $this->request->getNumber('alias_folderid');

        // If no alias, remove the alias
        if   ( ! $alias->filename ) {

            $alias->delete();
			$this->addNoticeFor( $alias,Messages::DELETED);
        }
        else
        {
            $alias->persist();
			$this->addNoticeFor( $alias,Messages::SAVED);
        }

    }
}
