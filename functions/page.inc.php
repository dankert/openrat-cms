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
// Revision 1.1  2004-03-20 14:15:00  dankert
// Kommentare
//
// ---------------------------------------------------------------------------


// Ermitteln der Ordner, in dem sich die Seite befindet
//

/*
function p1age_get_folder( $pageid,$filenames=true )
{
	global $conf,
		  $SESS,
		  $db;

	if   (!isset($db))
		$db = new DB( $conf['database_'.$SESS['dbid']] );

	$t_page = $conf_db_prefix.'page';
	$sql  = "SELECT folderid FROM $t_page WHERE id=".$SESS['pageid'];
	//echo "sql:$sql";
	$folderid  = $db->getOne($sql);
	
	return folder_path( $folderid,$filenames );
}


// Ermitteln aller übergeordneten Ordner
//
function foldser_path( $folderid,$filenames=true )
{
	global $conf,
		  $SESS,
		  $db;

	if   (!isset($db))
		$db = new DB( $conf['database_'.$SESS['dbid']] );

	$folder = array();
	
	if   ( $folderid == '' )
		return $folder;
		
	do
	{
		$t_folder = $conf_db_prefix.'folder';
		$sql = "SELECT * FROM $t_folder WHERE id=".$folderid;
		$res_folder = $db->query( $sql );
		$row_folder = $res_folder->fetchRow(DB_FETCHMODE_ASSOC);
		if   ( $filenames )
			$folder[ $folderid ] = $row_folder['filename'];
		else	$folder[ $folderid ] = $row_folder['name'];
		$folderid = $row_folder['parentid'];
		$res_folder->free();
	}
	while( $row_folder['parentid'] != null );
	
	// Array in umgekehrter Reihenfolge zurückgeben
	return array_reverse($folder,true);
}
*/


class Page extends Object
{
	var $pageid;
	var $templateid;

	var $simple = false;
	var $public = false;

	var $el = array();

	var $icons = false;
	var $src;
	var $tmpfile;
	var $name;
	var $ext;
	var $edit = false;

	var $content_negotiation = false;
	var $cut_index           = false;
	var $default_language    = false;
	var $link                = false;

	var $log_filenames       = array();


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
								$f = new File( $linkedObjectId );
								$f->load();
								$inhalt  = $this->up_path();
								$inhalt .= $f->full_filename();
							break;
			
							case 'page':
								$p = new Page( $linkedObjectId );
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
					$inhalt = "file.$conf_php?fileaction=show&objectid=".$objectid;
					break;

				case 'page':
					$inhalt = "page.$conf_php?pageaction=".$SESS['pageaction'].
					          '&objectid='.$objectid;
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
								$inhalt = "file.$conf_php?fileaction=show&objectid=".$link->linkedObjectId;
							break;
			
							case 'page':
								$inhalt = "page.$conf_php?pageaction=".$SESS['pageaction'].
								          '&objectid='.$link->linkedObjectId;
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
	  * Erzeugt Präfix für eine relative Pfadangabe
	  * Beispiel: Seite liegt in Ordner /pfad/pfad =&gt; '../../'
	  *
	  * @return String Pfadangabe
	  * @access private 
	  */ 
	function up_path()
	{
		$folder = new Folder( $this->parentid );
		$folder->load();
		$folder->parentfolder(false,true);
		$f = count( $folder->parentfolders );
		
		if   ( $f == 0 )
		{
			return './';
		}
		else
		{
			return str_repeat( '../',$f );
		}
	}


	/**
	  * getter-Methode für den Dateinamen
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

		$this->objectAdd(); // Hinzufügen von Objekt (dabei wird Objekt-ID ermittelt)
		
		$sql = new Sql('INSERT INTO {t_page}'.
		               ' (objectid,templateid)'.
		               ' VALUES( {objectid},{templateid} )' );
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
		echo $sql->query.'<br>';

		$sql = new Sql( 'DELETE FROM {t_page} '.
		                '  WHERE objectid={objectid}' );
		$sql->setInt('objectid',$this->objectid);
		$db->query( $sql->query );

		echo $sql->query.'<br>';
		
		$this->objectDelete();
	}


	function save()
	{
		$db = db_connection();

		$sql = new Sql('UPDATE {t_page}'.
		               'SET templateid ={templateid}'.
		                '   WHERE objectid={objectid}' );
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
		$t->projectmodelid = $this->projectmodelid;
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
		$t = new Template( $this->templateid );
		
		foreach( $t->getElementIds() as $elementid )
		{
			// neues Elementobjekt erzeugen
			$el = new Element( $elementid );
			$el->objectid   = $this->objectid;
			$el->pageid     = Page::getPageIdFromObjectId( $this->objectid );
			$el->languageid = $this->languageid;
			$el->simple     = $this->simple;
			$el->page       = &$this;
			$el->generate();
			$this->el[$elementid] = $el;
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
		
		foreach( $this->el as $id=>$el )
		{
			$inh = $el->value;
			$src = str_replace( '{{'.$id.'}}',$inh,$src );
			
			if   ( $this->icons )
				$src = str_replace( '{{->'.$id.'}}','<a href="'.sid('pageelement.'.$conf_php.'?elementid='.$id.'&pageelementaction=edit').'" title="'.$el['desc'].'" target="cms_main_main"><img src="'.$conf['directories']['themedir'].'/images/icon_el_'.$el['type'].'.gif" border="0"></a>',$src );
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
		
		$publish = new Publish();
		
		$this->content_negotiation = $publish->content_negotiation;
		$this->cut_index           = $publish->cut_index;
		$this->public              = true;

		// Schleife über alle Sprachvarianten
		foreach( Language::getAll() as $languageid=>$x )
		{
			$this->languageid = $languageid;

			// Schleife über alle Projektvarianten
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

		// Bei Verwendung der Content-Negotiation wird eine Default-Variante
		// ohne Sprachversion, aber mit doppelter Extension
		// z.B. index.html.html erzeugt
		if   ( $publish->content_negotiation && count(Language::getAll())>1 )
		{
			$this->languageid = Language::getDefaultId();
			$this->default_language = true;

			// Schleife über alle Projektvarianten
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

		$this->log_filenames = $publish->log_filenames;
	}
}


?>