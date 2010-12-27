<?php
// OpenRat Content Management System
// Copyright (C) 2002-2004 Jan Dankert, jandankert@jandankert.de
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



/**
 * Darstellen einer Verkn�pfung. Eine Verkn�pfung kann auf eine Objekt oder auf
 * eine beliebige Url zeigen
 *
 * @version $Revision$
 * @author $Author$
 * @package openrat.objects
 */
class Link extends Object
{
	var $linkid;
	var $linkedObjectId = 0;
	var $url            = '';
	var $isLinkToUrl    = false;
	var $isLinkToObject = false;

	function Link( $objectid='' )
	{
		$this->Object( $objectid );
		$this->isLink = true;
		$this->isLinkToObject = false;
	}
	

	// Lesen der Verkn�pfung aus der Datenbank
	function load()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT *'.
		                ' FROM {t_link}'.
		                ' WHERE objectid={objectid}' );
		$sql->setInt( 'objectid',$this->objectid );
		$row = $db->getRow( $sql );

		if	( count($row ) != 0 )
		{
			$this->url            = $row['url'];
			$this->linkedObjectId = $row['link_objectid'];
			
			if	( is_numeric( $this->linkedObjectId ) )
			{
				$this->isLinkToUrl    = false;
				$this->isLinkToObject = true;
			}
			else
			{
				$this->isLinkToUrl    = true;
				$this->isLinkToObject = false;
			}
		}
		
		$this->objectLoad();
	}



	function delete()
	{
		$db = db_connection();

		// Verkn�pfung l�schen
		$sql = new Sql( 'DELETE FROM {t_link} '.
		                ' WHERE objectid={objectid}' );
		$sql->setInt( 'objectid',$this->objectid );
		
		$db->query( $sql );

		$this->objectDelete();
	}



	function save()
	{
		global $SESS;
		$db = db_connection();
		
		$sql = new Sql('UPDATE {t_link} SET '.
		               '  url           = {url},'.
		               '  link_objectid = {linkobjectid}'.
		                ' WHERE objectid={objectid}' );
		$sql->setInt   ('objectid'    ,$this->objectid );
		
		if	( $this->isLinkToObject )
		{
			$sql->setInt ('linkobjectid',$this->linkedObjectId );
			$sql->setNull('url' );
		}
		else
		{
			$sql->setNull  ('linkobjectid');
			$sql->setString('url',$this->url );
		}
		
		$db->query( $sql );

		$this->objectSave();
	}


	function getProperties()
	{
		return array_merge( parent::getProperties(),
		                    Array( 'objectid'       =>$this->objectid,
		                           'linkobjectid'   =>$this->linkedObjectId,
		                           'url'            =>$this->url,
		                           'isLinkToUrl'    =>$this->isLinkToUrl,
		                           'isLinkToObject' =>$this->isLinkToObject) );
	}


	function getType()
	{
		if	( $this->isLinkToObject )
			return 'link';
		else	return 'url';
	}


	function add()
	{
		$this->objectAdd();

		$db = db_connection();

		$sql = new Sql('SELECT MAX(id) FROM {t_link}');
		$this->linkid = intval($db->getOne($sql))+1;

		$sql = new Sql('INSERT INTO {t_link}'.
		               ' (id,objectid,url,link_objectid)'.
		               ' VALUES( {linkid},{objectid},{url},{linkobjectid} )' );
		$sql->setInt   ('linkid'      ,$this->linkid         );
		$sql->setInt   ('objectid'    ,$this->objectid       );

		if	( $this->isLinkToObject )
		{
			$sql->setInt ('linkobjectid',$this->linkedObjectId );
			$sql->setNull('url' );
		}
		else
		{
			$sql->setNull  ('linkobjectid');
			$sql->setString('url',$this->url );
		}
		
		$db->query( $sql );
	}	
}

?>