<?php
// OpenRat Content Management System
// Copyright (C) 2002-2012 Jan Dankert, cms@jandankert.de
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
use cms\model\Folder;


/**
 * Service-Klasse fuer allgemeine Interface-Methoden. Insbesondere
 * in Code-Elementen kann und soll auf diese Methoden zurueckgegriffen
 * werden.
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class Api
{
	var $output   = '';
	var $objectid = 0;
	var $page;
	
	function db()
	{
		return db_connection();
	}

	function pageid()
	{
		echo 'WARNING: pageid() deprecated!<br>';
		global $SESS;
		return $SESS['objectid'];
	}

	function getObjectId()
	{
		return $this->objectid;
	}

	function setObjectId( $objectid )
	{
		$this->objectid = $objectid;
	}

	function getRootObjectId()
	{
		return Folder::getRootObjectId();
	}

	function folderid()
	{
		global $SESS;
		return $SESS['folderid'];
	}


	function execute( $code )
	{
		global $conf_tmpdir;
		$code = "<?php\n".$code."\n?>";

		$tmp  = $conf_tmpdir.'/'.md5(microtime()).'.tmp';
		$f = fopen( $tmp,'w' );
		fwrite( $f,$code );
		fclose( $f );
		
		require( $tmp ); // Ausfuehren des temporaeren PHP-Codes

		unlink( $tmp );
		$inhalt = Api::getOutput();
		$this->output( $inhalt );
	}	
	
	function delOutput()
	{
		$this->output = '';
	}
	
	function output( $text )
	{
		$this->output .= $text;
	}


	function getOutput()
	{
		return $this->output;
	}
}