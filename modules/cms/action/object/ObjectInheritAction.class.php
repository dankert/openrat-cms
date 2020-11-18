<?php
namespace cms\action\object;
use cms\action\Action;
use cms\action\Method;
use cms\action\ObjectAction;
use cms\model\Acl;
use cms\model\BaseObject;
use cms\model\Folder;
use logger\Logger;
use util\Session;

class ObjectInheritAction extends ObjectAction implements Method {
    public function view() {
		$o = new BaseObject( $this->getRequestId() );
		$o->objectLoadRaw();
		$this->setTemplateVar( 'type',$o->getType() );
		
		$acllist = array();
		$this->setTemplateVar('acls',$acllist );
    }
    public function post() {
		Session::close();
		
		$folder = new Folder( $this->getRequestId() );
		$folder->load();
		
		if	( ! $this->hasRequestVar('inherit') )
		{
			$this->addNotice('folder', 0, $folder->name, 'NOTHING_DONE', Action::NOTICE_WARN);
			return;
		}
		
		
		$aclids = $folder->getAllAclIds();
		
		$newAclList = array();
		foreach( $aclids as $aclid )
		{
			$acl = new Acl( $aclid );
			$acl->load();
			if	( $acl->transmit )
				$newAclList[] = $acl;
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
				$acl = new Acl( $aclid );
				$acl->objectid = $oid;
				$acl->delete();
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
		
		$this->addNotice('folder', 0, $folder->name, 'SAVED', Action::NOTICE_OK);
    }
}
