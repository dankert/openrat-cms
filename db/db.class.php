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
 * Grundsaetzliche Darstellung einer Datenbank-Verbindung
 * @author $Author: dankert $
 * @version $Revision: 1.9 $
 * @package openrat.database
 */
class DB
{
	/**
	 * Datenbank-Id.
	 *
	 * @var String
	 */
	var $id;
	
	/**
	 * Konfiguration der Datenbank-Verbindung
	 *
	 * @var Array
	 */
	var $conf;
	
	/**
	 * Kennzeichen, ob die Datenbank verfï¿½gbar ist.
	 *
	 * @var Boolean
	 */
	var $available;
	
	/**
	 * Enthï¿½lt eine Fehlermeldung (sofern verfï¿½gbar).
	 *
	 * @var String
	 */
	var $error;

	/**
	 * Client.
	 * Enthält ein Objekt der Klasse db_<type>.
	 *
	 * @var Object
	 */
	var $client;
	
	/**
	 * Schalter, ob eine Transaktion begonnen wurde.
	 * @var boolean
	 */
	var $transactionInProgress = false;
	

	/**
	 * Kontruktor.
	 * Erwartet die Datenbank-Konfiguration als Parameter.
	 *
	 * @param Array Konfiguration der Verbindung
	 * @return Status 'true' wenn Verbindung erfolgreich aufgebaut.
	 */
	function DB( $conf )
	{
		$this->available = false;
		$this->conf      = $conf;
		
		$this->connect();
		
		return $this->available;
	}
	

	/**
	 * Verbindung zur Datenbank aufbauen.
	 *
	 * @return Status
	 */
	function connect()
	{
		// Ausfuehren des Systemkommandos vor Verbindungsaufbau
		if	( !empty($this->conf['cmd']))
		{
			$ausgabe = array();
			$rc      = false;

			Logger::debug("Database command executing: ".$this->conf['cmd']);
			exec( $this->conf['cmd'],$ausgabe,$rc );
			
			foreach( $ausgabe as $zeile )
				Logger::debug("Database command output: ".$zeile);
			
			if	( $rc != 0 )
			{
				$this->error     = 'Command failed: '.implode("",$ausgabe);
				$this->available = false; 
				return false;
			}
		}
		
		$type = $this->conf['type'];
		$classname = 'db_'.$type;
		
		if	( ! class_exists($classname) )
		{
			$this->error     = 'Database type "'.$type.'" is not available';
			$this->available = false;
			return false;
		}
		
		// Client instanziieren
		$this->client = & new $classname;

		$ok = $this->client->connect( $this->conf );
		
		if	( ! $ok )
		{
			$this->error     = 'Cannot connect to database: '.$this->client->error;
			$this->available = false;
			return false; 
		}

				
		// SQL nach Verbindungsaufbau ausfuehren.
		if	( isset($this->conf['connection_sql']) &&  ! empty($this->conf['connection_sql']) )
		{
			$cmd = $this->conf['connection_sql'];
			$ok = $this->client->query($cmd);
			
			if	( ! $ok )
			{
				$this->error     = $this->client->error;
				$this->available = false;
				return false; 
			}
		}
		
		$this->available = true;
		return true;
	}


	/**
	 * Ausfuehren einer Datenbankanfrage.
	 *
	 * @param SQL-Objekt
	 * @return Object (Result)
	 */
	function query( $query )
	{
		if ( !is_object($query) )
			die('SQL-Query must be an object');
			
		// Vorbereitete Datenbankabfrage ("Prepared Statement")
		if	( isset($this->conf['prepare']) && $this->conf['prepare'] )
		{
			$this->client->clear();
			
			// Statement an die Datenbank schicken
			$this->client->prepare( $query->raw,$query->param );
			
			// Einzelne Parameter an die Anfrage binden
			foreach ($query->param as $name=>$unused)
				$this->client->bind($name,$query->data[$name]);
			
			// Ausführen...
			$result = $this->client->query($query);
			
			if	( $result === FALSE )
			{
				$this->error = $this->client->error;
				
				if	( true )
				{
					Logger::warn('Database error: '.$this->error);
					die('Database Error (prepared):<pre style="color:red">'.$this->error.'</pre>');
				}
			}
					
			return $result;
		}
		else
		{
			
			$flatQuery = $query->getQuery();
			
			Logger::trace('DB query: '.$query->raw);
	
			$result = $this->client->query($flatQuery);
			
			if	( $result === FALSE )
			{
				$this->error = $this->client->error;
				
				if	( true )
				{
					debug_print_backtrace();
					Logger::warn('Database error: '.$this->error);
					die('Database Error (not prepared):<pre style="color:red">'.$this->error.'</pre>');
				}
			}
	
			if	( isset($this->conf['autocommit']) && @$this->conf['autocommit'])
				if	( method_exists($this->client,'commit') )
					$this->client->commit();
			
			return $result;
		}
	}


	/**
	 * Ermittelt genau 1 Datenbankergebnis aus einer SQL-Anfrage.
	 * Falls es mehrere Treffer gibt, wird die 1. Spalte aus der 1. Zeile genommen.
	 *
	 * @param String $query
	 * @return String
	 */
	function &getOne( $query )
	{
		$none = '';
		$result = $this->query($query);
		
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
	 * @param String $query
	 * @return Array
	 */
	function &getRow( $query )
	{
		$result = $this->query($query);
		
		if	( $result === FALSE )
		{
			$this->error = $this->client->error;
			
			if	( true )
			{
				debug_print_backtrace();
				Logger::warn('Database error: '.$this->error);
				die('Database Error (not prepared):<pre style="color:red">'.$this->error.'</pre>');
			}
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
	 * @param String $query
	 * @return Array
	 */
	function &getCol( $query )
	{
		$result = $this->query($query);

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
	 * @param String $query
	 * @param Boolean $force_array
	 * @return Array
	 */
	function &getAssoc( $query, $force_array = false )
	{
		$results = array();
		$result = $this->query($query);

		$i = 0;
		
		while( $row = $this->client->fetchRow( $result,$i++ ) )
		{
			if	( empty($row) )
				break;
				
			if	( count($row) > 2 || $force_array )
			{
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
	 * @param String $query
	 * @return Array
	 */
	function &getAll( $query )
	{
		$result = $this->query( $query );

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
	 * Startet eine Transaktion.
	 */
	function start()
	{
		if	( @$this->conf['transaction'])
			if	( method_exists($this->client,'start') )
			{
				$this->transactionInProgress = true;
				$this->client->start();
			}
	}
	
	
	/**
	 * Beendet eine Transaktion.
	 */
	function commit()
	{
		if	( @$this->conf['transaction'])
			if	( method_exists($this->client,'commit') )
				if	( $this->transactionInProgress )
				{
					$this->client->commit();
					$this->transactionInProgress = false;
				}
	}
	
	/**
	 * Beendet eine Transaktion.
	 */
	function rollback()
	{
		if	( @$this->conf['transaction'])
			if	( method_exists($this->client,'rollback') )
				if	( $this->transactionInProgress )
				{
					$this->client->rollback();
					$this->transactionInProgress = false;
				}
	}
	
}


?>