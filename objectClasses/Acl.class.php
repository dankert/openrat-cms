<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// OpenRat Content Management System
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
// Revision 1.1  2004-04-24 15:15:12  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------


/**
 * Darstellen einer Berechtigung (ACL "Access Control List")
 * Die Berechtigung zu einem Objekt wird mit einer Liste dieser Objekte dargestellt
 *
 * Falls es mehrere ACLs zu einem Objekt gibt, werden die Berechtigung-Flags addiert.
 */
class Acl
{
	/**
	  * eindeutige ID dieser ACL
	  * @type Integer
	  */
	var $aclid;

	/**
	  * ID des Objektes, für das diese Berechtigung gilt
	  * @type Integer
	  */
	var $objectid   = 0;

	/**
	  * ID des Benutzers
	  * ( = 0 falls die Berechtigung für eine Gruppe gilt)
	  * @type Integer
	  */
	var $userid     = 0;

	/**
	  * ID der Gruppe
	  * ( = 0 falls die Berechtigung für einen Benutzer gilt)
	  * @type Integer
	  */
	var $groupid    = 0;

	/**
	  * ID der Sprache
	  * @type Integer
	  */
	var $languageid = 0;

	/**
	  * Es handelt sich um eine Standard-Berechtigung
	  * (Falls false, dann Zugriffs-Berechtigung)
	  * @type Boolean
	  */
	var $isDefault  = false;

	/**
	  * Name des Benutzers, für den diese Berechtigung gilt
	  * @type String
	  */
	var $username   = '';

	/**
	  * Name der Gruppe, für die diese Berechtigung gilt
	  * @type String
	  */
	var $groupname  = '';

	/**
	  * Inhalt lesen (ist immer wahr)
	  * @type Boolean
	  */
	var $read          = true;

	/**
	  * Inhalt bearbeiten
	  * @type Boolean
	  */
	var $write         = false;

	/**
	  * Eigenschaften bearbeiten
	  * @type Boolean
	  */
	var $prop          = false;

	/**
	  * Objekt löschen
	  * @type Boolean
	  */
	var $delete        = false;

	/**
	  * Objekt veröffentlichen
	  * @type Boolean
	  */
	var $publish       = false;

	/**
	  * Unterordner anlegen
	  * @type Boolean
	  */
	var $create_folder = false;

	/**
	  * Datei anlegen (bzw. hochladen)
	  * @type Boolean
	  */
	var $create_file   = false;

	/**
	  * Verknüpfung anlegen
	  * @type Boolean
	  */
	var $create_link   = false;

	/**
	  * Seite anlegen
	  * @type Boolean
	  */
	var $create_page   = false;

	/**
	  * Berechtigungen vergeben
	  * @type Boolean
	  */
	var $grant = false;

	/**
	  * Berechtigungen an Unterobjekte vererben
	  * @type Boolean
	  */
	var $transmit = false;


	/**
	 * Konstruktor
	 * @param Integer Acl-ID
	 */
	function Acl( $aclid = 0 )
	{
		if	( $aclid != 0 )
			$this->aclid = $aclid;
	}


	/**
	 * Laden einer ACL
	 */
	function load()
	{
		$db = db_connection();
		
		$sql = new Sql( 'SELECT {t_acl}.*,{t_user}.name as username,{t_group}.name as groupname,{t_language}.name as languagename'.
		                '  FROM {t_acl} '.
		                '    LEFT JOIN {t_user}     ON {t_user}.id     = {t_acl}.userid     '.
		                '    LEFT JOIN {t_group}    ON {t_group}.id    = {t_acl}.groupid    '.
		                '    LEFT JOIN {t_language} ON {t_language}.id = {t_acl}.languageid '.
		                '  WHERE {t_acl}.id={aclid}' );

		$sql->setInt('aclid',$this->aclid);
		
		$row = $db->getRow( $sql->query );
		
		$this->write         = ( $row['is_write'        ] == '1' );
		$this->prop          = ( $row['is_prop'         ] == '1' );
		$this->delete        = ( $row['is_delete'       ] == '1' );
		$this->publish       = ( $row['is_publish'      ] == '1' );
		$this->create_folder = ( $row['is_create_folder'] == '1' );
		$this->create_file   = ( $row['is_create_file'  ] == '1' );
		$this->create_page   = ( $row['is_create_page'  ] == '1' );
		$this->create_link   = ( $row['is_create_link'  ] == '1' );
		$this->grant         = ( $row['is_grant'        ] == '1' );
		$this->transmit      = ( $row['is_transmit'     ] == '1' );

		$this->objectid     = intval($row['objectid'  ]);
		$this->languageid   = intval($row['languageid']);
		$this->userid       = intval($row['userid'    ]);
		$this->groupid      = intval($row['groupid'   ]);
		if	( intval($this->languageid)==0 )
			$this->languagename = lang('ALL_LANGUAGES');
		else	$this->languagename = $row['languagename'];
		$this->username     = $row['username'    ];
		$this->groupname    = $row['groupname'   ];
	}


	function save()
	{
		if	( $this->delete )
			$this->prop = true;

		$db = db_connection();
		
		$sql = new Sql( 'UPDATE {t_acl} '.
		                ' SET userid          ={userid},'.
		                '     groupid         ={groupid},'.
		                '     objectid        ={objectid},'.
		                '     is_write        ={write},'.
		                '     is_prop         ={prop},'.
		                '     is_create_folder={create_folder},'.
		                '     is_create_file  ={create_file},'.
		                '     is_create_link  ={create_link},'.
		                '     is_create_page  ={create_page},'.
		                '     is_grant        ={grant},'.
		                '     is_transmit     ={transmit},'.
		                '     delete          ={delete},'.
		                '     publish         ={publish},'.
		                '     languageid      ={languageid}'.
		                '  WHERE aclid={aclid}' );

		$sql->setInt('aclid'   ,$this->aclid   );
		$sql->setInt('objectid',$this->objectid);
		
		if	( intval($this->groupid) == 0 )
		{
			$sql->setInt ('userid',$this->userid);
			$sql->setNull('groupid');
		}
		else
		{
			$sql->setNull('userid');
			$sql->setInt ('groupid',$this->groupid);
		}

		$sql->setBoolean('is_default'   ,$this->isDefault     );
		$sql->setBoolean('prop'         ,$this->prop          );
		$sql->setBoolean('write'        ,$this->write         );
		$sql->setBoolean('delete'       ,$this->delete        );
		$sql->setBoolean('publish'      ,$this->publish       );
		$sql->setBoolean('grant'        ,$this->grant         );
		$sql->setBoolean('transmit'     ,$this->transmit      );
		$sql->setBoolean('create_folder',$this->create_folder );
		$sql->setBoolean('create_file'  ,$this->create_file   );
		$sql->setBoolean('create_link'  ,$this->create_link   );
		$sql->setBoolean('create_page'  ,$this->create_page   );

		$sql->setInt('languageid',$this->languageid);

		$db->query( $sql->query );
	}



	function getProperties()
	{
		return Array( 'write'        => $this->write,
		              'prop'         => $this->prop,
		              'create_folder'=> $this->create_folder,
		              'create_file'  => $this->create_file,
		              'create_link'  => $this->create_link,
		              'create_page'  => $this->create_page,
		              'delete'       => $this->delete,
		              'publish'      => $this->publish,
		              'grant'        => $this->grant,
		              'transmit'     => $this->transmit,
		              'is_default'   => $this->isDefault,
		              'userid'       => $this->userid,
		              'username'     => $this->username,
		              'groupid'      => $this->groupid,
		              'groupname'    => $this->groupname,
		              'languageid'   => $this->languageid,
		              'languagename' => $this->languagename,
		              'objectid'     => $this->objectid );

	}


	function delete()
	{
		$db = db_connection();
		
		$sql = new Sql( 'DELETE FROM {t_acl} '.
		                ' WHERE id = {aclid}' );

		$sql->setInt('aclid',$this->aclid);
		
		$db->query( $sql->query );
		
		$this->aclid = 0;
	}


	function add()
	{
		if	( $this->delete )
			$this->prop = true;

		$db = db_connection();

		$sql = new Sql('SELECT MAX(id) FROM {t_acl}');
		$this->aclid = intval($db->getOne($sql->query))+1;
		
		$sql = new Sql( 'INSERT INTO {t_acl} '.
		                ' (id,userid,groupid,objectid,is_write,is_prop,is_create_folder,is_create_file,is_create_link,is_create_page,is_delete,is_publish,is_grant,is_transmit,languageid)'.
		                ' VALUES( {aclid},{userid},{groupid},{objectid},{write},{prop},{create_folder},{create_file},{create_link},{create_page},{delete},{publish},{grant},{transmit},{languageid} )' );

		$sql->setInt('aclid'   ,$this->aclid   );
		$sql->setInt('objectid',$this->objectid);
		
		if	( intval($this->groupid) == 0 )
		{
			$sql->setInt ('userid',$this->userid);
			$sql->setNull('groupid');
		}
		else
		{
			$sql->setNull('userid');
			$sql->setInt ('groupid',$this->groupid);
		}

		$sql->setBoolean('is_default'   ,$this->isDefault     );
		$sql->setBoolean('prop'         ,$this->prop          );
		$sql->setBoolean('write'        ,$this->write         );
		$sql->setBoolean('delete'       ,$this->delete        );
		$sql->setBoolean('publish'      ,$this->publish       );
		$sql->setBoolean('grant'        ,$this->grant         );
		$sql->setBoolean('transmit'     ,$this->transmit      );
		$sql->setBoolean('create_folder',$this->create_folder );
		$sql->setBoolean('create_file'  ,$this->create_file   );
		$sql->setBoolean('create_link'  ,$this->create_link   );
		$sql->setBoolean('create_page'  ,$this->create_page   );

		if	( intval($this->languageid) == 0 )
			$sql->setNull('languageid');
		else	$sql->setInt ('languageid',$this->languageid);

		$db->query( $sql->query );
	}


//	function getAccessACLsFromObject( $objectid=0 )
//	{
//		$db = db_connection();
//		
//		$sql = new Sql( 'SELECT id FROM {t_acl} '.
//		                '  WHERE objectid={objectid}'.
//		                '    AND is_default=0'.
//		                '  ORDER BY userid,groupid ASC' );
//
//		if	( $objectid == 0 )
//			$sql->setInt('objectid',$this->objectid);
//		else	$sql->setInt('objectid',$objectid      );
//
//		return $db->getCol( $sql->query );
//	}
//
//
//	function getDefaultACLsFromObject( $objectid=0 )
//	{
//		$db = db_connection();
//		
//		$sql = new Sql( 'SELECT id FROM {t_acl} '.
//		                '  WHERE objectid={objectid}'.
//		                '    AND is_default=1'.
//		                '  ORDER BY userid,groupid ASC' );
//
//		if	( $objectid == 0 )
//			$sql->setInt('objectid',$this->objectid);
//		else	$sql->setInt('objectid',$objectid      );
//
////		echo "<pre>".$sql->query."</pre>";
//		return $db->getCol( $sql->query );
//	}


	function getACLsFromUserId( $userid )
	{
		$db = db_connection();
		
		$sql = new Sql( 'SELECT id FROM {t_acl} '.
		                '  WHERE userid={userid}');
		$sql->setInt('userid',$userid);

		return $db->getCol( $sql->query );
	}


	function getACLsFromGroupId( $groupid )
	{
		$db = db_connection();
		
		$sql = new Sql( 'SELECT id FROM {t_acl} '.
		                '  WHERE groupid={groupid}' );
		$sql->setInt('groupid',$groupid);

		return $db->getCol( $sql->query );
	}
}