<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// DaCMS Content Management System
// Copyright (C) 2002 Jan Dankert, jandankert@jandankert.de
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
// Revision 1.24  2007-11-24 14:18:12  dankert
// MimeType in Template ermitteln.
//
// Revision 1.23  2007-11-24 12:16:32  dankert
// Neue Methode mimeType()
//
// Revision 1.22  2007-11-07 23:29:05  dankert
// Wenn Seite direkt aufgerufen wird, dann sofort Seitenelement anzeigen.
//
// Revision 1.21  2007-06-13 22:01:22  dankert
// Korrektur: Dateiname Icon zum Bearbeiten.
//
// Revision 1.20  2007-04-22 00:16:44  dankert
// Fehlermeldung vermeiden, wenn eine Objekt-Id nicht in der Datenbank vorhanden ist.
//
// Revision 1.19  2005/11/07 22:36:10  dankert
// Beruecksichtigen von absoluten Pfadangaben
//
// Revision 1.18  2004/12/29 20:21:42  dankert
// Korrektur Bearbeiten-Funktion, Parameter zu Html::url()
//
// Revision 1.17  2004/12/28 22:55:51  dankert
// Korrektur Dateinamen-Ermittlung
//
// Revision 1.16  2004/12/26 01:06:31  dankert
// Perfomanceverbesserung Seite/Elemente
//
// Revision 1.15  2004/12/25 21:05:29  dankert
// Korrektur Edit-Icons
//
// Revision 1.14  2004/12/19 21:48:31  dankert
// Links auf andere Objekte korrigiert
//
// Revision 1.13  2004/12/19 15:23:06  dankert
// Aussschalten content-negotiation
//
// Revision 1.12  2004/12/15 23:17:53  dankert
// temporaere Dateien vom System
//
// Revision 1.11  2004/11/29 23:24:36  dankert
// Korrektur Veroeffentlichung
//
// Revision 1.10  2004/11/10 22:47:17  dankert
// Methode copyValuesFromPage() zum Kopiern einer Seite
//
// Revision 1.9  2004/10/14 21:10:57  dankert
// neue Methode getElementIds()
//
// Revision 1.8  2004/10/05 10:01:56  dankert
// Austauschen einer Vorlage
//
// Revision 1.7  2004/07/09 20:57:14  dankert
// Dynamische Bereiche (IFEMPTY...)
//
// Revision 1.6  2004/07/07 20:47:22  dankert
// Korrektur f. Verkn?pfungen
//
// Revision 1.5  2004/05/07 21:41:14  dankert
// Url ?ber Html::url erzeugen
//
// Revision 1.4  2004/05/02 14:41:31  dankert
// Einf?gen package-name (@package)
//
// Revision 1.3  2004/05/02 11:40:00  dankert
// Freigabestatus der Seiteninhalte verarbeiten
//
// Revision 1.2  2004/04/24 15:28:17  dankert
// Korrektur: relative Pfad bei Listen
//
// Revision 1.1  2004/04/24 15:15:12  dankert
// Initiale Version
//
// Revision 1.1  2004/03/20 14:15:00  dankert
// Kommentare
//
// ---------------------------------------------------------------------------


/**
 * Darstellen einer Seite
 *
 * @version $Revision$
 * @author $Author$
 * @package openrat.objects
 */

class Page extends Object
{
	var $pageid;
	var $templateid;
	var $template;

	var $simple = false;
	var $public = false;

	var $el = array();

	var $icons = false;
	var $src   = '';
	var $edit  = false;

	var $content_negotiation = false;
	var $cut_index           = false;
	var $default_language    = false;
	var $withLanguage        = false;
	var $link                = false;
	var $fullFilename = '';

	var $log_filenames       = array();
	var $projectmodelid = 0;
	
	var $publish = null;
	var $up_path = '';


	function Page( $objectid='' )
	{
		$this->Object( $objectid );
		$this->isPage = true;
	}


	/**
	 * Ermitteln der Objekt-ID (Tabelle object) anhand der Seiten-ID (Tablle page)
	 *
	 * @deprecated pageid sollte nicht mehr benutzt werden
	 * @return Integer objectid
	 */
	function getObjectIdFromPageId( $pageid )
	{
		$db = db_connection();

		$sql  = new Sql( 'SELECT objectid FROM {t_page} '.
		                 '  WHERE id={pageid}' );
		$sql->setInt('pageid',$pageid);

		return $db->getOne( $sql->query );
	}


	/**
	 * Ermitteln der Seiten-ID anhand der Objekt-ID
	 *
	 * @deprecated pageid sollte nicht mehr benutzt werden
	 * @return Integer pageid
	 */
	function getPageIdFromObjectId( $objectid )
	{
		$db = db_connection();

		$sql  = new Sql( 'SELECT id FROM {t_page} '.
		                 '  WHERE objectid={objectid}' );
		$sql->setInt('objectid',$objectid);

		return $db->getOne( $sql->query );
	}


	/**
	  * Ermitteln aller Eigenschaften
	  *
	  * @return Array
	  */
	function getProperties()
	{
		return array_merge( parent::getProperties(),
		                    array('full_filename'=>$this->fullFilename,
		                          'pageid'       =>$this->pageid,
		                          'templateid'   =>$this->templateid,
		                          'mime_type'    =>$this->mimeType() ) );
	}


	/**
	 * Ermitteln der Ordner, in dem sich die Seite befindet
	 * @return Array
	 */
	function parentfolder()
	{
		$folder = new Folder();
		$folder->folderid = $this->folderid;
		
		return $folder->parentfolder( false,false );
	}


/*
	function path_to_file( $fileid )
	{
		global $conf_php;
		
		if   ( $this->public )
		{ 
			$inhalt = $this->up_path();
			
			$file = new File();
			$file->fileid = $fileid;
			$file->load();

			$inhalt .= $file->full_filename();
		}
		else
		{
			$inhalt = "file.$conf_php?fileaction=show&fileid=".$fileid;
			$inhalt = sid($inhalt);
		}
		
		return $inhalt;
	}
*/

	/**
	  * Ermittelt den Pfad zu einem beliebigen Objekt
	  *
	  * @param Integer Objekt-ID des Zielobjektes
	  * @return String Relative Link-angabe, Beispiel: '../../pfad/datei.jpeg'
	  */
	function path_to_object( $objectid )
	{
		global $conf_php,
		       $SESS;
		$inhalt = '';
		
		if	( ! Object::available( $objectid) )
			return '';
			
		$object = new Object( $objectid );
		$object->objectLoad();
		
		$cut_index           = ( is_object($this->publish) && $this->publish->cut_index           );
		$content_negotiation = ( is_object($this->publish) && $this->publish->content_negotiation );

		if   ( $this->public )
		{ 
			switch( $object->getType() )
			{
				case 'file':

					$inhalt  = $this->up_path();
					
					$f = new File( $objectid );
					$f->load();
					$inhalt .= $f->full_filename();
					break;

				case 'page':

					$inhalt  = $this->up_path();
					
					$p = new Page( $objectid );
					$p->languageid          = $this->languageid;
					$p->cut_index           = $cut_index;
					$p->content_negotiation = $content_negotiation;
					$p->withLanguage        = $this->withLanguage;
					$p->load();
					$inhalt .= $p->full_filename();
					break;

				case 'link':
					$link = new Link( $objectid );
					$link->load();

					if	( $link->isLinkToObject )
					{
						$linkedObject = new Object( $link->linkedObjectId );
						$linkedObject->load();

						switch( $linkedObject->getType() )
						{
							case 'file':
								$f = new File( $link->linkedObjectId );
								$f->load();
								$inhalt  = $this->up_path();
								$inhalt .= $f->full_filename();
							break;
			
							case 'page':
								$p = new Page( $link->linkedObjectId );
								$p->languageid          = $this->languageid;
								$p->cut_index           = $cut_index;
								$p->content_negotiation = $content_negotiation;
								$p->load();
								$inhalt  = $this->up_path();
								$inhalt .= $p->full_filename();
							break;
						}
					}
					else
					{
						$inhalt = $link->url;
					}
					break;
			}
		}
		else
		{
			// Interne Verlinkungen in der Seitenvorschau
			switch( $object->getType() )
			{
				case 'file':
					$inhalt = Html::url('file','show',$objectid);
					break;

				case 'page':
					$inhalt = Html::url('page','show',$objectid);
					break;

				case 'link':
					$link = new Link( $objectid );
					$link->load();

					if	( $link->isLinkToObject )
					{
						$linkedObject = new Object( $link->linkedObjectId );
						$linkedObject->load();

						switch( $linkedObject->getType() )
						{
							case 'file':
								$inhalt = Html::url('file','show',$link->linkedObjectId);
							break;
			
							case 'page':
								$inhalt = Html::url('page','show',$link->linkedObjectId);
							break;
						}
					}
					else
					{
						$inhalt = $link->url;
					}
					break;
			}
		}
		
		return $inhalt;
	}



	/**
	  * Erzeugt Pr?fix f?r eine relative Pfadangabe
	  * Beispiel: Seite liegt in Ordner /pfad/pfad dann '../../'
	  *
	  * @return String Pfadangabe
	  * @access private 
	  */ 
	function up_path()
	{
		global $conf;

		if	( $conf['filename']['url'] == 'absolute' )
		{
			$this->up_path = '/';
			return $this->up_path;
		}
			
		if	( $this->up_path != '' )
			return $this->up_path;

		$folder = new Folder( $this->parentid );
		$folder->load();
		$folder->parentObjectIds(false,true);
		$f = count( $folder->parentfolders );
		
		//echo $this->parentid;
		//print_r( $folder->parentfolders );
		
		if   ( $f == 0 )
		{
			$this->up_path = './';
		}
		else
		{
			$this->up_path = str_repeat( '../',$f );
		}

		return $this->up_path;
	}


	/**
	 * Eine Seite hinzufuegen
	 */
	function add()
	{
		$db = db_connection();

		$this->objectAdd(); // Hinzuf?gen von Objekt (dabei wird Objekt-ID ermittelt)

		$sql = new Sql('SELECT MAX(id) FROM {t_page}');
		$this->pageid = intval($db->getOne($sql->query))+1;

		$sql = new Sql('INSERT INTO {t_page}'.
		               ' (id,objectid,templateid)'.
		               ' VALUES( {pageid},{objectid},{templateid} )' );
		$sql->setInt   ('pageid'    ,$this->pageid     );
		$sql->setInt   ('objectid'  ,$this->objectid   );
		$sql->setInt   ('templateid',$this->templateid );

		$db->query( $sql->query );
	}


	/**
	  * Seite laden
	  */
	function load()
	{
		$db = db_connection();

		$sql  = new Sql( 'SELECT * FROM {t_page} '.
		                 '  WHERE objectid={objectid}' );
		$sql->setInt('objectid',$this->objectid);
		$row = $db->getRow( $sql->query );

		$this->pageid      = $row['id'        ];
		$this->templateid  = $row['templateid'];

		$this->objectLoad();
	}


	function delete()
	{
		global $db;

		$sql = new Sql( 'DELETE FROM {t_value} '.
		                '  WHERE pageid={pageid}' );
		$sql->setInt('pageid',$this->pageid);
		$db->query( $sql->query );

		$sql = new Sql( 'DELETE FROM {t_page} '.
		                '  WHERE objectid={objectid}' );
		$sql->setInt('objectid',$this->objectid);
		$db->query( $sql->query );
		
		$this->objectDelete();
	}


	/**
	 * Kopieren der Inhalts von einer anderen Seite
	 * @param ID der Seite, von der der Inhalt kopiert werden soll
	 */
	function copyValuesFromPage( $otherpageid )
	{
		$this->load();

		foreach( $this->getElementIds() as $elementid )
		{
			foreach( Language::getAll() as $lid=>$lname )
			{
				$val = new Value();
				$val->publish = false;
				$val->element = new Element( $elementid );
	
				$val->objectid   = $otherpageid;
				$val->pageid     = Page::getPageIdFromObjectId( $otherpageid );
				$val->languageid = $lid;
				$val->load();

				// Inhalt nur speichern, wenn vorher vorhanden	
				if	( $val->valueid != 0 )
				{
					$val->objectid   = $this->objectid;
					$val->pageid     = Page::getPageIdFromObjectId( $this->objectid );
					$val->save();
				}
			}
		}
	}




	function save()
	{
		$db = db_connection();

		$sql = new Sql('UPDATE {t_page}'.
		               '  SET templateid ={templateid}'.
		               '  WHERE objectid={objectid}' );
		$sql->setInt('templateid' ,$this->templateid);
		$sql->setInt('objectid'   ,$this->objectid  );
		$db->query( $sql->query );

		$this->objectSave();
	}


	
	function replaceTemplate( $newTemplateId,$replaceElementMap )
	{
		$oldTemplateId = $this->templateid;

		Logger::debug( 'replacing template of page '.$this->pageid. ' ('.$oldTemplateId.'->'.$newTemplateId.')' );
		$db = db_connection();

		// Template-id dieser Seite aendern
		$this->templateid = $newTemplateId;

		$sql = new Sql('UPDATE {t_page}'.
		               '  SET templateid ={templateid}'.
		               '  WHERE objectid={objectid}' );
		$sql->setInt('templateid' ,$this->templateid);
		$sql->setInt('objectid'   ,$this->objectid  );
		$db->query( $sql->query );


		// Inhalte umschluesseln, d.h. die Element-Ids aendern
		$template = new Template( $oldTemplateId );
		foreach( $template->getElementIds() as $oldElementId )
		{
			if	( !isset($replaceElementMap[$oldElementId])  ||
			      intval($replaceElementMap[$oldElementId]) < 1 )
			{
				Logger::debug( 'deleting value of elementid '.$oldElementId );
				$sql = new Sql('DELETE FROM {t_value}'.
				               '  WHERE pageid={pageid}'.
				               '    AND elementid={elementid}' );
				$sql->setInt('pageid'   ,$this->pageid);
				$sql->setInt('elementid',$oldElementId      );
				
				$db->query( $sql->query );
			}
			else
			{
				$newElementId = intval($replaceElementMap[$oldElementId]);

				Logger::debug( 'updating elementid '.$oldElementId.' -> '.$newElementId );
				$sql = new Sql('UPDATE {t_value}'.
				               '  SET elementid ={newelementid}'.
				               '  WHERE pageid   ={pageid}'.
				               '    AND elementid={oldelementid}' );
				$sql->setInt('pageid'      ,$this->pageid);
				$sql->setInt('oldelementid',$oldElementId      );
				$sql->setInt('newelementid',$newElementId      );
				$db->query( $sql->query );
			}
		}
	}


	
	/**
	  * Ermitteln des Dateinamens dieser Seite
	  *
	  * @return String Kompletter Dateiname, z.B. '/pfad/seite.en.html'
	  */
	function full_filename()
	{
		$filename = $this->path();

		if	( !empty($filename) )
			$filename .= '/';

		if	( !$this->cut_index || $this->filename != 'index' )
		{
			$filename .= $this->filename();
			
			if	( !$this->content_negotiation )
			{
				if	( !$this->default_language && $this->withLanguage )
				{		
					$l = new Language( $this->languageid );
					$l->load();
					$filename .= '.'.$l->isoCode;
				}
		
				$t = new Template( $this->templateid );
				$t->projectmodelid = $this->modelid;
				$t->load();
				$filename .= '.'.$t->extension;
		
				if	( $this->default_language && $this->withLanguage )
				{		
					$filename .= '.'.$t->extension;
				}
			}
		}

		$this->fullFilename = $filename;
		return $filename;
	}


//	function language_filename()
//	{
//		global $SESS;
//		
//		$db = db_connection();
//
//		$sql  = new Sql( 'SELECT COUNT(*) FROM {t_language}'.
//		                 ' WHERE projectid={projectid}' );
//		$sql->setInt('projectid',$SESS['projectid']);
//
//		if   ( $db->getOne( $sql->query ) == 1 )
//		{
//			// Wenn es nur eine Sprache gibt, keine Sprachangabe im Dateinamen
//			return '';
//		}
//		else
//		{
//			$sql = new Sql( 'SELECT isocode FROM {t_language}'.
//			                ' WHERE id={languageid}' );
//			$sql->setInt('languageid',$this->languageid);
//			$isocode = $db->getOne( $sql->query );
//
//			return strtolower( $isocode );
//		}		
//	}


	/**
	  * Erzeugen der Inhalte zu allen Elementen dieser Seite
	  * wird von generate() aufgerufen
	  *
	  * @access private 
	  */
	function getElementIds()
	{
		$t = new Template( $this->templateid );
		
		return $t->getElementIds();
	}



	/**
	  * Erzeugen der Inhalte zu allen Elementen dieser Seite
	  * wird von generate() aufgerufen
	  *
	  * @access private 
	  */
	function getElements()
	{
		if	( !isset($this->template) )
			$this->template = new Template( $this->templateid );
		
		return $this->template->getElements();
	}



	/**
	  * Erzeugen der Inhalte zu allen Elementen dieser Seite
	  * wird von generate() aufgerufen
	  *
	  * @access private 
	  */
	function getWritableElements()
	{
		if	( !isset($this->template) )
			$this->template = new Template( $this->templateid );
		
		return $this->template->getWritableElements();
	}



	/**
	  * Erzeugen der Inhalte zu allen Elementen dieser Seite
	  * wird von generate() aufgerufen
	  *
	  * @access private 
	  */
	function generate_elements()
	{
		$this->values = array();
		
		if	( $this->simple )
			$elements = $this->getWritableElements();
		else
			$elements = $this->getElements();
			
		foreach( $elements as $elementid=>$element )
		{
			// neues Elementobjekt erzeugen
			$val = new Value();
			$val->publish = $this->public;
			$val->element = $element;

			$val->objectid   = $this->objectid;
			$val->pageid     = $this->pageid;
			$val->languageid = $this->languageid;
			$val->simple     = $this->simple;
			$val->modelid    = $this->modelid;
			$val->page       = $this;
			$val->generate();
			$val->page       = null;
			$this->values[$elementid] = $val;
		}
	}


	/**
	  * Erzeugen des Inhaltes der gesamten Seite
	  * @return String Inhalt
	  */
	function generate()
	{
		
		global $conf,
		       $conf_php,
		       $db,
			   $conf_tmpdir,
			   $sess_vars,
			   $SESS;
	
		$this->generate_elements();

		$this->template = new Template( $this->templateid );
		$this->template->load();

		$this->ext = $this->template->extension;
		 
		$src = $this->template->src;

		// Ersetzen der Platzhalter durch die Element-Inhalte
		//
		
		foreach( $this->values as $id=>$value )
		{
			$inh = $value->value;
			$src = str_replace( '{{'.$id.'}}',$inh,$src );
			
			// Dynamische Bereiche ein- oder ausblenden
			if	( $inh == '' )
			{
				// Wenn Feld leer
				$src = str_replace( '{{IFEMPTY:'.$id.':BEGIN}}','',$src );
				$src = str_replace( '{{IFEMPTY:'.$id.':END}}'  ,'',$src );

				$src = eregi_replace( '{{IFNOTEMPTY:'.$id.':BEGIN}}.*{{IFNOTEMPTY:'.$id.':END}}','',$src );
			}
			else
			{
				// Wenn Feld gefuellt
				$src = str_replace( '{{IFNOTEMPTY:'.$id.':BEGIN}}','',$src );
				$src = str_replace( '{{IFNOTEMPTY:'.$id.':END}}'  ,'',$src );

				$src = eregi_replace( '{{IFEMPTY:'.$id.':BEGIN}}.*{{IFEMPTY:'.$id.':END}}','',$src );
			}
			
			if   ( $this->icons )
				$src = str_replace( '{{->'.$id.'}}','<a href="'.Html::url('pageelement','edit',$this->objectid,array('elementid'=>$id)).'" title="'.$value->element->desc.'" target="cms_main_main"><img src="'.OR_THEMES_DIR.$conf['interface']['theme'].'/images/icon_el_'.$value->element->type.IMG_ICON_EXT.'" border="0"></a>',$src );
			else
				$src = str_replace( '{{->'.$id.'}}','',$src );
		}

		$this->value = &$src;
				
		return $this->value;
	}


	/**
	  * Schreiben des Seiteninhaltes in die temporaere Datei
	  */
	function write()
	{
		// Schreiben der Cache-Datei
		//

		$f = fopen( $this->tmpfile(),'a' );
		fwrite( $f,$this->value );
		fclose( $f );
	}


	/**
	 * Generieren dieser Seite in Dateisystem und/oder auf FTP-Server
	 */
	function publish()
	{
		global $SESS;
		$db = db_connection();
		
		if	( ! is_object($this->publish) )
			$this->publish = new Publish();
		
		$this->public              = true;

		// Schleife ueber alle Sprachvarianten
		$allLanguages = Language::getAll();
		
		foreach( $allLanguages as $languageid=>$x )
		{
			$this->languageid   = $languageid;
			$this->withLanguage = count($allLanguages) > 1;

			// Schleife ueber alle Projektvarianten
			foreach( Model::getAll() as $projectmodelid )
			{
				$this->projectmodelid = $projectmodelid;
			
				$this->load();
				$this->generate();
				$this->write();
				
				// Nur wenn eine Datei-Endung vorliegt wird die Seite veroeffentlicht
				if	( !empty($this->template->extension) )
				{ 	
					$this->publish->copy( $this->tmpfile(),$this->full_filename() );
					unlink( $this->tmpfile );
					$this->publish->publishedObjects[] = $this->getProperties();
				}
			}
		}

	}
	

	/**
	 * Ermittelt den Mime-Type zu dieser Seite
	 *
	 * @return String Mime-Type  
	 */
	function mimeType()
	{
		if	( !empty( $this->mime_type ) )
			return $this->mime_type;

		global $conf;
		$mime_types = $conf['mime-types'];

		if	( ! is_object($this->template) )
			$this->template = new Template( $this->templateid );

		$this->template->load();
		$this->mime_type = $this->template->mimeType();
			
		return( $this->mime_type );
	}
	
}


?>