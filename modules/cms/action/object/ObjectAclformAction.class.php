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
use util\exception\ValidationException;

class ObjectAclformAction extends ObjectAction implements Method {
	public function getRequiredPermission()
	{
		return Permission::ACL_GRANT;
	}

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
		
		// Handelt es sich um eine Benutzer- oder Gruppen ACL?
		switch( $this->request->getText('type') )
		{
			case 'user':
				$permission->userid  = $this->request->getRequiredNumber('userid' );
				$permission->type    = Permission::TYPE_USER;

				break;
			case 'group':
				$permission->groupid = $this->request->getRequiredNumber('groupid');
				$permission->type    = Permission::TYPE_GROUP;
				break;
			case 'all':
				$permission->type    = Permission::TYPE_AUTH;
				break;
			case 'guest':
				$permission->type    = Permission::TYPE_GUEST;
				break;
			default:
				throw new ValidationException('type');
		}

		$permission->languageid    = $this->request->getLanguageId();

		$permission->write         = ( $this->request->isTrue('write'        ) );
		$permission->prop          = ( $this->request->isTrue('prop'         ) );
		$permission->delete        = ( $this->request->isTrue('delete'       ) );
		$permission->release       = ( $this->request->isTrue('release'      ) );
		$permission->publish       = ( $this->request->isTrue('publish'      ) );
		$permission->create_folder = ( $this->request->isTrue('create_folder') );
		$permission->create_file   = ( $this->request->isTrue('create_file'  ) );
		$permission->create_link   = ( $this->request->isTrue('create_link'  ) );
		$permission->create_page   = ( $this->request->isTrue('create_page'  ) );
		$permission->grant         = ( $this->request->isTrue('grant'        ) );
		$permission->transmit      = ( $this->request->isTrue('transmit'     ) );

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
		
		$this->baseObject->setTimestamp();
    }
}
