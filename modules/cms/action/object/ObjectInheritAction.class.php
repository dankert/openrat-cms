<?php
namespace cms\action\object;
use cms\action\Action;
use cms\action\Method;
use cms\action\ObjectAction;
use cms\model\Permission;
use cms\model\BaseObject;
use cms\model\Folder;
use language\Messages;
use logger\Logger;
use util\Session;

class ObjectInheritAction extends ObjectAction implements Method {

	public function getRequiredPermission()
	{
		return Permission::ACL_GRANT;
	}

    public function view() {
		$o = new BaseObject( $this->request->getId() );
		$o->objectLoadRaw();
		$this->setTemplateVar( 'type',$o->getType() );
		
		$acllist = array();
		$this->setTemplateVar('acls',$acllist );
    }
    public function post() {
		Session::close();
		
		$folder = new Folder( $this->request->getId() );
		$folder->load();
		
		if	( ! $this->request->has('inherit') )
		{
			$this->addWarningFor( $folder,Messages::NOTHING_DONE);
			return;
		}
		
		
		$aclids = $folder->getAllAclIds();
		
		$newAclList = array();
		foreach( $aclids as $aclid )
		{
			$permission = new Permission( $aclid );
			$permission->load();
			if	( $permission->transmit )
				$newAclList[] = $permission;
		}
		Logger::debug('inheriting '.count($newAclList).' acls');
		
		$oids = $folder->getObjectIds();
		
		foreach( $folder->getAllSubfolderIds() as $sfid )
		{
			$subfolder = new Folder( $sfid );
			
			$oids = array_merge($oids,$subfolder->getObjectIds());
		}
		
		foreach( $oids as $oid )
		{
			$object = new BaseObject( $oid );
		
			// Die alten ACLs des Objektes löschen.
			foreach( $object->getAllAclIds() as $aclid )
			{
				$permission = new Permission( $aclid );
				$permission->objectid = $oid;
				$permission->delete();
				Logger::debug('removing acl '.$aclid.' for object '.$oid);
			}
			
			// Vererbbare ACLs des aktuellen Ordners anwenden.
			foreach( $newAclList as $newAcl )
			{
				$newAcl->objectid = $oid;
				$newAcl->persist();
				Logger::debug('adding new acl '.$newAcl->aclid.' for object '.$oid);
			}
		}
		
		$this->addNoticeFor($folder,Messages::SAVED);
    }
}
