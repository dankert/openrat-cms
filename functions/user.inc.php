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


class User
{
	var $userid;

	var $name     = '';
	var $fullname = '';

	function User( $userid='' )
	{
		if   ( is_numeric($userid) )
			$this->userid = $userid;
	}
	

	

	// Lesen Benutzer aus der Datenbank
	function load()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT * FROM {t_user}'.
		                ' WHERE id={userid}' );
		$sql->setInt( 'userid',$this->userid );
		$row = $db->getRow( $sql->query );

		$this->fullname = $row['fullname'];
		$this->name     = $row['name'    ];
	}




	function add()
	{
		$db = db_connection();

		$sql = new Sql('INSERT INTO {t_user}'.
		               ' (folderid,name,filename,extension,size,create_date,create_userid,lastchange_date,lastchange_userid,value)'.
		               ' VALUES( {folderid},{name},{filename},{extension},{filesize},{time},{userid},{time},{userid},{value} )' );
		$sql->setInt   ('folderid' ,$this->folderid);
		$sql->setString('filename' ,$this->filename);
		$sql->setString('name'     ,$this->name);
		$sql->setString('extension',$this->extension);
		$sql->setInt   ('filesize' ,strlen($this->value) );
		$sql->setInt   ('time'     ,$this->create_date );
		$sql->setInt   ('userid'   ,$this->create_userid );
		$sql->setString('value'    ,$this->value );

		$db->query( $sql->query );
	}	
}

?>