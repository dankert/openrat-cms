<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// OpenRat Content Management System
// Copyright (C) 2002-2004 Jan Dankert, cms@jandankert.de
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
// ---------------------------------------------------------------------------
// $Log$
// Revision 1.52  2009-03-22 21:54:35  dankert
// Korrektur: Rechteabfrage für Verschieben/Löschen.
//
// Revision 1.51  2009-03-22 21:49:08  dankert
// Subaction "showprop" entfernt, da in "prop" mit aufgegangen.
//
// Revision 1.50  2009-03-17 01:43:19  dankert
// Auch Bilder (wieder) im gleichen Frame anzeigen.
//
// Revision 1.49  2009-03-02 23:07:11  dankert
// Bugfix: Sortieren nach Typ
//
// Revision 1.48  2009-02-07 02:41:37  dankert
// CSS-Klasse für Ordner-Inhalte ermitteln.
//
// Revision 1.47  2008-09-11 19:04:39  dankert
// Korrektur Rueckmeldung.
//
// Revision 1.46  2007-12-23 16:05:00  dankert
// Anzeigen der Ordner-Eigenschaften verbessert.
//
// Revision 1.45  2007-11-22 21:21:45  dankert
// Dateien auch per HTTP-Link anlegen.
//
// Revision 1.44  2007-11-15 21:41:59  dankert
// Warnmeldung, wenn es keine Seitenvorlagen gibt.
//
// Revision 1.43  2007-11-08 20:37:59  dankert
// Warnmeldung, wenn beim L?schen nicht best?tigt wird.
//
// Revision 1.42  2007-11-05 20:47:39  dankert
// Aufruf von "addValidationError(...)" bei Eingabefehlern.
//
// Revision 1.41  2007-10-05 23:32:40  dankert
// Nach dem Ver?ffentlichen auf Fehler abfragen.
//
// Revision 1.40  2007-10-02 21:13:44  dankert
// Men?punkt "Neu" mit direktem Hinzuf?gen von Objekten.
//
// Revision 1.39  2007-10-01 21:43:42  dankert
// Ermitteln der maximalen Dateigroesse bei Uploads.
//
// Revision 1.38  2007-07-02 20:14:07  dankert
// Ordnerinhalte rekursiv l?schen (also samt Unterordnern)
//
// Revision 1.37  2007-07-02 19:02:08  dankert
// Korrektur: Anzeige der letzten ?nderung.
//
// Revision 1.36  2006/06/01 19:11:46  dankert
// Abfragen von Rechten.
//
// Revision 1.35  2006/06/01 18:15:30  dankert
// Implementiert: "kopieren, verschieben, l?schen"
//
// Revision 1.34  2006/02/05 11:30:12  dankert
// Hinzuf?gen: Methode "select()"
//
// Revision 1.33  2006/01/29 17:18:58  dankert
// Steuerung der Aktionsklasse ?ber .ini-Datei, dazu umbenennen einzelner Methoden
//
// Revision 1.32  2006/01/23 23:08:52  dankert
// Kl. ?nderungen beim Anlegen von Objekten
//
// Revision 1.31  2006/01/11 22:50:00  dankert
// Neue Methode order()
//
// Revision 1.30  2005/11/07 22:31:38  dankert
// Wenn Dateiname=Objekt-Id, dann Dateinamen auf leer setzen.
//
// Revision 1.29  2005/01/28 23:05:39  dankert
// Bei Aenderungen des Verzeichnis-Inhaltes den Timestamp des Verzeichnisses aktualisieren
//
// Revision 1.28  2005/01/27 22:21:30  dankert
// Nach Generierung Systembefehl mit exec() ausf?hren
//
// Revision 1.27  2005/01/14 21:40:57  dankert
// Aufruf von lastModified() fuer Conditional-GET
//
// Revision 1.26  2004/12/30 23:11:03  dankert
// Wenn Root-Folder, dann keine Eigenschaften
//
// Revision 1.25  2004/12/30 21:44:23  dankert
// Nach Speichern der Eigenschaften wieder Eigenschaften aufrufen
//
// Revision 1.24  2004/12/29 20:43:30  dankert
// Kontextsensitives Anzeigen der Veroeffentlichungs-Checkboxen
//
// Revision 1.23  2004/12/28 22:58:23  dankert
// Neuer Schalter fuer "Liveserver aufraeumen"
//
// Revision 1.22  2004/12/27 23:26:39  dankert
// Seite vor dem Loeschen laden
//
// Revision 1.21  2004/12/27 23:24:50  dankert
// Korrektur Html::url(...)
//
// Revision 1.20  2004/12/26 20:54:29  dankert
// Sortierfunktion korrigiert
//
// Revision 1.19  2004/12/20 22:31:22  dankert
// Uebertragen des Benutzers geaendert
//
// Revision 1.18  2004/12/19 20:40:51  dankert
// Korrektur URLs
//
// Revision 1.17  2004/12/19 14:53:54  dankert
// pub2() -> pubnow()
//
// Revision 1.16  2004/12/15 23:23:11  dankert
// Anpassung an Session-Funktionen
//
// Revision 1.15  2004/11/29 23:24:36  dankert
// Korrektur Veroeffentlichung
//
// Revision 1.14  2004/11/29 21:09:51  dankert
// neue Methode pub2()
//
// Revision 1.13  2004/11/28 22:59:48  dankert
// Ausgabe von "notices"
//
// Revision 1.12  2004/11/28 21:27:07  dankert
// Ausgabe von "notices"
//
// Revision 1.11  2004/11/28 16:53:51  dankert
// Korrektur create()
//
// Revision 1.10  2004/11/27 13:06:26  dankert
// Ausgabe von Meldungen
//
// Revision 1.9  2004/11/10 22:36:16  dankert
// Dateioperationen, Verschieben/Kopieren/Verknuepfen von mehreren Objekten in einem Arbeitsschritt
//
// Revision 1.8  2004/10/14 22:57:44  dankert
// Neue Verknuepfungen mit dem Linknamen als Url vorbelegen
//
// Revision 1.7  2004/10/13 21:18:50  dankert
// Neue Links zum Verschieben nach ganz oben/unten
//
// Revision 1.6  2004/05/07 21:30:59  dankert
// Korrektur up_url
//
// Revision 1.5  2004/05/07 21:29:16  dankert
// Url ?ber Html::url erzeugen
//
// Revision 1.4  2004/05/02 14:49:37  dankert
// Einf?gen package-name (@package)
//
// Revision 1.3  2004/04/28 20:01:52  dankert
// Ordner l?schen erm?glichen
//
// Revision 1.2  2004/04/24 16:57:13  dankert
// Korrektur: pub()
//
// Revision 1.1  2004/04/24 15:14:52  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------


/**
 * Action-Klasse zum Bearbeiten eines Ordners
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */

class FolderAction extends ObjectAction
{
	var $defaultSubAction = 'show';
	var $folder;

	function FolderAction()
	{
		if	( $this->getRequestId() != 0  )
		{
			$this->folder = new Folder( $this->getRequestId() );
			$this->folder->load();
			Session::setObject( $this->folder );
		}
		else
		{
			$this->folder = Session::getObject();
		}
		
		// Datum letzte Aenderung an Browser uebertragen
		//$this->lastModified( $this->folder->lastchangeDate );
	}



	/**
	 * Neues Objekt anlegen.<br>
	 * Dies kann ein(e) Verzeichnis, Seite, Verkn�pfung oder Datei sein.<br>
	 */
	function createnew()
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
		
					$link->isLinkToObject = false;
					$link->url            = $name;
		
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
				
			default:
				$this->addValidationError('type');
				$this->callSubAction('create');
				
		}
						
	}	

	
	
	function createnewfolder()
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
		}
		else
		{
			$this->addValidationError('name');
			$this->callSubAction('createfolder');
		}
		
		$this->folder->setTimestamp();
	}	



	function createnewfile()
	{
		$type        = $this->getRequestVar('type'       );
		$name        = $this->getRequestVar('name'       );
		$filename    = $this->getRequestVar('filename'   );
		$description = $this->getRequestVar('description');
		
		$file   = new File();
		
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
			
			if	( !$upload->isValid() )
			{
				$this->addValidationError('file','COMMON_VALIDATION_ERROR',array(),$upload->error);
				$this->callSubAction('createfile');
				return;
			}
	
			$file->desc      = $description;
			$file->filename  = $upload->filename;
			$file->name      = !empty($name)?$name:$upload->filename;
			$file->extension = $upload->extension;		
			$file->size      = $upload->size;
			$file->parentid  = $this->folder->objectid;
	
			$file->value     = $upload->value;
		}

		$file->add(); // Datei hinzufuegen
		$this->addNotice('file',$file->name,'ADDED','ok');

		$this->folder->setTimestamp();

		$this->setTemplateVar('tree_refresh',true);
	}	



	function createnewlink()
	{
		$type        = $this->getRequestVar('type'       );
		$name        = $this->getRequestVar('name'       );
		$filename    = $this->getRequestVar('filename'   );
		$description = $this->getRequestVar('description');
		
		if   ( !empty($name) )
		{
			$link = new Link();
			$link->name           = $name;
			$link->desc           = $description;
			$link->parentid       = $this->folder->objectid;

			$link->isLinkToObject = false;
			$link->url            = $this->getRequestVar('name');

			$this->addNotice('link',$link->name,'ADDED','ok');

			$link->add();
		}
		else
		{
			$this->addValidationError('name');
			$this->callSubAction('createlink');
			return;
		}
		
		$this->folder->setTimestamp();
	}	



	function createnewpage()
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

			$this->addNotice('page',$page->name,'ADDED','ok');
			$page->add();
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
	function saveprop()
	{
		// Ordnereigenschaften speichern
		if   ( $this->getRequestVar('name') != '' )
			$this->folder->name     = $this->getRequestVar('name'    ,'full');
		elseif ($this->getRequestVar('filename') != '' )
		 	$this->folder->name     = $this->getRequestVar('filename','alphanum');
		else
		{
			$this->addValidationError('name');
			$this->addValidationError('filename');
			$this->callSubAction('prop');
			return;
		}
		
		$this->folder->filename = $this->getRequestVar('filename'   ,'alphanum');
		$this->folder->desc     = $this->getRequestVar('description','full'    );
		$this->folder->save();
		$this->addNotice($this->folder->getType(),$this->folder->name,'PROP_SAVED','ok');
	}


	/**
	 * Abspeichern der Ordner-Eigenschaften. Ist der Schalter "delete" gesetzt, wird
	 * der Ordner stattdessen gel?scht.
	 */
	function delete()
	{
		if   ( $this->getRequestVar('delete') != '' )
		{
			// Ordner l?schen
			$this->folder->delete();
			$this->addNotice($this->folder->getType(),$this->folder->name,lang('DELETED'),'ok');
		}
	}


	// Reihenfolge von Objekten aendern
	function changesequence()
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
				
			$o = new Object( $id );
			$o->setOrderId( $seq );
	
			unset( $o ); // Selfmade Garbage Collection :-)
		}
		
		$this->addNotice($this->folder->getType(),$this->folder->name,'SEQUENCE_CHANGED','ok');
		$this->folder->setTimestamp();

		// Ordner anzeigen
		$this->callSubAction('order');
		
	}


	/**
	 * Verschieben/Kopieren/Loeschen/Verknuepfen von mehreren Dateien in diesem Ordner.
	 * 
	 * Es werden alle ausgew�hlten Dateien nochmal angezeigt.
	 * Abh�ngig von der ausgew�hlten Aktion wird eine weitere Auswahl ben�tigt. 
	 */
	function edit()
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
				exit("trouble");
				
		} // switch
		
		$ids        = $this->folder->getObjectIds();
		$objectList = array();

		foreach( $ids as $id )
		{
			// Nur, wenn Objekt ausgewaehlt wurde
			if	( !$this->hasRequestVar('obj'.$id) )
				continue;

			$o = new Object( $id );
			$o->load();
			
			// F�r die gew�nschte Aktion m�ssen pro Objekt die entsprechenden Rechte
			// vorhanden sein.
			if	( $type == 'copy'   && $o->hasRight( ACL_READ   ) ||
				  $type == 'move'   && $o->hasRight( ACL_DELETE ) ||
				  $type == 'link'   && $o->hasRight( ACL_READ   ) ||
				  $type == 'delete' && $o->hasRight( ACL_DELETE )    )
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
	function multiple()
	{
		$type           = $this->getRequestVar('type');
		$ids            = explode(',',$this->getRequestVar('ids'));
		$targetObjectId = $this->getRequestVar('targetobjectid');

		foreach( $ids as $id )
		{
			$o = new Object( $id );
			$o->load();

			switch( $type )
			{
				case 'move':
					if	( $o->isFolder )
					{
						$f = new Folder( $id );
						$allsubfolders = $f->getAllSubFolderIds();
						
						// Wenn
						// - Das Zielverzeichnis sich nicht in einem Unterverzeichnis des zu verschiebenen Ordners liegt
						// und
						// - Das Zielverzeichnis nicht der zu verschiebene Ordner ist
						// dann verschieben
						if	( !in_array($targetObjectId,$allsubfolders) && $id != $targetObjectId )
						{
							$this->addNotice($o->getType(),$o->name,'MOVED','ok');
							//$o->setParentId( $targetObjectId );
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
							$f->name     = lang('GLOBAL_COPY_OF').' '.$f->name;
							$f->parentid = $targetObjectId;
							$f->add();
							$f->copyValueFromFile( $id );
							$this->addNotice($o->getType(),$o->name,'COPIED','ok');
							break;
						
						case 'page':
							$p = new Page( $id );
							$p->load();
							$p->filename = '';
							$p->name     = lang('GLOBAL_COPY_OF').' '.$p->name;
							$p->parentid = $targetObjectId;
							$p->add();
							$p->copyValuesFromPage( $id );
							$this->addNotice($o->getType(),$o->name,'COPIED','ok');
							break;
						
						case 'link':
							$l = new Link( $id );
							$l->load();
							$l->filename = '';
							$l->name     = lang('GLOBAL_COPY_OF').' '.$l->name;
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
						  $o->isPage  )  // Nur Seiten oder Dateien sind verknuepfbar
					{
						$link = new Link();
						$link->parentid       = $targetObjectId;
				
						$link->linkedObjectId = $id;
						$link->isLinkToObject = true;
						$link->name           = lang('GLOBAL_LINK_TO').' '.$o->name;
						$link->add();
						$this->addNotice($o->getType(),$o->name,'LINKED','ok');
					}
					else
					{
						$this->addNotice($o->getType(),$o->name,'ERROR','error');
					}
					break;
	
				case 'delete':

					if	( $this->hasRequestVar('commit') ) 
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
							
							default:
								Http::serverError('Internal Error while deleting: What type to delete?');
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

		$this->folder->setTimestamp();
		
		// Ordner anzeigen
		$this->callSubAction('show');
	}


	// Reihenfolge von Objekten aendern
	function reorder()
	{
		$type = $this->getRequestVar('type');
		
		switch( $type )
		{
			case 'type':
				$ids = $this->folder->getObjectIdsByType();
				break;

			case 'name':
				$ids = $this->folder->getObjectIdsByName();
				break;

			case 'lastchange':
				$ids = $this->folder->getObjectIdsByLastChange();
				break;

			case 'flip':
				$ids = $this->folder->getObjectIds();
				$ids = array_reverse( $ids ); // Reihenfolge drehen
				
				break;

			default:
				Http::sendStatus(400,'Bad request','Unknown reordertype: '.$type );
		}

		// Und jetzt die neu ermittelte Reihenfolge speichern
		$seq = 0;
		foreach( $ids as $id )
		{
			$seq++; // Sequenz um 1 erhoehen
			
			$o = new Object( $id );
			$o->setOrderId( $seq );
	
			unset( $o );
		}
		$this->addNotice($this->folder->getType(),$this->folder->name,'SEQUENCE_CHANGED','ok');

		$this->folder->setTimestamp();
		
		// Ordner anzeigen
		$this->callSubAction('order');
	}


	function settop()
	{
		$o = new Object( $this->getRequestVar('objectid1') );
		$o->setOrderId( 1 );

		$ids = $this->folder->getObjectIds();
		$seq = 1;

		foreach( $ids as $id )
		{
			if   ( $id != $this->getRequestVar('objectid1') )
			{
				$seq++; // Sequenz um 1 erhoehen

				$o = new Object( $id );
				$o->setOrderId( $seq );
	
				unset( $o ); // Selfmade Garbage Collection :-)
			}
		}

		$this->addNotice($this->folder->getType(),$this->folder->name,'SEQUENCE_CHANGED','ok');
		$this->folder->setTimestamp();
		
		// Ordner anzeigen
		$this->callSubAction('order');
	}


	function setbottom()
	{
		$ids = $this->folder->getObjectIds();
		$seq = 0;

		foreach( $ids as $id )
		{
			if   ( $id != $this->getRequestVar('objectid1') )
			{
				$seq++; // Sequenz um 1 erhoehen

				$o = new Object( $id );
				$o->setOrderId( $seq );
	
				unset( $o ); // Selfmade Garbage Collection :-)
			}
		}

		$seq++; // Sequenz um 1 erhoehen
		$o = new Object( $this->getRequestVar('objectid1') );
		$o->setOrderId( $seq );

		$this->addNotice($this->folder->getType(),$this->folder->name,'SEQUENCE_CHANGED','ok');
		$this->folder->setTimestamp();
		
		// Ordner anzeigen
		$this->callSubAction('order');
		
	}


	function create()
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



	function createfolder()
	{
		$this->setTemplateVar('objectid'  ,$this->folder->objectid );
	}



	/**
	 * Ermittelt die maximale Gr��e einer hochzuladenden Datei.<br>
	 * Der Wert wird aus der PHP- und OpenRat-Konfiguration ermittelt.<br>
	 * 
	 * @return Integer maximale Dateigroesse in Bytes
	 */
	function maxFileSize()
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
	function createfile()
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
	function stringToBytes($val)
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
 
	

	function createlink()
	{
		$this->setTemplateVar('objectid'  ,$this->folder->objectid );
	}


	function createpage()
	{
		$all_templates = Template::getAll();
		$this->setTemplateVar('templates' ,$all_templates          );
		$this->setTemplateVar('objectid'  ,$this->folder->objectid );

		if	( count($all_templates) == 0 )
			$this->addNotice('folder',$this->folder->name,'NO_TEMPLATES_AVAILABLE',OR_NOTICE_WARN);
	}


	/**
	 * Anzeige aller Objekte in diesem Ordner.
	 * @return unknown_type
	 */
	function show()
	{
		global $conf_php;

		if   ( ! $this->folder->isRoot )
			$this->setTemplateVar('up_url',Html::url('main','folder',$this->folder->parentid));

		$this->setTemplateVar('writable',$this->folder->hasRight(ACL_WRITE) );
		
		$list = array();

		// Schleife ueber alle Objekte in diesem Ordner
		foreach( $this->folder->getObjects() as $o )
		{
			$id = $o->objectid;

			if   ( $o->hasRight(ACL_READ) )
			{
				$list[$id]['name']     = Text::maxLaenge( 30,$o->name     );
				$list[$id]['filename'] = Text::maxLaenge( 20,$o->filename );
				$list[$id]['desc']     = Text::maxLaenge( 30,$o->desc     );
				if	( $list[$id]['desc'] == '' )
					$list[$id]['desc'] = lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');
				$list[$id]['desc'] = $list[$id]['desc'].' - '.lang('GLOBAL_IMAGE').' '.$id; 

				$list[$id]['type'] = $o->getType();
				
				$list[$id]['icon' ] = $o->getType();
				$list[$id]['class'] = $o->getType();
				$list[$id]['url' ] = Html::url('main',$o->getType(),$id);
				
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


	function select()
	{
		global $conf_php;

		$this->setTemplateVar('writable',$this->folder->hasRight(ACL_WRITE) );
		
		$list = array();

		// Schleife ueber alle Objekte in diesem Ordner
		foreach( $this->folder->getObjects() as $o )
		{
			$id = $o->objectid;

			if   ( $o->hasRight(ACL_READ) )
			{
				$list[$id]['id']     = 'obj'.$id;
				$list[$id]['name']     = Text::maxLaenge( 30,$o->name     );
				$list[$id]['filename'] = Text::maxLaenge( 20,$o->filename );
				$list[$id]['desc']     = Text::maxLaenge( 30,$o->desc     );
				if	( $list[$id]['desc'] == '' )
					$list[$id]['desc'] = lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');
				$list[$id]['desc'] = 'ID '.$id.' - '.$list[$id]['desc']; 

				$list[$id]['type'] = $o->getType();
				
				$list[$id]['icon'] = $o->getType();

				if	( $o->getType() == 'file' )
				{
					$file = new File( $id );
					$file->load();
					$list[$id]['desc'] .= ' - '.intval($file->size/1000).'kB';

					if	( substr($file->mimeType(),0,6) == 'image/' )
						$list[$id]['icon'] = 'image';
//					if	( substr($file->mimeType(),0,5) == 'text/' )
//						$list[$id]['icon'] = 'text';
				}

				$list[$id]['url' ] = Html::url('main',$o->getType(),$id);
				$list[$id]['date'] = date( lang('DATE_FORMAT'),$o->lastchangeDate );
				$list[$id]['user'] = $o->lastchangeUser;
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
		$actionList[] = array('type'=>'copy');
		$actionList[] = array('type'=>'link');

		if	( $this->folder->hasRight(ACL_WRITE) )
		{
			$actionList[] = array('type'=>'move');
			$actionList[] = array('type'=>'delete');
		}
		
		$this->setTemplateVar('actionlist',$actionList );

		$this->setTemplateVar('object'      ,$list            );
		$this->setTemplateVar('act_objectid',$this->folder->id);
	}






	function order()
	{
		global $conf_php;

		$list = array();
		$last_objectid = 0;

		// Schleife ueber alle Objekte in diesem Ordner
		foreach( $this->folder->getObjects() as $o )
		{
			$id = $o->objectid;

			if   ( $o->hasRight(ACL_READ) )
			{
				$list[$id]['name']     = Text::maxLaenge( 30,$o->name     );
				$list[$id]['filename'] = Text::maxLaenge( 20,$o->filename );
				$list[$id]['desc']     = Text::maxLaenge( 30,$o->desc     );
				if	( $list[$id]['desc'] == '' )
					$list[$id]['desc'] = lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');
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

				$list[$id]['url' ] = Html::url('main',$o->getType(),$id);
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
	}


	
	function prop()
	{
		$this->setTemplateVars( $this->folder->getProperties() );
		$this->setTemplateVar( 'full_filename',$this->folder->full_filename() );
	}


	function remove()
	{
		$this->setTemplateVars( $this->folder->getProperties() );
	}


	function pub()
	{
		// Schalter nur anzeigen, wenn sinnvoll
		$this->setTemplateVar('files'  ,count($this->folder->getFiles()) > 0 );
		$this->setTemplateVar('pages'  ,count($this->folder->getPages()) > 0 );
		$this->setTemplateVar('subdirs',count($this->folder->getSubFolderIds()) > 0 );
		$this->setTemplateVar('clean'  ,$this->folder->isRoot );
		
//		$this->addNotice('folder',$this->folder->name,'MUCH_TIME',OR_NOTICE_WARN);
	}


	function pubnow()
	{
		if	( !$this->folder->hasRight( ACL_PUBLISH ) )
			die('no rights for publish');

		$subdirs = ( $this->hasRequestVar('subdirs') );
		$pages   = ( $this->hasRequestVar('pages'  ) );
		$files   = ( $this->hasRequestVar('files'  ) );

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

		$this->callSubaction( 'pub' );
	}
	
	
	
	function checkMenu( $name )
	{
		switch( $name)
		{
			case 'createfolder':
				return !readonly() && $this->folder->hasRight(ACL_CREATE_FOLDER) && count($this->folder->parentObjectFileNames(true,true)) < MAX_FOLDER_DEPTH;

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
}