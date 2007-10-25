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
// Revision 1.4  2007-10-25 22:28:18  dankert
// Filemanager f?r den FCK-Editor mit Zugriff auf OpenRat-Verzeichnis.
//
// Revision 1.3  2007-10-02 21:13:44  dankert
// Men?punkt "Neu" mit direktem Hinzuf?gen von Objekten.
//
// Revision 1.2  2004/05/02 15:04:16  dankert
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

	/**
	 * Bearbeitet den Upload einer Datei.<br>
	 * Bei der Objekterzeugung wird die Datei bereits geladen.<br>
	 *
	 * @return Upload
	 */
	function Upload( $name='file' ) // Konstruktor
	{
		global $FILES;

		$this->size = filesize($FILES[$name]['tmp_name']);
		
		if	( $this->size == 0 )
			exit;

		$fh    = fopen( $FILES[$name]['tmp_name'],'r' );
		
		$this->value = fread($fh,$this->size);
		fclose( $fh );
	
		$this->filename = $FILES[$name]['name'];
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