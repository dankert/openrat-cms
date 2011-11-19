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
 * F�r die echten DB-Aufrufe werden die entsprechenden
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
	public function DB( $conf )
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
	public function query( $query )
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
				$this->client->bind($name,$this->convertCharsetToDatabase($query->data[$name]));
			
			// Ausf�hren...
			$result = $this->client->query($query);
			
			if	( $result === FALSE )
			{
				$this->error = $this->client->error;
				
				Logger::warn('Database error: '.$this->error);
				Http::serverError('Database Error',$this->error);
			}
					
			return $result;
		}
		else
		{
			// Es handelt sich um eine nicht-vorbereitete Anfrage. Das gesamte
			// SQL wird durch die SQL-Klasse erzeugt, dort werden auch die Parameter
			// in die Abfrage gesetzt.
			
			$escape_function = method_exists($this->client,'escape')?$this->client->escape():'addslashes';
			$flatQuery = $query->getQuery( $escape_function );

			$flatQuery = $this->convertCharsetToDatabase($flatQuery);
			
			Logger::trace('DB query on DB '.$this->id."\n".$query->raw);
	
			$result = $this->client->query($flatQuery);
			
			if	( $result === FALSE )
			{
				$this->error = $this->client->error;
				
				if	( true )
				{
					Logger::warn('Database error: '.$this->error);
					Http::serverError('Database Error',$this->error);
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
	public function &getOne( $query )
	{
		$none = '';
		$result = $this->query($query);
		
		$row = $this->client->fetchRow( $result,0 );
		$this->client->freeResult($result);

		if	( ! is_array($row) )
			return $none;
			
		array_walk($row,array($this,'convertCharsetFromDatabase'));
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

			//Html::debug($row,"vorher");
		$row = $this->convertRowWithCharsetFromDatabase($row);
			//Html::debug($row,"nachher");
			
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
				
			array_walk($row,array($this,'convertCharsetFromDatabase'));
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

			array_walk($row,array($this,'convertCharsetFromDatabase'));
				
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
			array_walk($row,array($this,'convertCharsetFromDatabase'));
			$results[] = $row;
		}

		$this->client->freeResult( $result );
		
		return $results;
	}
	
	
	/**
	 * Startet eine Transaktion.
	 */
	public function start()
	{
		if	( @$this->conf['transaction'])
			if	( method_exists($this->client,'start') )
			{
				$this->transactionInProgress = true;
				$this->client->start();
			}
	}
	
	
	/**
	 * Beendet und best�tigt eine Transaktion.
	 */
	public function commit()
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
	 * Setzt eine Transaktion zur�ck.
	 */
	public function rollback()
	{
		if	( @$this->conf['transaction'])
			if	( method_exists($this->client,'rollback') )
				if	( $this->transactionInProgress )
				{
					$this->client->rollback();
					$this->transactionInProgress = false;
				}
	}
	
	
	private function convertCharsetToDatabase($text)
	{
		//Logger::debug('from '.$text);
		$dbCharset = @$this->conf['charset'];
		if	( !empty($dbCharset) && $dbCharset != 'UTF-8' )
		{
		//	Logger::debug('Converting from UTF-8 to '.$dbCharset);
			if	( !function_exists('iconv') )
				Logger::warn('iconv not available - database charset unchanged. Please '.
				             'enable iconv on your system or transform your database content to UTF-8.');
			else
				$text = iconv('UTF-8',$dbCharset.'//TRANSLIT',$text);
		}
		//Logger::debug('to   '.$text);
		return $text;
		
	}
	
	
	private function convertCharsetFromDatabase($text)
	{
		//Logger::debug('from '.$text);
		$dbCharset = @$this->conf['charset'];
		if	( !empty($dbCharset) && $dbCharset != 'UTF-8' )
		{
			//Logger::debug('Converting to UTF-8 from '.$dbCharset);
			if	( !function_exists('iconv') )
				Logger::warn('iconv not available - database charset unchanged. Please '.
				             'enable iconv on your system or transform your database content to UTF-8.');
			else
				$text = iconv($dbCharset,'UTF-8//TRANSLIT',$text);
		}
		//Logger::debug('to   '.$text);
		return $text;
		
	}
	
	
	private function convertRowWithCharsetFromDatabase($row)
	{
		foreach( $row as $key=>$value)
		{
			$row[$key] = $this->convertCharsetFromDatabase($row[$key]);
		}
		return $row;
	}
	
}


?>