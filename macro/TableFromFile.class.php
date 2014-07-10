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
 * Erstellt eine HTML-Tabelle aus einer CSV-Datei.
 * 
 * @author Jan Dankert
 */
class TagCloud extends Macro
{
	/**
	 * Beschreibung dieser Klasse
	 * @type String
	 */
	var $description = '';


	public $fileid = 0;
	public $separator = ',';
	public $firstlineheader = 1;
	public $firstcolumnheader = 1;
	public $ignorefirstline = 0;
	public $header = 'A,B,C';
	public $encodeHtml = 1;
	

	function execute()
	{
		$this->output('<table>');
		$file = new File( $this->fileid );
		$lines = explode("\n",$file->loadValue() );
		
		$firstline = true;
		foreach( $lines as $line )
		{
			if	( $firstline)
			{
				$firstline = false;
				if	( $this->ignorefirstline)
					continue;
				elseif	( $this->firstlineheader )
					$lcelltag = 'th';
				else
					$lcelltag = 'td';
			}
			else
				$lcelltag = 'td';
			
			$columns = explode($this->separator,$line);
			
			$this->output('<tr>');
			$firstcolumn = true;
			foreach( $columns as $column )
			{
				if ($firstcolumn)
				{
					$firstcolumn = false;
					if	( $this->firstcolumnheader )
						$celltag = 'th'; 
					else 
						$celltag = $lcelltag;
					
					if	( $this->encodeHtml) $column = encodeHtml($column);
					$this->output('<'.$celltag.'>'.$column.'</'.$celltag.'>');
				}
			}
			$this->output('</tr>');
		}
		$this->output('</table>');
	}

}