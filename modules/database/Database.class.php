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
use Logger;
use RuntimeException;

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
	 * Kontruktor.
	 * Erwartet die Datenbank-Konfiguration als Parameter.
	 *
	 * @param array Konfiguration der Verbindung
	 * @param boolean admin Wenn es eine Admin-DB-Verbindung werden soll, die auch DDL ausfuehren darf
	 */
	public function __construct( $dbconf,$admin=false )
	{
		global $conf;
		
		$this->conf = $dbconf + $conf['database-default']['defaults']; // linksstehender Operator hat Priorität!
		
		if	( $admin )
		{
			// Bevorzugung der Unter-Konfiguration 'update'
			if	( isset($this->conf['update']) )
				$this->conf = $this->conf['update'] + $this->conf; // linksstehender Operator hat Priorität!
		}
		
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
        if (!empty($this->conf['cmd']))
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
				throw new RuntimeException( "Could not execute connection-query '".$cmd."'");
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
	 * Falls der Schalter 'transaction' nicht gesetzt ist, passiert nichts.
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
        $rc = false;

        Logger::debug("Database command executing: " . $this->conf['cmd']);
        exec($cmd, $ausgabe, $rc);

        foreach ($ausgabe as $zeile)
            Logger::debug("Database command output: " . $zeile);

        if ($rc != 0) {
            throw new RuntimeException('Command failed: ' . implode("", $ausgabe));
        }
    }

}


?>