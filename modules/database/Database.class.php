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
use cms\base\Configuration as C;
use database\driver\PDODriver;
use logger\Logger;
use util\exception\DatabaseException;

/**
 * Darstellung einer Datenbank-Verbindung.
 * 
 * Fuer die echten DB-Aufrufe werden die entsprechenden
 * Methoden des passenden Clients aufgerufen.
 * 
 * Diese Klasse stammt urspruenglich aus dem PHP-Pear-DB-Projekt, wurde hier aber intensiv veraendert.
 * 
 * @author Jan Dankert
 * @package openrat.database
 */
class Database
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
	 * @var array
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
	 * @var PDODriver
	 */
	var $client;
	
	/**
	 * Schalter, ob eine Transaktion begonnen wurde.
	 * @var boolean
	 */
	var $transactionInProgress = false;


	/**
	 * Default configuration.
	 * @var array
	 */
	private static $DEFAULT_CONFIG = [
		'prefix'         => 'cms_',
		'suffix'         => '',
		'enabled'        => true,
		'name'           => '',
		'description'    => '',
		'type'           => 'pdo',
		'driver'         => 'mysql',
		'dsn'            => '',
		'user'           => '',
		'password'       => '',
		'host'           => 'localhost',
		'port'           => 0,
		'database'       => '',
		'base64'         => false,
		'persistent'     => true,
		'charset'        => 'UTF-8',
		'connection_sql' => '',
		'cmd'            => '',
		'prepare'        => true,
		'transaction'    => true,
		'update'         =>
			[
			],
		'auto_update'    => true,
	];


	/**
	 * Kontruktor.
	 * Erwartet die Datenbank-Konfiguration als Parameter.
	 *
	 * @param array Konfiguration der Verbindung
	 */
	public function __construct( $dbconf )
	{
		$this->conf = array_merge(
			Database::$DEFAULT_CONFIG, // internal defaults
			C::subset('database-default')->subset('defaults')->getConfig(), // defaults from config
			$dbconf  // per-connection DB configuration
		);

		$this->connect();
	}
	

	/**
	 * Verbindung zur Datenbank aufbauen.
	 *
	 * @return bool Status
	 */
	public function connect()
	{
        // Ausfuehren des Systemkommandos vor Verbindungsaufbau
        if ( $this->conf['cmd'] )
            $this->executeSystemCommand( $this->conf['cmd'] );

		// Client instanziieren
		$this->client = new PDODriver();

		// Verbindung aufbauen
		$this->client->connect( $this->conf );
		
		// SQL nach Verbindungsaufbau ausfuehren.
		if	( ! empty($this->conf['connection_sql']) )
		{
			$cmd = $this->conf['connection_sql'];
			
			$stmt = $this->sql($cmd);
			
			$ok = $stmt->execute();
			
			if	( ! $ok )
			{
				throw new DatabaseException( "Could not execute connection-query '".$cmd."'");
			}
		}

		// Setting isolation level to "read committed".
        // if another session is committing data, we want to read that immediatly
        if  ( $this->conf['persistent'])
        {
//            $sql = $this->sql('ROLLBACK');
//            $sql->execute();
//            $sql = $this->sql('SET TRANSACTION ISOLATION LEVEL READ COMMITTED');
//            $sql->execute();
        }


        Logger::debug('Database connection established');
		
		$this->available = true;
	}

	/**
	 * Startet eine Transaktion.
	 */
	public function start()
	{
	    Logger::debug("Starting database transaction!");
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
            Logger::debug("Committing database transaction!");
            $this->client->commit();
			$this->transactionInProgress = false;
		} else {
            Logger::warn("No Transaction in progress, ignoring commit request.");
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
            Logger::debug("Rolling back database transaction!");
            $this->client->rollback();
			$this->transactionInProgress = false;
        } else {
            Logger::warn("No Transaction in progress, ignoring rollback request.");
        }
	}


	public function disconnect()
    {
        $this->client->disconnect();
    }
    /**
     * @param $sql string das SQL
     * @return Statement
     */
    public function sql($sql )
	{
		return new Statement( $sql,$this->client,$this->conf);
	}


    private function executeSystemCommand( $cmd )
    {
        $ausgabe = array();
        $rc      = false;

        Logger::debug("Database command executing: " . $cmd );
        exec($cmd, $ausgabe, $rc);

        foreach ($ausgabe as $zeile)
            Logger::debug("Database command output: " . $zeile);

        if ($rc != 0) {
            throw new DatabaseException('Command failed: ' . implode("", $ausgabe));
        }
    }

}