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

/**
 * Methoden fuer den Upload einer Datei
 *
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class Upload
{
	public $filename;
	public $extension;
	public $value;
	public $size;

	public $parameterName;

	public static $DEFAULT_PARAM_NAME = 'file';

	
	/**
	 * Bearbeitet den Upload einer Datei.<br>
	 * Bei der Objekterzeugung wird die Datei bereits geladen.<br>
	 *
	 * @return Upload
	 */
	function __construct( $name='file' ) // Konstruktor
	{
	    $this->parameterName = $name;
	}

	public function processUpload()
    {
        $name = $this->parameterName;

        if	( !isset($_FILES[$name])              ||
            !isset($_FILES[$name]['tmp_name'])  ||
            !is_file($_FILES[$name]['tmp_name'])   )
        {
            throw new InvalidArgumentException('No file received under the key '.$name );
        }

        $this->size = filesize($_FILES[$name]['tmp_name']);

        $fh    = fopen( $_FILES[$name]['tmp_name'],'r' );

        $this->value = fread($fh,$this->size);
        fclose( $fh );

        $this->filename = $_FILES[$name]['name'];
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