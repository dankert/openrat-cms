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
 * Datenbank-abhaengige Methoden fuer PDO.
 * 
 * @author Jan Dankert
 * @version $Revision: 1.5 $
 * @package openrat.database
 */
class DB_pdo
{
	/**
	 * Die PDO-Verbindung.
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
		$url    = $conf['dsn'];
		$user   = $conf['user'];
		$pw     = $conf['password'];
		$db     = $conf['database'];
		
		if	( isset($conf['port']) )
			$host .= ':'.$conf['port'];

		$options = array();
		foreach( $conf as $c )
			if	( substr($c,0,7) == 'option_' )
				$options[substr($c,8)] = $conf[$c];
				
		$this->connection = new PDO($url, $user, $pw, $options);
		
		if	( !is_object($this->connection) )
		{
			$this->error = "Could not connect to database on host $host. ".PDO::errorInfo();
			return false;
		}
				
		return true;
    }



	function disconnect()
	{
		$this->connection = null;
		return true;
	}



	function query($query)
	{
		$this->result = $this->connection->query($query);

		if	( ! $this->result )
		{
			$this->error = 'Database error: '.PDO::errorInfo();
			return FALSE;
		}

		return $this->result;
	}


	function fetchRow( $result, $rownum )
	{
		return $this->result->fetch( PDO::FETCH_ASSOC() );
	}

 
	function freeResult($result)
	{
		return true;
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

		$this->stmt = $this->connection->prepare($query);
		
	}

	
	
	function bind( $param,$value )
	{
		$this->params[$param] = $value;
	}
	
	
	
	/**
     * Startet eine Transaktion.
     */
	function start()
	{
		$this->connection->beginTransaction();
	}

	
	
	/**
     * Beendet eine Transaktion.
     */
	function commit()
	{
		$this->connection->commit();
	}


	/**
     * Bricht eine Transaktion ab.
     */
	function rollback()
	{
		$this->connection->rollBack();
	}
	
}

?>