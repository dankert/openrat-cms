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
	 * Enth�lt ein Objekt der Klasse db_<type>.
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
	public function DB( $conf,$admin=false )
	{
		$defaultConf = array( 'prefix'          => '',
		                      'suffix'          => '',
		                      'enabled'         => true,
		                      'comment'         => '',
		                      'type'            => 'mysqli',
		                      'user'            => '',
		                      'password'        => '',
		                      'host'            => '',
		                      'database'        => '',
		                      'base64'          => false,
		                      'persistent'      => true,
		                      'charset'         => 'UTF-8',
		                      'connection_sql'  => '',
		                      'cmd'             => '',
		                      'prepare'         => true,
		                      'transaction'     => true,
				              'update'          => array(),
				              'auto_update'     => true
		                    ); 
		
		$this->available = false;
		$this->conf      = $conf + $defaultConf;
		
		if	( $admin )
		{
			// Bevorzugung der Unter-Konfiguration 'update'
			if	( isset($this->conf['update']) )
				$this->conf = $this->conf['update'] + $this->conf; // linksstehender Operator hat Priorität!
		}
		$this->connect();
		
		return $this->available;
	}
	

	/**
	 * Verbindung zur Datenbank aufbauen.
	 *
	 * @return Status
	 */
	public function connect()
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
				throw new OpenRatException( 'ERROR_DATABASE_CONNECTION','Command failed: '.implode("",$ausgabe) );
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
		$this->client = new $classname;
		

		$this->client->connect( $this->conf );
		
		// SQL nach Verbindungsaufbau ausfuehren.
		if	( ! empty($this->conf['connection_sql']) )
		{
			$cmd = $this->conf['connection_sql'];
			$ok = $this->client->query($cmd);
			
			if	( ! $ok )
			{
				throw new OpenRatException( 'ERROR_DATABASE_CONNECTION',"Could not execute connection-query '".$cmd."'");
			}
		}
		
		Logger::debug('database connection established');
		
		$this->available = true;
		return true;
	}


	/**
	 * Ausfuehren einer Datenbankanfrage.
	 *
	 * @param SQL-Objekt
	 * @return Object (Result)
	 */
	public function query( &$query )
	{
		if ( !is_object($query) )
			throw new RuntimeException('SQL-Query must be an object');
			
		// Vorbereitete Datenbankabfrage ("Prepared Statement")
		$this->client->clear();
		
		// Statement an die Datenbank schicken
		$this->client->prepare( $query->raw,$query->param );
		
		// Einzelne Parameter an die Anfrage binden
		foreach ($query->param as $name=>$unused)
			$this->client->bind($name,$query->data[$name]);
		
		// Ausfuehren...
		$result = $this->client->query($query);
		
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
	 * @param String $query
	 * @return String
	 */
	public function &getOne( $query )
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
	public function &getRow( $query )
	{
		$result = $this->query($query);
		
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
	 * @param String $query
	 * @return Array
	 */
	public function &getCol( $query )
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
	public function &getAssoc( $query, $force_array = false )
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
	 * @param String $query
	 * @return Array
	 */
	public function &getAll( $query )
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
	 * Falls der Schalter 'transaction' nicht gesetzt ist, passiert nichts.
	 */
	public function start()
	{
		$this->transactionInProgress = true;
		$this->client->start();
	}
	
	
	/**
	 * Beendet und bestaetigt eine Transaktion.
	 * Falls der Schalter 'transaction' nicht gesetzt ist, passiert nichts.
	 */
	public function commit()
	{
		if	( $this->transactionInProgress )
		{
			$this->client->commit();
			$this->transactionInProgress = false;
		}
	}
	
	
	/**
	 * Führt eine Query aus und gibt nur zurück, ob diese funktioniert.
	 * 
	 * @param unknown_type $query
	 * @return boolean
	 */
	public function testQuery( $query )
	{
				
		try
		{
			$result = $this->query($query);
			return $result; 
		}
		catch( Exception $e )
		{
			return false;
		}
		
	}
	
	
	/**
	 * Setzt eine Transaktion zurueck. 
	 * Falls der Schalter 'transaction' nicht gesetzt ist, passiert nichts.
	 */
	public function rollback()
	{
		if	( $this->transactionInProgress )
		{
			$this->client->rollback();
			$this->transactionInProgress = false;
		}
	}
	
	public function sql( $sql )
	{
		return new Statement( $sql,$this->client );
	}
	
}


?>