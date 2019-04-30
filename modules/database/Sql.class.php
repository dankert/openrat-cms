<?php
// OpenRat Content Management System
// Copyright (C) 2002-2006 Jan Dankert, jandankert@jandankert.de
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

namespace database;
use Logger;
use LogicException;

/**
 * SQL-Anweisung.<br>
 * <br>
 * Darstellen eines SQL-Statements incl. Methoden zum Fuellen von
 * Platzhaltern im SQL-Befehl.<br>
 * <br>
 * Beispiel<br>
 * <pre>
 * // Neues Objekt erzeugen mit SQL-Anweisung
 * $stmt = $db->sql('SELECT * FROM xy WHERE id={uid} AND name={name}');
 * 
 * // Parameter f�llen
 * $stmt->setInt   ('uid' ,1      );
 * $stmt->setString('name','peter');
 * 
 * // Fertige SQL-Anweisung verwenden
 * $stmt->execute();
 * </pre>
 * <br>
 * Ziele dieser Klasse sind:<br>
 * - Schreiben einfacher SQL-Anweisungen ohne Stringverarbeitung<br>
 * - Verhindern von SQL-Injection.<br>
 * <br>
 *   
 * @author Jan Dankert, $Author$
 * @version $Revision$
 * @package openrat.services
 */

class Sql
{
	/**
	 * SQL-Anweisung.
     * @type string
	 */
	var $query;
	
	/**
	 * Ein 1-dimensionales Array mit den Positionen der Parameter.<br>
	 * <br>
	 * Beispiel:<br>
	 * <pre>
	 * 
	 * Array
	 * (
	 *    [lid] => 16
	 *    [oid] => 24
	 * )
	 * </pre>
	 */
	public $param    = array();


    /**
     * Erzeugt ein SQL-Objekt und analysiert die SQL-Anfrage.
     * @param string $query SQL-Query
     */
	public function __construct( $query = '' )
	{
		$this->parseSourceQuery( $query );
	}


	/**
	 * Die SQL-Anfrage wird auf Parameter untersucht.
	 */
	private function parseSourceQuery( $query )
	{
		Logger::trace( "SQL-query:\n$query" );
		
		while( true )  // Schleife wird solange durchlaufen, solange Parameter gefunden werden.
		{
			$posKlLinks  = strpos($query,'{');
			$posKlRechts = strpos($query,'}');
			
			if 	( $posKlLinks === false || $posKlRechts === false )
				break; // Schleife abbrechen, wenn kein Parameter mehr gefunden wird.
				
			$nameParam = substr($query,$posKlLinks+1,$posKlRechts-$posKlLinks-1);  // Name Parameter
			
			if	( isset($this->param[$nameParam ]))
				throw new LogicException( "The named parameter '$nameParam'' is used more than one time in the SQL query:\n$query" );
				
			$this->param[$nameParam] = $posKlLinks;
			
			$query = substr($query,0,$posKlLinks).substr($query,$posKlRechts+1);
		}
		
		$this->query = $query;

	}


}

 
?>