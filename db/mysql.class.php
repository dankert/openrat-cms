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
 * Datenbank-abhaengige Methoden fuer MySQL 
 * @author $Author: dankert $
 * @version $Revision: 1.5 $
 * @package openrat.database
 */
class DB_mysql
{
	/**
	 * Die MySql-Verbindung.
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
		$host   = $conf['host'];
		$user   = $conf['user'];
		$pw     = $conf['password'];
		$db     = $conf['database'];
		
		if	( isset($conf['port']) )
			$host .= ':'.$conf['port'];

		if   ( $conf['persistent'] )
			$connect_function = 'mysql_pconnect';
		else
			$connect_function = 'mysql_connect';

		if    ( $pw != '' )
			$this->connection = $connect_function( $host,$user,$pw );
		elseif ( $user != '' ) 
			$this->connection = $connect_function( $host,$user );
		elseif ( $host != '' ) 
			$this->connection = $connect_function( $host );
		else 
			$this->connection = $connect_function();

		if	( !is_resource($this->connection) )
		{
			$this->error = "Could not connect to database on host $host.";
			return false;
		}
				
		if    ( $db != '' )
		{
			if	( !@mysql_select_db( $db,$this->connection ) )
			{
				$this->error = "Could not select database '$db' on host $host.";
				return false;
			}
		}

		return true;
    }



	function disconnect()
	{
		$ret = mysql_close( $this->connection );
		$this->connection = null;
		return $ret;
	}



	function query($query)
	{
		$result = mysql_query($query, $this->connection);

		if	( ! $result )
		{
			$this->error = 'Database error: '.mysql_error();
			return FALSE;
		}

		return $result;
	}


	function fetchRow( $result, $rownum )
	{
		return mysql_fetch_array( $result,MYSQL_ASSOC );
	}

 
	function freeResult($result)
	{
		if	( is_resource($result) )
			return mysql_free_result($result);
		return true;
	}


	function numCols($result)
	{
		return mysql_num_fields( $result );
	}



	function numRows( $result )
	{
		return mysql_num_rows($result);
	}
	
	
	/**
     * Startet eine Transaktion.
     */
	function start()
	{
		mysql_query('BEGIN', $this->connection);
	}


	/**
     * Beendet eine Transaktion.
     */
	function commit()
	{
		mysql_query('COMMIT', $this->connection);
	}


	/**
     * Bricht eine Transaktion ab.
     */
	function rollback()
	{
		mysql_query('ROLLBACK', $this->connection);
	}
	
}

?>