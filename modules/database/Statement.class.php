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
use database\driver\PDODriver;
use logger\Logger;
use util\exception\DatabaseException;

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
	 *
	 * @var PDODriver
	 */
	var $client;
	
	
	/**
	 * Datenbank-Konfiguration
	 * @var array
	 */
	var $conf;

    /**
     * Statement
     * @var \PDOStatement
     */
	var $stmt;

    /**
     * Statement constructor.
     * @param $sql string Sql
     * @param $client Database
     * @param $conf array
     */
    public function __construct($sql, $client, $conf )
	{
		// Tabellen-Praefixe ergaenzen.
		$this->conf   = $conf;
		$this->client = $client;
		
		$sql = str_replace('{{',$conf['prefix'],$sql);
		$sql = str_replace('}}',$conf['suffix'],$sql);
		
		$this->sql = new Sql( $sql );

		// Statement an die Datenbank schicken
		$this->stmt = $this->client->prepare( $this->sql->query,$this->sql->param );
	}


    /**
     * Ausfuehren einer Datenbankanfrage.
     *
     * @return Object (Result)
     */
	public function execute()
	{
		// Ausfuehren...
		try {
			return $this->client->execute($this->stmt, $this->sql);
		} catch( \Exception $e ) {
			throw new DatabaseException('Database statement failed'."\n".$this->sql->query,$e);
		}
	}


    /**
     * Ermittelt genau 1 Datenbankergebnis aus einer SQL-Anfrage.
     * Falls es mehrere Treffer gibt, wird die 1. Spalte aus der 1. Zeile genommen.
     *
     * @return String|null
     */
	public function getOne()
	{
		$this->execute();

		return $this->client->fetchFirstColumn($this->stmt);
	}


    /**
     * Ermittelt eine Zeile aus der Datenbank.
     *
     * @return array
     */
	public function &getRow()
	{
		$this->execute();
		$row = $this->client->fetchAssocRow($this->stmt);

		if	( ! is_array($row) )
			$row = array();

		return $row;
	}


    /**
     * Ermittelt eine (die 1.) Spalte aus dem Datenbankergebnis.
     *
     * @return array
     */
	public function getCol()
	{
		$this->execute();

		return $this->client->fetchAllFirstColumn($this->stmt);
	}


    /**
     * Ermittelt ein assoziatives Array aus der Datenbank.
     *
     * @return array
     */
	public function &getAssoc()
	{
		$this->execute();
		$results = array();

		while( $row = $this->client->fetchIndexedRow($this->stmt) )
			$results[ $row[0] ] = $row[1];

		return $results;
	}


    /**
     * Ermittelt alle Datenbankergebniszeilen.
     *
     * @return array
     */
	public function getAll()
	{
		$this->execute();

		return $this->client->fetchAllRows($this->stmt);
	}
	
	
    /**
     * Setzt eine Ganzzahl als Parameter.<br>
     * @param $name string
     * @param $value integer
     */
	function setInt( $name,$value )
	{
		$this->client->bind( $this->stmt, $name, (int)$value );
	}
	
	
	
    /**
     * Setzt eine Ganzzahl als Parameter.<br>
     * @param $name string
     * @param $value integer
     */
	function setIntOrNull( $name,$value )
	{
		if   ( is_int($value))
			$this->setInt( $name,$value);
		else
			$this->setNull( $name );
	}


    /**
     * Setzt eine Ganzzahl als Parameter.<br>
     * @param $name string
     * @param $value integer
     */
	function setStringOrNull( $name,$value )
	{
		if   ( is_string($value))
			$this->setString( $name,$value);
		else
			$this->setNull( $name );
	}



	/**
	 * Setzt eine Zeichenkette als Parameter.<br>
	 *
     * @param $name string
     * @param $value string
	 */
	function setString( $name,$value )
	{
		$this->client->bind( $this->stmt, $name, (string)$value );
	}
	
	
	
	/**
	 * Setzt einen bool'schen Wert als Parameter.<br>
	 * Ist der Parameterwert wahr, dann wird eine 1 gesetzt. Sonst 0.<br>
	 *
     * @param $name string
     * @param $value bool

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
	 * @param $name string Name des Parameters
	 */
	function setNull( $name )
	{
		$this->client->bind( $this->stmt, $name, null );
	}
	
	
}
