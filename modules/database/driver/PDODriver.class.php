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

use database\Sql;
use logger\Logger;
use \PDO;
use \PDOException;
use PDOStatement;
use util\exception\DatabaseException;

/**
 * Implementation of all database operations in PDO.
 *
 * PDO is available since PHP 5.1 and OpenRat CMS forces a newer PHP version than this. So there should be no problem to rely on PDO.
 *
 * @author Jan Dankert
 */
class PDODriver
{
	/**
	 * Die PDO-Verbindung.
	 *
	 * @var PDO
	 */
	private $connection;
	

    /**
     * @var PDOStatement
     */
    public $stmt;


	/**
	 * Connect to a database
	 *
	 * @param $conf array connection configuration
	 * @throws DatabaseException
	 */
    function connect( $conf )
	{
		if ( !defined('PDO::ATTR_DRIVER_NAME') ) {
			// This should never happen, because PHP is always bundled with PDO.
			// but maybe... some installation could miss the module.
			throw new DatabaseException('PDO unavailable');
		}

		$dsn    = $conf['dsn'     ]; // Optional a pre-configured DSN.
		$user   = $conf['user'    ];
		$pw     = $conf['password'];

		if   ( ! $dsn ) {
			// No DSN is configured, so we are building a DSN.
			$driver = $conf['driver'];

			if (!in_array($driver,PDO::getAvailableDrivers(),TRUE))
				throw new DatabaseException('PDO driver '.$driver.' is not available');

			$dsnParts = [];
			if   ( $conf['host'] )
				$dsnParts[ $driver.':host' ] = $conf['host']; // Hostname for RDBMS with IP-stack
			elseif   ( $conf['file'] )
					$dsnParts[ $driver.':'.$conf['file'] ] = $conf['host']; // Filename for SQLITE

			if   ( $conf['database'] )
				$dsnParts['dbname' ] = $conf['database'];
			if   ( $conf['port'] )
				$dsnParts['port' ] = $conf['port'];
			if   ( $conf['charset'] )
				$dsnParts['charset'] = $conf['charset' ];

			// Building the DSN for PDO.
			$dsn = implode('; ',array_map( function($key,$value) {
				return $key.'='.$value;
			},array_keys($dsnParts),$dsnParts));
		}

		// we must have a prefix or suffix
		// this is because some table names are reserved words in some RDBMS
		if   ( ! $conf['prefix'] && ! $conf['suffix'] )
			throw new DatabaseException('database tables must have a prefix or a suffix, both are empty.');
		
		$options = array();
		foreach( $conf as $c )
			if	( is_string($c) && substr($c,0,7) == 'option_' )
				$options[substr($c,8)] = $conf[$c];

		if	( $conf['persistent'])
		    // From the docs:
		    // "Many web applications will benefit from making persistent connections to database servers.
		    //  Persistent connections are not closed at the end of the script, but are cached and re-used
		    //  when another script requests a connection using the same credentials."
		    // "The persistent connection cache allows you to avoid the overhead of establishing a new
		    // connection every time a script needs to talk to a database, resulting in a faster web application."
			$options[ PDO::ATTR_PERSISTENT ] = true;

		// From the docs:
		// "try to use native prepared statements (if FALSE).
		//  It will always fall back to emulating the prepared statement if the driver cannot successfully prepare the current query"
		$options[ PDO::ATTR_EMULATE_PREPARES  ] = false;
		
		// Convert numeric values to strings when fetching => NO
		$options[ PDO::ATTR_STRINGIFY_FETCHES ] = false;

		// From the docs:
		// "If this value is FALSE, PDO attempts to disable autocommit so that the connection begins a transaction."
        // We do NOT need transactions for reading actions (GET requests).
        // We are opening a transaction with PDO::beginTransaction at the beginning of a  POST-request.
        // do NOT set this to false, otherwise there will be left open transactions.
		//$options[ PDO::ATTR_AUTOCOMMIT ] = true;
			
		// We like Exceptions
		$options[ PDO::ERRMODE_EXCEPTION       ] = true;
		$options[ PDO::ATTR_DEFAULT_FETCH_MODE ] = PDO::FETCH_ASSOC;

        try
        {
            $this->connection = new PDO($dsn, $user, $pw, $options);
        }
        catch(\PDOException $e)
        {
            throw new DatabaseException("Could not connect to database with DSN '$dsn'",$e);
        }

        // This should never happen, because PDO should throw an exception if the connection fails.
		if	( !is_object($this->connection) )
			throw new DatabaseException("Could not connect to database with DSN '$dsn', Reason: ".PDO::errorInfo() );
    }


    /**
     * Disconnects the database connection.
     *
     * @return bool
     */
    public function disconnect()
	{
	    // There is no disconnection-function.
        // So the GC will call the finalize-method of the connection object.
		$this->connection = null;

		return true;
	}


    /**
     * @param $stmt PDOStatement
     * @param $query Sql
     * @return PDOStatement
     */
    public function query($stmt,$query)
	{
		$erg = $stmt->execute();

		if	( $erg === false )
			throw new DatabaseException( 'Could not execute prepared statement "'.$query->query.'": '.implode('/',$stmt->errorInfo()) );

		return $stmt;
	}


	/**
	 * @param $stmt PDOStatement
	 * @return mixed Row
	 */
	public function fetchRow($stmt)
	{
		return $stmt->fetch( PDO::FETCH_ASSOC );
	}

 
	public function prepare( $query,$param)
	{
		$offset = 0;
		foreach( $param as $name=>$pos)
		{
			$name = ':'.$name;
			$pos  += $offset;
			$query = substr($query,0,$pos).$name.substr($query,$pos);
			
			$offset = $offset + strlen($name);
		}

		$stmt = $this->connection->prepare($query);
		
		if	( $stmt === false )
			throw new DatabaseException("Could not prepare statement:\n$query\nCause: ".implode(' / ',$this->connection->errorInfo()) );

		return $stmt;
	}


    /**
     * Binding a parameter value.
     *
     * @param $stmt PDOStatement
     * @param $param
     * @param $value
     */
	public function bind( $stmt,$param,$value )
	{
		$name = ':'.$param;
		
		if	( is_string($value) )
			$type = PDO::PARAM_STR;
		elseif( is_int($value)) 
			$type = PDO::PARAM_INT;
		elseif( is_null($value))
			$type = PDO::PARAM_NULL;
		else
			throw new DatabaseException( 'Unknown type for parameter '.$name.': '.gettype($value) );
		
		$stmt->bindValue($name,$value,$type);
	}
	
	
	
	/**
     * Startet eine Transaktion.
     */
	public function start()
	{
		$this->connection->beginTransaction();
	}

	
	
	/**
     * Beendet eine Transaktion.
     */
	public function commit()
	{
		$this->connection->commit();
	}


	/**
     * Bricht eine Transaktion ab.
     */
	public function rollback()
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
	 * Why this? See http://e-mats.org/2008/07/fatal-error-exception-thrown-without-a-stack-frame-in-unknown-on-line-0/
	 * 
	 * @return array
	 */
	function __sleep() {
    	return array();
  }  
	
}

?>