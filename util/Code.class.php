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
// Revision 1.1  2004-12-15 23:14:21  dankert
// *** empty log message ***
//
// ---------------------------------------------------------------------------

/**
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class Code extends Dynamic
{
	var $code = '';
	
	function execute()
	{
		if	( substr($this->code,0,5) != '<?php' )
			$this->code = "<?php\n".$this->code."\n?>";

		$tmp = Object::getTempDir().'/openratDynamic';
		$tmp .= '.code.php.tmp';
		
		$f = fopen( $tmp,'w' );
		fwrite( $f,$this->code );
		fclose( $f );
		
		require( $tmp ); // Ausfuehren des temporaeren PHP-Codes

		unlink( $tmp );
	}	
}