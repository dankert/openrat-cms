<?php
namespace cms\action\folder;
use cms\action\FolderAction;
use cms\action\Method;
use cms\model\Permission;
use cms\model\BaseObject;
use cms\model\File;
use util\Html;


class FolderEditAction extends FolderAction implements Method {
    public function view() {
		if   ( ! $this->folder->isRoot() )
			$this->setTemplateVar('parentid',$this->folder->parentid);

		$list = array();

		// Schleife ueber alle Objekte in diesem Ordner
		foreach( $this->folder->getObjects() as $o )
		{
            /* @var $o BaseObject */

            $id = $o->objectid;

			if   ( $o->hasRight(Permission::ACL_READ) )
			{
				$list[$id]['name']     = $o->getDefaultName()->name;
				$list[$id]['filename'] = $o->filename;
				$list[$id]['desc']     = $o->getDefaultName()->description;
				if	( $list[$id]['desc'] == '' )
					$list[$id]['desc'] = \cms\base\Language::lang('NO_DESCRIPTION_AVAILABLE');
				$list[$id]['desc'] = $list[$id]['desc'].' - '.\cms\base\Language::lang('IMAGE').' '.$id;

				$list[$id]['type'] = $o->getType();
				$list[$id]['id'  ] = $id;

				$list[$id]['icon' ] = $o->getType();
				$list[$id]['class'] = $o->getType();
				$list[$id]['url' ] = Html::url($o->getType(),'',$id);

				if	( $o->getType() == 'file' )
				{
					$file = new File( $id );
					$file->load();
					$list[$id]['desc'] .= ' - '.intval($file->size/1000).'kB';
				}

				$list[$id]['date'] = $o->lastchangeDate;
				$list[$id]['user'] = $o->lastchangeUser;
			}
		}

		$this->setTemplateVar('object'      ,$list            );

		$this->setTemplateVar('add',parent::hasPermissionToAddAnyObject() );
	}


    public function post() {
    }
}
