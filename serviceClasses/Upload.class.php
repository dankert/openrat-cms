<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// OpenRat Content Management System
// Copyright (C) 2002-2004 Jan Dankert, jandankert@jandankert.de
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
// Revision 1.2  2004-05-02 15:04:16  dankert
// Einfügen package-name (@package)
//
// Revision 1.1  2004/04/24 17:03:28  dankert
// Initiale Version
//
// Revision 1.1  2003/10/27 23:21:55  dankert
// Methode(n) hinzugefügt: savevalue(), save()
//
// ---------------------------------------------------------------------------

/**
 * Methoden fuer den Upload einer Datei
 *
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class Upload
{
	var $filename;
	var $extension;
	var $value;
	var $size;

	function Upload() // Konstruktor
	{
		global $FILES;

		$this->size = filesize($FILES['file']['tmp_name']);

		$fh    = fopen( $FILES['file']['tmp_name'],'r' );
		$this->value = fread($fh,$this->size);
		fclose( $fh );
	
		$this->filename = $FILES['file']['name'];
		$this->extension = '';

		$p = strrpos( $this->filename,'.' ); // Letzten Punkt suchen

		if   ($p!==false) // Wennn letzten Punkt gefunden, dann dort aufteilen
		{
			$this->extension = substr( $this->filename,$p+1 );
			$this->filename  = substr( $this->filename,0,$p );
		}
	}
}

?>