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
 * @author $Author: dankert $
 * @version $Revision: 1.5 $
 * @package openrat.database
 */
class DB_postgresql
{
	var $connection;

	/**
	 * SQL-Statement (nur fuer prepared-Statements).
	 * @var Resource
	 */
	var $prepared;
	
	var $params = array();
	
	
	/**
	 * Verbinden zum POSTGRES-Server.
	 *
	 * @param Array $conf
	 * @return boolean
	 */
	function connect( $conf )
	{
		$host   = $conf['host'];
		$user   = $conf['user'];
		$pw     = $conf['password'];
		$db     = $conf['database'];

		if	( isset($conf['port']) )
			$host .= ':'.$conf['port'];
		
		if   ( $conf['persistent'] )
			$connect_function = 'pg_pconnect';
		else
			$connect_function = 'pg_connect';

		if    ( $pw != '' )
			$this->connection = @$connect_function( "host=$host dbname=$db user=$user password=$pw" );
		elseif ( $user != '' ) 
			$this->connection = @$connect_function( "host=$host dbname=$db user=$user" );
		elseif ( $host != '' ) 
			$this->connection = @$connect_function( "host=$host dbname=$db" );
		else 
			$this->connection = @$connect_function( "dbname=$db");
			
		if	( ! is_resource($this->connection) )
		{
			$this->error = 'could not connect to database on host '.$host;
			return false;
		}

		return true;
    }



    /**
     * Verbindung schlie�en.
     *
     * @return unknown
     */
	function disconnect()
	{
		$ret = pg_query( $this->connection );
		$this->connection = null;
		return $ret;
	}



    /**
     * Startet eine Transaktion.
     */
	function start()
	{
		@pg_exec( $this->connection,"BEGIN WORK" );
	}


	/**
     * Beendet eine Transaktion.
     */
	function commit()
	{
		@pg_exec( $this->connection,"COMMIT" );
	}


	/**
     * Bricht eine Transaktion ab.
     */
	function rollback()
	{
		@pg_exec( $this->connection,"ROLLBACK" );
	}


	
	function query($query)
	{
		if	( $this->prepared )
		{
			$ar = array();
			foreach($this->params as $name => $data)
			{
				switch( $data['type'] )
				{
					case 'string':
	        			$ar[] = (String)$data['value'];
	        			break;
					case 'int':
	        			$ar[] = (int) $data['value'];
	        			break;
					case 'null':
	        			$ar[] = null;
	        			break;
	        		default:
						die('unknown type "'.$data['type'].'"');
				}
			}
			//Html::debug($this->params,'Parameter');
			
			$result = @pg_execute( $this->connection,$this->stmtid,$ar );
			
			if	( $result === false )
			{
				if	( empty($this->error) )
					$this->error = 'PostgreSQL (prepared) says: '.@pg_errormessage();
				debug_print_backtrace();
				return FALSE;
			}
	
			return $result;
		}
		
		
		
		$result = @pg_exec( $this->connection,$query );

		if	( ! $result )
		{
			if	( empty($this->error) )
				$this->error = 'PostgreSQL (not prepared) says: '.@pg_errormessage();
			return FALSE;
		}

		return $result;
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
	
	
	function prepare( $query,$param )
	{
		$nr = 1;
		foreach($param as $name=>$unused_a )
		{
			foreach( $param[$name] as $idx=>$xyz )
			{
				$pos = $param[$name][$idx];
				
				$query = substr( $query,0,$pos ).'$'.$nr.substr( $query,$pos );
			
				foreach( $param as $pn=>$par)
				{
					foreach( $par as $i=>$p )
					{
						if	( $p > $pos )
							$param[$pn][$i]=$p+strlen((string)$nr)+1;
					}
				}
			}
			$nr++;
		}
		//Html::debug($query);
		$this->stmtid = md5($query);
		$this->prepared = true;

		// Feststellen, ob Statement bereits vorhanden ist
		$result = pg_query_params($this->connection, 'SELECT name FROM pg_prepared_statements WHERE name = $1', array($this->stmtid));
		if	(pg_num_rows($result) > 0)
			return;
		
		pg_prepare($this->connection,$this->stmtid,$query);
	}
	
	
	function bind( $param,$value )
	{
		$this->params[$param] = $value;
	}
	
	
	function clear()
	{
		$this->prepared = false;
		$this->params   = array();
	}
	
}

?>