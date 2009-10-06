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
class DB_mysqli
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
	
	/**
	 * SQL-Statement (nur fuer prepared-Statements).
	 * @var Resource
	 */
	var $stmt;
	
	var $params = array();


	function connect( $conf )
	{
		$host   = $conf['host'];
		$user   = $conf['user'];
		$pw     = $conf['password'];
		$db     = $conf['database'];
		$host = '127.0.0.1';
		
		if	( isset($conf['port']) )
			$host .= ':'.$conf['port'];

		// 5.3.0 - Added the ability of persistent connections. 
		if   ( $conf['persistent'] && version_compare(PHP_VERSION, '5.3.0', '>') )
			$host = 'p:'.$host; // Prepending host by p: opens a persistent connection.
		
		$connect_function = 'mysqli_connect';

		if    ( $pw != '' )
			$this->connection = $connect_function( $host,$user,$pw );
		elseif ( $user != '' ) 
			$this->connection = $connect_function( $host,$user );
		elseif ( $host != '' ) 
			$this->connection = $connect_function( $host );
		else 
			$this->connection = $connect_function();

		#print_r($this->connection);
		
		if	( false && !is_object($this->connection) )
		{
			$this->error = "Could not connect to mysqli-database on host $host.";
			return false;
		}
				
		if    ( $db != '' )
		{
			if	( !mysqli_select_db( $this->connection,$db ) )
			{
				$this->error = "Could not select database '$db' on host $host.";
				return false;
			}
		}

		return true;
    }



	function disconnect()
	{
		$ret = mysqli_close( $this->connection );
		$this->connection = null;
		return $ret;
	}



	function query($query)
	{
		if	( is_object($this->stmt) )
		{
			foreach($this->params as $name => $data)
			{
				switch( $data['type'] )
				{
					case 'int':
						$ar[0] .= 'i';
						break;
					case 'string':
						$ar[0] .= 's';
						break;
					default:
						continue;
				}
				
        		$ar[] = &$data['value'];
			}
		
			call_user_func_array(array($this->stmt, 'bind_param'),$ar);
			
		}
		
		$result = mysqli_query($this->connection,$query);

		if	( ! $result )
		{
			$this->error = 'Database error: '.mysql_error();
			return FALSE;
		}

		return $result;
	}


	function fetchRow( $result, $rownum )
	{
		return mysqli_fetch_array( $result,MYSQL_ASSOC );
	}

 
	function freeResult($result)
	{
		if	( is_resource($result) )
			return mysqli_free_result($result);
		return true;
	}


	function numCols($result)
	{
		return mysqli_num_fields( $result );
	}



	function numRows( $result )
	{
		return mysqli_num_rows($result);
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

		$this->stmt = mysqli_prepare($this->connection,$query);
		
	}
	
	function bind( $param,$value )
	{
		$this->params[$param] = $value;
	}
}

?>