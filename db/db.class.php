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

// This is the database abstraction layer. This class was inspired by the
// PHP-Pear-DB package. Thanks to its developers.




/**
 * Grundsaetzliche Darstellung einer Datenbank-Verbindung
 * @author $Author$
 * @version $Revision$
 * @package openrat.database
 */
class DB
{
	var $dbh;
	var $conf;
	var $id;


	function DB( $conf = array() )
	{
		$this->connect( $conf );
	}
	
	
	function connect( $conf = array() )
	{
		if	( count($conf)>0 )
			$this->conf = $conf;
//			print_r($this->conf);

		$type = $this->conf['type'];
		$classname = 'db_'.$type;
		
		$this->dbh = & new $classname;

		$this->dbh->connect( $this->conf );

		return true;
	}


	function isError( $value )
	{
		return $this->isError;
	}


	function nextId( $sequenceName )
	{
		return $this->dbh->nextId( $sequenceName );
	}


	function query( $query )
	{
		Logger::trace('DB query: '.substr($query,0,45));
		$result = $this->dbh->simpleQuery($query);

		return new DB_result( $this->dbh,$result );
	}


	function affectedRows()
	{
		return $this->dbh->affectedRows( $query );
	}


	function &getOne( $query )
	{
		$res = $this->query($query);

		if	( $res->numRows() > 0 )
		{
			$row = $res->fetchRow( 0 );
			$res->free();
	
			$keys = array_keys($row);
	
			return $row[ $keys[0] ];
		}
		else
		{
			$res->free();
			$leer = array();
			return $leer;
		}
	}


	function &getRow( $query )
	{
		$res = $this->query($query);

		if	( $res->numRows() > 0 )
			$row = $res->fetchRow( 0 );
		else
			$row = array();

		$res->free();

		return $row;
	}


	function &getCol( $query )
	{
		$res = $this->query( $query );
		
		$ret = array();

		$numRows = $res->numRows();
		
		for( $i=0; $i<$numRows; $i++ )
		{
			$row = $res->fetchRow($i);
			
			$keys = array_keys($row);
			$ret[] = $row[ $keys[0] ];
		}

		$res->free();

		return $ret;
	}


	function &getAssoc( $query, $force_array = false )
	{
		$res = $this->query($query);

		$numCols = $res->numCols();
		$numRows = $res->numRows();

		$results = array();

		if ( $numCols > 2 || $force_array )
		{
			for( $i=0; $i<$numRows; $i++ )
			{
				$row = $res->fetchRow($i);

				$keys = array_keys($row);
				$key1 = $keys[0];

				unset( $row[$key1] );
				$results[ $row[$key1] ] = $row;
			}
		}
		else
		{
			for( $i=0; $i<$numRows; $i++ )
			{
				$row = $res->fetchRow($i);

				$keys = array_keys($row);
				$key1 = $keys[0];
				$key2 = $keys[1];

				$results[ $row[$key1] ] = $row[$key2];
			}
		}

		$res->free();

		return $results;
	}


	function &getAll( $query )
	{
		$res = $this->query( $query );

		$results = array();
		$numRows = $res->numRows();

		for( $i=0; $i<$numRows; $i++ )
		{
			$row = $res->fetchRow($i);
			$results[] = $row;
		}

		$res->free();

		return $results;
	}
}




/**
 * Darstellung eines Datenbank-Ergebnisses
 * @author $Author$
 * @version $Revision$
 * @package openrat.database
 */

class DB_result
{
	var $dbh;
	var $result;


	function DB_result( $dbh, $result )
	{
		$this->dbh    = $dbh;
		$this->result = $result;
	}


	function fetchRow( $rownum = 0 )
	{
		$arr = $this->dbh->fetchRow( $this->result, $rownum );

		return $arr;
	}


	function numCols()
	{
		return $this->dbh->numCols($this->result);
	}


	function numRows()
	{
		return $this->dbh->numRows( $this->result );
	}


	function free()
	{
		$err = $this->dbh->freeResult($this->result);
		return true;
	}
}


?>