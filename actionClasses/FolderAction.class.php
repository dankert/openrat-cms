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
// Revision 1.14  2004-11-29 21:09:51  dankert
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
		$this->folder = new Folder( $this->getSessionVar('objectid') );
		$this->folder->load();

		if	( ! $this->folder->isFolder )
			die( ' id '.$this->folder->objectid.' is not a folder' );
	}


	function createnew()
	{
		// Neues Objekt in diesem Ordner anlegen
		switch( $this->getRequestVar('type') )
		{
			case 'folder':

				if   ( $this->getRequestVar('foldername') != '' )
				{
					$f = new Folder();
					$f->name     = $this->getRequestVar('foldername');
					$f->filename = $this->getRequestVar('foldername');
					$f->parentid = $this->folder->objectid; 

					$f->add();
					$this->addNotice('folder',$f->name,'ADDED','ok');
				}

				break;
			
			case 'page':

				if   ( $this->getRequestVar('pagename') != '' )
				{
					$page = new Page();
					$page->name       = $this->getRequestVar('pagename'  );
					$page->filename   = $this->getRequestVar('pagename'  );
					$page->templateid = $this->getRequestVar('templateid');
					$page->parentid   = $this->folder->objectid;

					$this->addNotice('page',$page->name,'ADDED','ok');
					$page->add();
				}

				break;
			
			case 'file':

				$file   = new File();
				$upload = new Upload();
		
				$file->filename  = $upload->filename;
				$file->name      = $upload->filename;
				$file->extension = $upload->extension;		
				$file->size      = $upload->size;
				$file->parentid  = $this->folder->objectid;
		
				$file->value     = $upload->value;
		
				$file->add(); // Datei hinzufuegen
				$this->addNotice('file',$file->name,'ADDED','ok');
				break;
			
			case 'link':

				if   ( $this->getRequestVar('linkname') != '' )
				{
					$link = new Link();
					$link->name           = $this->getRequestVar('linkname');
					$link->parentid       = $this->folder->objectid; 
					$link->isLinkToObject = false;
					$link->url            = $this->getRequestVar('linkname');;
					$this->addNotice('link',$link->name,'ADDED','ok');
					$link->add();
				}
				break;
			
			default: die();
		}

		$this->setTemplateVar('tree_refresh',true);
		$this->callSubAction('show');
	}	


	/**
	 * Abspeichern der Ordner-Eigenschaften. Ist der Schalter "delete" gesetzt, wird
	 * der Ordner stattdessen gel?scht.
	 */
	function save()
	{
		if   ( $this->getRequestVar('delete') != '' )
		{
			// Ordner l?schen
			$this->folder->delete();
			$this->addNotice($this->folder->getType(),$this->folder->name,lang('DELETED'),'ok');
		}
		else
		{
			// Ordnereigenschaften speichern
			if   ( $this->getRequestVar('name') != '' )
				$this->folder->name     = $this->getRequestVar('name'    );
			else	$this->folder->name     = $this->getRequestVar('filename');

			$this->folder->filename = $this->getRequestVar('filename');
			$this->folder->desc     = $this->getRequestVar('desc');
			$this->folder->save();
			$this->addNotice($this->folder->getType(),$this->folder->name,lang('PROP_SAVED'),'ok');
		}
	
		$this->setTemplateVar('tree_refresh',true);
		$this->callSubAction('show');
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

		// Ordner anzeigen
		$this->callSubAction('show');
		
	}


	// Verschieben/Kopieren/Loeschen/Verknuepfen von mehreren Dateien in diesem Ordner
	function multiple()
	{
		$ids  = $this->folder->getObjectIds();
		$type = $this->getRequestVar('type');
		$targetObjectId = intval($this->getRequestVar('targetobjectid'));

		if	( $targetObjectId == 0 )
			exit('fatal: no target');

		$notices = array();

		foreach( $ids as $id )
		{
			// Nur, wenn Objekt ausgewaehlt wurde
			if	( $this->getRequestVar('obj'.$id) != '1' )
				continue;

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

					switch( $o->getType() )
					{
						case 'folder':
							$f = new Folder( $id );
							$f->delete();
							break;
						
						case 'file':
							$f = new File( $id );
							$f->delete();
							break;
						
						case 'page':
							$p = new Page( $id );
							$p->delete();
							break;
						
						case 'link':
							$l = new Link( $id );
							$l->delete();
							break;
						
						default:
							die('fatal: what type to delete?');
					}
					$this->addNotice($o->getType(),$o->name,'DELETED','ok');
					break;

				default:
					$this->addNotice($o->getType(),$o->name,'ERROR','error');
			}

		}
		
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
				die('fatal: unknown reordertype');
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
		
		// Ordner anzeigen
		$this->callSubAction('show');
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
		
		// Ordner anzeigen
		$this->callSubAction('show');
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
		
		// Ordner anzeigen
		$this->callSubAction('show');
		
	}


	function move()
	{
		$this->objectMove();

		$this->callSubAction('show');
	}


	function create()
	{
		$this->setTemplateVar('templates',Template::getAll());
		$this->setTemplateVar('new_folder',$this->folder->hasRight(ACL_CREATE_FOLDER));
		$this->setTemplateVar('new_file'  ,$this->folder->hasRight(ACL_CREATE_FILE  ));
		$this->setTemplateVar('new_link'  ,$this->folder->hasRight(ACL_CREATE_LINK  ));
		$this->setTemplateVar('new_page'  ,$this->folder->hasRight(ACL_CREATE_PAGE  ));
		
		$this->forward('folder_new');
	}



	function show()
	{
		global $conf_php;

		if   ( ! $this->folder->isRoot )
			$this->setTemplateVar('up_url',Html::url(array('action'=>'main','callAction'=>'folder','callSubaction'=>'show','objectid'=>$this->folder->parentid)));
		
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
					$list[$id]['desc'] = lang('NO_DESCRIPTION_AVAILABLE');
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

				$list[$id]['url' ] = Html::url(array('action'    =>'main',
				                                     'callAction'=>$o->getType(),
				                                     'objectid'  =>$id));
				$list[$id]['propurl' ] = Html::url(array('action'=>$o->getType(),
				                                         'subaction'=>'prop',
				                                         'objectid'=>$id));
				$list[$id]['date'] = date( lang('DATE_FORMAT'),$o->lastchange_date );
				$list[$id]['user'] = User::getUserName( $o->lastchange_userid );

				if   ( $last_objectid != 0 && $o->hasRight(ACL_WRITE) )
				{
					$list[$id           ]['upurl'    ] = Html::url(array('action'   =>'folder',
					                                                     'subaction'=>'changesequence',
					                                                     'objectid1'=>$id,
					                                                     'objectid2'=>$last_objectid));
					$list[$last_objectid]['downurl'  ] = $list[$id]['upurl'];
					$list[$last_objectid]['bottomurl'] = Html::url(array('action'   =>'folder',
					                                                     'subaction'=>'setbottom',
					                                                     'objectid1'=>$last_objectid));
					$list[$id           ]['topurl'   ] = Html::url(array('action'   =>'folder',
					                                                     'subaction'=>'settop',
					                                                     'objectid1'=>$id));
				}

				$last_objectid = $id;
			}
		}

		if   ( $o->hasRight(ACL_WRITE) )
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
			$this->setTemplateVar('orderbytype_url'      ,Html::url(array('action'   =>'folder',
			                                                              'subaction'=>'reorder',
			                                                              'type'     =>'type')) );
			$this->setTemplateVar('orderbyname_url'      ,Html::url(array('action'   =>'folder',
			                                                              'subaction'=>'reorder',
			                                                              'type'     =>'name')) );
			$this->setTemplateVar('orderbylastchange_url',Html::url(array('action'   =>'folder',
			                                                              'subaction'=>'reorder',
			                                                              'type'     =>'lastchange')) );
			$this->setTemplateVar('flip_url'             ,Html::url(array('action'   =>'folder',
			                                                              'subaction'=>'reorder',
			                                                              'type'     =>'flip')) );
		}	
		$this->setTemplateVar('object'      ,$list            );
		$this->setTemplateVar('act_objectid',$this->folder->id);

		$this->forward('folder_show');
		
	}


	function prop()
	{
		$this->setTemplateVars( $this->folder->getProperties() );
	
		// Alle Ordner ermitteln
		$this->setTemplateVar('act_objectid',$this->folder->objectid);
		
		$list = array();
		$allsubfolders = $this->folder->getAllSubFolderIds();
		
		foreach( $this->folder->getOtherFolders() as $id )
		{
			$f = new Folder( $id );
			if   ( ! in_array($id,$allsubfolders) )
				$list[$id] = implode( ' &raquo; ',$f->parentObjectNames(true,true) );
		}
		asort( $list );
		$this->setTemplateVar('folder',$list);
		
		// Wenn Ordner leer ist, dann L?schen erm?glichen
		if	( count($this->folder->getObjectIds()) == 0 )
			$this->setTemplateVar('delete',true );
		else	$this->setTemplateVar('delete',false);
	
		$this->forward('folder_prop');
	}


	function pub()
	{
		$this->forward('folder_pub');
	}


	function pub2()
	{
		$subdirs = ( $this->hasRequestVar('subdirs') );
		$pages   = ( $this->hasRequestVar('pages'  ) );
		$files   = ( $this->hasRequestVar('files'  ) );

		$publish = new Publish();
		
		$this->folder->publish = &$publish;
		$this->folder->publish( $pages,$files,$subdirs );

		foreach( $publish->publishedObjects as $o )
		{
			$this->addNotice('',$o['filename'],'PUBLISHED','ok');
		}

		$this->callSubaction( 'pub' );
	}
}