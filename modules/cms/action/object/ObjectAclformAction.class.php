<?php
namespace cms\action\object;
use cms\action\Action;
use cms\action\Method;
use cms\action\ObjectAction;
use cms\action\RequestParams;
use cms\model\Permission;
use cms\model\BaseObject;
use cms\model\Folder;
use cms\model\Group;
use cms\model\Project;
use cms\model\User;
use language\Messages;

class ObjectAclformAction extends ObjectAction implements Method {
    public function view() {
		$o = new BaseObject( $this->request->getId() );
		$o->objectLoadRaw();

		$this->setTemplateVars( $o->getAssocRelatedAclTypes() );
		$this->setTemplateVar( 'show',$o->getRelatedAclTypes() );

		$this->setTemplateVar('users'    ,User::listAll()   );
		$this->setTemplateVar('groups'   ,Group::getAll()   );

		$languages = array(0=>\cms\base\Language::lang('ALL_LANGUAGES'));

		$project = new Project( $this->baseObject->projectid );

		$languages += $project->getLanguages();
		$this->setTemplateVar('languages',$languages       );
		$this->setTemplateVar('objectid' ,$o->objectid     );
		$this->setTemplateVar('action'   ,$this->request->action);
    }
    public function post() {
		$permission = new Permission();

		$permission->objectid = $this->request->getId();
		
		// Nachschauen, ob der Benutzer ueberhaupt berechtigt ist, an
		// diesem Objekt die ACLs zu aendern.
		$o = new BaseObject( $permission->objectid );

		if	( !$o->hasRight( Permission::ACL_GRANT ) )
			throw new \util\exception\SecurityException('Not allowed to insert permissions.'); // Scheiss Hacker ;)
		
		// Handelt es sich um eine Benutzer- oder Gruppen ACL?
		switch( $this->request->getText('type') )
		{
			case 'user':
				$permission->userid  = $this->request->getText('userid' );
				
				if	( $permission->userid <= 0 )
				{
					$this->addValidationError('type'     );
					$this->addValidationError('userid','');
					return;
				}
				break;
			case 'group':
				$permission->groupid = $this->request->getText('groupid');
				if	( $permission->groupid <= 0 )
				{
					$this->addValidationError('type'      );
					$this->addValidationError('groupid','');
					return;
				}
				break;
			case 'all':
				break;
			default:
				$this->addValidationError('type');
				return;
		}

		$permission->languageid    = $this->request->getLanguageId();

		$permission->write         = ( $this->request->has('write'        ) );
		$permission->prop          = ( $this->request->has('prop'         ) );
		$permission->delete        = ( $this->request->has('delete'       ) );
		$permission->release       = ( $this->request->has('release'      ) );
		$permission->publish       = ( $this->request->has('publish'      ) );
		$permission->create_folder = ( $this->request->has('create_folder') );
		$permission->create_file   = ( $this->request->has('create_file'  ) );
		$permission->create_link   = ( $this->request->has('create_link'  ) );
		$permission->create_page   = ( $this->request->has('create_page'  ) );
		$permission->grant         = ( $this->request->has('grant'        ) );
		$permission->transmit      = ( $this->request->has('transmit'     ) );

		$permission->persist();

		// Falls die Berechtigung vererbbar ist, dann diese sofort an
		// Unterobjekte vererben.
		if	( $permission->transmit )
		{
			$folder = new Folder( $permission->objectid );
			$oids = $folder->getObjectIds();
			foreach( $folder->getAllSubfolderIds() as $sfid )
			{
				$subfolder = new Folder( $sfid );
				$oids = array_merge($oids,$subfolder->getObjectIds());
			}
			
			foreach( $oids as $oid )
			{
				$permission->aclid = null;
				$permission->objectid = $oid;
				$permission->persist();
			}
		}
		
		
		
		
		$this->addNoticeFor( $this->baseObject,Messages::ADDED);
		
		$o->setTimestamp();
    }
}
