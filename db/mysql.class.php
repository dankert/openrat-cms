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
 * @author $Author$
 * @version $Revision$
 * @package openrat.database
 */
class DB_mysql
{
	var $connection;
	var $autocommit = true;
	var $fetchmode  = DB_FETCHMODE_ORDERED; /* Default fetch mode */
	var $isError    = false;

	function connect( $conf )
	{
		$host   = $conf['host'];
		$user   = $conf['user'];
		$pw     = $conf['password'];
		$db     = $conf['database'];

		if   ( $conf['persistent'] )
			$connect_function = 'mysql_pconnect';
		else $connect_function = 'mysql_connect';

		if    ( $pw != '' )
			$this->connection = $connect_function( $host,$user,$pw );
		elseif ( $user != '' ) 
			$this->connection = $connect_function( $host,$user );
		elseif ( $host != '' ) 
			$this->connection = $connect_function( $host );
		else 
			$this->connection = $connect_function();

		if    ( $db != '' )
		{
			if	( !mysql_select_db( $db,$this->connection ) )
				die( "cannot select database '$db'. Check rights." );
		}

		return true;
    }



//	function nextId( $sequenceName )
//	{
//		$res = mysql_query("SELECT id FROM `$sequenceName`",$this->connection );
//		if	( mysql_errno($this->connection) != 0 )
//			die( mysql_error($this->connection) );
//		
//		$nextId = intval( mysql_result($res,0,0) ) + 1;
//
//		mysql_query("UPDATE `$sequenceName` SET id=".$nextId,$this->connection );
//		if	( mysql_errno($this->connection) != 0 )
//			die( mysql_error($this->connection) );
//
//		return $nextId;
//	}
//
//
//
	function disconnect()
	{
		$ret = mysql_close( $this->connection );
		$this->connection = null;
		return $ret;
	}



	function simpleQuery($query)
	{
		$result = mysql_query($query, $this->connection);

		if   ( ! $result )
		{
			die( '<pre>'.$query."\n".'<span style="color:red;">'.mysql_error().'</span></pre>' );
		}

		return $result;;
	}


	function affectedRows()
	{
		return mysql_affected_rows();
	}


	function fetchRow( $result, $fetchmode, $rownum )
	{
		if   ( $rownum !== null )
		{
			if   ( ! @mysql_data_seek($result, $rownum) )
			{
				return null;
			}
		}

		if   ( $fetchmode == DB_FETCHMODE_ORDERED )
		{
			$arr = @mysql_fetch_row( $result );
		}
		else
		{
			$arr = @mysql_fetch_array( $result,MYSQL_ASSOC );
		}

		if   ( ! $arr )
		{
			$this->isError = true;
		}
		
		return $arr;
	}

 
	function freeResult($result)
	{
		if (is_resource($result))
		{
			return mysql_free_result($result);
		}
		return true;
	}


	function numCols($result)
	{
		$cols = mysql_num_fields( $result );

		if   ( ! $cols )
		{
			return $this->mysqlRaiseError();
		}

		return $cols;
	}



	function numRows( $result )
	{
		//echo "yo";
		//print_r($result);
		$rows = mysql_num_rows($result);

		if   ($rows === null )
		{
			$this->isError = true;
		}
		return $rows;
	}
}

?>