<?php
namespace cms\action\folder;
use cms\action\FolderAction;
use cms\action\Method;
use cms\model\Acl;
use cms\model\BaseObject;
use cms\model\File;
use util\Html;


class FolderEditAction extends FolderAction implements Method {
    public function view() {
		if   ( ! $this->folder->isRoot )
			$this->setTemplateVar('parentid',$this->folder->parentid);

		$list = array();

		// Schleife ueber alle Objekte in diesem Ordner
		foreach( $this->folder->getObjects() as $o )
		{
            /* @var $o BaseObject */

            $id = $o->objectid;

			if   ( $o->hasRight(Acl::ACL_READ) )
			{
				$list[$id]['name']     = \util\Text::maxLength($o->name, 30);
				$list[$id]['filename'] = \util\Text::maxLength($o->filename, 20);
				$list[$id]['desc']     = \util\Text::maxLength($o->desc, 30);
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

					if	( $file->isImage() )
					{
						$list[$id]['icon' ] = 'image';
						$list[$id]['class'] = 'image';
						//$list[$id]['url' ] = Html::url('file','show',$id) nur sinnvoll bei Lightbox-Anzeige
					}
//					if	( substr($file->mimeType(),0,5) == 'text/' )
//						$list[$id]['icon'] = 'text';
				}

				$list[$id]['date'] = $o->lastchangeDate;
				$list[$id]['user'] = $o->lastchangeUser;
			}
		}

		$this->setTemplateVar('object'      ,$list            );
    }


    public function post() {
    }
}
