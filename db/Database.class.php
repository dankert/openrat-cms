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
		return new Statement( $sql,$this->client,$this->id);
	}
	
}


?>