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
// Revision 1.6  2004-07-07 20:47:22  dankert
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

	var $simple = false;
	var $public = false;

	var $el = array();

	var $icons = false;
	var $src   = '';
	var $tmpfile;
	var $edit  = false;

	var $content_negotiation = false;
	var $cut_index           = false;
	var $default_language    = false;
	var $link                = false;

	var $log_filenames       = array();
	var $projectmodelid = 0;
	
	var $publish = null;
	var $up_path = '';


	function Page( $objectid='' )
	{
		$this->Object( $objectid );
		$this->isPage = true;
	}


	function tmpfile()
	{
		$this->tmpfile = parent::tmpfile();
		$this->tmpfile .= '.php';
		return $this->tmpfile;
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
		                    Array('full_filename'=>$this->full_filename(),
		                          'pageid'       =>$this->pageid,
		                          'templateid'   =>$this->templateid ) );
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
		$object = new Object( $objectid );
		$object->objectLoad();
		

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
					$p->languageid = $this->languageid;
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
								$p->languageid = $this->languageid;
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
					$inhalt = Html::url(array('action'=>'file','subaction'=>'show','objectid'=>$objectid));
					break;

				case 'page':
					$inhalt = Html::url(array('action'=>'page','objectid'=>$objectid));
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
								$inhalt = Html::url(array('action'=>'file','subaction'=>'show','objectid'=>$link->linkedObjectId));
							break;
			
							case 'page':
								$inhalt = Html::url(array('action'=>'page','objectid'=>$link->linkedObjectId));
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
	  * getter-Methode f?r den Dateinamen
	  *
	  * @return String Dateiname
	  */
	function filename()
	{
		return $this->filename;
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


	
	/**
	  * Ermitteln des Dateinamens dieser Seite
	  *
	  * @return String Kompletter Dateiname, z.B. '/pfad/seite.en.html'
	  */
	function full_filename()
	{
		$filename = parent::full_filename();

		if	( !$this->default_language )
		{		
			$l = new Language( $this->languageid );
			$l->load();
			$filename .= '.'.$l->isoCode;
		}

		$t = new Template( $this->templateid );
		$t->projectmodelid = $this->modelid;
		$t->load();
		$filename .= '.'.$t->extension;

		if	( $this->default_language )
		{		
			$filename .= '.'.$t->extension;
		}

		return $filename;
	}


	function language_filename()
	{
		global $SESS;
		
		$db = db_connection();

		$sql  = new Sql( 'SELECT COUNT(*) FROM {t_language}'.
		                 ' WHERE projectid={projectid}' );
		$sql->setInt('projectid',$SESS['projectid']);

		if   ( $db->getOne( $sql->query ) == 1 )
		{
			// Wenn es nur eine Sprache gibt, keine Sprachangabe im Dateinamen
			return '';
		}
		else
		{
			$sql = new Sql( 'SELECT isocode FROM {t_language}'.
			                ' WHERE id={languageid}' );
			$sql->setInt('languageid',$this->languageid);
			$isocode = $db->getOne( $sql->query );

			return strtolower( $isocode );
		}		
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

		$t = new Template( $this->templateid );
		
		foreach( $t->getElementIds() as $elementid )
		{
			// neues Elementobjekt erzeugen
			$val = new Value();
			$val->publish = $this->public;
			$val->element = new Element( $elementid );
			$val->element->load();

			$val->objectid   = $this->objectid;
			$val->pageid     = Page::getPageIdFromObjectId( $this->objectid );
			$val->languageid = $this->languageid;
			$val->simple     = $this->simple;
			$val->modelid    = $this->modelid;
			$val->page       = &$this;
			$val->generate();
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

		$template = new Template( $this->templateid );
		$template->load();

		$this->ext = $template->extension;
		 
		$src = $template->src;

		// Ersetzen der Platzhalter durch die Element-Inhalte
		//
		
		foreach( $this->values as $id=>$value )
		{
			$inh = $value->value;
			$src = str_replace( '{{'.$id.'}}',$inh,$src );
			
			if   ( $this->icons )
				$src = str_replace( '{{->'.$id.'}}','<a href="'.Html::url(array('action'=>'pagelement','elementid'=>$id,'subaction'=>'edit')).'" title="'.$value->element->desc.'" target="cms_main_main"><img src="'.$conf['directories']['themedir'].'/images/icon_el_'.$value->element->type.'.png" border="0"></a>',$src );
			else	$src = str_replace( '{{->'.$id.'}}','',$src );
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

		$f = fopen( $this->tmpfile(),'w' );
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
		
		$this->content_negotiation = $this->publish->content_negotiation;
		$this->cut_index           = $this->publish->cut_index;
		$this->public              = true;

		// Schleife ?ber alle Sprachvarianten
		foreach( Language::getAll() as $languageid=>$x )
		{
			$this->languageid = $languageid;

			// Schleife ?ber alle Projektvarianten
			foreach( Model::getAll() as $projectmodelid )
			{
				$this->projectmodelid = $projectmodelid;
			
				$this->load();
				$this->generate();
				$this->write();
				
				//echo $this->tmpfile().' &gt; '.$this->full_filename().'<br>';
				$this->publish->copy( $this->tmpfile(),$this->full_filename() );
			}
		}

		// Bei Verwendung der Content-Negotiation wird eine Default-Variante
		// ohne Sprachversion, aber mit doppelter Extension
		// z.B. index.html.html erzeugt
		if   ( $this->publish->content_negotiation && count(Language::getAll())>1 )
		{
			$this->languageid = Language::getDefaultId();
			$this->default_language = true;

			// Schleife ?ber alle Projektvarianten
			foreach( Model::getAll() as $projectmodelid )
			{
				$this->projectmodelid = $projectmodelid;
			
				$this->load();
				$this->generate();
				$this->write();
				
				//echo $this->tmpfile().' &gt; '.$this->full_filename().'<br>';
				$publish->copy( $this->tmpfile(),$this->full_filename() );
			}
		}

//		$this->log_filenames = $this->publish->log_filenames;
	}
}


?>