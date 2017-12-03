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
 * Darstellung einer Datenbank-Abfrage.
 * 
 * @author Jan Dankert
 * @package openrat.database
 */
class Statement
{
	
	/**
	 * SQL-Objekt.
	 *
	 * @var SQL
	 */
	var $sql;

	/**
	 * Client.
	 * Enth�lt ein Objekt der Klasse db_<type>.
	 *
	 * @var Object
	 */
	var $client;
	
	
	/**
	 * Datenbank-Konfiguration
	 * @var Array
	 */
	var $conf;
	
	/**
	 * Kontruktor.
	 * Erwartet die Datenbank-Konfiguration als Parameter.
	 *
	 * @param Array Konfiguration der Verbindung
	 * @return Status 'true' wenn Verbindung erfolgreich aufgebaut.
	 */
	public function Statement( $sql, $client,$conf )
	{
		// Tabellen-Praefixe ergaenzen.
		$this->conf   = $conf;
		$this->client = $client;
		
		$sql = str_replace('{{',$conf['prefix'],$sql);
		$sql = str_replace('}}',$conf['suffix'],$sql);
		
		$this->sql = new Sql( $sql );
		
		// Vorbereitete Datenbankabfrage ("Prepared Statement")
		$this->client->clear();
		
		// Statement an die Datenbank schicken
		$this->client->prepare( $this->sql->query,$this->sql->param );
	}
	


	/**
	 * Ausfuehren einer Datenbankanfrage.
	 *
	 * @param SQL-Objekt
	 * @return Object (Result)
	 */
	public function query( )
	{
		return $this->execute();
	}
	
	
	/**
	 * Ausfuehren einer Datenbankanfrage.
	 *
	 * @param SQL-Objekt
	 * @return Object (Result)
	 */
	public function execute( )
	{
		// Ausfuehren...
		$result = $this->client->query($this->sql);
	
		if	( $result === FALSE )
		{
			throw new RuntimeException( 'Database error: '.$this->client->error);
		}
	
		return $result;
	}
	

	/**
	 * Ermittelt genau 1 Datenbankergebnis aus einer SQL-Anfrage.
	 * Falls es mehrere Treffer gibt, wird die 1. Spalte aus der 1. Zeile genommen.
	 *
	 * @param String $this->query
	 * @return String
	 */
	public function &getOne()
	{
		$none = '';
		$result = $this->query();
		
		$row = $this->client->fetchRow( $result,0 );
		$this->client->freeResult($result);

		if	( ! is_array($row) )
			return $none;
			
		$keys = array_keys($row);
		
		return $row[ $keys[0] ];
	}


	/**
	 * Ermittelt eine Zeile aus der Datenbank.
	 *
	 * @param String $this->query
	 * @return Array
	 */
	public function &getRow()
	{
		$result = $this->query();
		
		$row = $this->client->fetchRow( $result,0 );
		$this->client->freeResult($result);

		if	( ! is_array($row) )
			$row = array();

		return $row;
	}


	/**
	 * Ermittelt eine (die 1.) Spalte aus dem Datenbankergebnis.
	 *
	 * @param String $this->query
	 * @return Array
	 */
	public function &getCol()
	{
		$result = $this->query();

		$i = 0;
		$col = array();
		while( $row = $this->client->fetchRow( $result,$i++ ) )
		{
			if	( empty($row) )
				break;
				
			$keys = array_keys($row);
			$col[] = $row[ $keys[0] ];
		}
			
		$this->client->freeResult($result);
		
		return $col;
	}


	/**
	 * Ermittelt ein assoziatives Array aus der Datenbank.
	 *
	 * @param String $this->query
	 * @param Boolean $force_array
	 * @return Array
	 */
	public function &getAssoc()
	{
		$force_array = false;
		
		$results = array();
		$result = $this->query();

		$i = 0;
		
		while( $row = $this->client->fetchRow( $result,$i++ ) )
		{
			if	( empty($row) )
				break;

			$keys = array_keys($row);
			$key1 = $keys[0];
			$id = $row[$key1];
				
			if	( count($row) > 2 || $force_array )
			{
				unset( $row[$key1] );
				$results[ $id ] = $row;
			}
			else
			{
				$key2 = $keys[1];

				$results[ $id ] = $row[$key2];
			}
		}

		$this->client->freeResult( $result );

		return $results;
	}


	/**
	 * Ermittelt alle Datenbankergebniszeilen.
	 *
	 * @param String $this->query
	 * @return Array
	 */
	public function &getAll()
	{
		$result = $this->query();

		$results = array();
		$i = 0;

		while( $row = $this->client->fetchRow( $result,$i++ ) )
		{
			$results[] = $row;
		}

		$this->client->freeResult( $result );
		
		return $results;
	}
	
	
	/**
	 * Führt eine Query aus und gibt nur zurück, ob diese funktioniert.
	 * 
	 * @param unknown_type $this->query
	 * @return boolean
	 */
	public function testQuery()
	{
		try
		{
			$result = $this->query();
			return $result; 
		}
		catch( Exception $e )
		{
			return false;
		}
	}
	
	
	/**
	 * Setzt eine Ganzzahl als Parameter.<br>
	 *
	 * @param name Name des Parameters
	 * @param value Inhalt
	 */
	function setInt( $name,$value )
	{
		$this->client->bind( $name, (int)$value );
	}
	
	
	
	/**
	 * Setzt eine Zeichenkette als Parameter.<br>
	 *
	 * @param name Name des Parameters
	 * @param value Inhalt
	 */
	function setString( $name,$value )
	{
		$this->client->bind( $name, (string)$value );
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
		else
			$this->setInt( $name,0 );
	}
	
	
	
	/**
	 * Setzt einen Parameter auf den Wert <code>null</code>.<br>
	 *
	 * @param name Name des Parameters
	 */
	function setNull( $name )
	{
		$this->client->bind( $name, null );
	}
	
	
}


?>