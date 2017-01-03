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
	 * @return boolean 'true', wenn Verbindung aufgebaut wurde
	 */
	function connect( $conf )
	{
		$host   = $conf['host'];
		$user   = $conf['user'];
		$pw     = $conf['password'];
		$db     = $conf['database'];

		if	( !empty($conf['port']) )
			$host .= ':'.$conf['port'];
		
		if   ( $conf['persistent'] )
			$connect_function = 'pg_pconnect';
		else
			$connect_function = 'pg_connect';

		if	( ! function_exists($connect_function))
		{
			$this->error = 'Function does not exist: '.$connect_function.' Postgresql is not available';
			return false;
		}
		
		Logger::debug('postgresql: connecting to: '."host=$host, dbname=$db");
		
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
			$this->error = 'Could not connect to postgresql-server '.$host.': '.@pg_errormessage();
			return false;
		}

		return true;
    }



    /**
     * Verbindung schliessen.
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
			// Prepared Statement
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
						throw new RuntimeException('unknown type "'.$data['type'].'"');
				}
			}
			
			$result = @pg_execute( $this->connection,$this->stmtid,$ar );
			
			if	( $result === false )
			{
				if	( empty($this->error) )
					$this->error = 'PostgreSQL is unable to execute the prepared statement: '.@pg_errormessage();
				return FALSE;
			}
	
			return $result;
		}
		else
		{
			// Flat Query:
			$result = @pg_exec( $this->connection,$query );
	
			if	( ! $result )
			{
				if	( empty($this->error) )
					$this->error = 'PostgreSQL is unable to execute the flat query: '.@pg_errormessage();
				return FALSE;
			}
	
			return $result;
		}
	}


	function fetchRow( $result, $rownum )
	{
		if	( $rownum >= pg_num_rows($result) )
			return false;
			 
		return pg_fetch_array( $result,$rownum,PGSQL_ASSOC );
	}

 
	function freeResult($result)
	{
		return pg_freeresult($result);
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
		$this->stmtid = md5($query);
		$this->prepared = true;

		// Feststellen, ob Statement bereits vorhanden ist
		$result = pg_query_params($this->connection, 'SELECT name FROM pg_prepared_statements WHERE name = $1', array($this->stmtid));
		if	(pg_num_rows($result) > 0)
			return;
		
		$erg = @pg_prepare($this->connection,$this->stmtid,$query);
		
		if	( $erg === FALSE )
		{
			throw new OpenRatException('ERROR_DATABASE','PostgreSQL is unable to prepare the statement: "'.$query.'" Reason: '.@pg_errormessage() );
		}
		else
		{
			return $erg;
		}
	}
	
	
	function bind( $param,$value )
	{
		$this->params[$param] = &$value;
	}
	
	
	function clear()
	{
		$this->prepared = false;
		$this->params   = array();
	}
	
	function escape()
	{
		return 'pg_escape_string';
	}
	
}

?>