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
 * Datenbank-abhaengige Methoden fuer SQ-Lite-Datenbanken 
 * @author $Author: dankert $
 * @version $Revision: 1.5 $
 * @package openrat.database
 */
class DB_sqlite
{
	/**
	 * Die SQ-Lite-Verbindung.
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

		if   ( $conf['persistent'] )
			$connect_function = 'sqlite_popen';
		else
			$connect_function = 'sqlite_open';
		
		$this->connection = @$connect_function($filename,0666,$error);

		if	( !is_resource($this->connection) )
		{
			$this->error = 'Could not connect to sqlite-database: '.$error;
			return false;
		}
				
		return true;
    }



	function disconnect()
	{
		$ret = sqlite_close( $this->connection );
		$this->connection = null;
		return $ret;
	}



	function query($query)
	{
		$result = sqlite_query($this->connection,$query );

		if	( ! $result )
		{
			$this->error = 'Database error: '.sqlite_error_string(sqlite_last_error($this->connection));
			return FALSE;
		}

		return $result;
	}
	
	/**
     * Startet eine Transaktion.
     */
	function start()
	{
		sqlite_query( $this->connection,'BEGIN TRANSACTION;');
	}


	/**
     * Beendet eine Transaktion.
     */
	function commit()
	{
		sqlite_query( $this->connection,'COMMIT;');
	}


	/**
     * Bricht eine Transaktion ab.
     */
	function rollback()
	{
		sqlite_query( $this->connection,'ROLLBACK;');
	}
	


	function fetchRow( $result, $rownum )
	{
		return sqlite_fetch_array( $result,SQLITE_ASSOC );
	}

 
	function freeResult($result)
	{
		return true;
	}
	
	
	function escape()
	{
		return 'sqlite_escape_string';
	}
}


?>