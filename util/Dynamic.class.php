<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// DaCMS Content Management System
// Copyright (C) 2002 Jan Dankert, jandankert@jandankert.de
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
// ---------------------------------------------------------------------------
// $Log$
// Revision 1.4  2005-01-03 19:38:03  dankert
// Neue Methode outputLn
//
// Revision 1.3  2004/12/19 21:49:02  dankert
// Methode pathToObject()
//
// Revision 1.2  2004/12/19 15:25:12  dankert
// Anpassung Session-Funktionen
//
// Revision 1.1  2004/12/15 23:14:21  dankert
// *** empty log message ***
//
// Revision 1.5  2004/11/10 22:50:10  dankert
// Neue Methode execute()
//
// Revision 1.4  2004/10/06 09:53:39  dankert
// Benutzung auch nicht-statisch
//
// Revision 1.3  2004/05/03 20:21:34  dankert
// neu: setObjectId()
//
// Revision 1.2  2004/05/02 15:04:16  dankert
// Einf?gen package-name (@package)
//
// Revision 1.1  2004/04/24 17:03:29  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------

/**
 * Service-Klasse fuer allgemeine Interface-Methoden. Insbesondere
 * in Code-Elementen kann und soll auf diese Methoden zurueckgegriffen
 * werden.
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class Dynamic
{
	var $project;
	var $output   = '';
	var $objectid = 0;
	var $page;
	var $parameters  = array();
	var $description = '';
	
	
	function db()
	{
		return db_connection();
	}

	function getObjectId()
	{
		return $this->objectid;
	}

	function &getObject()
	{
		return Session::getObject();
	}

	function setObjectId( $objectid )
	{
		$this->objectid = $objectid;
	}

	function getRootObjectId()
	{
		$project = Session::getProject();
		return $project->getRootObjectId();
	}

	function folderid()
	{
		global $SESS;
		return $SESS['folderid'];
	}


	function execute()
	{
		// overwrite this in subclasses
	}	
	
	function delOutput()
	{
		$this->output = '';
	}
	
	function output( $text )
	{
		$this->output .= $text;
	}

	function outputLn( $text )
	{
		$this->output .= $text."\n";
	}


	function getOutput()
	{
		return $this->output;
	}
	
	function setSessionVar( $var,$value )
	{
		Session::set( $var,$value );
	}


	function getSessionVar( $var )
	{
		return Session::get( $var );
	}


	function pathToObject( $obj )
	{
		if	( is_object($obj) )
			return $this->page->path_to_object($obj->objectid);
		else
			return $this->page->path_to_object($obj);
	}

}