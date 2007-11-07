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
 * Datenbank-abhaengige Methoden fuer PostgreSQL 
 * @author $Author$
 * @version $Revision$
 * @package openrat.database
 */
class DB_postgresql
{
	var $connection;


	function connect( $conf )
	{
		$host   = $conf['host'];
		$user   = $conf['user'];
		$pw     = $conf['password'];
		$db     = $conf['database'];

		if   ( $conf['persistent'] )
			$connect_function = 'pg_pconnect';
		else $connect_function = 'pg_connect';

		if    ( $pw != '' )
			$this->connection = $connect_function( "host=$host dbname=$db user=$user password=$pw" );
		elseif ( $user != '' ) 
			$this->connection = $connect_function( "host=$host dbname=$db user=$user" );
		elseif ( $host != '' ) 
			$this->connection = $connect_function( "host=$host dbname=$db" );
		else 
			$this->connection = $connect_function( "dbname=$db");

		return true;
    }



	function disconnect()
	{
		$ret = pg_close( $this->connection );
		$this->connection = null;
		return $ret;
	}



	function simpleQuery($query)
	{
		$result = @pg_exec( $this->connection,$query );

		if	( ! $result )
			Http::serverError('Database Error'.'<pre>'.$query."\n".'<span style="color:red;">'.pg_errormessage().'</span></pre>' );

		return $result;;
	}


	function fetchRow( $result, $rownum )
	{
		return pg_fetch_array( $result,$rownum,PGSQL_ASSOC );
	}

 
	function freeResult($result)
	{
		return pg_freeresult($result);
	}


	function numCols($result )
	{
		return pg_numfields( $result );
	}



	function numRows( $result )
	{
		return pg_numrows($result);
	}
}

?>