<?php
namespace cms\action\object;
use cms\action\Method;
use cms\action\ObjectAction;
use cms\base\Language;
use cms\model\Permission;
use cms\model\BaseObject;
use language\Messages;


class ObjectRightsAction extends ObjectAction implements Method {


	public function view() {
		$o = new BaseObject( $this->request->getId() );
		$o->objectLoadRaw();
		$this->setTemplateVar( 'show',$o->getRelatedAclTypes() );
		$this->setTemplateVar( 'type',$o->getType() );
		
		$acllist = array();


		foreach( $o->getAllAclIds() as $aclid )
		{
			$permission = new Permission( $aclid );
			$permission->load();
			$key = 'bu'.$permission->username.'g'.$permission->groupname.'a'.$aclid;
			$acllist[$key] = $permission->getProperties();
			$acllist[$key]['aclid'] = $aclid;

			switch( $permission->type ) {
				case Permission::TYPE_USER:
					$type = 'user';
					$name = $permission->username;
					break;
				case Permission::TYPE_GROUP:
					$type = 'group';
					$name = $permission->groupname;
					break;
				case Permission::TYPE_AUTH:
					$type = 'auth';
					$name = Language::lang( Messages::USERS_AUTHENTICATED );
					break;
				case Permission::TYPE_GUEST:
				default:
					$type = 'guest';
					$name = Language::lang( Messages::USERS_GUESTS );
					break;
			}

			$acllist[$key]['type'] = $type;
			$acllist[$key]['name'] = $name;
		}
		ksort( $acllist );

		$this->setTemplateVar('acls',$acllist );

		$this->setTemplateVars( $o->getAssocRelatedAclTypes() );
    }
    public function post() {
    }


	/**
	 * @return int Permission-flag.
	 */
	public function getRequiredPermission() {
		return Permission::ACL_GRANT;
	}


}
