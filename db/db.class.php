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
	 * Kennzeichen, ob die Datenbank verf�gbar ist.
	 *
	 * @var Boolean
	 */
	var $available;
	
	/**
	 * Enth�lt eine Fehlermeldung (sofern verf�gbar).
	 *
	 * @var String
	 */
	var $error;

	/**
	 * Client.
	 *
	 * @var Object
	 */
	var $client;
	

	/**
	 * Kontruktor.
	 * Erwartet die Datenbank-Konfiguration als Parameter.
	 *
	 * @param Array $conf
	 * @return Status
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
		// Ausf�hren des Systemkommandos.
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
		
		$this->client = & new $classname;

		$ok = $this->client->connect( $this->conf );
		
		if	( ! $ok )
		{
			$this->error     = $this->client->error;
			$this->available = false;
			return false; 
//			if	( empty($this->error) )
//				$this->error = 'Error while connecting to database.';
		}

				
		// SQL bei Verbindungsaufbau ausführen.
		$cmd = $this->conf['connection_sql'];
		if	( ! empty($cmd) )
		{
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
	 * Ausf�hren einer Datenbankanfrage.
	 *
	 * @param String $query
	 * @return Object (Result)
	 */
	function query( $query )
	{
		if	( is_object($query) && $this->conf['prepare'] )
		{
			$this->client->clear();
			//Html::debug($query);
			$this->client->prepare( $query->raw,$query->param );
			
			foreach( $query->data as $name=>$value)
			{
				$this->client->bind($name,$value);
			}
			
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
					
			return new DB_result( $this->client,$result );
		}
		if ( is_object($query) )
			$query = $query->query;
		
		Logger::trace('DB query: '.substr($query,0,45).'...');

		$result = $this->client->query($query);
		
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
			
		return new DB_result( $this->client,$result );
	}


	/**
	 * Ermittelt die Anzahl der betroffenen Zeilen nach einer Datebank-Anfrage.
	 *
	 * @return unknown
	 */
	function affectedRows()
	{
		return $this->client->affectedRows( $query );
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
		$res = $this->query($query);

		if	( $res->numRows() > 0 )
		{
			$row = $res->fetchRow( 0 );
			$res->free();
	
			$keys = array_keys($row);
	
			return $row[ $keys[0] ];
		}
		else
		{
			$res->free();
			$leer = '';
			return $leer;
		}
	}


	/**
	 * Ermittelt eine Zeile aus der Datenbank.
	 *
	 * @param String $query
	 * @return Array
	 */
	function &getRow( $query )
	{
		$res = $this->query($query);

		if	( $res->numRows() > 0 )
			$row = $res->fetchRow( 0 );
		else
			$row = array();

		$res->free();

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
		$res = $this->query( $query );
		
		$ret = array();

		$numRows = $res->numRows();
		
		for( $i=0; $i<$numRows; $i++ )
		{
			$row = $res->fetchRow($i);
			
			$keys = array_keys($row);
			$ret[] = $row[ $keys[0] ];
		}

		$res->free();

		return $ret;
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
		$res = $this->query($query);

		$numCols = $res->numCols();
		$numRows = $res->numRows();

		$results = array();

		if ( $numCols > 2 || $force_array )
		{
			for( $i=0; $i<$numRows; $i++ )
			{
				$row = $res->fetchRow($i);

				$keys = array_keys($row);
				$key1 = $keys[0];

				unset( $row[$key1] );
				$results[ $row[$key1] ] = $row;
			}
		}
		else
		{
			for( $i=0; $i<$numRows; $i++ )
			{
				$row = $res->fetchRow($i);

				$keys = array_keys($row);
				$key1 = $keys[0];
				$key2 = $keys[1];

				$results[ $row[$key1] ] = $row[$key2];
			}
		}

		$res->free();

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
		$res = $this->query( $query );

		$results = array();
		$numRows = $res->numRows();

		for( $i=0; $i<$numRows; $i++ )
		{
			$row = $res->fetchRow($i);
			$results[] = $row;
		}

		$res->free();

		return $results;
	}
}




/**
 * Darstellung eines Datenbank-Ergebnisses.
 * 
 * @author Jan Dankert
 * @version $Revision: 1.9 $
 * @package openrat.database
 */

class DB_result
{
	var $client;
	var $result;


	function DB_result( $client, $result )
	{
		$this->client    = $client;
		$this->result = $result;
	}


	function fetchRow( $rownum = 0 )
	{
		$arr = $this->client->fetchRow( $this->result, $rownum );

		return $arr;
	}


	function numCols()
	{
		return $this->client->numCols($this->result);
	}


	function numRows()
	{
		return $this->client->numRows( $this->result );
	}


	function free()
	{
		$err = $this->client->freeResult($this->result);
		return true;
	}
}


?>