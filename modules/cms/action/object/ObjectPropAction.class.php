<?php
namespace cms\action\object;
use cms\action\Method;
use cms\action\ObjectAction;
use cms\action\RequestParams;
use cms\model\BaseObject;
use cms\model\Permission;
use cms\model\Project;
use language\Messages;
use util\exception\ValidationException;


class ObjectPropAction extends ObjectAction implements Method {

	public function getRequiredPermission()
	{
		return Permission::ACL_PROP;
	}

	public function view() {
        $this->setTemplateVar( 'filename', $this->baseObject->filename   );
        $alias = $this->baseObject->getAliasForLanguage(null );
        $this->setTemplateVar( 'alias_filename', $alias->filename );
        $this->setTemplateVar( 'alias_folderid', $alias->parentid );

        $project = Project::create( $this->baseObject->projectid );
        $this->setTemplateVar( 'folders' , $project->getAllFlatFolders() );
    }


    public function post() {

        if   ( ! $this->request->has('filename' ) )
            throw new ValidationException('filename');

        $this->baseObject->filename = BaseObject::urlify( $this->request->getText('filename') );
        $this->baseObject->save();

        $alias = $this->baseObject->getAliasForLanguage(null);
        $alias->filename = BaseObject::urlify( $this->request->getText( 'alias_filename') );
        $alias->parentid = $this->request->getNumber('alias_folderid');

        // If no alias, remove the alias
        if   ( ! $alias->filename )
                $alias->delete();
        else
                $alias->persist();


        // Should we do this?
        if	( $this->request->has('creationTimestamp') && $this->userIsAdmin() )
            $this->baseObject->createDate = $this->request->getNumber('creationTimestamp');
        $this->baseObject->setCreationTimestamp();


		$this->addNoticeFor( $this->baseObject,Messages::PROP_SAVED);
    }
}
