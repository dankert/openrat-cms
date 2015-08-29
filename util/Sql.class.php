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



/**
 * SQL-Anweisung.<br>
 * <br>
 * Darstellen eines SQL-Statements incl. Methoden zum Fuellen von
 * Platzhaltern im SQL-Befehl.<br>
 * <br>
 * Beispiel<br>
 * <pre>
 * // Neues Objekt erzeugen mit SQL-Anweisung
 * $sql = new Sql('SELECT * FROM xy WHERE id={uid} AND name={name}');
 * 
 * // Parameter f�llen
 * $sql->setInt   ('uid' ,1      );
 * $sql->setString('name','peter');
 * 
 * // Fertige SQL-Anweisung verwenden
 * $xy->execute( $sql->query );
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
	 * Urspr�ngliche SQL-Anweisung.
	 */
	var $src      = '';
	
	/**
	 * Auszuf�hrende Abfrage.
	 */
	var $query    = '';
	
	var $raw      = '';
	
	
	/**
	 * Zwischenspeicher f�r Parameterwerte.
	 */
	var $data     = Array();
	
	/**
	 * Ein 2-dimensionales Array mit den Positionen der Parameter.<br>
	 * <br>
	 * Beispiel:<br>
	 * <pre>
	 * 
	 * Array
	 * (
	 *    [lid] => Array
	 *    (
	 *       [0] => 65
	 *       [1] => 81
	 *    )
	 *    [oid] => Array
	 *    (
	 *        [0] => 123
	 *    )
	 * )
	 * </pre>
	 * In der ersten Dimension sind die Parameter vorhanden, jeder Parameter hat eine Liste von Positionen, an denen er steht.<br>
	 * Ein Parameter kann n�mlich mehrfach vorkommen!
	 */
	var $param    = array();
	
	
	var $dbid     = '';
	
	
	/**
	 * Erzeugt ein SQL-Objekt und analysiert die SQL-Anfrage.
	 */
	function Sql( $query = '', $dbid='' )
	{
		$this->dbid  = $dbid;
		$this->parseSourceQuery( $query );

		$this->data  = array();
	}



	/**
	 * Die SQL-Anfrage wird auf Parameter untersucht.
	 */
	function parseSourceQuery( $query )
	{
		$this->src   = $query; // Wir merken uns die Ur-Abfrage, evtl. f�r Fehlermeldungen interessant.
		
		while( true )  // Schleife wird solange durchlaufen, solange Parameter gefunden werden.
		{
			$posKlLinks  = strpos($query,'{');
			$posKlRechts = strpos($query,'}');
			
			if 	( $posKlLinks === false )
				break; // Schleife abbrechen, wenn kein Parameter mehr gefunden wird.
				
			$nameParam = substr($query,$posKlLinks+1,$posKlRechts-$posKlLinks-1);  // Name Parameter
			
			if	( !isset($this->param[$nameParam ]))
				$this->param   [$nameParam ] = array();
				
			$this->param[$nameParam ][] = $posKlLinks;
			
			$query = substr($query,0,$posKlLinks).substr($query,$posKlRechts+1);
		}
		
		$this->query = $query;
//		$merkeParam = $this->param;
		
		// Tabellennamen in die Platzhalter setzen.
		// Dies ist noch OpenRat-spezifisch und sollte bei einer sauberen Abstraktion woanders gemacht werden. Aber wo?
		foreach( table_names($this->dbid) as $t=>$name )
		{
			$this->setParam($t,$name,false );
			
			unset( $this->param[$t] );
			
		}
		
		$this->raw   = $this->query;
		//$this->param = $merkeParam;

	}



	/**
	 * Setzt eine neue SQL-Abfrage.<br>
	 * Bereits vorhandene Parameter werden automatisch wieder gesetzt.
	 */
	function setQuery( $query = '' )
	{
		$this->parseSourceQuery( $query );

		// Bereits vorhande Parameter setzen.		
		foreach( $this->data as $name=>$data )
		{
			if	( $data['type']=='string'     ) $this->setString    ($name,$data['value'] );
			if	( $data['type']=='int'        ) $this->setInt       ($name,$data['value'] );
			if	( $data['type']=='null'       ) $this->setNull      ($name                );
		}
	}



	/**
	 * Setzt einen Parameter.<br>
	 * Diese Methode sollte nur intern aufgerufen werden!<br>
	 * 
	 * @param name Name des Parameters
	 * @param value Inhalt
	 * @param dieIfUnknown wenn <code>true</code> und Parameter unbekannt, dann Abbruch.
	 * @access private
	 */
	private function setParam( $name,$value,$dieIfUnknown=true)
	{

		//   Nett gemeint, f�hrt aber aktuell zu Fehlern, weil an vielen Stellen zu viele Parameter gef�llt werden.
		//   Daher erstmal deaktiviert.
		//		if	( !isset($this->param[$name]) )
		//		{
		//			if	( $dieIfUnknown )
		//				die("parameter '$name' unknown. SQL=".$this->src);
		//			else
		//				return;
		//		}

		if	( !isset($this->param[$name]) )
			return; // Parameter nicht vorhanden.

		if	( is_array($this->param[$name]) )
		{
			foreach( $this->param[$name] as $idx=>$xyz )
			{
				$pos = $this->param[$name][$idx];
				
				$this->query = substr( $this->query,0,$pos ).$value.substr( $this->query,$pos );
			
				foreach( $this->param as $pn=>$par)
				{
					foreach( $par as $i=>$p )
					{
						if	( $p > $pos )
							$this->param[$pn][$i]=$p+strlen($value);
					}
				}
				
			}
		}
	}
	


	/**
	 * Setzt einen Parameter.<br>
	 * Der Typ des Parameters wird automatisch ermittelt.<br>
	 * 
	 * @param name Name des Parameters
	 * @param value Inhalt
	 */
	function setVar( $name,$value )
	{
		if   ( is_string($value) )
			$this->setString( $name,$value );

		if   ( is_null($value) )
			$this->setNull( $name );
		
		if   ( is_int($value) )
			$this->setInt( $name,$value );
	}


	
	/**
	 * Setzt eine Ganzzahl als Parameter.<br>
	 * 
	 * @param name Name des Parameters
	 * @param value Inhalt
	 */
	function setInt( $name,$value )
	{
		$this->data[ $name ] = array( 'type'=>'int','value'=>(int)$value );
	}



	/**
	 * Setzt eine Zeichenkette als Parameter.<br>
	 * 
	 * @param name Name des Parameters
	 * @param value Inhalt
	 */
	function setString( $name,$value )
	{
		$this->data[ $name ] = array( 'type'=>'string','value'=>$value );
	}
	
	
	
	/**
	 * Setzt einen bool'schen Wert als Parameter.<br>
	 * Ist der Parameterwert wahr, dann wird eine 1 gesetzt. Sonst 0.<br>
	 * 
	 * @param name Name des Parameters
	 * @param value Inhalt
	 */
	function setBoolean( $name,$value )
	{
		if	( $value )
			$this->setInt( $name,1 );
		else	$this->setInt( $name,0 );
	}



	/**
	 * Setzt einen Parameter auf den Wert <code>null</code>.<br>
	 * 
	 * @param name Name des Parameters
	 */
	function setNull( $name )
	{
		$this->data[ $name ] = array( 'type'=>'null' );
	}
	


	/**
	 * Ermittelt die fertige SQL-Anfrage.<br>
	 * Alias zu #getQuery()
	 */
	function &query()
	{
		return $this->getQuery();
	}



	/**
	 * Ermittelt die fertige SQL-Anfrage.
	 * @param Name einer Funktion, die eine Zeichenkette f�r die
	 *        Datenbank schuetzt. Dies kann je nach verwendetem RDBMS
	 *        unterschiedlich sein, daher diese Funktionsreferenz.
	 */
	function &getQuery( $escape_function )
	{
		// Bereits gesetzte Parameter setzen.		
		foreach( $this->data as $name=>$data )
		{
			if		( $data['type']=='string' ) $this->setParam($name,"'".$escape_function($data['value'])."'" );
			elseif	( $data['type']=='int'    ) $this->setParam($name,(int)$data['value']                );
			elseif	( $data['type']=='null'   ) $this->setParam($name,'NULL'                             );
		}
		
		return $this->query;
	}
}

 
?>