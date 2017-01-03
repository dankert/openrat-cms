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

	var $prepared = false;
	var $params = array();


	function connect( $conf )
	{
		$host   = $conf['host'];
		$user   = $conf['user'];
		$pw     = $conf['password'];
		$db     = $conf['database'];
		$host = '127.0.0.1';
		
		if	( !empty($conf['port']) )
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

		if	( !$this->connection )
		{
			throw new OpenRatException( 'ERROR_DATABASE_CONNECTION',"Could not connect to database on host $host: ".mysqli_connect_errno().'/'.mysqli_connect_error() );
		}
				
		if    ( $db != '' )
		{
			if	( !mysqli_select_db( $this->connection,$db ) )
			{
				throw new OpenRatException( 'ERROR_DATABASE_CONNECTION',"Could not select database $db: ".mysqli_error($this->connection) );
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



	function query( &$query )
	{
		$ar     = array();
		$ar[-1] = $this->stmt;
		$ar[0]  = '';
		
		if	( ! empty($this->params) )
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
						die('mysqli: unknown data type: '.$data['type']);
				}
				
        		$ar[] = &$data['value'];
			}
			
			call_user_func_array('mysqli_stmt_bind_param',$ar);
		}
				
		$this->stmt->execute();
		
		return $this->stmt;
	}


	function fetchRow( $result, $rownum )
	{
        $result = $this->stmt->result_metadata();
        $fields = array();
        while ($field = mysqli_fetch_field($result)) {
            $name = $field->name;
            $fields[$name] = &$$name;
        }
        array_unshift($fields, $this->stmt);
        call_user_func_array('mysqli_stmt_bind_result', $fields);
        
        array_shift($fields);
        if	( mysqli_stmt_fetch($this->stmt) )
        {
            $temp = array();
            foreach($fields as $key => $val)
            	$temp[$key] = $val;
            //array_push($results, $temp);
            return $temp;
        }
        else
        {
	        mysqli_stmt_close($this->stmt);
	        $this->stmt = null; 
        	return false;
        }
	}

 
	function freeResult($result)
	{
		if	( is_resource($result) )
			return mysqli_free_result($result);
		return true;
	}



	function prepare( $query,$param)
	{
		if	( is_object($this->stmt) )
		{
			mysqli_stmt_close($this->stmt);
			unset($this->stmt);
			$this->stmt = null;
		}
		
		$offset = 0;
		foreach( $param as $pos)
		{
			foreach( $pos as $posn )
			{
				$posn += $offset++;
				$query = substr($query,0,$posn).'?'.substr($query,$posn);
			}
		}

		$this->stmt = mysqli_prepare($this->connection,$query);
		if	( $this->stmt === FALSE )
			throw new OpenRatException( 'ERROR_DATABASE','Unable to prepare the statement: '.$query.' : '.mysqli_error($this->connection) );
		$this->prepared = true;
	}
	
	function bind( $param,&$value )
	{
		$this->params[$param] = $value;
	}
	
	
		/**
     * Startet eine Transaktion.
     */
	function start()
	{
		mysqli_query($this->connection,'BEGIN');
	}


	/**
     * Beendet eine Transaktion.
     */
	function commit()
	{
		mysqli_query($this->connection,'COMMIT');
	}


	/**
     * Bricht eine Transaktion ab.
     */
	function rollback()
	{
		mysqli_query($this->connection,'ROLLBACK');
	}
	

	/**
	 * Setzt die letzte Abfrage zurueck.
	 */
	function clear()
	{
		$this->prepared = false;
		$this->params   = array();
	}
	
}

?>