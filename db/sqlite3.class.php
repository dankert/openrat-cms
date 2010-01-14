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

/**
 * Datenbank-abhaengige Methoden fuer SQLITE3
 * @author $Author: dankert $
 * @version $Revision: 1.5 $
 * @package openrat.database
 */
class DB_sqlite3
{
	/**
	 * Das SQLITE3-Verbindungsobjekt.
	 *
	 * @var Resource
	 */
	var $connection;
	
	/**
	 * Datenbank-Fehler.
	 *
	 * @var String
	 */
	var $error;


	function connect( $conf )
	{
		$filename = $conf['filename'];
		
		$this->connection = new SQLite3( $filename );

		if	( !is_object($this->connection) )
		{
			$this->error = "Could not connect to SQLITE3-database: ".SQLite3::lastErrorMsg();
			return false;
		}
				
		return true;
    }



	function disconnect()
	{
		$this->connection->close();
		$this->connection = null;
		return true;
	}



	function query($query)
	{
		$this->result = $this->connection->query($query);

		if	( !$result )
		{
			$this->error = 'Database error: '.SQLite3::lastErrorMsg();
			return FALSE;
		}

		return $this->result;
	}


	function fetchRow( $result, $rownum )
	{
		return $this->result->fetchArray( SQLITE3_ASSOC );
	}

 
	function freeResult($result)
	{
		return true;
	}


	
	/**
     * Startet eine Transaktion.
     */
	function start()
	{
		$this->connection->query( 'BEGIN TRANSACTION;');
	}


	/**
     * Beendet eine Transaktion.
     */
	function commit()
	{
		$this->connection->query( 'COMMIT;');
	}


	/**
     * Bricht eine Transaktion ab.
     */
	function rollback()
	{
		$this->connection->query( 'ROLLBACK;');
	}
	
	
	function prepare( $query,$param)
	{
		foreach( $param as $pos)
		{
			foreach( $pos as $pos )
			{
				$query = substr($query,0,$pos-1).'?'.substr($query,$pos+1);
			}
		}

		$this->stmt = sqlite3_prepare($this->connection,$query);
		
	}
	
	function bind( $param,$value )
	{
		$this->params[$param] = $value;
	}
	
}

?>