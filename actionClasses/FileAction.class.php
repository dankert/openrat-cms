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
// Revision 1.8  2004-11-28 21:27:21  dankert
// Bildbearbeitung erweitert
//
// Revision 1.7  2004/11/27 13:05:59  dankert
// Einzelne Funktionen verlagert
//
// Revision 1.6  2004/09/26 12:12:31  dankert
// Erweiterung HTTP-Header bei Anzeige der Bin?rdatei
//
// Revision 1.5  2004/05/02 14:49:37  dankert
// Einf?gen package-name (@package)
//
// Revision 1.4  2004/04/28 20:22:32  dankert
// Rechte hinzuf?gen
//
// Revision 1.3  2004/04/24 17:02:47  dankert
// Korrektur: Link auf Seite
//
// Revision 1.2  2004/04/24 16:55:27  dankert
// Korrektur: pub()
//
// Revision 1.1  2004/04/24 15:14:52  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------


/**
 * Action-Klasse zum Bearbeiten einer Datei
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */
class FileAction extends ObjectAction
{
	var $file;
	var $defaultSubAction = 'show';

	/**
	 * Konstruktor
	 */
	function FileAction()
	{
		$this->file = new File( $this->getSessionVar('objectid') );
		$this->file->load();
	}


	/**
	 * Ersetzt den Inhalt mit einer anderen Datei
	 */
	function replace()
	{
		$upload = new Upload();

		$this->file->filename  = $upload->filename;
		$this->file->extension = $upload->extension;		
		$this->file->size      = $upload->size;
		$this->file->save();
		
		$this->file->value = $upload->value;
		$this->file->saveValue();

		//$setTemplateVar('tree_refresh',true);
		$this->addNotice($this->file->getType(),$this->file->name,'VALUE_SAVED','ok');

		$this->callSubAction('edit');
	}


	function savevalue()
	{
		$this->file->value = $this->getRequestVar('value');
		$this->file->saveValue();
	
		$this->addNotice($this->file->getType(),$this->file->name,'VALUE_SAVED','ok');
		$this->callSubAction('edit');
	}


	function save()
	{
		global $SESS;

		// Wenn Dateiname gefuellt, dann Datenbank-Update
		if   ( $this->getRequestVar('delete') != '' )
		{
			// Datei loeschen
			$this->file->delete();

			$this->addNotice($this->file->getType(),$this->file->name,'DELETED','ok');
			unset( $SESS['objectid'] );
		}
		else
		{
			// Eigenschaften speichern
			$this->file->filename  = $this->getRequestVar('filename' );
			$this->file->name      = $this->getRequestVar('name'     );
			$this->file->extension = $this->getRequestVar('extension');
			$this->file->desc      = $this->getRequestVar('desc'     );
			
			$this->addNotice($this->file->getType(),$this->file->name,'PROP_SAVED','ok');
			$this->file->save();
		}

		$this->setTemplateVar('tree_refresh',true);
		$this->callSubAction('prop');
	}


	/**
	 * Anzeigen des Inhaltes, der Inhalt wird samt Header direkt
	 * auf die Standardausgabe geschrieben
	 */
	function show()
	{
		// Angabe Content-Type
		header('Content-Type: '.$this->file->mimeType() );
		header('X-File-Id: '.$this->file->fileid );

		// Angabe Content-Disposition
		// - Bild soll "inline" gezeigt werden
		// - Dateiname wird benutzt, wenn der Browser das Bild speichern moechte
		header('Content-Disposition: inline; filename='.$this->file->filenameWithExtension() );
		header('Content-Transfer-Encoding: binary' );
		header('Content-Description: '.$this->file->name );

		$this->file->loadValue(); // Bild aus Datenbank laden

		// Groesse des Bildes in Bytes
		// Der Browser hat so die Moeglichkeit, einen Fortschrittsbalken zu zeigen
		header('Content-Length: '.strlen($this->file->value) );

		echo $this->file->value;
		exit;
	}


	/**
	 * Bildgroesse eines Bildes aendern
	 */
	function resize()
	{
		$width           = intval($this->getRequestVar('width'           ));
		$height          = intval($this->getRequestVar('height'          ));
		$jpegcompression =        $this->getRequestVar('jpeg_compression') ;
		$format          =        $this->getRequestVar('format'          ) ;
		
		$this->file->imageResize( intval($width),intval($height),$format,$jpegcompression );
		$this->file->save();
		$this->file->saveValue();

		$this->addNotice($this->file->getType(),$this->file->name,'IMAGE_RESIZED','ok');
		$this->callSubAction('edit');
	}


	function prop()
	{
		// Eigenschaften der Datei uebertragen
		$this->setTemplateVars( $this->file->getProperties() );

		$this->setTemplateVar('full_filename',$this->file->full_filename());

		if	( is_numeric($this->file->lastchange_userid) )
		{
			$user = new User( $this->file->lastchange_userid );
			$user->load();
			$this->setTemplateVar('lastchange_user',array('name'=>$user->name,
			                                              'url' =>Html::url(array('action'=>'user',
			                                                                      'userid'=>$user->userid))));
		}
		else
		{
			$this->setTemplateVar('lastchange_user',array('name'=>lang('UNKNOWN')));
		}
	
		if	( is_numeric($this->file->create_userid) )
		{
			$user = new User( $this->file->create_userid );
			$user->load();
			$this->setTemplateVar('create_user',array('name'=>$user->name,
			                                          'url' =>Html::url(array('action'=>'user',
			                                                                  'userid'=>$user->userid))));
		}
		else
		{
			$this->setTemplateVar('create_user',array('name'=>lang('UNKNOWN')));
		}
		
		// Alle Seiten mit dieser Datei ermitteln
		$pages = $this->file->getDependentObjectIds();
			
		$list = array();
		foreach( $pages as $id )
		{
			$o = new Object( $id );
			$o->load();
			$list[$id] = array();
			$list[$id]['url' ] = Html::url(array('action'=>'main','callAction'=>'page','objectid'=>$id));
			$list[$id]['name'] = $o->name;
		}
		asort( $list );
		$this->setTemplateVar('pages',$list);
	
		$this->forward( 'file_prop' );
	}


	/**
	 * Anzeigen des Inhaltes
	 */
	function edit()
	{
		global $conf;
		// MIME-Types aus Datei lesen
		$this->setTemplateVars( $this->file->getProperties() );
		$this->setTemplateVar('value',$this->file->loadValue());
		$formats = array();
		foreach( explode(',',$conf['gd']['extension']) as $f )
			$formats[$f] = $f;
		$this->setTemplateVar('formats',$formats);
		$this->forward('file_edit');
	}


	/**
	 * Datei ver?ffentlichen
	 */
	function pub()
	{
		$this->file->publish();

		$list = array();
		foreach( $this->file->publish->publishedObjects as $o )
		{
			$list[] = $o['filename'];
		}

		$this->setTemplateVar('filenames',$list);

		$this->forward('publish');
	}
}

?>