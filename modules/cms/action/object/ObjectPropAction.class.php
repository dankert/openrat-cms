<?php
namespace cms\action\object;
use cms\action\Method;
use cms\action\ObjectAction;
use cms\action\RequestParams;
use cms\model\BaseObject;
use cms\model\Project;
use util\exception\ValidationException;


class ObjectPropAction extends ObjectAction implements Method {

	public function view() {
        $this->setTemplateVar( 'filename', $this->baseObject->filename   );
        $alias = $this->baseObject->getAliasForLanguage(null );
        $this->setTemplateVar( 'alias_filename', $alias->filename );
        $this->setTemplateVar( 'alias_folderid', $alias->parentid );

        $project = Project::create( $this->baseObject->projectid );
        $this->setTemplateVar( 'folders' , $project->getAllFlatFolders() );
    }


    public function post() {
        if   ( ! $this->hasRequestVar('filename' ) )
            throw new ValidationException('filename');

        $this->baseObject->filename = BaseObject::urlify( $this->getRequestVar('filename') );
        $this->baseObject->save();

        $alias = $this->baseObject->getAliasForLanguage(null);
        $alias->filename = BaseObject::urlify( $this->getRequestVar( 'alias_filename') );
        $alias->parentid = $this->getRequestId('alias_folderid');

        // If no alias, remove the alias
        if   ( ! $alias->filename )
                $alias->delete();
        else
                $alias->save();


        // Should we do this?
        if	( $this->hasRequestVar('creationTimestamp') && $this->userIsAdmin() )
            $this->baseObject->createDate = $this->getRequestVar('creationTimestamp',RequestParams::FILTER_NUMBER);
        $this->baseObject->setCreationTimestamp();


        $this->addNotice($this->baseObject->getType(), 0, $this->baseObject->filename, 'PROP_SAVED', 'ok');
    }
}
