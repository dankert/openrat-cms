<?php
/*
  DaCMS Content Management System
  Copyright (C) 2002,2003 Jan Dankert, jd@jandankert.de

  This program is free software; you can redistribute it and/or
  modify it under the terms of the GNU General Public License
  as published by the Free Software Foundation; either version 2
  of the License, or (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
  
  $Id$
  
  $Log$
  Revision 1.1  2003-09-25 20:07:15  dankert
  *** empty log message ***

*/

$conf = parse_ini_file( 'config.ini.php',true );

require_once( $conf['directories']['incldir'].
              '/config.inc.'.
              $conf['global']['ext']            );

session_start();


include( "DB.php" );

include( "$conf_incldir/language.inc.$conf_php" );
include( "$conf_incldir/theme.inc.$conf_php" );
include( "$conf_incldir/request.inc.$conf_php" );
include( "$conf_incldir/db.inc.$conf_php" );
include( "$conf_incldir/file.inc.$conf_php" );
include( "$conf_incldir/page.inc.$conf_php" );
include( "$conf_incldir/ftp.inc.$conf_php" );

request_into_session('fileid');
request_into_session('fileaction');

if   (!isset($SESS['fileaction']))
	$SESS['fileaction'] = 'show';

// Verbindung zur Datenbank
//
$db = new DB( $conf['database_'.$SESS['dbid']] );

$var = array();

if   ( $SESS['fileaction'] == 'replace' )
{
	$fileHandle  = fopen($FILES['file']['tmp_name'],'r');
	$fileContent = fread($fileHandle,filesize($FILES['file']['tmp_name']));
	$fileSize    = strlen($fileContent);	
	$fileContent = addslashes($fileContent);	

	$filename = $FILES['file']['name'];
	$extension = '';
	$p = strrpos($filename,'.');
	if   ($p!==false)
	{
		$extension = substr( $filename,$p+1 );
		$filename  = substr( $filename,0,$p );
	}
	
	$sql = "UPDATE $t_file SET ".
	       "folderid='".$SESS['folderid']."',".
	       "filename='$filename',".
	       "extension='$extension',".
	       "size='".$fileSize."',".
	       "lastchange_date=".time().",".
	       "lastchange_userid='".$SESS['user']['id']."',".
	       "value='".$fileContent."' ".
	       "WHERE id=".$SESS['fileid'];
	$res = $db->query($sql);
	if (DB::isError($db)) die ($db->getMessage());

	$SESS['fileaction'] = 'prop';
	$var['tree_refresh'] = true;
}


if   ( $SESS['fileaction'] == 'move' )
{
	$t_file = $conf_db_prefix.'file';
	
	// Hauptverzeichnis (folderid=NULL) oder sonstiger Ordner
	if   ($REQ['folderid'] == 'null')
		$f_id = 'NULL';
	else $f_id = "'".$REQ['folderid']."'";
	$sql = "UPDATE $t_file SET ".
	       "lastchange_date=".time().",".
	       "lastchange_userid='".$SESS['user']['id']."',".
	       "folderid=$f_id ".
	       "WHERE id=".$SESS['fileid'];
	$res = $db->query($sql);

	$SESS['fileaction'] = 'prop';
	$var['tree_refresh'] = true;
}


if   ( $SESS['fileaction'] == 'savevalue' )
{
	$sql = "UPDATE $t_file SET ".
	       "lastchange_date=".time().",".
	       "lastchange_userid='".$SESS['user']['id']."',".
	       "value='".$REQ['value']."'".
	       "WHERE id=".$SESS['fileid'];
	$res = $db->query($sql);

	$SESS['fileaction'] = 'prop';
}


if   ( $SESS['fileaction'] == 'save' )
{
	// Falls Name leer, dann Dateinamen dafür benutzen
	if   ( $REQ['name'] == '' )
		$REQ['name'] = $REQ['filename'];
	
	// Wenn Dateiname gefüllt, dann Datenbank-Update
	if   ( $REQ['filename'] != '' )
	{
		$sql = "UPDATE $t_file SET ".
		       "lastchange_date=".time().",".
		       "lastchange_userid='".$SESS['user']['id']."',".
		       "filename='".$REQ['filename']."',".
		       "name='".$REQ['name']."',".
		       "extension='".$REQ['extension']."', ".
		       "`desc`='".$REQ['desc']."' ".
		       "WHERE id=".$SESS['fileid'];
		$res = $db->query($sql);
	}

	$SESS['fileaction'] = 'edit';
	$var['tree_refresh'] = true;
}


if   ( $SESS['fileaction'] == 'show' )
{
	$mime_types = parse_ini_file( "$conf_languagedir/mime-types.ini.$conf_php" );

	$sql = "SELECT extension,value FROM $t_file ".
	       "WHERE id=".$SESS['fileid'];
	$res = $db->query($sql);
	
	$row = & $res->fetchRow(DB_FETCHMODE_ASSOC);
	
	$mime = $mime_types[ strtolower($row['extension']) ];
	if   ( $mime == '' )
		$mime = 'application/octet-stream';
		
	header('Content-Type: '.$mime);
	
	echo $row['value'];
	
	$res->free();
}


if   ( $SESS['fileaction'] == 'showresize' )
{
	$mime_types = parse_ini_file( "$conf_languagedir/mime-types.ini.$conf_php" );

	$file = new File();
	$file->fileid = $SESS['fileid'];
	$file->load();
	$file->resize( $REQ['width'],$REQ['height']);
	
	$mime = $mime_types[ strtolower($file->extension) ];
	if   ( $mime == '' )
		$mime = 'application/octet-stream';
		
	header('Content-Type: '.$mime);
	
	readfile( $file->tmpfile );
}


if   ( $SESS['fileaction'] == 'edit' )
{
	$mime_types = parse_ini_file( "$conf_languagedir/mime-types.ini.$conf_php" );

	$t_file = $conf_db_prefix.'file';
	$sql = "SELECT name,filename,extension,`desc`,size,create_date,create_userid,lastchange_date,lastchange_userid FROM $t_file ".
	       "WHERE id=".$SESS['fileid'];
	$row = $db->getRow($sql);
	
	$mime = $mime_types[ $row['extension'] ];
	if   ( $mime == '' )
		$mime = 'application/octet-stream';
	
	$var = array_merge( $var,$row );
	$var['mime'] = $mime;

	if   ( substr($mime,0,5) == 'text/' )
		$var['src_url'] = 'file.'.$conf_php.'?fileaction=src';

	$sql = "SELECT name,fullname,mail ".
	       "FROM $t_user ".
	       "WHERE id=".$var['lastchange_userid'];
	$row = $db->getRow($sql);
	$var['lastchange_user'] = $row;
	$var['lastchange_user']['url'] = 'main.'.$conf_php.'?action=user&useraction=show&userid='.$var['lastchange_userid'];

	$sql = "SELECT name,fullname,mail ".
	       "FROM $t_user ".
	       "WHERE id=".$var['create_userid'];
	$row = $db->getRow($sql);
	$var['create_user'] = $row;
	$var['create_user']['url'] = 'main.'.$conf_php.'?action=user&useraction=show&userid='.$var['create_userid'];
	
	// Alle Ordner ermitteln
	$var['act_folderid'] = $SESS['folderid'];
	$var['folder'] = array();
	$var['folder']['null'] = '&lt;'.lang('ROOT_DIRECTORY').'&gt;';
	
	$sql = "SELECT * FROM $t_folder ".
	       "WHERE projectid=".$SESS['projectid'];
	$res_f = $db->Query($sql);
	while( $row_f = $res_f->fetchRow() )
	{
		$var['folder'][$row_f['id']] = implode('/',folder_path($row_f['id']));
	}

	output( 'file_edit',$var );
}


if   ( $SESS['fileaction'] == 'src' )
{
	$sql = "SELECT value FROM $t_file ".
	       "WHERE id=".$SESS['fileid'];

	$var['value'] = $db->getOne($sql);
	
	$SESS['fileaction'] = 'edit';
	 
	output( 'file_src',$var );
}


if   ( $SESS['fileaction'] == 'prop' )
{
	$mime_types = parse_ini_file( "$conf_languagedir/mime-types.ini.$conf_php" );

	$sql = "SELECT filename,extension,`desc`,size,create_date,create_userid,lastchange_date,lastchange_userid ".
	       "FROM $t_file ".
	       "WHERE id=".$SESS['fileid'];

	$row = $db->getRow($sql);
	$var = array_merge( $var,$row );

	$sql = "SELECT name,fullname,mail ".
	       "FROM $t_user ".
	       "WHERE id=".$row['lastchange_userid'];
	$row = $db->getRow($sql);
	$var['lastchange_user'] = $row;
	$var['lastchange_user']['url'] = 'action.'.$conf_php.'?action=user&useraction=show&userid='.$row['id'];

	$sql = "SELECT name,fullname,mail ".
	       "FROM $t_user ".
	       "WHERE id=".$row['create_userid'];
	$row = $db->getRow($sql);
	$var['create_user'] = $row;
	$var['create_user']['url'] = 'action.'.$conf_php.'?action=user&useraction=show&userid='.$row['id'];

	$mime = $mime_types[ $row['extension'] ];
	if   ( $mime == '' )
		$mime = 'application/octet-stream';
	
	$var['mime'] = $mime;
	output( 'file_prop',$var );
}


if   ( $SESS['fileaction'] == "pub" )
{
	$var['filenames'] = array();
	// Projektdaten ermitteln
	$sql  = "SELECT * FROM $t_project WHERE id=".$SESS['projectid'];
	$row = $db->getRow( $sql );

	$is_ftp = false;
	
	if   ( $row['ftp_url'] != '' )
	{
		$ftp = new Ftp( $row['ftp_url'] );
		$is_ftp = true;
	}

	$file = new File();
	$file->fileid = $SESS['fileid'];

	$file->load();
	
	$source = $file->tmpfile;
	$dest = $row['target_dir'].'/'.$file->full_filename(); 

	$var['filenames'][] = $file->full_filename();

	if   (!copy( $source,$dest ));
	{
		mkdirs( dirname($dest) );

		if   (!copy( $source,$dest ))
		{
			// error
		}
	}
	
	if   ( $is_ftp )
	{
		$dest = $file->full_filename(); 
		$ftp->put( $source,$dest,FTP_ASCII );
	}

	if   ( $is_ftp )
	{
		$ftp->close();
	}
	
	output('file_publish',$var);
}


?>