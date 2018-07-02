<?php

namespace cms\action;

use ArchiveTar;
use cms\model\Template;
use cms\model\Page;
use cms\model\Folder;
use cms\model\BaseObject;
use cms\model\File;
use cms\model\Link;

use cms\model\Url;
use Http;
use Publish;
use Session;
use \Html;
use Text;
use Upload;

// OpenRat Content Management System
// Copyright (C) 2002-2012 Jan Dankert, cms@jandankert.de
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.


/**
 * Action-Klasse zum Bearbeiten eines Ordners
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */

class FolderAction extends ObjectAction
{
	public $security = SECURITY_USER;

	private $folder;

    public function __construct()
	{
        parent::__construct();
		$this->folder = new Folder( $this->getRequestId() );
		$this->folder->languageid = $this->request->getLanguageId();
		$this->folder->load();

		$this->lastModified( $this->folder->lastchangeDate);
	}



	/**
	 * Neues Objekt anlegen.<br>
	 * Dies kann ein(e) Verzeichnis, Seite, Verkn�pfung oder Datei sein.<br>
	 */
    public function createPost()
	{
		global $conf;
		$type = $this->getRequestVar('type'       );

		switch( $type )
		{
			case 'folder':
				$name = $this->getRequestVar('folder_name');

				if   ( !empty($name) )
				{
					$f = new Folder();
					$f->name     = $name;
					$f->parentid = $this->folder->objectid;
					$f->add();
					$this->folder->setTimestamp();
					$this->addNotice('folder',$f->name,'ADDED','ok');
				}
				else
				{
					$this->addValidationError('folder_name');
					$this->callSubAction('create');
				}
				break;

			case 'file':
				$upload = new Upload();

				if	( !$upload->isValid() )
				{
					$this->addValidationError('file','COMMON_VALIDATION_ERROR',array(),$upload->error);
					$this->callSubAction('createfile');
					return;
				}
				// Pr�fen der maximal erlaubten Dateigr��e.
				elseif	( $upload->size > $this->maxFileSize() )
				{
					// Maximale Dateigr��e ist �berschritten
					$this->addValidationError('file','MAX_FILE_SIZE_EXCEEDED');
					$this->callSubAction('createfile');
					return;
				}
				elseif( $upload->size > 0 )
				{
					$file   = new File();
					$file->desc      = '';
					$file->filename  = $upload->filename;
					$file->name      = $upload->filename;
					$file->extension = $upload->extension;
					$file->size      = $upload->size;
					$file->parentid  = $this->folder->objectid;

					$file->value     = $upload->value;

					$file->add(); // Datei hinzufuegen
					$this->folder->setTimestamp();
					$this->addNotice('file',$file->name,'ADDED','ok');
				}

				break;

			case 'page':

				$name = $this->getRequestVar('page_name');
				if   ( !empty($name) )
				{
					$page = new Page();
					$page->name       = $name;
					$page->templateid = $this->getRequestVar('page_templateid');
					$page->parentid   = $this->folder->objectid;
					$page->add();
					$this->folder->setTimestamp();

					$this->addNotice('page',$page->name,'ADDED','ok');
				}
				else
				{
					$this->addValidationError('page_name');
					$this->callSubAction('create');
				}
				break;

			case 'link':

				$name = $this->getRequestVar('link_name');
				if   ( !empty($name) )
				{
					$link = new Link();
					$link->name           = $name;
					$link->parentid       = $this->folder->objectid;

					$link->add();
					$this->folder->setTimestamp();

					$this->addNotice('link',$link->name,'ADDED','ok');
				}
				else
				{
					$this->addValidationError('link_name');
					$this->callSubAction('create');
				}

				break;

			case 'url':

				$urlValue = $this->getRequestVar('url');
				if   ( !empty($urlValue) )
				{
					$url = new Url();
                    $url->name           = $urlValue;
                    $url->parentid       = $this->folder->objectid;

                    $url->url            = $urlValue;

                    $url->add();
					$this->folder->setTimestamp();

					$this->addNotice('url',$url->name,'ADDED','ok');
				}
				else
				{
					$this->addValidationError('url');
					$this->callSubAction('create');
				}

				break;

			default:
				$this->addValidationError('type');
				$this->callSubAction('create');

		}

	}



    public function createfolderPost()
	{
		$type        = $this->getRequestVar('type'       );
		$name        = $this->getRequestVar('name'       );
		$filename    = $this->getRequestVar('filename'   );
		$description = $this->getRequestVar('description');

		if   ( !empty($name) )
		{
			$f = new Folder();
			$f->name     = $name;
			$f->filename = $name;
			$f->desc     = $description;
			$f->parentid = $this->folder->objectid;

			$f->add();
			$this->addNotice('folder',$f->name,'ADDED','ok');
			$this->setTemplateVar('objectid',$f->objectid);
		}
		else
		{
			$this->addValidationError('name');
			$this->callSubAction('createfolder');
		}

		$this->folder->setTimestamp();
	}



    public function createfilePost()
	{
		$type        = $this->getRequestVar('type'       );
		$name        = $this->getRequestVar('name'       );
		$filename    = $this->getRequestVar('filename'   );
		$description = $this->getRequestVar('description');

		$file   = new File();

		// Die neue Datei wird über eine URL geladen und dann im CMS gespeichert.
		if	( $this->hasRequestVar('url') )
		{
			$url = $this->getRequestVar('url');
			$http = new Http();
			$http->setUrl( $url );

			$ok = $http->request();

			if	( !$ok )
			{
				$this->addValidationError('url','COMMON_VALIDATION_ERROR',array(),$http->error);
				$this->callSubAction('createfile');
				return;
			}

			$file->desc      = $description;
			$file->filename  = basename($url);
			$file->name      = !empty($name)?$name:basename($url);
			$file->size      = strlen($http->body);
			$file->value     = $http->body;
			$file->parentid  = $this->folder->objectid;
		}
		else
		{
			$upload = new Upload();

			if	( $upload->isValid() )
			{
				$file->desc      = $description;
				$file->filename  = $upload->filename;
				$file->name      = !empty($name)?$name:$upload->filename;
				$file->extension = $upload->extension;
				$file->size      = $upload->size;
				$file->parentid  = $this->folder->objectid;

				$file->value     = $upload->value;
			}
			else
			{
				if	( $this->hasRequestVar('name') )
				{
					$file->name     = $this->getRequestVar('name');
					$file->desc     = $this->getRequestVar('description');
					$file->filename = $this->getRequestVar('filename', OR_FILTER_FILENAME);
					$file->parentid = $this->folder->objectid;
				}
				else
				{
					$this->addValidationError('file','COMMON_VALIDATION_ERROR',array(),$upload->error);
					$this->callSubAction('createfile');
					return;
				}

			}
		}

		$file->add(); // Datei hinzufuegen
		$this->addNotice('file',$file->name,'ADDED','ok');
		$this->setTemplateVar('objectid',$file->objectid);

		$this->folder->setTimestamp();
	}



    public function createlinkPost()
	{
		$name        = $this->getRequestVar('name'       );
		$filename    = $this->getRequestVar('filename'   );
        $description = $this->getRequestVar('description');

        if   ( !empty($name) )
        {
            $link = new Link();
            $link->filename       = $filename;
            $link->name           = $name;
            $link->desc           = $description;
            $link->parentid       = $this->folder->objectid;

            $link->linkedObjectId = $this->getRequestVar('targetobjectid');

            $link->add();

            $this->addNotice('link',$link->name,'ADDED','ok');
            $this->setTemplateVar('objectid',$link->objectid);
        }
        else
        {
            $this->addValidationError('name');
            $this->callSubAction('createlink');
            return;
        }

        $this->folder->setTimestamp();
    }

	public function createurlPost()
	{
		$name        = $this->getRequestVar('name'       );
		$description = $this->getRequestVar('description');
        $filename    = $this->getRequestVar('filename'   );

		if   ( !empty($name) )
		{
			$url = new Url();
			$url->filename       = $filename;
			$url->name           = $name;
			$url->desc           = $description;
			$url->parentid       = $this->folder->objectid;

			$url->url            = $this->getRequestVar('url');

			$url->add();

			$this->addNotice('url',$url->name,'ADDED','ok');
			$this->setTemplateVar('objectid',$url->objectid);
		}
		else
		{
			$this->addValidationError('name');
			$this->callSubAction('createurl');
			return;
		}

		$this->folder->setTimestamp();
	}



    public function createpagePost()
	{
		$type        = $this->getRequestVar('type'       );
		$name        = $this->getRequestVar('name'       );
		$filename    = $this->getRequestVar('filename'   );
		$description = $this->getRequestVar('description');

		if   ( $this->getRequestVar('name') != '' )
		{
			$page = new Page();
			$page->name       = $name;
			$page->desc       = $description;
			$page->filename   = $filename;
			$page->templateid = $this->getRequestVar('templateid');
			$page->parentid   = $this->folder->objectid;

			$page->add();

			$this->addNotice('page',$page->name,'ADDED','ok');
			$this->setTemplateVar('objectid',$page->objectid);
		}
		else
		{
			$this->addValidationError('name');
			$this->callSubAction('createpage');
			return;
		}

		$this->folder->setTimestamp();
	}



	/**
	 * Abspeichern der Ordner-Eigenschaften. Ist der Schalter "delete" gesetzt, wird
	 * der Ordner stattdessen gel?scht.
	 */
    public function propPost()
	{
		// Ordnereigenschaften speichern
		if   ( $this->getRequestVar('name') != '' )
			$this->folder->name     = $this->getRequestVar('name'    ,'full');
		elseif ($this->getRequestVar('filename') != '' )
		 	$this->folder->name     = $this->getRequestVar('filename',OR_FILTER_ALPHANUM);
		else
		{
			$this->addValidationError('name');
			$this->addValidationError('filename');
			//$this->callSubAction('prop');
			return;
		}

		$this->folder->filename = $this->getRequestVar('filename'   ,OR_FILTER_ALPHANUM);
		$this->folder->desc     = $this->getRequestVar('description','full'    );
		$this->folder->save();
		$this->addNotice($this->folder->getType(),$this->folder->name,'PROP_SAVED','ok');
	}


	/**
	 * Reihenfolge von Objekten aendern.
	 */
    public function orderPost()
	{
		$ids   = $this->folder->getObjectIds();
		$seq   = 0;

		$order = explode(',',$this->getRequestVar('order') );

		foreach( $order as $objectid )
		{
			if	( ! in_array($objectid,$ids) )
			{
				throw new \LogicException('Object-Id '.$objectid.' is not in this folder any more');
			}
			$seq++; // Sequenz um 1 erhoehen

			$o = new BaseObject( $objectid );
			$o->setOrderId( $seq );

			unset( $o ); // Selfmade Garbage Collection :-)
		}

		$this->addNotice($this->folder->getType(),$this->folder->name,'SEQUENCE_CHANGED','ok');
		$this->folder->setTimestamp();
	}


	// Reihenfolge von Objekten aendern
    public function changesequencePost()
	{
		$ids = $this->folder->getObjectIds();
		$seq = 0;
		foreach( $ids as $id )
		{
			$seq++; // Sequenz um 1 erhoehen

			// Die beiden Ordner vertauschen
			if   ( $id == $this->getRequestVar('objectid1') )
				$id = $this->getRequestVar('objectid2');
			elseif ( $id == $this->getRequestVar('objectid2') )
				$id = $this->getRequestVar('objectid1');

			$o = new BaseObject( $id );
			$o->setOrderId( $seq );

			unset( $o ); // Selfmade Garbage Collection :-)
		}

		$this->addNotice($this->folder->getType(),$this->folder->name,'SEQUENCE_CHANGED','ok');
		$this->folder->setTimestamp();

		// Ordner anzeigen
		$this->callSubAction('order');

	}


	private function OLD__________editPost()
	{
		$type = $this->getRequestVar('type'); // Typ der Aktion, z.B "copy" oder "move"

		switch( $type )
		{
			case 'move':
			case 'copy':
			case 'link':
				// Liste von m�glichen Zielordnern anzeigen

				$otherfolder = array();
				foreach( $this->folder->getAllFolders() as $id )
				{
					$f = new Folder( $id );

					// Beim Verkn�pfen muss im Zielordner die Berechtigung zum Erstellen
					// von Verkn�pfungen vorhanden sein.
					//
					// Beim Verschieben und Kopieren muss im Zielordner die Berechtigung
					// zum Erstellen von Ordner, Dateien oder Seiten vorhanden sein.
					if	( ( $type=='link' && $f->hasRight( ACL_CREATE_LINK ) ) ||
						  ( ( $type=='move' || $type == 'copy' ) &&
						    ( $f->hasRight(ACL_CREATE_FOLDER) || $f->hasRight(ACL_CREATE_FILE) || $f->hasRight(ACL_CREATE_PAGE) ) ) )
						// Zielordner hinzuf�gen
						$otherfolder[$id] = FILE_SEP.implode( FILE_SEP,$f->parentObjectNames(false,true) );
				}

				// Zielordner-Liste alphabetisch sortieren
				asort( $otherfolder );

				$this->setTemplateVar('folder',$otherfolder);

				break;

			case 'archive':
				$this->setTemplateVar('ask_filename','');
				break;

			case 'delete':
				$this->setTemplateVar('ask_commit','');
				break;

			default:
				$this->addValidationError('type');
				return;

		} // switch

		$ids        = $this->folder->getObjectIds();
		$objectList = array();

		foreach( $ids as $id )
		{
			// Nur, wenn Objekt ausgewaehlt wurde
			if	( !$this->hasRequestVar('obj'.$id) )
				continue;

			$o = new BaseObject( $id );
			$o->load();

			// F�r die gew�nschte Aktion m�ssen pro Objekt die entsprechenden Rechte
			// vorhanden sein.
			if	( $type == 'copy'    && $o->hasRight( ACL_READ   ) ||
				  $type == 'move'    && $o->hasRight( ACL_DELETE ) ||
				  $type == 'link'    && $o->hasRight( ACL_READ   ) ||
				  $type == 'archive' && $o->hasRight( ACL_READ   ) ||
				  $type == 'delete'  && $o->hasRight( ACL_DELETE )    )
				$objectList[ $id ] = $o->getProperties();
		}

		$this->setTemplateVar('type'  ,$type       );
		$this->setTemplateVar('objectlist',$objectList );

		// Komma-separierte Liste von ausgew�hlten Objekt-Ids erzeugen
		$this->setTemplateVar('ids',join(array_keys($objectList),',') );
	}



	/**
	 * Verschieben/Kopieren/Loeschen/Verknuepfen von mehreren Dateien in diesem Ordner
	 */
	public function editPost()
	{
		$type           = $this->getRequestVar('type');
		$ids            = explode(',',$this->getRequestVar('ids'));
		$targetObjectId = $this->getRequestVar('targetobjectid');

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
				if	( ( $type=='link' && $f->hasRight( ACL_CREATE_LINK ) ) ||
					  ( ( $type=='move' || $type == 'copy' ) &&
					    ( $f->hasRight(ACL_CREATE_FOLDER) || $f->hasRight(ACL_CREATE_FILE) || $f->hasRight(ACL_CREATE_PAGE) ) ) )
				{
					// OK
				}
				else
				{
					$this->addValidationError('targetobjectid','no_rights');
					return;
				}

				break;
			default:
		}


		$ids        = $this->folder->getObjectIds();
		$objectList = array();

		foreach( $ids as $id )
		{
			// Nur, wenn Objekt ausgewaehlt wurde
			if	( !$this->hasRequestVar('obj'.$id) )
				continue;

			$o = new BaseObject( $id );
			$o->load();

			// Fuer die gewuenschte Aktion muessen pro Objekt die entsprechenden Rechte
			// vorhanden sein.
			if	( $type == 'copy'    && $o->hasRight( ACL_READ   ) ||
				  $type == 'move'    && $o->hasRight( ACL_WRITE  ) ||
				  $type == 'link'    && $o->hasRight( ACL_READ   ) ||
				  $type == 'archive' && $o->hasRight( ACL_READ   ) ||
				  $type == 'delete'  && $o->hasRight( ACL_DELETE )    )
				$objectList[ $id ] = $o->getProperties();
			else
				$this->addNotice($o->getType(),$o->name,'no_rights',OR_NOTICE_WARN);
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
					$info['name'] = $file->filenameWithExtension();
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
					$this->addNotice($o->getType(),$o->name,'NOTHING_DONE',OR_NOTICE_WARN);
				}

			}

			// TAR speichern.
			$tarFile = new File();
			$tarFile->name     = lang('GLOBAL_ARCHIVE').' '.$this->getRequestVar('filename');
			$tarFile->filename = $this->getRequestVar('filename');
			$tarFile->extension = 'tar';
			$tarFile->parentid = $this->folder->objectid;

			$tar->__generateTAR();
			$tarFile->value = $tar->tar_file;
			$tarFile->add();
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
								$this->addNotice($o->getType(),$o->name,'MOVED','ok');
								$o->setParentId( $targetObjectId );
							}
							else
							{
								$this->addNotice($o->getType(),$o->name,'ERROR','error');
							}
						}
						else
						{
							$o->setParentId( $targetObjectId );
							$this->addNotice($o->getType(),$o->name,'MOVED','ok');
						}
						break;

					case 'copy':
						switch( $o->getType() )
						{
							case 'folder':
								// Ordner zur Zeit nicht kopieren
								// Funktion waere zu verwirrend
								$this->addNotice($o->getType(),$o->name,'CANNOT_COPY_FOLDER','error');
								break;

							case 'file':
								$f = new File( $id );
								$f->load();
								$f->filename = '';
								$f->name     = lang('COPY_OF').' '.$f->name;
								$f->parentid = $targetObjectId;
								$f->add();
								$f->copyValueFromFile( $id );

								$this->addNotice($o->getType(),$o->name,'COPIED','ok');
								break;

							case 'page':
								$p = new Page( $id );
								$p->load();
								$p->filename = '';
								$p->name     = lang('COPY_OF').' '.$p->name;
								$p->parentid = $targetObjectId;
								$p->add();
								$p->copyValuesFromPage( $id );
								$this->addNotice($o->getType(),$o->name,'COPIED','ok');
								break;

							case 'link':
								$l = new Link( $id );
								$l->load();
								$l->filename = '';
								$l->name     = lang('COPY_OF').' '.$l->name;
								$l->parentid = $targetObjectId;
								$l->add();
								$this->addNotice($o->getType(),$o->name,'COPIED','ok');
								break;

							default:
								die('fatal: what type to delete?');
						}
						$notices[] = lang('COPIED');
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
							$link->name           = lang('LINK_TO').' '.$o->name;
							$link->add();
							$this->addNotice($o->getType(),$o->name,'LINKED','ok');
						}
						else
						{
							$this->addNotice($o->getType(),$o->name,'ERROR','error');
						}
						break;

					case 'delete':

						if	( $this->hasRequestVar('confirm') )
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
							$this->addNotice($o->getType(),$o->name,'DELETED',OR_NOTICE_OK);
						}
						else
						{
							$this->addNotice($o->getType(),$o->name,'NOTHING_DONE',OR_NOTICE_WARN);
						}

						break;

					default:
						$this->addNotice($o->getType(),$o->name,'ERROR','error');
				}

			}
		}

		$this->folder->setTimestamp();
	}


	/**
	 * Reihenfolge von Objekten aendern.
	 */
	public function reorderPost()
	{
		$type = $this->getRequestVar('type');

		switch( $type )
		{
			case 'type':
				$ids = $this->folder->getObjectIdsByType();
				break;

			case 'name':
				$ids = $this->folder->getChildObjectIdsByName();
				break;

			case 'lastchange':
				$ids = $this->folder->getObjectIdsByLastChange();
				break;

			case 'flip':
				$ids = $this->folder->getObjectIds();
				$ids = array_reverse( $ids ); // Reihenfolge drehen

				break;

			default:
				throw new \InvalidArgumentException('Unknown reordertype: '.$type );
		}

		// Und jetzt die neu ermittelte Reihenfolge speichern
		$seq = 0;
		foreach( $ids as $id )
		{
			$seq++; // Sequenz um 1 erhoehen

			$o = new BaseObject( $id );
			$o->setOrderId( $seq );

			unset( $o );
		}
		$this->addNotice($this->folder->getType(),$this->folder->name,'SEQUENCE_CHANGED','ok');

		$this->folder->setTimestamp();
	}


    public function settopPost()
	{
		$o = new BaseObject( $this->getRequestVar('objectid1') );
		$o->setOrderId( 1 );

		$ids = $this->folder->getObjectIds();
		$seq = 1;

		foreach( $ids as $id )
		{
			if   ( $id != $this->getRequestVar('objectid1') )
			{
				$seq++; // Sequenz um 1 erhoehen

				$o = new BaseObject( $id );
				$o->setOrderId( $seq );

				unset( $o ); // Selfmade Garbage Collection :-)
			}
		}

		$this->addNotice($this->folder->getType(),$this->folder->name,'SEQUENCE_CHANGED','ok');
		$this->folder->setTimestamp();

		// Ordner anzeigen
		$this->callSubAction('order');
	}


    public function setbottomPost()
	{
		$ids = $this->folder->getObjectIds();
		$seq = 0;

		foreach( $ids as $id )
		{
			if   ( $id != $this->getRequestVar('objectid1') )
			{
				$seq++; // Sequenz um 1 erhoehen

				$o = new BaseObject( $id );
				$o->setOrderId( $seq );

				unset( $o ); // Selfmade Garbage Collection :-)
			}
		}

		$seq++; // Sequenz um 1 erhoehen
		$o = new BaseObject( $this->getRequestVar('objectid1') );
		$o->setOrderId( $seq );

		$this->addNotice($this->folder->getType(),$this->folder->name,'SEQUENCE_CHANGED','ok');
		$this->folder->setTimestamp();

		// Ordner anzeigen
		$this->callSubAction('order');

	}


	/**
	 * Alias für Methode 'create'.
	 */
	public function newView()
	{
		$this->nextSubAction('create');
	}


	/**
	 * Alias für Methode 'create'.
	 */
	public function newPost()
	{
		$this->nextSubAction('create');
	}


    public function createView()
	{
		// Maximale Dateigroesse.
		$maxSizeBytes = $this->maxFileSize();
		$this->setTemplateVar('max_size' ,($maxSizeBytes/1024).' KB' );
		$this->setTemplateVar('maxlength',$maxSizeBytes );

		$all_templates = Template::getAll();
		$this->setTemplateVar('templates' ,$all_templates );

		if	( count($all_templates) == 0 )
			$this->addNotice('folder',$this->folder->name,'NO_TEMPLATES_AVAILABLE',OR_NOTICE_WARN);

		$this->setTemplateVar('objectid'  ,$this->folder->objectid );
	}



    public function createfolderView()
	{
		$this->setTemplateVar('objectid'  ,$this->folder->objectid );
	}



	/**
	 * Ermittelt die maximale Gr��e einer hochzuladenden Datei.<br>
	 * Der Wert wird aus der PHP- und OpenRat-Konfiguration ermittelt.<br>
	 *
	 * @return Integer maximale Dateigroesse in Bytes
	 */
	private function maxFileSize()
	{
		global $conf;

		// When querying memory size values:
		// Many ini memory size values, such as upload_max_filesize,
		// are stored in the php.ini file in shorthand notation.
		// ini_get() will return the exact string stored in the php.ini file
		// and NOT its integer equivalent.
		$sizes = array(10*1024*1024*1024); // Init with 10GB enough? :)

		foreach( array('upload_max_filesize','post_max_size','memory_limit') as $var )
		{
			$v = $this->stringToBytes(ini_get($var));

			if	($v > 0 )
				$sizes[] = $v;
		}

		$confMaxSize = intval($conf['content']['file']['max_file_size'])*1024;
		if	( $confMaxSize > 0 )
			$sizes[] = $confMaxSize;

		return min($sizes);
	}


	/**
	 * Hochladen einer Datei.
	 *
	 */
    public function createfileView()
	{
		// Maximale Dateigroesse.
		$maxSizeBytes = $this->maxFileSize();
		$this->setTemplateVar('max_size' ,($maxSizeBytes/1024).' KB' );
		$this->setTemplateVar('maxlength',$maxSizeBytes );

		$this->setTemplateVar('objectid',$this->folder->objectid );
	}


	/**
	 * Umwandlung von abgek�rzten Bytewerten ("Shorthand Notation") wie
	 * "4M" oder "500K" in eine ganzzahlige Byteanzahl.<br>
	 * <br>
	 * Quelle: http://de.php.net/manual/de/function.ini-get.php
	 *
	 * @param String Abgek�rzter Bytewert
	 * @return Integer Byteanzahl
	 */
	private function stringToBytes($val)
	{
		$val  = trim($val);
		$last = strtolower($val{strlen($val)-1});
		// Achtung: Der Trick ist das "Fallthrough", kein "break" vorhanden!
		switch($last)
		{
			// The 'G' modifier is available since PHP 5.1.0
			case 'g':
				$val *= 1024;
			case 'm':
				$val *= 1024;
			case 'k':
				$val *= 1024;
		}

     	return intval($val);
	}



    public function createlinkView()
	{
		$this->setTemplateVar('objectid'  ,$this->folder->objectid );
	}


    public function createurlView()
	{
	}


    public function createpageView()
	{
		$all_templates = Template::getAll();
		$this->setTemplateVar('templates' ,$all_templates          );
		$this->setTemplateVar('objectid'  ,$this->folder->objectid );

		if	( count($all_templates) == 0 )
			$this->addNotice('folder',$this->folder->name,'NO_TEMPLATES_AVAILABLE',OR_NOTICE_WARN);
	}


	/**
	 * Anzeigen des Inhaltes, der Inhalt wird samt Header direkt
	 * auf die Standardausgabe geschrieben
	 */
	private function previewViewUnused()
	{
		$this->setTemplateVar('preview_url',Html::url('folder','show',$this->folder->objectid,array('target'=>'none') ) );
	}



	/**
	 * Anzeige aller Objekte in diesem Ordner.
	 */
	public function previewView()
	{
		global $conf_php;

		if   ( ! $this->folder->isRoot )
			$this->setTemplateVar('up_url',Html::url('folder','show',$this->folder->parentid));

		$list = array();

		// Schleife ueber alle Objekte in diesem Ordner
		foreach( $this->folder->getObjects() as $o )
		{
            /* @var $o BaseObject */

            $id = $o->objectid;

			if   ( $o->hasRight(ACL_READ) )
			{
				$list[$id]['name']     = Text::maxLaenge( 30,$o->name     );
				$list[$id]['filename'] = Text::maxLaenge( 20,$o->filename );
				$list[$id]['desc']     = Text::maxLaenge( 30,$o->desc     );
				if	( $list[$id]['desc'] == '' )
					$list[$id]['desc'] = lang('NO_DESCRIPTION_AVAILABLE');
				$list[$id]['desc'] = $list[$id]['desc'].' - '.lang('IMAGE').' '.$id;

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


	/**
	 * Anzeige aller Objekte in diesem Ordner.
	 */
	public function contentView()
	{
		global $conf_php;

		if   ( ! $this->folder->isRoot )
			$this->setTemplateVar('up_url',Html::url('folder','show',$this->folder->parentid));

		$this->setTemplateVar('writable',$this->folder->hasRight(ACL_WRITE) );

		$list = array();

		// Schleife ueber alle Objekte in diesem Ordner
		foreach( $this->folder->getObjects() as $o )
		{
            /* @var $o BaseObject */
            $id = $o->objectid;

			if   ( $o->hasRight(ACL_READ) )
			{
				$list[$id]['name']     = Text::maxLaenge( 30,$o->name     );
				$list[$id]['filename'] = Text::maxLaenge( 20,$o->filename );
				$list[$id]['desc']     = Text::maxLaenge( 30,$o->desc     );
				if	( $list[$id]['desc'] == '' )
					$list[$id]['desc'] = lang('NO_DESCRIPTION_AVAILABLE');
				$list[$id]['desc'] = $list[$id]['desc'].' - '.lang('IMAGE').' '.$id;

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


	public function editView()
	{
		global $conf_php;

		$this->setTemplateVar('writable',$this->folder->hasRight(ACL_WRITE) );

		$list = array();

		// Schleife ueber alle Objekte in diesem Ordner
		foreach( $this->folder->getObjects() as $o )
		{
		    /* @var $o BaseObject */
			$id = $o->objectid;

			if   ( $o->hasRight(ACL_READ) )
			{
				$list[$id]['objectid'] = $id;
				$list[$id]['id'      ] = 'obj'.$id;
				$list[$id]['name'    ] = $o->name;
				$list[$id]['filename'] = $o->filename;
				$list[$id]['desc'    ] = $o->desc;
				if	( $list[$id]['desc'] == '' )
					$list[$id]['desc'] = lang('NO_DESCRIPTION_AVAILABLE');
				$list[$id]['desc'] = 'ID '.$id.' - '.$list[$id]['desc'];

				$list[$id]['type'] = $o->getType();

				$list[$id]['icon'] = $o->getType();

				if	( $o->getType() == 'file' )
				{
					$file = new File( $id );
					$file->load();
					$list[$id]['size'] = $file->size;
					$list[$id]['desc'] .= ' - '.intval($file->size/1000).'kB';

					if	( substr($file->mimeType(),0,6) == 'image/' )
						$list[$id]['icon'] = 'image';
//					if	( substr($file->mimeType(),0,5) == 'text/' )
//						$list[$id]['icon'] = 'text';
				}

				$list[$id]['url' ] = Html::url($o->getType(),'',$id);
				$list[$id]['date'] = date( lang('DATE_FORMAT'),$o->lastchangeDate );
				$list[$id]['user'] = $o->lastchangeUser;

				if	( $this->hasRequestVar("markall") || $this->hasRequestVar('obj'.$id) )
					$this->setTemplateVar('obj'.$id,'1');
			}
		}

		if   ( $this->folder->hasRight(ACL_WRITE) )
		{
			// Alle anderen Ordner ermitteln
			$otherfolder = array();
			foreach( $this->folder->getAllFolders() as $id )
			{
				$f = new Folder( $id );
				if	( $f->hasRight( ACL_WRITE ) )
					$otherfolder[$id] = FILE_SEP.implode( FILE_SEP,$f->parentObjectNames(false,true) );
			}
			asort( $otherfolder );

			$this->setTemplateVar('folder',$otherfolder);

			// URLs zum Umsortieren der Eintraege
			$this->setTemplateVar('order_url'      ,Html::url('folder','order',$this->folder->id) );
		}

		$actionList = array();
		$actionList[] = 'copy';
		$actionList[] = 'link';
		$actionList[] = 'archive';

		if	( $this->folder->hasRight(ACL_WRITE) )
		{
			$actionList[] = 'move';
			$actionList[] = 'delete';
		}

		$this->setTemplateVar('actionlist',$actionList );
		$this->setTemplateVar('defaulttype',$this->getRequestVar('type','alpha'));

		$this->setTemplateVar('object'      ,$list            );
		$this->setTemplateVar('act_objectid',$this->folder->id);

		$rootFolder = new Folder( $this->folder->getRootFolderId() );
		$rootFolder->load();

		$this->setTemplateVar('properties'    ,$this->folder->getProperties() );
		$this->setTemplateVar('rootfolderid'  ,$rootFolder->id  );
		$this->setTemplateVar('rootfoldername',$rootFolder->name);
	}




	public function rootView()
	{
		$rootFolder = new Folder( Folder::getRootFolderId() );
		$rootFolder->load();

		$this->setTemplateVar('rootfolderid'  ,$rootFolder->id  );
		$this->setTemplateVar('rootfoldername',$rootFolder->name);
	}



	/**
	 * Reihenfolge bearbeiten.
	 */
    public function orderView()
	{
		global $conf_php;

		$list = array();
		$last_objectid = 0;

		// Schleife ueber alle Objekte in diesem Ordner
		foreach( $this->folder->getObjects() as $o )
		{
            /* @var $o BaseObject */
			$id = $o->objectid;

			if   ( $o->hasRight(ACL_READ) )
			{
				$list[$id]['id'  ]     = $id;
				$list[$id]['name']     = Text::maxLength( $o->name     ,30);
				$list[$id]['filename'] = Text::maxLength( $o->filename ,20);
				$list[$id]['desc']     = Text::maxLength( $o->desc     ,30);
				if	( $list[$id]['desc'] == '' )
					$list[$id]['desc'] = lang('NO_DESCRIPTION_AVAILABLE');
				$list[$id]['desc'] = 'ID '.$id.' - '.$list[$id]['desc'];

				$list[$id]['type'] = $o->getType();

				$list[$id]['icon'] = $o->getType();

				if	( $o->getType() == 'file' )
				{
					$file = new File( $id );
					$file->load();
					$list[$id]['desc'] .= ' - '.intval($file->size/1000).'kB';

					if	( $file->isImage() )
						$list[$id]['icon'] = 'image';
				}

				$list[$id]['url' ] = Html::url($o->getType(),'',$id);
				$list[$id]['date'] = $o->lastchangeDate;
				$list[$id]['user'] = $o->lastchangeUser;

				if   ( $last_objectid != 0 && $o->hasRight(ACL_WRITE) )
				{
					$list[$id           ]['upurl'    ] = Html::url('folder','changesequence',0,array(
					                                                     'objectid1'=>$id,
					                                                     'objectid2'=>$last_objectid));
					$list[$last_objectid]['downurl'  ] = $list[$id]['upurl'];
					$list[$last_objectid]['bottomurl'] = Html::url('folder','setbottom',0,array(
					                                                     'objectid1'=>$last_objectid));
					$list[$id           ]['topurl'   ] = Html::url('folder','settop',0,array(
					                                                     'objectid1'=>$id));
				}

				$last_objectid = $id;
			}
		}

		$this->setTemplateVar('flip_url'             ,Html::url('folder','reorder',0,array('type'=>'flip'      )) );
		$this->setTemplateVar('orderbyname_url'      ,Html::url('folder','reorder',0,array('type'=>'name'      )) );
		$this->setTemplateVar('orderbytype_url'      ,Html::url('folder','reorder',0,array('type'=>'type'      )) );
		$this->setTemplateVar('orderbylastchange_url',Html::url('folder','reorder',0,array('type'=>'lastchange')) );
		$this->setTemplateVar('object'      ,$list            );
		$this->setTemplateVar('act_objectid',$this->folder->id);
		$this->setTemplateVar('token',token() );
	}



	/**
	 * Eigenschaften anzeigen.
	 */
	public function propView()
	{
		$this->setTemplateVars( $this->folder->getProperties() );
	}

	/**
	 * Infos anzeigen.
	 */
	public function infoView()
	{
		$this->setTemplateVars( $this->folder->getProperties() );
		$this->setTemplateVar( 'full_filename',$this->folder->full_filename() );
	}



	/**
	 * Liefert die Struktur zu diesem Ordner:
	 * - Mit den übergeordneten Ordnern und
	 * - den in diesem Ordner enthaltenen Objekten
	 *
	 * Beispiel:
	 * <pre>
	 * - A
	 *   - B
	 *     - C (dieser Ordner)
	 *       - Unterordner
	 *       - Seite
	 *       - Seite
	 *       - Datei
	 * </pre>
	 */
	public function structureView()
	{

		$structure = array();
		$tmp = &$structure;
		$nr  = 0;

		$parents = $this->folder->parentObjectNames(false,true);

		foreach( $parents as $id=>$name)
		{
			//Html::debug($name,"Name");

			unset($children);
			unset($o);
			$children = array();
			$o = array('id'=>$id,'name'=>$name,'type'=>'folder','level'=>++$nr,'children'=>&$children);

			if	( $id == $this->folder->objectid)
				$o['self'] = true;

			$tmp[$id] = &$o;;

			unset($tmp);

			$tmp = &$children;
		}


		$contents = $this->folder->getObjects();

		unset($children);
		unset($o);

		$children = array();
		foreach( $contents as $o )
		{
            /* @var $o BaseObject */
			$children[$o->objectid] = array('id'=>$o->objectid,'name'=>$o->name,'type'=>$o->getType());
		}
		$tmp+= $children;

		//Html::debug($structure);

		$this->setTemplateVar('outline',$structure);
	}


	public function pubView()
	{
		// Schalter nur anzeigen, wenn sinnvoll
		$this->setTemplateVar('files'  ,count($this->folder->getFiles()) > 0 );
		$this->setTemplateVar('pages'  ,count($this->folder->getPages()) > 0 );
		$this->setTemplateVar('subdirs',count($this->folder->getSubFolderIds()) > 0 );

		//$this->setTemplateVar('clean'  ,$this->folder->isRoot );
		// Gefaehrliche Option, da dies bestehende Dateien, die evtl. nicht zum CMS gehören, überschreibt.
		// Daher deaktiviert.
		$this->setTemplateVar('clean'  ,false );
	}


	public function pubPost()
	{
		if	( !$this->folder->hasRight( ACL_PUBLISH ) )
			die('no rights for publish');

		$subdirs = ( $this->hasRequestVar('subdirs') );
		$pages   = ( $this->hasRequestVar('pages'  ) );
		$files   = ( $this->hasRequestVar('files'  ) );

		Session::close();
		$publish = new Publish();

		$this->folder->publish = &$publish;
		$this->folder->publish( $pages,$files,$subdirs );
		$this->folder->publish->close();

		$list = array();
		foreach( $publish->publishedObjects as $o )
			$list[] = $o['full_filename'];

		if	( !$publish->ok )
			$this->addNotice('folder',$this->folder->name,'PUBLISHED_ERROR',OR_NOTICE_ERROR,array(),$publish->log);
		else
			$this->addNotice('folder',$this->folder->name,'PUBLISHED',OR_NOTICE_OK,array(),$list);

		// Wenn gewuenscht, das Zielverzeichnis aufraeumen
		if	( $this->hasRequestVar('clean')      )
			$publish->clean();
	}



    public function checkMenu( $name )
	{
		switch( $name)
		{
			case 'createfolder':
				return !readonly() && $this->folder->hasRight(ACL_CREATE_FOLDER);

			case 'createfile':
				return !readonly() && $this->folder->hasRight(ACL_CREATE_FILE);

			case 'createlink':
				return !readonly() && $this->folder->hasRight(ACL_CREATE_LINK);

			case 'createpage':
				return !readonly() && $this->folder->hasRight(ACL_CREATE_PAGE);

			case 'remove':
				return !readonly() && count($this->folder->getObjectIds()) == 0;

			case 'select':
			case 'order':
			case 'aclform':
				return !readonly();

			default:
				return true;
		}
	}

	public function showView() {
	    $this->nextSubAction('edit');
    }
}