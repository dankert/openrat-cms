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
// great PHP-Pear-DB package. Thanks to its developers.


// Column data indexed by numbers, ordered from 0 and up
define('DB_FETCHMODE_ORDERED', 1);

// Column data indexed by column names
define('DB_FETCHMODE_ASSOC'  , 2);

// Column data as object properties
define('DB_FETCHMODE_OBJECT' , 3);

define('DB_FETCHMODE_DEFAULT', DB_FETCHMODE_ASSOC);



/**
 * Grundsaetzliche Darstellung einer Datenbank-Verbindung
 * @author $Author$
 * @version $Revision$
 * @package openrat.database
 */
class DB
{
	var $isError = false;
	var $error   = '';
	var $dbh;
	var $fetchmode = DB_FETCHMODE_ORDERED;
	var $conf;
	var $id;


	function DB( $conf = array() )
	{
		$this->connect( $conf );
	}
	
	
	function setFetchMode( $fetchmode )
	{
		$this->fetchmode = $fetchmode;
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

		if ( $this->dbh->isError )
			return false;

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

		$err = $res->fetchInto( &$row, DB_FETCHMODE_ORDERED );
		$res->free();

		return $row[0];
	}


	function &getRow( $query )
	{
		$res = $this->query($query);

		$err = $res->fetchInto($row);

		$res->free();

		return $row;
	}


	function &getCol( $query, $col=0 )
	{
		$res = $this->query( $query );
		
		if   ( is_integer( $col ) )
			$fetchmode = DB_FETCHMODE_ORDERED;
		else $fetchmode = DB_FETCHMODE_ASSOC;

		$ret = array();

		while( is_array($row = $res->fetchRow($fetchmode)) )
		{
			$ret[] = $row[$col];
		}

		$res->free();

		return $ret;
	}


	function &getAssoc( $query, $force_array = false )
	{
		$res = $this->query($query);

		$cols = $res->numCols();

		$results = array();

		if ( $cols > 2 || $force_array )
		{
			while( is_array($row = $res->fetchRow(DB_FETCHMODE_ORDERED)) )
			{
				reset($row);
				$results[ $row[0] ] = array_slice($row, 1);
			}
		}
		else
		{
			while (is_array($row = $res->fetchRow(DB_FETCHMODE_ORDERED)))
			{
				$results[$row[0]] = $row[1];
			}
		}

		$res->free();

		return $results;
	}

	function &getAll($query, $fetchmode = DB_FETCHMODE_DEFAULT )
	{

		$fetchmode = (empty($fetchmode)) ? DB_FETCHMODE_DEFAULT : $fetchmode;

		$res = $this->query( $query );

		$results = array();

		while( $row = $res->fetchRow( $fetchmode) )
		{
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


	function fetchRow( $fetchmode = null, $rownum = null )
	{
		$arr = $this->dbh->fetchRow( $this->result, $fetchmode, $rownum );

		return $arr;
	}


	function fetchInto( &$arr, $fetchmode = null, $rownum=null )
	{
		$arr = $this->fetchRow( $fetchmode, $rownum );

		return true;
	}


	function numCols()
	{
		return $this->dbh->numCols($this->result);
	}


	function numRows()
	{
		$rows = $this->dbh->numRows( $this->result );

		if   ( $this->dbh->isError )
			echo "Fehler";
		
		return $rows;
	}


	function free()
	{
		$err = $this->dbh->freeResult($this->result);
		return true;
	}
}


?>