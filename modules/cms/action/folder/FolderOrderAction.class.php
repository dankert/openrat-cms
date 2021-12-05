<?php
namespace cms\action\folder;
use cms\action\FolderAction;
use cms\action\Method;
use cms\model\Permission;
use cms\model\BaseObject;
use language\Messages;


class FolderOrderAction extends FolderAction implements Method {

	public function getRequiredPermission() {
		return Permission::ACL_WRITE;
	}

	public function view() {
		$list = array();

		// Schleife ueber alle Objekte in diesem Ordner
		foreach( $this->folder->getObjects() as $o )
		{
            /* @var $o BaseObject */
			$id = $o->objectid;
			$name = $o->getDefaultName();

			if   ( $o->hasRight(Permission::ACL_READ) )
			{
				$list[$id]['id'  ]     = $id;
				$list[$id]['name']     = $name->name;
				$list[$id]['filename'] = $o->filename;
				$list[$id]['desc']     = 'ID '.$id.' - '.$name->description;

				$list[$id]['type']     = $o->getType();
				$list[$id]['icon']     = $o->getType();

				$list[$id]['date'] = $o->lastchangeDate;
				$list[$id]['user'] = $o->lastchangeUser;

				$last_objectid = $id;
			}
		}

		$this->setTemplateVar('object'      ,$list            );
		$this->setTemplateVar('act_objectid',$this->folder->objectid);
    }


    public function post() {
		$ids   = $this->folder->getObjectIds();
		$seq   = 0;

		$order = explode(',',$this->request->getText('order') );

		foreach( $order as $objectid )
		{
			if	( ! is_numeric($objectid) || ! in_array($objectid,$ids) )
			{
				throw new \LogicException('Object-Id '.$objectid.' is not in this folder any more');
			}
			$seq++; // Sequenz um 1 erhoehen

			$o = new BaseObject( $objectid );
			$o->setOrderId( $seq );

			unset( $o ); // Selfmade Garbage Collection :-)
		}

		$this->addNoticeFor($this->folder, Messages::SEQUENCE_CHANGED);
		$this->folder->setTimestamp();
    }
}
