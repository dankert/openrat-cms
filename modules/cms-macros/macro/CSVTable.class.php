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
use cms\model\File;
use util\Macro;


/**
 * Aus einer CSV-Datei wird eine HTML-Tabelle erstellt.
 *
 * @author Jan Dankert
 */
class CSVList extends Macro
{
	/**
	 * Id der Datei, welche die Werte enthält. 
	 * @var unknown_type
	 */
	var $fileid                = 0;
	
	/**
	 * CSS-Klasse der Tabelle.
	 * @var unknown_type
	 */
	var $css_class             = 'table';
	
	/**
	 * Trennzeichen (Default: Komma).
	 * @var unknown_type
	 */
	var $seperator             = ',';
	
	/**
	 * Bitte immer eine Beschreibung benutzen, dies ist fuer den Web-Developer hilfreich.
	 * @type String
	 */
	var $description = 'Creates a HTML-table from a CSV-file';

	
	
	function execute()
	{
		$this->output('<table class="'.$this->css_class.'">');
		
		// Datei lesen
		$file = new File( $this->fileid );
		$values = $file->loadValue();
		
		// In einzelne Zeilen zerlegen.
		$lines = explode("\n",$values);
		
		foreach( $lines as $line )
		{
			$this->output('<tr>');
			
			// In einzelne Spalten zerlegen.
			$columns = explode($seperator,$line);
			foreach( $columns as $column )
			{
				$this->output('<td>' );
				$this->output($column);
				$this->output('</td>');
			}
			$this->output('</tr>');
		}

		$this->output('</table>');
	}
}


?>