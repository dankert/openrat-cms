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
// Revision 1.1  2003-10-27 23:21:55  dankert
// Methode(n) hinzugefügt: savevalue(), save()
//
// ---------------------------------------------------------------------------


class File
{
	var $fileid;

	var $folderid;
	var $filename = '';
	var $name     = '';
	var $desc;
	var $size;
	var $create_date;
	var $create_userid;
	var $lastchange_date;
	var $lastchange_userid;
	var $extension;
	var $tmpfile;
	var $value;
	var $log_filenames = array();

	function File( $fileid='' )
	{
		if   ( is_numeric($fileid) )
			$this->fileid = $fileid;
	}
	

	function parse_filename( $filename )
	{
		$p = strrpos( $filename,'.' );
		if   ( $p!==false )
		{
			$this->extension = substr( $filename,$p+1 );
			$this->filename  = substr( $filename,0,$p );
		}
		else
		{
			$this->extension = '';
			$this->filename  = $filename;
		}
	}

	
	function full_filename()
	{
		$path = $this->path();
		if   ( $path != '' )
			$path .= '/';

		$path .= $this->filename();
		
		if   ( $this->extension() != '' )
			$path .= '.'.$this->extension();
			
		return $path;
	}


	function resize( $width,$height )
	{
		global $conf;
		
		// Bildinformationen ermitteln 
		$size = getimagesize( $this->tmpfile ); 
		$breite = $size[0]; 
		$hoehe  = $size[1]; 

		$neueBreite=$width; 
		$neueHoehe=intval($hoehe*$neueBreite/$breite); 

		if   ( $size[2]==1 )
		{ 
			// GIF 
			$altesBild=ImageCreateFromGIF( $this->tmpfile ); 
			$neuesBild=ImageCreate($neueBreite,$neueHoehe); 
			ImageCopyResized($neuesBild,$altesBild,0,0,0,0,$neueBreite,
			$neueHoehe,$breite,$hoehe); 
			ImageGIF($neuesBild, $this->tmpfile ); 
		} 
			
		if   ( $size[2]==2 )
		{ 
			// JPG 
			$altesBild=ImageCreateFromJPEG( $this->tmpfile );

			if   ( $conf['gd']['version'] >= 2 )
			{
				// Verwende TrueColor
				$neuesBild = imageCreateTrueColor( $neueBreite,$neueHoehe );

				ImageCopyResampled($neuesBild,$altesBild,0,0,0,0,$neueBreite,
				$neueHoehe,$breite,$hoehe); 
			}
			else
			{
				// GD Version 1.x unterstützt kein TrueColor
				$neuesBild = ImageCreate($neueBreite,$neueHoehe);

				ImageCopyResized($neuesBild,$altesBild,0,0,0,0,$neueBreite,
				$neueHoehe,$breite,$hoehe); 
			}

			ImageJPEG($neuesBild, $this->tmpfile ); 
		} 

		if   ( $size[2]==3 )
		{ 
			// PNG 
			$altesBild = ImageCreateFromPNG( $this->tmpfile );
			
			// Versuche TrueColor, sofern möglich.
			$neuesBild = @imageCreateTrueColor( $neueBreite,$neueHoehe );
			if	( ! $dst_img )
			{
				$neuesBild = ImageCreate($neueBreite,$neueHoehe); 
			}
			
			ImageCopyResized($neuesBild,$altesBild,0,0,0,0,$neueBreite,$neueHoehe,$breite,$hoehe); 
			ImagePNG( $neuesBild,$this->tmpfile ); 
		} 
	}


	function path()
	{
		$folder = new Folder( $this->folderid );
		$folder->load();
		$folder->parentfolder( false,true );
		
		return implode( '/',$folder->parentfolders );
	}


	function filename()
	{
		if   ( $this->filename!='' )
			return $this->filename;
			
		global $db;
		extract( table_names() );

		$sql  = "SELECT filename FROM $t_file WHERE id=".$this->fileid;
		$this->filename = $db->getOne( $sql );
		
		return $this->filename;
	}


	function extension()
	{
		if   ( $this->extension!='' )
			return $this->extension;
			
		global $db;
		extract( table_names() );

		$sql  = "SELECT extension FROM $t_file WHERE id=".$this->fileid;
		$this->extension = $db->getOne( $sql );
		
		return $this->extension;
	}
	

	// Lesen der Datei aus der Datenbank
	function load()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT folderid,filename,name,extension,`desc`,size,create_date,create_userid,lastchange_date,lastchange_userid'.
		                ' FROM {t_file}'.
		                ' WHERE id={fileid}' );
		$sql->setInt( 'fileid',$this->fileid );
		$row = $db->getRow( $sql->query );

		$this->folderid  = $row['folderid'];

		$this->filename = eregi_replace('[^a-z0-9\.\_\-]','',$row['filename']); // RFC 1630
		if   ( $this->filename == '' )
			$this->filename = 'f'.$this->fileid;
		$this->name      = $row['name'];
		$this->extension = $row['extension'];
		$this->size      = $row['size'];
		$this->desc      = $row['desc'];
		$this->create_date       = $row['create_date'      ];
		$this->create_userid     = $row['create_userid'    ];
		$this->lastchange_date   = $row['lastchange_date'  ];
		$this->lastchange_userid = $row['lastchange_userid'];
	}



	function delete()
	{
		$db = db_connection();

		// Alle Inhalte mit dieser Datei löschen
		$sql = new Sql( 'DELETE FROM {t_value} '.
		                '  WHERE fileid={fileid}' );
		$sql->setInt( 'fileid',$this->fileid );
		$db->query( $sql->query );

		// Alle Elemente dieser Datei als Default-Inhalt auf NULL setzen
		$sql = new Sql( 'UPDATE {t_element} '.
		                '  SET default_fileid = NULL'.
		                '  WHERE default_fileid = {fileid}' );
		$sql->setInt( 'fileid',$this->fileid );
		$db->query( $sql->query );

		// Datei löschen
		$sql = new Sql( 'DELETE FROM {t_file} '.
		                '  WHERE id={fileid}' );
		$sql->setInt( 'fileid',$this->fileid );
		$db->query( $sql->query );
	}



	function save()
	{
		global $SESS;
		$db = db_connection();
		
		$sql = new Sql('UPDATE {t_file} SET '.
		               '  folderid={folderid},'.
		               '  lastchange_date   = {time}  ,'.
		               '  lastchange_userid = {userid},'.
		               '  filename  = {filename} ,'.
		               '  name      = {name}     ,'.
		               '  extension = {extension},'.
		               '  `desc`    = {desc}      '.
		               ' WHERE id={fileid}' );
		$sql->setInt   ('fileid'   ,$this->fileid   );
		$sql->setInt   ('folderid' ,$this->folderid );
		$sql->setString('filename' ,$this->filename );
		$sql->setString('name'     ,$this->name     );
		$sql->setString('desc'     ,$this->desc     );
		$sql->setString('extension',$this->extension);
		$sql->setInt   ('time'     ,time()          );
		$sql->setInt   ('userid'   ,$SESS['user']['id'] );
		$sql->setString('value'    ,$this->value    );

		$db->query( $sql->query );
	}


	// Lesen der Datei aus der Datenbank
	function loadvalue()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT value'.
		                ' FROM {t_file}'.
		                ' WHERE id={fileid}' );
		$sql->setInt( 'fileid',$this->fileid );
		$this->value = &$db->getOne( $sql->query );
		
		return( $this->value );
	}


	// Lesen der Datei aus der Datenbank
	function savevalue()
	{
		$db = db_connection();

		$sql = new Sql( 'UPDATE {t_file}'.
		                ' SET value={value} '.
		                ' WHERE id={fileid}' );
		$sql->setInt   ( 'fileid',$this->fileid );
		$sql->setString( 'value' ,$this->value  );

		$db->query( $sql->query );
	}


	// Lesen der Datei aus der Datenbank
	function write()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT value'.
		                ' FROM {t_file}'.
		                ' WHERE id={fileid}' );
		$sql->setInt( 'fileid',$this->fileid );

		$f = fopen( $this->tmpfile(),'w' );
		fwrite( $f,$db->getOne( $sql->query ) );
		fclose( $f );
	}


	function add()
	{
		$db = db_connection();

		$sql = new Sql('INSERT INTO {t_file}'.
		               ' (folderid,name,filename,extension,size,`desc`,create_date,create_userid,lastchange_date,lastchange_userid,value)'.
		               ' VALUES( {folderid},{name},{filename},{extension},{filesize},{desc},{time},{userid},{time},{userid},{value} )' );
		$sql->setInt   ('folderid' ,$this->folderid );
		$sql->setString('filename' ,$this->filename );
		$sql->setString('name'     ,$this->name     );
		$sql->setString('extension',$this->extension);
		$sql->setInt   ('filesize' ,strlen($this->value) );
		$sql->setString('desc'     ,$this->desc );
		$sql->setInt   ('time'     ,$this->create_date   );
		$sql->setInt   ('userid'   ,$this->create_userid );
		$sql->setString('value'    ,addslashes($this->value) );

		$db->query( $sql->query );
	}	


	function tmpfile()
	{
		global $conf_tmpdir;

		$this->tmpfile = $conf_tmpdir.'/tmp_file'.$this->fileid.'.tmp';
		//$this->tmpfile = $conf_tmpdir.'/'.md5('f'.$this->fileid).'.tmp';
		
		return $this->tmpfile;
	}
	

	function publish()
	{
		$publish = new Publish();
		
		$this->write();

		$publish->copy( $this->tmpfile(),$this->full_filename() );
		
		$this->log_filenames = $publish->log_filenames;
	}
}

?>