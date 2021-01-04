<?php
namespace cms\action\object;
use cms\action\Action;
use cms\action\Method;
use cms\action\ObjectAction;
use cms\action\RequestParams;
use cms\model\Permission;
use cms\model\BaseObject;
use cms\model\File;
use cms\model\Folder;
use cms\model\Link;
use cms\model\Page;
use language\Messages;


class ObjectCopyAction extends ObjectAction implements Method {
    public function view() {
		$sourceObject = new BaseObject( $this->getRequestId());
		$sourceObject->load();
		
		$targetFolder = new BaseObject( $this->getRequestVar('targetFolderId',RequestParams::FILTER_NUMBER));
		$targetFolder->load();
		
		$this->setTemplateVar('source'  ,$sourceObject->getProperties() );
		$this->setTemplateVar('sourceId',$sourceObject->objectid        );
		$this->setTemplateVar('target'  ,$targetFolder->getProperties() );
		$this->setTemplateVar('targetId',$targetFolder->objectid        );
		$this->setTemplateVar('types'   ,array('move'=>'move','moveandlink'=>'moveandlink','copy'=>'copy','link'=>'link') );
		
		if   ( ! $targetFolder->hasRight(Permission::ACL_WRITE) )
		{
			$this->addErrorFor( $this->baseObject,Messages::FOLDER_NOT_WRITABLE );
		}
    }
    public function post() {
		$type           = $this->getRequestVar('type');
		$targetObjectId = $this->getRequestVar('targetid',RequestParams::FILTER_NUMBER);
		$sourceObjectId = $this->getRequestVar('sourceid',RequestParams::FILTER_NUMBER);

		$sourceObject = new BaseObject( $sourceObjectId );
		$sourceObject->load();
		
		$targetFolder = new BaseObject( $targetObjectId );
		$targetFolder->load();
		
		// Prüfen, ob Schreibrechte im Zielordner bestehen.
		if   ( ! $targetFolder->hasRight(Permission::ACL_WRITE) )
		{
			$this->addErrorFor( $targetFolder,Messages::FOLDER_NOT_WRITABLE );
			return;
		}
		
		switch( $type )
		{
			case 'move':
				
				if	( $sourceObject->isFolder )
				{
					$f = new Folder( $sourceObjectId );
					$allsubfolders = $f->getAllSubFolderIds();
				
					// Plausibilisierungsprüfung:
					//
					// Wenn
					// - Das Zielverzeichnis sich nicht in einem Unterverzeichnis des zu verschiebenen Ordners liegt
					// und
					// - Das Zielverzeichnis nicht der zu verschiebene Ordner ist
					// dann verschieben
					if	( in_array($targetObjectId,$allsubfolders) || $sourceObjectId == $targetObjectId )
					{
						$this->addErrorFor( $sourceObject,Messages::ERROR);
						return;
					}
				}
				
				// TODO:
				// Beim Verschieben und Kopieren muss im Zielordner die Berechtigung
				// zum Erstellen von Ordner, Dateien oder Seiten vorhanden sein.
				$sourceObject->setParentId( $targetObjectId );
				$this->addNoticeFor( $sourceObject,Messages::MOVED);
				break;
				
			case 'moveandlink':

				$oldParentId = $sourceObject->parentid;
				
				$sourceObject->setParentId( $targetObjectId );
				$this->addNoticeFor($sourceObject,Messages::MOVED);
				
				$link = new Link();
				$link->parentid = $oldParentId;
				$link->name     = \cms\base\Language::lang('LINK_TO').' '.$sourceObject->name;
				$link->filename = $sourceObject->filename;
				$link->linkedObjectId = $sourceObjectId;
				$link->persist();
				$this->addNoticeFor($link,Messages::ADDED);
				
				break;
				
			case 'copy':
				
				switch( $sourceObject->getType() )
				{
					case 'folder':
						// Ordner zur Zeit nicht kopieren
						// Funktion waere zu verwirrend
						$this->addErrorFor($sourceObject,Messages::CANNOT_COPY_FOLDER);
						break;
							
					case 'file':
						$f = new File( $sourceObjectId );
						$f->load();
						$f->filename = '';
						$f->name     = \cms\base\Language::lang('COPY_OF').' '.$f->name;
						$f->parentid = $targetObjectId;
						$f->persist();
						$f->copyValueFromFile( $sourceObjectId );

						$this->addNoticeFor($sourceObject,Messages::COPIED);
						break;
				
					case 'page':
						$p = new Page( $sourceObjectId );
						$p->load();
						$p->filename = '';
						$p->name     = \cms\base\Language::lang('COPY_OF').' '.$p->name;
						$p->parentid = $targetObjectId;
						$p->persist();
						$p->copyValuesFromPage( $sourceObjectId );
						$this->addNoticeFor($sourceObject,Messages::COPIED);
						break;
							
					case 'link':
						$l = new Link( $sourceObjectId );
						$l->load();
						$l->filename = '';
						$l->name     = \cms\base\Language::lang('COPY_OF').' '.$l->name;
						$l->parentid = $targetObjectId;
						$l->persist();
						$this->addNoticeFor($sourceObject,Messages::COPIED);
						break;
							
					default:
						throw new \LogicException('fatal: unknown type while deleting');
				}
				break;				
				
			case 'link':

				// Beim Verkn�pfen muss im Zielordner die Berechtigung zum Erstellen
				// von Verkn�pfungen vorhanden sein.
				if   ( ! $targetFolder->hasRight(Permission::ACL_CREATE_LINK) )
				{
					$this->addErrorFor($targetFolder,Messages::FOLDER_NOT_WRITABLE);
					return;
				}
				
				$link = new Link();
				$link->parentid = $targetObjectId;
				$link->name     = \cms\base\Language::lang('LINK_TO').' '.$sourceObject->name;
				$link->filename = $sourceObject->filename;
				$link->linkedObjectId = $sourceObjectId;
				$link->isLinkToObject = true;
				$link->persist();
				$this->addNoticeFor($link,Messages::ADDED);
				// OK
				break;
				
			default:
				throw new \LogicException('Unknown type for copying');
				break;
		}
		
		$targetFolder->setTimestamp();
		
    }
}
