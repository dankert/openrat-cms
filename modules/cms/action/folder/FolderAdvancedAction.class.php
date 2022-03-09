<?php
namespace cms\action\folder;
use cms\action\Action;
use cms\action\FolderAction;
use cms\action\Method;
use cms\base\Startup;
use cms\model\Permission;
use cms\model\BaseObject;
use cms\model\File;
use cms\model\Folder;
use cms\model\Link;
use cms\model\Page;
use cms\model\Project;
use cms\model\Url;
use language\Messages;
use util\ArchiveTar;
use util\exception\SecurityException;
use util\Html;


class FolderAdvancedAction extends FolderAction implements Method {

	public function view() {
		$this->setTemplateVar('writable',$this->folder->hasRight(Permission::ACL_WRITE) );

		$list = array();

		// Schleife ueber alle Objekte in diesem Ordner
		foreach( $this->folder->getObjects() as $o )
		{
		    /* @var $o BaseObject */
			$id = $o->objectid;

			if   ( $o->hasRight(Permission::ACL_READ) )
			{
				$list[$id]['objectid'] = $id;
				$list[$id]['id'      ] = 'obj'.$id;
				$list[$id]['name'    ] = $o->getDefaultName()->name;
				$list[$id]['filename'] = $o->filename;
				$list[$id]['desc'    ] = $o->getDefaultName()->description;
				if	( $list[$id]['desc'] == '' )
					$list[$id]['desc'] = \cms\base\Language::lang('NO_DESCRIPTION_AVAILABLE');
				$list[$id]['desc'] = 'ID '.$id.' - '.$list[$id]['desc'];

				$list[$id]['type'] = $o->getType();

				$list[$id]['icon'] = $o->getType();

				$list[$id]['url' ] = Html::url($o->getType(),'',$id);
				$list[$id]['date'] = date( \cms\base\Language::lang('DATE_FORMAT'),$o->lastchangeDate );
				$list[$id]['user'] = $o->lastchangeUser;

				if	( $this->request->isTrue("markall") || $this->request->isTrue('obj'.$id) )
					$this->setTemplateVar('obj'.$id,'1');
			}
		}

		if   ( $this->folder->hasRight(Permission::ACL_WRITE) )
		{
			// Alle anderen Ordner ermitteln
			$otherfolder = array();
			$project = new Project( $this->folder->projectid );
			foreach( $project->getAllFolders() as $id )
			{
				$f = new Folder( $id );
				if	( $f->hasRight( Permission::ACL_WRITE ) )
					$otherfolder[$id] = Startup::FILE_SEP.implode( Startup::FILE_SEP,$f->parentObjectNames(false,true) );
			}
			asort( $otherfolder );

			$this->setTemplateVar('folder',$otherfolder);

			// URLs zum Umsortieren der Eintraege
			$this->setTemplateVar('order_url'      ,Html::url('folder','order',$this->folder->objectid) );
		}

		$actionList = array();
		$actionList[] = 'copy';
		$actionList[] = 'link';
		$actionList[] = 'archive';

		if	( $this->folder->hasRight(Permission::ACL_WRITE) )
		{
			$actionList[] = 'move';
			$actionList[] = 'delete';
		}

		$this->setTemplateVar('actionlist',$actionList );
		$this->setTemplateVar('defaulttype',$this->request->getAlphanum('type'));

		$this->setTemplateVar('object'      ,$list            );
		$this->setTemplateVar('act_objectid',$this->folder->objectid);

		$project = new Project($this->folder->projectid);
		$rootFolder = new Folder( $project->getRootObjectId() );
		$rootFolder->load();

		$this->setTemplateVar('properties'    ,$this->folder->getProperties() );
		$this->setTemplateVar('rootfolderid'  ,$rootFolder->objectid  );
		$this->setTemplateVar('rootfoldername',$rootFolder->filename  );
    }


    public function post() {
		$type           = $this->request->getText('type');
		$ids            = explode(',',$this->request->getText('ids'));
		$targetObjectId = $this->request->getText('targetobjectid');

		// Prüfen, ob Schreibrechte im Zielordner bestehen.
		switch( $type )
		{
			case 'move':
			case 'copy':
			case 'link':
				$f = new Folder( $targetObjectId );

				// Beim Verkn�pfen muss im Zielordner die Berechtigung zum Erstellen
				// von Verkn�pfungen vorhanden sein.
				//
				// Beim Verschieben und Kopieren muss im Zielordner die Berechtigung
				// zum Erstellen von Ordner, Dateien oder Seiten vorhanden sein.
				if	( ( $type=='link' && $f->hasRight( Permission::ACL_CREATE_LINK ) ) ||
					  ( ( $type=='move' || $type == 'copy' ) &&
					    ( $f->hasRight(Permission::ACL_CREATE_FOLDER) || $f->hasRight(Permission::ACL_CREATE_FILE) || $f->hasRight(Permission::ACL_CREATE_PAGE) ) ) )
					;	// OK
				else
					throw new SecurityException('no_rights');

				break;
			default:
		}


		$ids        = $this->folder->getObjectIds();
		$objectList = array();

		foreach( $ids as $id )
		{
			// Nur, wenn Objekt ausgewaehlt wurde
			if	( !$this->request->isTrue('obj'.$id) )
				continue;

			$o = new BaseObject( $id );
			$o->load();

			// Fuer die gewuenschte Aktion muessen pro Objekt die entsprechenden Rechte
			// vorhanden sein.
			if	( $type == 'copy'    && $o->hasRight( Permission::ACL_READ   ) ||
				  $type == 'move'    && $o->hasRight( Permission::ACL_WRITE  ) ||
				  $type == 'link'    && $o->hasRight( Permission::ACL_READ   ) ||
				  $type == 'archive' && $o->hasRight( Permission::ACL_READ   ) ||
				  $type == 'delete'  && $o->hasRight( Permission::ACL_DELETE )    )
				$objectList[ $id ] = $o->getProperties();
			else
				$this->addNoticeFor($o,Messages::NO_RIGHTS );
		}

		$ids = array_keys($objectList);

		if	( $type == 'archive' )
		{
			require_once('serviceClasses/ArchiveTar.class.php');
			$tar = new ArchiveTar();
			$tar->files = array();

			foreach( $ids as $id )
			{
				$o = new BaseObject( $id );
				$o->load();

				if	( $o->isFile )
				{
					$file = new File($id);
					$file->load();

					// Datei dem Archiv hinzufügen.
					$info = array();
					$info['name'] = $file->filename();
					$info['file'] = $file->loadValue();
					$info['mode'] = 0600;
					$info['size'] = $file->size;
					$info['time'] = $file->lastchangeDate;
					$info['user_id' ] = 1000;
					$info['group_id'] = 1000;
					$info['user_name' ] = 'nobody';
					$info['group_name'] = 'nobody';

					$tar->numFiles++;
					$tar->files[]= $info;
				}
				else
				{
					// Was anderes als Dateien ignorieren.
					$this->addNoticeFor($o,Messages::NOTHING_DONE);
				}

			}

			// TAR speichern.
			$tarFile = new File();
			$tarFile->filename = $this->request->getText('filename');
			$tarFile->extension = 'tar';
			$tarFile->parentid = $this->folder->objectid;

			$tar->__generateTAR();
			$tarFile->value = $tar->tar_file;
			$tarFile->persist();
		}
		else
		{
			foreach( $ids as $id )
			{
				$o = new BaseObject( $id );
				$o->load();

				switch( $type )
				{
					case 'move':
						if	( $o->isFolder )
						{
							$f = new Folder( $id );
							$allsubfolders = $f->getAllSubFolderIds();

							// Plausibilisierungsprüfung:
							//
							// Wenn
							// - Das Zielverzeichnis sich nicht in einem Unterverzeichnis des zu verschiebenen Ordners liegt
							// und
							// - Das Zielverzeichnis nicht der zu verschiebene Ordner ist
							// dann verschieben
							if	( !in_array($targetObjectId,$allsubfolders) && $id != $targetObjectId )
							{
								$this->addNoticeFor($o,Messages::MOVED);
								$o->setParentId( $targetObjectId );
							}
							else
							{
								$this->addErrorFor($o,Messages::NO_RIGHTS);
							}
						}
						else
						{
							$o->setParentId( $targetObjectId );
							$this->addNoticeFor($o,Messages::MOVED);
						}
						break;

					case 'copy':
						switch( $o->getType() )
						{
							case 'folder':
								// Ordner zur Zeit nicht kopieren
								// Funktion waere zu verwirrend
								$this->addErrorFor($o,Messages::CANNOT_COPY_FOLDER);
								break;

							case 'file':
								$f = new File();
								$f->load();
								$f->filename = '';
								$f->parentid = $targetObjectId;
								$f->persist();
								$f->copyValueFromFile( $id );
								$f->copyNamesFrom( $id );

								$this->addNoticeFor($o,Messages::COPIED);
								break;

							case 'page':
								$p = new Page();
								$p->load();
								$p->filename = '';
								$p->parentid = $targetObjectId;
								$p->persist();
								$p->copyValuesFromPage( $id );
								$p->copyNamesFrom( $id );
								$this->addNoticeFor($o,Messages::COPIED);
								break;

							case 'link':
								$l = new Link();
								$l->load();
								$l->filename = '';
								$l->parentid = $targetObjectId;
								$l->persist();
								$l->copyNamesFrom( $id );
								$this->addNoticeFor($o,Messages::COPIED);
								break;

							default:
								throw new \LogicException('fatal: what type to delete?');
						}
						$notices[] = \cms\base\Language::lang('COPIED');
						break;

					case 'link':

						if	( $o->isFile  ||
                              $o->isImage ||
                              $o->isText  ||
							  $o->isPage  )  // Nur Seiten oder Dateien sind verknuepfbar
						{
							$link = new Link();
							$link->parentid       = $targetObjectId;

							$link->linkedObjectId = $id;
							$link->isLinkToObject = true;
							$link->persist();
							$link->copyNamesFrom($o->objectid);
							$this->addNoticeFor($o,Messages::LINKED);
						}
						else
						{
							$this->addErrorFor($o,Messages::ERROR);
						}
						break;

					case 'delete':

						if	( $this->request->isTrue('confirm') )
						{
							switch( $o->getType() )
							{
								case 'folder':
									$f = new Folder( $id );
									$f->deleteAll();
									break;

								case 'file':
									$f = new File( $id );
									$f->delete();
									break;

								case 'page':
									$p = new Page( $id );
									$p->load();
									$p->delete();
									break;

								case 'link':
									$l = new Link( $id );
									$l->delete();
									break;

								case 'url':
									$u = new Url( $id );
									$u->delete();
									break;

								default:
									throw new \LogicException("Error while deleting: Unknown type: {$o->getType()}");
							}
							$this->addNoticeFor($o,Messages::DELETED);
						}
						else
						{
							$this->addNoticeFor($o,Messages::NOTHING_DONE);
						}

						break;

					default:
						$this->addErrorFor($o,Messages::ERROR);
				}

			}
		}

		$this->folder->setTimestamp();
    }



}
