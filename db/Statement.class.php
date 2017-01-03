<?php
//
// +----------------------------------------------------------------------+
// | PHP version 4.0                                                      |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2001 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.02 of the PHP license,      |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/2_02.txt.                                 |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Stig Bakken <ssb@fast.no>                                   |
// |          Jan Dankert <phpdb@jandankert.de>                           |
// +----------------------------------------------------------------------+
//

// This is the database abstraction layer. This class was inspired by the
// PHP-Pear-DB package. Thanks to its developers.

/**
 * Darstellung einer Datenbank-Verbindung.
 * Fuer die echten DB-Aufrufe werden die entsprechenden
 * Methoden des passenden Clients aufgerufen.
 * 
 * Diese Klasse stammt urspruenglich aus dem PHP-Pear-DB-Projekt und unterliegt
 * daher auch der PHP-licence.
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
	 * Kontruktor.
	 * Erwartet die Datenbank-Konfiguration als Parameter.
	 *
	 * @param Array Konfiguration der Verbindung
	 * @return Status 'true' wenn Verbindung erfolgreich aufgebaut.
	 */
	public function Statement( $sql, $client,$dbid )
	{
		$this->client = $client;
		$this->sql = new Sql( $sql,$dbid );
	}
	


	/**
	 * Ausfuehren einer Datenbankanfrage.
	 *
	 * @param SQL-Objekt
	 * @return Object (Result)
	 */
	public function query( )
	{
		$this->execute();
	}
	
	
	/**
	 * Ausfuehren einer Datenbankanfrage.
	 *
	 * @param SQL-Objekt
	 * @return Object (Result)
	 */
	public function execute( )
	{
		// Vorbereitete Datenbankabfrage ("Prepared Statement")
		$this->client->clear();
	
		// Statement an die Datenbank schicken
		$this->client->prepare( $this->sql->raw,$this->sql->param );
	
		// Einzelne Parameter an die Anfrage binden
		foreach ($this->sql->param as $name=>$unused)
			$this->client->bind($name,$this->sql->data[$name]);
	
		// Ausfuehren...
		$result = $this->client->query($this->sql);
	
		if	( $result === FALSE )
		{
			throw new Exception( 'Database error: '.$this->client->error);
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
		
		if	( $result === FALSE )
		{
			$this->error = $this->client->error;
			
			Logger::warn('Database error: '.$this->error);
			Http::serverError('Database Error',$this->error);
		}

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
	public function &getAssoc( $force_array = false )
	{
		$results = array();
		$result = $this->query();

		$i = 0;
		
		while( $row = $this->client->fetchRow( $result,$i++ ) )
		{
			if	( empty($row) )
				break;

			if	( count($row) > 2 || $force_array )
			{
				// FIXME: Wird offenbar nie ausgeführt.
				$row = $res->fetchRow($i);

				$keys = array_keys($row);
				$key1 = $keys[0];

				unset( $row[$key1] );
				$results[ $row[$key1] ] = $row;
			}
			else
			{
				$keys = array_keys($row);
				$key1 = $keys[0];
				$key2 = $keys[1];

				$results[ $row[$key1] ] = $row[$key2];
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
		$this->sql->setInt($name, $value);
	}
	
	
	
	/**
	 * Setzt eine Zeichenkette als Parameter.<br>
	 *
	 * @param name Name des Parameters
	 * @param value Inhalt
	 */
	function setString( $name,$value )
	{
		$this->sql->setString($name, $value);
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
		$this->sql->setNull($name);
	}
	
	
}


?>