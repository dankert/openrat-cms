<?php
namespace cms\action\object;
use cms\action\Action;
use cms\action\Method;
use cms\action\ObjectAction;
use cms\action\RequestParams;
use cms\model\Acl;
use cms\model\BaseObject;
use cms\model\Folder;
use cms\model\Group;
use cms\model\Project;
use cms\model\User;

class ObjectAclformAction extends ObjectAction implements Method {
    public function view() {
		$o = new BaseObject( $this->getRequestId() );
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
		$acl = new Acl();

		$acl->objectid = $this->getRequestId();
		
		// Nachschauen, ob der Benutzer ueberhaupt berechtigt ist, an
		// diesem Objekt die ACLs zu aendern.
		$o = new BaseObject( $acl->objectid );

		if	( !$o->hasRight( Acl::ACL_GRANT ) )
			throw new \util\exception\SecurityException('Not allowed to insert permissions.'); // Scheiss Hacker ;)
		
		// Handelt es sich um eine Benutzer- oder Gruppen ACL?
		switch( $this->getRequestVar('type') )
		{
			case 'user':
				$acl->userid  = $this->getRequestVar('userid' );
				
				if	( $acl->userid <= 0 )
				{
					$this->addValidationError('type'     );
					$this->addValidationError('userid','');
					$this->callSubAction('aclform');
					return;
				}
				break;
			case 'group':
				$acl->groupid = $this->getRequestVar('groupid');
				if	( $acl->groupid <= 0 )
				{
					$this->addValidationError('type'      );
					$this->addValidationError('groupid','');
					$this->callSubAction('aclform');
					return;
				}
				break;
			case 'all':
				break;
			default:
				$this->addValidationError('type');
				$this->callSubAction('aclform');
				return;
		}

		$acl->languageid    = $this->getRequestVar(RequestParams::PARAM_LANGUAGE_ID);

		$acl->write         = ( $this->hasRequestVar('write'        ) );
		$acl->prop          = ( $this->hasRequestVar('prop'         ) );
		$acl->delete        = ( $this->hasRequestVar('delete'       ) );
		$acl->release       = ( $this->hasRequestVar('release'      ) );
		$acl->publish       = ( $this->hasRequestVar('publish'      ) );
		$acl->create_folder = ( $this->hasRequestVar('create_folder') );
		$acl->create_file   = ( $this->hasRequestVar('create_file'  ) );
		$acl->create_link   = ( $this->hasRequestVar('create_link'  ) );
		$acl->create_page   = ( $this->hasRequestVar('create_page'  ) );
		$acl->grant         = ( $this->hasRequestVar('grant'        ) );
		$acl->transmit      = ( $this->hasRequestVar('transmit'     ) );

		$acl->add();

		// Falls die Berechtigung vererbbar ist, dann diese sofort an
		// Unterobjekte vererben.
		if	( $acl->transmit )
		{
			$folder = new Folder( $acl->objectid );
			$oids = $folder->getObjectIds();
			foreach( $folder->getAllSubfolderIds() as $sfid )
			{
				$subfolder = new Folder( $sfid );
				$oids = array_merge($oids,$subfolder->getObjectIds());
			}
			
			foreach( $oids as $oid )
			{
				$acl->objectid = $oid;
				$acl->add();
			}
		}
		
		
		
		
		$this->addNotice('', 0, '', 'ADDED', Action::NOTICE_OK);
		
		$o->setTimestamp();
    }
}
