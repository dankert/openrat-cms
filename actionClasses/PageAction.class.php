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
//

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
				if	( $this->page->hasRight( ACL_RELEASE ) && $this->hasRequestVar('release') )
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
		$this->page->setTimestamp(); // "Letzte Aenderung" setzen

		if	( $this->hasRequestVar('publish') )
			$this->callSubAction( 'pubnow' );
		else
			$this->callSubAction( 'el' );
	}


	/**
	 * Element speichern
	 *
	 * Der Inhalt eines Elementes wird abgespeichert
	 */
	function elsave()
	{
		$value = new Value();
		$language = Session::getProjectLanguage();
		$value->languageid = $language->languageid;
		$value->objectid   = $this->page->objectid;
		$value->pageid     = Page::getPageIdFromObjectId( $this->page->objectid );

		if	( $this->hasRequestVar('elementid') )
			$value->element = new Element( $this->getRequestVar('elementid') );
		else
			$value->element = Session::getElement();

		$value->element->load();
		$value->publish = false;
		$value->load();

		$value->number         = $this->getRequestVar('number') * pow(10,$value->element->decimals);
		$value->linkToObjectId = intval($this->getRequestVar('linkobjectid'));
		$value->text           = $this->getRequestVar('text');

		// Vorschau anzeigen
		if	( $value->element->type=='longtext' && $this->hasRequestVar('preview') )
		{
			$value->page             = $this->page;
			$value->simple           = false;
			$value->page->languageid = $value->languageid;
			$value->page->load();
			$value->generate();
	
			$this->setTemplateVar( 'release',$this->page->hasRight(ACL_RELEASE) );
			$this->setTemplateVar( 'publish',$this->page->hasRight(ACL_PUBLISH) );
			$this->setTemplateVar( 'html'   ,$value->element->html );
			$this->setTemplateVar( 'wiki'   ,$value->element->wiki );
			$this->setTemplateVar( 'text'   ,$value->text          );
			$this->setTemplateVar( 'name'   ,$value->element->name );
			$this->setTemplateVar( 'desc'   ,$value->element->desc );
			$this->setTemplateVar('preview_text',$value->value );
			$this->forward( 'pageelement_edit_longtext' );
		}

		if	( $this->hasRequestVar('year') ) // Wird ein Datum gespeichert?
		{
			// Wenn ein ANSI-Datum eingegeben wurde, dann dieses verwenden
			if   ( $this->getRequestVar('ansidate') != $this->getRequestVar('ansidate_orig') )
				$value->date = strtotime($this->getRequestVar('ansidate') );
			else
				// Sonst die Zeitwerte einzeln zu einem Datum zusammensetzen
				$value->date = mktime( $this->getRequestVar('hour'  ),
				                       $this->getRequestVar('minute'),
				 	                   $this->getRequestVar('second'),
				 	                   $this->getRequestVar('month' ),
					                   $this->getRequestVar('day'   ),
					                   $this->getRequestVar('year'  ) );
		}
		else $value->date = 0; // Datum nicht gesetzt.
	
		$value->text = $this->getRequestVar('text');

		$value->page = new Page( $value->objectid );
		$value->page->load();
		
		// Inhalt sofort freigegeben, wenn
		// - Recht vorhanden
		// - Freigabe gewuenscht
		if	( $value->page->hasRight( ACL_RELEASE ) && $this->getRequestVar('release')!='' )
			$value->publish = true;
		else
			$value->publish = false;

		// Inhalt speichern
		
		// Wenn Inhalt in allen Sprachen gleich ist, dann wird der Inhalt
		// fuer jede Sprache einzeln gespeichert.
		if	( $value->element->allLanguages )
		{
			$project = Session::getProject();
			foreach( $project->getLanguageIds() as $languageid )
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

		$this->page->setTimestamp(); // "Letzte Aenderung" setzen

		// Falls ausgewaehlt die Seite sofort veroeffentlichen
		if	( $this->hasRequestVar('publish') )
			$this->callSubAction( 'pubnow' ); // Weiter zum veroeffentlichen
		else
			$this->callSubAction( 'el' ); // Element-Liste anzeigen
	}



	/**
	 * Eigenschaften der Seite speichern
	 */
	function propsave()
	{
		if   ( $this->getRequestVar('name')!='' )
		{
			$this->page->name        = $this->getRequestVar('name'    );
			$this->page->filename    = $this->getRequestVar('filename');
			$this->page->desc        = $this->getRequestVar('desc'    );

			$this->page->save();
			$this->addNotice($this->page->getType(),$this->page->name,'PROP_SAVED','ok');
		}
		
		$this->callSubAction('prop');
	}



	/**
	 * Austauschen der Vorlage vorbereiten
	 *
	 * Es wird ein Formualr erzeugt, in dem der Benutzer auswaehlen kann, welche Elemente
	 * in welches Element uebernommen werden sollen
	 */
	function replacetemplateselectelements()
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



	/**
	 * Die Vorlage der Seite austauschen
	 *
	 * Die Vorlage wird ausgetauscht, die Inhalte werden gemaess der Benutzereingaben kopiert
	 */
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
			$this->page->replaceTemplate( $newTemplateId,$replaceElementMap );
		}

		$this->callSubAction('prop');
	}




	/**
	 * Alle Elemente der Seite anzeigen
	 */
	function el()
	{
		global $conf_php;

		$this->page->public = true;
		$this->page->simple = true;
		$this->page->generate_elements();
		
		$list = array();
	
		// Schleife ueber alle Inhalte der Seite
		foreach( $this->page->values as $id=>$value )
		{
			// Element wird nur angezeigt, wenn es editierbar ist
			if   ( $value->element->isWritable() )
			{
				$list[$id] = array();
				$list[$id]['name']       = $value->element->name;
				$list[$id]['desc']       = $value->element->desc;
				$list[$id]['type']       = $value->element->type;
	
				$list[$id]['date'         ] = date( lang('DATE_FORMAT'),$value->lastchangeTimeStamp);
				$list[$id]['archive_count'] = $value->getCountVersions();
				$list[$id]['archive_url'  ] = Html::url( 'pageelement','archive','0',array('elementid'=>$id) );
				$list[$id]['url'          ] = Html::url( 'pageelement','edit'   ,'0',array('elementid'=>$id) );
				
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

		$this->setTemplateVar( 'release',$this->page->hasRight(ACL_RELEASE) );
		$this->setTemplateVar( 'publish',$this->page->hasRight(ACL_PUBLISH) );

		$this->setTemplateVar('el',$list);
		$this->forward('page_form');
	}



	/**
	 * Seite anzeigen
	 */
	function show()
	{
		// Seite definieren
		$this->page->load();
		$this->page->generate();
		$this->page->write();

		require( $this->page->tmpfile );

		unlink( $this->page->tmpfile );
	}



	/**
	 * Die Seite im Bearbeitungsmodus anzeigen
	 *
	 * Bei editierbaren Feldern wird ein Editor-Ikon vorangestellt.
	 */
	function edit()
	{
		// Editier-Icons anzeigen
		$this->page->icons = true;
	
		$this->page->load();
		$this->page->generate();
		$this->page->write();
		require( $this->page->tmpfile() );

	}



	/**
	 * Den Quellcode der Seite anzeigen
	 *
	 * Alle HTML-Sonderzeichen werden maskiert
	 */
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



	/**
	 * Die Eigenschaften der Seite anzeigen
	 */
	function prop()
	{
		$this->setTemplateVar('id',$this->page->objectid);
	
		$this->page->public = true;
		$this->page->load();
		$this->page->full_filename();
		$this->setTemplateVars( $this->page->getProperties() );
		
		if   ( $this->userIsAdmin() )
		{
			$this->setTemplateVar('template_url',Html::url('main','template',$this->page->templateid));
		}
	
		$template = new Template( $this->page->templateid );
		$template->load();
		$this->setTemplateVar('template_name',$template->name);
	
		// Alle Ordner ermitteln
//		$this->setTemplateVar('act_folderobjectid',$this->page->parentid);
//
//		$folders = array();
//		$folder = new Folder( $this->page->parentid );
		
//		foreach( $folder->getOtherFolders() as $oid )
//		{
//			$f = new Folder( $oid );
//			$folders[$oid] = implode( FILE_SEP,$f->parentObjectNames(true,true) );
//		}
//		asort( $folders );
//		$this->setTemplateVar('folder',$folders); 

		$templates = Array();
		foreach( Template::getAll() as $id=>$name )
		{
			if	( $id != $this->page->templateid )
				$templates[$id]=$name;
		}
		$this->setTemplateVar('templates',$templates); 
		 
	
		$this->forward('page_prop');
	}



	/**
	 * Seite veroeffentlichen
	 *
	 * Es wird ein Formular angzeigt, mit dem die Seite veroeffentlicht
	 * werden kann 
	 */
	function pub()
	{
		$this->forward('page_pub');
	}



	/**
	 * Seite veroeffentlichen
	 *
	 * Die Seite wird generiert.
	 */
	function pubnow()
	{
		if	( !$this->page->hasRight( ACL_PUBLISH ) )
			die( 'no right for publish' );

		$this->page->publish();

		foreach( $this->page->publish->publishedObjects as $o )
		{
			$this->addNotice($o['type'],$o['full_filename'],'PUBLISHED','ok');
		}

		$this->callSubaction('pub');
	}
}

?>