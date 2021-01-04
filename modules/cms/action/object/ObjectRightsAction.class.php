<?php
namespace cms\action\object;
use cms\action\Method;
use cms\action\ObjectAction;
use cms\model\Permission;
use cms\model\BaseObject;


class ObjectRightsAction extends ObjectAction implements Method {

    public function view() {
		$o = new BaseObject( $this->getRequestId() );
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
		}
		ksort( $acllist );

		$this->setTemplateVar('acls',$acllist );

		$this->setTemplateVars( $o->getAssocRelatedAclTypes() );
    }
    public function post() {
    }
}
