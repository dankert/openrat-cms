<?php
namespace cms\action\object;
use cms\action\Action;
use cms\action\Method;
use cms\action\ObjectAction;
use cms\action\RequestParams;
use cms\model\Acl;
use cms\model\BaseObject;
use cms\model\File;
use cms\model\Folder;
use cms\model\Link;
use cms\model\Page;


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
		
		if   ( ! $targetFolder->hasRight(Acl::ACL_WRITE) )
		{
			$this->addNotice('folder', 0, $targetFolder->name, 'NOT_WRITABLE', Action::NOTICE_ERROR);
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
		if   ( ! $targetFolder->hasRight(Acl::ACL_WRITE) )
		{
			$this->addNotice('folder', 0, $targetFolder->name, 'NOT_WRITABLE', Action::NOTICE_ERROR);
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
						$this->addNotice('folder', 0, $sourceObject->name, 'ERROR', Action::NOTICE_ERROR);
						return;
					}
				}
				
				// TODO:
				// Beim Verschieben und Kopieren muss im Zielordner die Berechtigung
				// zum Erstellen von Ordner, Dateien oder Seiten vorhanden sein.
				$sourceObject->setParentId( $targetObjectId );
				$this->addNotice($sourceObject->type, 0, $sourceObject->name, 'moved');
				break;
				
			case 'moveandlink':

				$oldParentId = $sourceObject->parentid;
				
				$sourceObject->setParentId( $targetObjectId );
				$this->addNotice($sourceObject->type, 0, $sourceObject->name, 'moved');
				
				$link = new Link();
				$link->parentid = $oldParentId;
				$link->name     = \cms\base\Language::lang('LINK_TO').' '.$sourceObject->name;
				$link->filename = $sourceObject->filename;
				$link->linkedObjectId = $sourceObjectId;
				$link->add();
				$this->addNotice('link', 0, $link->name, 'added');
				
				break;
				
			case 'copy':
				
				switch( $sourceObject->getType() )
				{
					case 'folder':
						// Ordner zur Zeit nicht kopieren
						// Funktion waere zu verwirrend
						$this->addNotice($sourceObject->getType(), 0, $sourceObject->name, 'CANNOT_COPY_FOLDER', 'error');
						break;
							
					case 'file':
						$f = new File( $sourceObjectId );
						$f->load();
						$f->filename = '';
						$f->name     = \cms\base\Language::lang('COPY_OF').' '.$f->name;
						$f->parentid = $targetObjectId;
						$f->add();
						$f->copyValueFromFile( $sourceObjectId );
				
						$this->addNotice($sourceObject->getType(), 0, $sourceObject->name, 'COPIED', 'ok');
						break;
				
					case 'page':
						$p = new Page( $sourceObjectId );
						$p->load();
						$p->filename = '';
						$p->name     = \cms\base\Language::lang('COPY_OF').' '.$p->name;
						$p->parentid = $targetObjectId;
						$p->add();
						$p->copyValuesFromPage( $sourceObjectId );
						$this->addNotice($sourceObject->getType(), 0, $sourceObject->name, 'COPIED', 'ok');
						break;
							
					case 'link':
						$l = new Link( $sourceObjectId );
						$l->load();
						$l->filename = '';
						$l->name     = \cms\base\Language::lang('COPY_OF').' '.$l->name;
						$l->parentid = $targetObjectId;
						$l->add();
						$this->addNotice($sourceObject->getType(), 0, $sourceObject->name, 'COPIED', 'ok');
						break;
							
					default:
						throw new \LogicException('fatal: unknown type while deleting');
				}
				break;				
				
			case 'link':

				// Beim Verkn�pfen muss im Zielordner die Berechtigung zum Erstellen
				// von Verkn�pfungen vorhanden sein.
				if   ( ! $targetFolder->hasRight(Acl::ACL_CREATE_LINK) )
				{
					$this->addNotice('folder', 0, $targetFolder->name, 'NOT_WRITABLE', Action::NOTICE_ERROR);
					return;
				}
				
				$link = new Link();
				$link->parentid = $targetObjectId;
				$link->name     = \cms\base\Language::lang('LINK_TO').' '.$sourceObject->name;
				$link->filename = $sourceObject->filename;
				$link->linkedObjectId = $sourceObjectId;
				$link->isLinkToObject = true;
				$link->add();
				$this->addNotice('link', 0, $link->name, 'added');
				// OK
				break;
				
			default:
				throw new \LogicException('Unknown type for copying');
				break;
		}
		
		$targetFolder->setTimestamp();
		
    }
}
