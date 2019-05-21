<?php

namespace cms\action;

use ArchiveTar;
use cms\model\Image;
use cms\model\Language;
use cms\model\Project;
use cms\model\Template;
use cms\model\Page;
use cms\model\Folder;
use cms\model\BaseObject;
use cms\model\File;
use cms\model\Link;

use cms\model\Text;
use cms\model\Url;
use cms\publish\PublishPublic;
use Http;
use Publish;
use Session;
use \Html;
use Upload;

/**
 * Action-Klasse zum Bearbeiten eines Ordners.
 *
 * @author Jan Dankert
 */

class FolderAction extends ObjectAction
{
	public $security = Action::SECURITY_USER;

    /**
     * @var Folder
     */
	private $folder;

    public function __construct()
	{
        parent::__construct();
    }


    public function init()
    {
		$this->folder = new Folder( $this->getRequestId() );
		$this->folder->languageid = $this->request->getLanguageId();
		$this->folder->load();

		$this->lastModified( $this->folder->lastchangeDate);

		parent::init();
	}



    public function createfolderPost()
	{
		$name        = $this->getRequestVar('name'       );
		$description = $this->getRequestVar('description');

		if   ( !empty($name) )
		{
			$f = new Folder();
			$f->projectid  = $this->folder->projectid;
			$f->languageid = $this->folder->languageid;
			$f->name       = $name;
			$f->filename   = BaseObject::urlify( $name );
			$f->desc       = $description;
			$f->parentid   = $this->folder->objectid;

			$f->add();
			$f->setNameForAllLanguages( $name,$description );

			$this->addNotice('folder',$f->name,'ADDED','ok');

			// Die neue Folder-Id (wichtig für API-Aufrufe).
            $this->setTemplateVar('objectid',$f->objectid);

            $this->folder->setTimestamp(); // Zeitstempel setzen.
        }
    else
        {
            $this->addValidationError('name');
        }

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
			$file->filename  = BaseObject::urlify( $name );
			$file->name      = !empty($name)?$name:basename($url);
			$file->size      = strlen($http->body);
			$file->value     = $http->body;
			$file->parentid  = $this->folder->objectid;
		}
		else
		{
            $upload = new Upload('file');

		    try
            {
                $upload->processUpload();
            }
            catch( \Exception $e )
            {
                // technical error.
                throw new \RuntimeException('Exception while processing the upload: '.$e->getMessage(), 0, $e);

                //throw new \ValidationException( $upload->parameterName );
            }

            $file->desc      = $description;
            $file->filename  = BaseObject::urlify( $upload->filename );
            $file->name      = !empty($name)?$name:$upload->filename;
            $file->extension = $upload->extension;
            $file->size      = $upload->size;
            $file->parentid  = $this->folder->objectid;
            $file->projectid = $this->folder->projectid;

            $file->value     = $upload->value;
		}

		$file->add(); // Datei hinzufuegen
        $file->setNameForAllLanguages( $name,$description );

		$this->addNotice('file',$file->name,'ADDED','ok');
		$this->setTemplateVar('objectid',$file->objectid);

		$this->folder->setTimestamp();
	}



    public function createimagePost()
	{
		$type        = $this->getRequestVar('type'       );
		$name        = $this->getRequestVar('name'       );
		$filename    = $this->getRequestVar('filename'   );
		$description = $this->getRequestVar('description');

		$image       = new Image();

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

			$image->desc      = $description;
			$image->filename  = BaseObject::urlify( basename($url) );
			$image->name      = !empty($name)?$name:basename($url);
			$image->size      = strlen($http->body);
			$image->value     = $http->body;
			$image->parentid  = $this->folder->objectid;
		}
		else
		{
			$upload = new Upload();

            try
            {
                $upload->processUpload();
            }
            catch( \Exception $e )
            {
                // technical error.
                throw new \RuntimeException('Exception while processing the upload: '.$e->getMessage(), 0, $e);

                //throw new \ValidationException( $upload->parameterName );
            }

            $image->desc      = $description;
            $image->filename  = BaseObject::urlify( $upload->filename );
            $image->name      = !empty($name)?$name:$upload->filename;
            $image->extension = $upload->extension;
            $image->size      = $upload->size;
            $image->parentid  = $this->folder->objectid;
            $image->projectid = $this->folder->projectid;

            $image->value     = $upload->value;
		}

		$image->add(); // Datei hinzufuegen
		$this->addNotice('file',$image->name,'ADDED','ok');
        $image->setNameForAllLanguages( $name,$description );
		$this->setTemplateVar('objectid',$image->objectid);

		$this->folder->setTimestamp();
	}



    public function createtextPost()
	{
		$name        = $this->getRequestVar('name'       );
		$description = $this->getRequestVar('description');

		$text   = new Text();

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

			$text->desc      = $description;
			$text->filename  = BaseObject::urlify( basename($url) );
			$text->name      = !empty($name)?$name:basename($url);
			$text->size      = strlen($http->body);
			$text->value     = $http->body;
			$text->parentid  = $this->folder->objectid;
            $text->projectid = $this->folder->projectid;
		}
		else
		{
			$upload = new Upload();

            try
            {
                $upload->processUpload();
            }
            catch( \Exception $e )
            {
                throw $e;
            }

            $text->desc      = $description;
            $text->filename  = BaseObject::urlify( $upload->filename );
            $text->name      = !empty($name)?$name:$upload->filename;
            $text->extension = $upload->extension;
            $text->size      = $upload->size;
            $text->parentid  = $this->folder->objectid;
            $text->projectid = $this->folder->projectid;

            $text->value     = $upload->value;
		}

		$text->add(); // Datei hinzufuegen
        $text->setNameForAllLanguages( $name,$description );
		$this->addNotice('file',$text->name,'ADDED','ok');
		$this->setTemplateVar('objectid',$text->objectid);

		$this->folder->setTimestamp();
	}



    public function createlinkPost()
	{
		$name        = $this->getRequestVar('name'       );
        $description = $this->getRequestVar('description');

        if   ( !empty($name) )
        {
            $link = new Link();
            $link->filename       = BaseObject::urlify( $name );
            $link->parentid       = $this->folder->objectid;

            $link->linkedObjectId = $this->getRequestVar('targetobjectid');
            $link->projectid      = $this->folder->projectid;

            $link->add();
            $link->setNameForAllLanguages( $name,$description );

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
			$url->filename       = BaseObject::urlify( $name );
			$url->parentid       = $this->folder->objectid;
            $url->projectid      = $this->folder->projectid;

			$url->url            = $this->getRequestVar('url');

			$url->add();
            $url->setNameForAllLanguages( $name,$description );

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
			$page->filename   = BaseObject::urlify( $name );
			$page->templateid = $this->getRequestVar('templateid');
			$page->parentid   = $this->folder->objectid;
			$page->projectid  = $this->folder->projectid;


			$page->add();
            $page->setNameForAllLanguages( $name,$description );

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
	 * Reihenfolge von Objekten aendern.
	 */
    public function orderPost()
	{
		$ids   = $this->folder->getObjectIds();
		$seq   = 0;

		$order = explode(',',$this->getRequestVar('order') );

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

		$this->addNotice($this->folder->getType(),$this->folder->name,'SEQUENCE_CHANGED','ok');
		$this->folder->setTimestamp();
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
	public function advancedPost()
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
								throw new \LogicException('fatal: what type to delete?');
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
	 * Alias für Methode 'create'.
	 */
	public function addView()
	{
		$this->nextSubAction('create');
	}


	/**
	 * Alias für Methode 'create'.
	 */
	public function addPost()
	{
		$this->nextSubAction('create');
	}


    public function createView()
	{
	    $this->setTemplateVar('mayCreateFolder',$this->folder->hasRight( ACL_CREATE_FOLDER ) );
	    $this->setTemplateVar('mayCreateFile'  ,$this->folder->hasRight( ACL_CREATE_FILE   ) );
	    $this->setTemplateVar('mayCreateText'  ,$this->folder->hasRight( ACL_CREATE_FILE   ) );
	    $this->setTemplateVar('mayCreateImage' ,$this->folder->hasRight( ACL_CREATE_FILE   ) );
	    $this->setTemplateVar('mayCreatePage'  ,$this->folder->hasRight( ACL_CREATE_PAGE   ) );
	    $this->setTemplateVar('mayCreateUrl'   ,$this->folder->hasRight( ACL_CREATE_LINK   ) );
	    $this->setTemplateVar('mayCreateLink'  ,$this->folder->hasRight( ACL_CREATE_LINK   ) );

	}



    public function createfolderView()
	{
		$this->setTemplateVar('objectid'  ,$this->folder->objectid   );
		$this->setTemplateVar('languageid',$this->folder->languageid );
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
	 * Hochladen einer Datei.
	 *
	 */
    public function createimageView()
	{
		// Maximale Dateigroesse.
		$maxSizeBytes = $this->maxFileSize();
		$this->setTemplateVar('max_size' ,($maxSizeBytes/1024).' KB' );
		$this->setTemplateVar('maxlength',$maxSizeBytes );

		$this->setTemplateVar('objectid',$this->folder->objectid );
	}


	/**
	 * Hochladen einer Datei.
	 *
	 */
    public function createtextView()
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
		$val  = intval($val);
		// Achtung: Der Trick ist das "Fallthrough", kein "break" vorhanden!
		switch($last)
		{
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
        $project = new Project( $this->folder->projectid );

        $all_templates = $project->getTemplates();
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
	public function editView()
	{
		global $conf_php;

		if   ( ! $this->folder->isRoot )
			$this->setTemplateVar('parentid',$this->folder->parentid);

		$list = array();

		// Schleife ueber alle Objekte in diesem Ordner
		foreach( $this->folder->getObjects() as $o )
		{
            /* @var $o BaseObject */

            $id = $o->objectid;

			if   ( $o->hasRight(ACL_READ) )
			{
				$list[$id]['name']     = \Text::maxLength($o->name, 30);
				$list[$id]['filename'] = \Text::maxLength($o->filename, 20);
				$list[$id]['desc']     = \Text::maxLength($o->desc, 30);
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
				$list[$id]['name']     = \Text::maxLength($o->name, 30);
				$list[$id]['filename'] = \Text::maxLength($o->filename, 20);
				$list[$id]['desc']     = \Text::maxLength($o->desc, 30);
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


	public function advancedView()
	{
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
			$project = new Project( $this->folder->projectid );
			foreach( $project->getAllFolders() as $id )
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

		$project = new Project($this->folder->projectid);
		$rootFolder = new Folder( $project->getRootObjectId() );
		$rootFolder->load();

		$this->setTemplateVar('properties'    ,$this->folder->getProperties() );
		$this->setTemplateVar('rootfolderid'  ,$rootFolder->id  );
		$this->setTemplateVar('rootfoldername',$rootFolder->name);
	}




	public function rootView()
	{
        $project = new Project($this->folder->projectid);
        $rootFolder = new Folder( $project->getRootObjectId() );
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
				$list[$id]['name']     = \Text::maxLength( $o->name     ,30);
				$list[$id]['filename'] = \Text::maxLength( $o->filename ,20);
				$list[$id]['desc']     = \Text::maxLength( $o->desc     ,30);
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

				$last_objectid = $id;
			}
		}

		$this->setTemplateVar('object'      ,$list            );
		$this->setTemplateVar('act_objectid',$this->folder->id);
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

        // TODO texts, urls....
		$this->setTemplateVar('files'  ,count($this->folder->getFiles()) >= 0 );
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
			throw new \SecurityException('no rights for publish');

		$subdirs = ( $this->hasRequestVar('subdirs') );
		$pages   = ( $this->hasRequestVar('pages'  ) );
		$files   = ( $this->hasRequestVar('files'  ) );

		Session::close();
		$publisher = new PublishPublic( $this->folder->projectid );

		$this->folder->publisher = &$publisher;
		$this->folder->publish( $pages,$files,$subdirs );

		$publisher->close();


		$list = array_map(
		    function($obj)
            {
                return $obj['full_filename'];
            },
            $publisher->publishedObjects
        );

		$this->addNotice('folder',$this->folder->getDefaultName()->name,'PUBLISHED',OR_NOTICE_OK,array(),$list);

		// Wenn gewuenscht, das Zielverzeichnis aufraeumen
		if	( $this->hasRequestVar('clean')      )
			$publisher->clean();
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


    /**
     * Shows the folder content as html.
     */
	public function showView() {

        // Angabe Content-Type
        header('Content-Type: text/html' );

        header('X-Folder-Id: '   .$this->folder->folderid );
        header('X-Id: '         .$this->folder->id       );
        header('Content-Description: '.$this->folder->filename() );

        echo '<html><body>';
        echo '<h1>'.$this->folder->filename.'</h1>';
        echo '<ul>';

        // Schleife ueber alle Objekte in diesem Ordner
        foreach( $this->folder->getObjects() as $o )
        {
            /* @var $o BaseObject */
            $id = $o->objectid;

            if   ( $o->hasRight(ACL_READ) )
            {
                echo '<li><a href="'. Html::url($o->getType(),'',$id).'">'.$o->filename.'</a></li>';

                //echo date( lang('DATE_FORMAT'),$o->lastchangeDate );
                //echo $o->lastchangeUser;
            }
        }

        echo '</ul>';
        echo '</body></html>';

        exit;
    }



    public function removeView()
    {
        $this->setTemplateVar( 'name',$this->folder->filename );
        $this->setTemplateVar( 'hasChildren', $this->folder->hasChildren() );
    }


    public function removePost()
    {
        if   ( !$this->hasRequestVar('delete') )
            throw new \ValidationException("delete");

        if  ( $this->hasRequestVar( 'withChildren'))
            $this->folder->deleteAll();  // Delete with children
        else
            if   ( $this->folder->hasChildren() )
                throw new \ValidationException("withChildren");
            else
                $this->folder->delete();  // Only delete current folder.

        $this->addNotice('folder',$this->folder->filename,'DELETED',OR_NOTICE_OK);
    }

}