<?php
#
#  DaCMS Content Management System
#  Copyright (C) 2002 Jan Dankert, jandankert@jandankert.de
#
#  This program is free software; you can redistribute it and/or
#  modify it under the terms of the GNU General Public License
#  as published by the Free Software Foundation; either version 2
#  of the License, or (at your option) any later version.
#
#  This program is distributed in the hope that it will be useful,
#  but WITHOUT ANY WARRANTY; without even the implied warranty of
#  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#  GNU General Public License for more details.
#
#  You should have received a copy of the GNU General Public License
#  along with this program; if not, write to the Free Software
#  Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
#




/**
 * Darstellen eines SQL-Statements incl. Methoden zum Fuellen von
 * Platzhaltern im SQL-Befehl.
 *
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */

class Sql
{
	var $query = '';
	var $data  = Array();
	
	// Konstruktor, normalerweise setzen der SQL-Abfrage
	function Sql( $query = '' )
	{
		$this->query = $query;
		$this->data  = array();
		
		foreach( table_names() as $t=>$name )
		{
			$this->query = str_replace( '{'.$t.'}',$name,$this->query );
		}
	}


	// Neues Setzen der SQL-Abfrage
	function setQuery( $query = '' )
	{
		$this->query = $query;
		
		foreach( table_names() as $t=>$name )
		{
			$this->query = str_replace( '{'.$t.'}',$name,$this->query );
		}
		
		foreach( $this->data as $name=>$data )
		{
			if	( $data['type']=='string' ) $this->setString($name,$data['value'] );
			if	( $data['type']=='int'    ) $this->setInt   ($name,$data['value'] );
			if	( $data['type']=='null'   ) $this->setNull  ($name                );
		}
	}


	function setVar( $name,$value )
	{
		if   ( is_string($value) )
			$this->setString( $name,$value );

		if   ( is_null($value) )
			$this->setNull( $name );
		
		if   ( is_int($value) )
			$this->setInt( $name,$value );
	}


	function setInt( $name,$value )
	{
		$this->data[ $name ] = array( 'type'=>'int','value'=>$value );
		$this->query = str_replace( '{'.$name.'}',intval($value),$this->query );
	}


	function setString( $name,$value )
	{
		$this->data[ $name ] = array( 'type'=>'string','value'=>$value );

		//if	( defined('CONF_ADDSLASHES') && CONF_ADDSLASHES )
			$value = addslashes( $value );

		$value = "'".$value."'";
		$this->query = str_replace( '{'.$name.'}',$value,$this->query );
	}


	function setBoolean( $name,$value )
	{
		if	( $value )
			$this->setInt( $name,1 );
		else	$this->setInt( $name,0 );
	}


	function setNull( $name )
	{
		$this->data[ $name ] = array( 'type'=>'null' );
		$this->query = str_replace( '{'.$name.'}','NULL',$this->query );
	}
	

	function query()
	{
		return $this->getQuery();
	}


	function getQuery()
	{
		return $this->query;
	}
}

 
?>