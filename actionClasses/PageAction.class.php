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
// Revision 1.18  2004-12-15 23:23:11  dankert
// Anpassung an Session-Funktionen
//
// Revision 1.17  2004/11/29 23:52:33  dankert
// Korrektur Vorversion
//
// Revision 1.16  2004/11/29 23:48:00  dankert
// Korrektur Vorversion
//
// Revision 1.15  2004/11/29 23:34:59  dankert
// Beim Speichern von Seiteninhalten den Zeitstempel setzen
//
// Revision 1.14  2004/11/29 23:24:36  dankert
// Korrektur Veroeffentlichung
//
// Revision 1.13  2004/11/27 09:55:54  dankert
// Rechte-Funktionen entfernt, Anzahl Versionen in Elementliste
//
// Revision 1.12  2004/11/10 22:39:24  dankert
// Entfernen der Methode move()
//
// Revision 1.11  2004/10/13 22:12:57  dankert
// Neue Seitenfunktion zum gleichzeitigen Bearbeiten aller Seiteninhalte
//
// Revision 1.10  2004/10/05 10:00:49  dankert
// Neue Funktionalit?t: Austauschen einer Vorlage
//
// Revision 1.9  2004/09/07 21:12:08  dankert
// Seiten laden bei elsave()
//
// Revision 1.8  2004/05/03 20:22:58  dankert
// move() korrigiert
//
// Revision 1.7  2004/05/02 14:49:37  dankert
// Einf?gen package-name (@package)
//
// Revision 1.6  2004/05/02 12:00:44  dankert
// Initialisieren von $value->publish
//
// Revision 1.5  2004/04/30 21:07:32  dankert
// Auswerten von Schalter $release
//
// Revision 1.4  2004/04/30 20:31:47  dankert
// Berechtigungen anzeigen
//
// Revision 1.3  2004/04/25 19:01:02  dankert
// Speichern von Elementen, die in allen Sprachen gleich sind
//
// Revision 1.2  2004/04/24 16:55:27  dankert
// Korrektur: pub()
//
// Revision 1.1  2004/04/24 15:14:52  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------

/**
 * Action-Klasse zum Bearbeiten einer Seite
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */

class PageAction extends ObjectAction
{
	var $page;
	var $defaultSubAction = 'show';


	function PageAction()
	{
		$this->page = Session::getObject();
		
		if	( $this->getRequestId() != 0  )
		{
			$this->page = new Page( $this->getRequestId() );
			$this->page->load();
			Session::setObject( $this->page );
		}
		else
		{
			$this->page = Session::getObject();
		}
	}


	/**
	 * Alle Daten aus dem Formular speichern
	 */
	function saveform()
	{
		$this->page->public = true;
		$this->page->simple = true;
		$this->page->generate_elements();

		foreach( $this->page->values as $id=>$value )
		{
			if   ( $value->element->isWritable() && $this->getRequestVar('saveid'.$value->element->elementid)=='1' )
			{
				$value = new Value();
				$value->objectid   = $this->page->objectid;
				$value->pageid     = Page::getPageIdFromObjectId( $value->objectid );
				$value->element = new Element( $id );
				$value->element->load();
				$value->publish = false;
				$value->load();
		
				$varname = 'id'.$value->element->elementid;
				$inhalt  = $this->getRequestVar($varname);
		
				switch( $value->element->type )
				{
					case 'number':
						$value->number = $inhalt * pow(10,$value->element->decimals);
						break;

					case 'date':
						$value->date = strtotime( $inhalt );
						break;

					case 'text':
					case 'longtext':
					case 'select':
						$value->text = $inhalt;
						break;

					case 'link':
					case 'list':
						$value->linkToObjectId = intval($inhalt);
						break;
				}
			
				$value->page = &$this->page;
				
				// Ermitteln, ob Inhalt sofort freigegeben werden kann und soll
				if	( $this->page->hasRight('release') && $this->getRequestVar('release')!='' )
					$value->publish = true;
				else
					$value->publish = false;
		
				// Inhalt speichern
				// Wenn Inhalt in allen Sprachen gleich ist, dann wird der Inhalt
				// fuer jede Sprache einzeln gespeichert.
				if	( $value->element->allLanguages )
				{
					$p = new Project();
					foreach( $p->getLanguageIds() as $languageid )
					{
						$value->languageid = $languageid;
						$value->save();
					}
				}
				else
				{
					// sonst nur 1x speichern (fuer die aktuelle Sprache)
					$value->languageid = $this->getSessionVar('languageid');
					$value->save();
				}
			}
		}
		$this->page->setTimestamp();
	
		$this->callSubAction( 'form');
	}


	function elsave()
	{
		$value = new Value();
		$value->languageid = $this->getSessionVar('languageid');
		$value->objectid   = $this->getSessionVar('objectid');
		$value->pageid     = Page::getPageIdFromObjectId( $this->getSessionVar('objectid') );
		$value->element = new Element( $this->getSessionVar('elementid') );
		$value->element->load();
		$value->publish = false;
		$value->load();

		$value->number = $this->getRequestVar('number') * pow(10,$value->element->decimals);

		$value->linkToObjectId = intval($this->getRequestVar('linkobjectid'));
	
		$value->text           = $this->getRequestVar('text');

		if   ( $this->getRequestVar('year') != '' )
		{
			if   ( $this->getRequestVar('ansidate') != $this->getRequestVar('ansidate_orig') )
				$value->date = strtotime($this->getRequestVar('ansidate') );
			else	$value->date = mktime( $this->getRequestVar('hour'),
					                  $this->getRequestVar('minute'),
					                  $this->getRequestVar('second'),
					                  $this->getRequestVar('month'),
					                  $this->getRequestVar('day'),
					                  $this->getRequestVar('year')    );
		}
		else $value->date = 0;
	
		$value->text = $this->getRequestVar('text');

		$value->page = new Page( $value->objectid );
		$value->page->load();
		
		// Ermitteln, ob Inhalt sofort freigegeben werden kann und soll
		if	( $value->page->hasRight('release') && $this->getRequestVar('release')!='' )
			$value->publish = true;
		else	$value->publish = false;

		// Inhalt speichern
		
		// Wenn Inhalt in allen Sprachen gleich ist, dann wird der Inhalt
		// fuer jede Sprache einzeln gespeichert.
		if	( $value->element->allLanguages )
		{
			$p = new Project();
			foreach( $p->getLanguageIds() as $languageid )
			{
				$value->languageid = $languageid;
				$value->save();
			}
		}
		else
		{
			// sonst nur 1x speichern (fuer die aktuelle Sprache)
			$value->save();
		}
		$this->page->setTimestamp();
		$this->callSubAction( $this->getRequestVar('old_pageaction') );
	}


	function propsave()
	{
		if   ( $this->getRequestVar('name')!='' )
		{
			$this->page->name        = $this->getRequestVar('name'    );
			$this->page->filename    = $this->getRequestVar('filename');
			$this->page->desc        = $this->getRequestVar('desc'    );

			$this->page->save();
			$this->addNotice($this->file->getType(),$this->file->name,'PROP_SAVED','ok');
		}
		
		$this->callSubAction('prop');
	}


	function ReplaceTemplateSelectElements()
	{
		$newTemplateId = intval($this->getRequestVar('templateid'));

		if   ( $newTemplateId != 0  )
		{
			$this->setTemplateVar('newTemplateId',$newTemplateId );

			$oldElements = Array();
			$oldTemplate = new Template( $this->page->templateid );
			$newTemplate = new Template( $newTemplateId );
			
			foreach( $oldTemplate->getElementIds() as $elementid )
			{
				$e = new Element( $elementid );
				$e->load();
				
				if	( !$e->isWritable() )
					continue;

				$oldElements[$elementid] = $e->name.' - '.lang('EL_'.$e->type );

				$newElements = Array();
				$newElements[0] = lang('ELEMENT_DELETE_VALUES');
	
				foreach( $newTemplate->getElementIds() as $newelementid )
				{
					$ne = new Element( $newelementid );
					$ne->load();
					
					// Nur neue Elemente anbieten, deren Typ identisch ist
					if	( $ne->type == $e->type )
						$newElements[$newelementid] = lang('ELEMENT').': '.$e->name.' - '.lang('EL_'.$e->type );
				}
				$this->setTemplateVar('newTemplateElementsOf'.$elementid,$newElements );
			}
			$this->setTemplateVar('oldTemplateElements',$oldElements );


			$this->forward('page_replacetemplate');
		}
		else
		{
			$this->callSubAction('prop');
		}
	}


	function replaceTemplate()
	{
		$newTemplateId = intval($this->getRequestVar('newTemplateId'));
		$replaceElementMap = Array();
		
		$oldTemplate = new Template( $this->page->templateid );
		foreach( $oldTemplate->getElementIds() as $elementid )
		{
			$replaceElementMap[$elementid] = $this->getRequestVar('from'.$elementid);
		}
		
		if   ($newTemplateId != 0  )
		{
			print_r( $replaceElementMap );
			$this->page->replaceTemplate( $newTemplateId,$replaceElementMap );
		}

		$this->callSubAction('prop');
	}


	function el()
	{
		global $conf_php;

		$this->page->public = true;
		$this->page->simple = true;
		$this->page->generate_elements();
		
		$list = array();
	
		foreach( $this->page->values as $id=>$value )
		{
			if   ( $value->element->isWritable() )
			{
				$list[$id] = array();
				$list[$id]['name']       = $value->element->name;
				$list[$id]['desc']       = $value->element->desc;
				$list[$id]['type']       = $value->element->type;
	
				$u = new User( $value->lastchangeUserId );
				$u->load();
				$list[$id]['username'     ] = $u->name;
				$list[$id]['userfullname' ] = $u->fullname;

				$list[$id]['date'         ] = date( lang('DATE_FORMAT'),$value->lastchangeTimeStamp);
				$list[$id]['archive_count'] = $value->getCountVersions();
				$list[$id]['archive_url'  ] = Html::url(array('action'=>'pageelement','elementid'=>$id,'subaction'=>'archive'));
				$list[$id]['url'          ] = Html::url(array('action'=>'pageelement','elementid'=>$id,'subaction'=>'edit'   ));
				
				// Maximal 50 Stellen des Inhaltes anzeigen
				$list[$id]['value'] = Text::maxLaenge( 50,$value->value );
			}
		}

		$this->setTemplateVar('el',$list);
		$this->forward('page_element');

	}


	/**
	 * Alle editierbaren Felder in einem Formular bereitstellen
	 */
	function form()
	{
		global $conf_php;

		$this->page->public = false;
		$this->page->simple = true;
		$this->page->generate_elements();
		
		$list = array();
	
		foreach( $this->page->values as $id=>$value )
		{
			if   ( $value->element->isWritable() )
			{
				$list[$id] = array();
				$list[$id]['name']        = $value->element->name;
				$list[$id]['desc']        = $value->element->desc;
				$list[$id]['type']        = $value->element->type;

				switch( $value->element->type )
				{
					case 'text':
					case 'longtext':
						$list[$id]['value'] = $value->text;
						break;

					case 'date':
						$list[$id]['value'] = date( 'Y-m-d H:i:s',$value->date );
						break;

					case 'number':
						$list[$id]['value'] = $value->number / pow(10,$value->element->decimals);
						break;

					case 'select':
						$list[$id]['list' ] = $value->element->getSelectItems();
						$list[$id]['value'] = $value->text;
						break;

					case 'link':
						$objects = array();
				
						foreach( Folder::getAllObjectIds() as $oid )
						{
							$o = new Object( $oid );
							$o->load();
							
							if	( $o->getType() != 'folder' )
							{ 
								$f = new Folder( $o->parentid );
								$f->load();
								
								$objects[ $oid ]  = lang( $o->getType() ).': '; 
								$objects[ $oid ] .=  implode( ' &raquo; ',$f->parentObjectNames(false,true) ); 
								$objects[ $oid ] .= ' &raquo; '.$o->name;
							} 
						}
		
						asort( $objects ); // Sortieren
				
						$list[$id]['list' ] = $objects;
						$list[$id]['value'] = $value->linkToObjectId;
						break;

					case 'list':
						$objects = array();
						foreach( Folder::getAllFolders() as $oid )
						{
							$f = new Folder( $oid );
							$f->load();
							
							$objects[ $oid ]  = lang( $f->getType() ).': '; 
							$objects[ $oid ] .=  implode( ' &raquo; ',$f->parentObjectNames(false,true) ); 
						}
				
						asort( $objects ); // Sortieren
				
						$this->setTemplateVar('list' ,$objects);
						$this->setTemplateVar('value',$this->value->linkToObjectId);
		
						break;
						break;
				}
			}
		}

		$this->setTemplateVar('el',$list);
		$this->forward('page_form');
	}


	function show()
	{
		// Seite definieren
		$this->page->load();
		$this->page->generate();
		$this->page->write();

		require( $this->page->tmpfile );

		unlink( $this->page->tmpfile );
	}


	function edit()
	{
		// Editier-Icons anzeigen
		$this->page->icons = true;
	
		$this->page->load();
		$this->page->generate();
		$this->page->write();
		require( $this->page->tmpfile() );

	}


	function src()
	{
		$this->page->public = true;
		$this->page->load();
	
		$src = $this->page->generate();
		
		// HTML Highlighting
		$src = preg_replace( '|<(.+)( .+)?>|Us'       , '<strong>&lt;$1</strong>$2<strong>&gt;</strong>', $src);
		$src = preg_replace( '|([a-zA-Z]+)="(.+)"|Us' , '<em>$1</em>=<var>"$2"</var>'                   , $src);
		//$var['src'] = htmlentities($src);
		$this->setTemplateVar('src',$src);
	
		$this->forward('page_src');
	}


	function prop()
	{
		global $SESS;
		$this->setTemplateVar('id',$this->page->objectid);
	
		$this->page->public = true;
		$this->page->load();
		$this->page->full_filename();
		$this->setTemplateVars( $this->page->getProperties() );
		
		$this->setTemplateVar('delete',$this->page->hasRight('delete'));
	
		if   ( $SESS['user']['is_admin'] == '1' )
		{
			$this->setTemplateVar('template_url',Html::url(array('action'=>'main','callAction'=>'template','templateid'=>$this->page->templateid,'tplaction'=>'show')));
		}
	
		$template = new Template( $this->page->templateid );
		$template->load();
		$this->setTemplateVar('template_name',$template->name);
	
		// Alle Ordner ermitteln
		$this->setTemplateVar('act_folderobjectid',$this->page->parentid);

		$folders = array();
		$folder = new Folder( $this->page->parentid );
		
		foreach( $folder->getOtherFolders() as $oid )
		{
			$f = new Folder( $oid );
			$folders[$oid] = implode(' &raquo; ',$f->parentObjectNames(true,true) );
		}
		asort( $folders );
		$this->setTemplateVar('folder',$folders); 

		$templates = Array();
		foreach( Template::getAll() as $id=>$name )
		{
			if	( $id != $this->page->templateid )
				$templates[$id]=$name;
		}
		$this->setTemplateVar('templates',$templates); 
		 
	
		$this->forward('page_prop');
	}


	function pub()
	{
		$this->forward('page_pub');
	}


	function pub2()
	{
		$this->page->publish();

		foreach( $this->page->publish->publishedObjects as $o )
		{
			$this->addNotice($o['type'],$o['full_filename'],'PUBLISHED','ok');
		}

		$this->callSubaction('pub');
	}
}

?>