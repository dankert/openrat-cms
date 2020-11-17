<?php
namespace cms\action\page;
use cms\action\Method;
use cms\action\PageAction;
use cms\model\BaseObject;
use cms\model\Project;

class PageNameAction extends PageAction implements Method {
    public function view() {
		$languageId = $this->getRequestVar('languageid');

		$name = $this->page->getNameForLanguage($languageId);

        $this->setTemplateVars( $name->getProperties() );

        $alias = $this->page->getAliasForLanguage( $languageId );

        $this->setTemplateVar( 'alias_filename', $alias->filename );
        $this->setTemplateVar( 'alias_folderid', $alias->parentid );

        $project = Project::create( $this->page->projectid );
        $this->setTemplateVar( 'folders' , $project->getAllFlatFolders() );
    }
    public function post() {

	    parent::namePost(); // Save name and description

        $alias = $this->page->getAliasForLanguage( $this->getRequestId('languageid'));

        $alias->filename = BaseObject::urlify( $this->getRequestVar( 'alias_filename') );
        $alias->parentid = $this->getRequestId('alias_folderid');

        // If no alias, remove the alias
        if   ( ! $alias->filename ) {

            $alias->delete();
            $this->addNotice($alias->getType(), 0, '', 'DELETED', 'ok');
        }
        else
        {
            $alias->save();
            $this->addNotice($alias->getType(), 0, $alias->filename, 'SAVED', 'ok');
        }

    }
}
