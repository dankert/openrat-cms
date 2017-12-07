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
namespace database\driver;

use \Logger;
use \PDO;
use \PDOException;
use \RuntimeException;

/**
 * Datenbank-abhaengige Methoden fuer PDO.
 * 
 * @author Jan Dankert
 * @version $Revision: 1.5 $
 * @package openrat.database
 */
class PDODriver
{
	/**
	 * Die PDO-Verbindung.
	 *
	 * @var PDO
	 */
	var $connection;
	
	/**
	 * Datenbank-Fehler.
	 *
	 * @var String
	 */
	var $error;
	
	var $lowercase = false;
	
	var $params;


    /**
     * @var \PDOStatement
     */
    public $stmt;


    function connect( $conf )
	{
		$url    = $conf['dsn'     ];
		$user   = $conf['user'    ];
		$pw     = $conf['password'];
		
		if	( !empty($conf['convert_to_lowercase']) )
			$this->lowercase = true;
		
		$options = array();
		foreach( $conf as $c )
			if	( is_string($c) && substr($c,0,7) == 'option_' )
				$options[substr($c,8)] = $conf[$c];

		if	( $conf['persistent'])
			$options[ PDO::ATTR_PERSISTENT ] = true;

		//if	( !$conf['prepare']) <- unused...
		// From the docs:
		// try to use native prepared statements (if FALSE).
		// It will always fall back to emulating the prepared statement if the driver cannot successfully prepare the current query
		$options[ PDO::ATTR_EMULATE_PREPARES ] = false;
		
		// Convert numeric values to strings when fetching => NO
		$options[ PDO::ATTR_STRINGIFY_FETCHES ] = false;
		$options[ PDO::ATTR_AUTOCOMMIT ] = false;
			
		// We like Exceptions
		$options[ PDO::ERRMODE_EXCEPTION ] = true;
		$options[ PDO::ATTR_DEFAULT_FETCH_MODE ] = PDO::FETCH_ASSOC;

        try
        {
            $this->connection = new PDO($url, $user, $pw, $options);
        }
        catch(\PDOException $e)
        {
            throw new \RuntimeException("Could not connect to database on host $url.",$e);
        }

        // This should never happen, because PDO should throw an exception if the connection fails.
		if	( !is_object($this->connection) )
			throw new RuntimeException("Could not connect to database on host $url. ".PDO::errorInfo() );
				
		return true;
    }


    /**
     * Disconnects the database connection.
     *
     * @return bool
     */
    function disconnect()
	{
	    // There is no disconnection-function.
        // So the GC will call the finalize-method of the connection object.
		$this->connection = null;

		return true;
	}



	function query($query)
	{
		$erg = $this->stmt->execute();

		if	( $erg === false )
		{
			throw new RuntimeException( 'Could not execute prepared statement "'.$query->query.'": '.implode('/',$this->stmt->errorInfo()) );
		}
		
		return $this->stmt;
	}


	function fetchRow( $result, $rownum )
	{
		$row = $this->stmt->fetch( PDO::FETCH_ASSOC );
		
/*
 * 
		
		
		if(intval(@$row['id'])==1)
		{
 		echo "Hallo:";
 		
//  		echo "\n";print_r($row)."\n";
 		var_dump($row);
 		echo " ist... ".gettype($row);
			
		}
		
 */		
		
		
		if	( is_array($row) && $this->lowercase )
			$row = array_change_key_case($row);
				
		return $row;
	}

 
	function freeResult($result)
	{
		return true;
	}


	function prepare( $query,$param)
	{
		$this->params = $param;
		$offset = 0;
		foreach( $param as $name=>$pos)
		{
			$name = ':'.$name;
			$pos  += $offset;
			$query = substr($query,0,$pos).$name.substr($query,$pos);
			
			$offset = $offset + strlen($name);
		}

		$this->stmt = $this->connection->prepare($query);
		
		if	( $this->stmt === false )
			throw new RuntimeException('Could not prepare statement: '.$query.' Cause: '.implode('/',$this->connection->errorInfo()) );
		
	}

	
	
	function bind( $param,$value )
	{
		$name = ':'.$param;
		
		if	( is_string($value) )
			$type = PDO::PARAM_STR;
		elseif( is_int($value)) 
			$type = PDO::PARAM_INT;
		elseif( is_null($value))
			$type = PDO::PARAM_NULL;
		else
			throw new RuntimeException( 'Unknown type' );
		
		$this->stmt->bindValue($name,$value,$type);
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
		try
		{
			$this->connection->rollBack();
		}
		catch ( PDOException $e )
		{
			// Kommt vor, wenn keine Transaktion existiert.
		}
	}
	
	
	
	/**
	 * Setzt die letzte Abfrage zurueck.
	 */
	function clear()
	{
		$this->params   = array();
	}


	/**
	 * Why this? See http://e-mats.org/2008/07/fatal-error-exception-thrown-without-a-stack-frame-in-unknown-on-line-0/
	 * 
	 * @return array
	 */
	function __sleep() {
    	return array();
  }  
	
}

?>