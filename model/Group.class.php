<?php
// OpenRat Content Management System
// Copyright (C) 2002-2012 Jan Dankert, cms@jandankert.de
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
 * Darstellen einer Benutzergruppe. Eine Gruppe enthaelt beliebig viele Benutzer
 *
 * @version $Revision$
 * @author $Author$
 * @package openrat.objects
 */
class Group
{
	var $groupid   = 0;
	var $error    = '';

	var $name     = '';
	var $fullname = '';
	var $ldap_dn;
	var $tel;
	var $mail;
	var $desc;
	var $style;
	var $isAdmin;


	// Konstruktor
	function Group( $groupid='' )
	{
		if   ( is_numeric($groupid) )
			$this->groupid = $groupid;
	}


	// Lesen aller Gruppen aus der Datenbank
	function getAll()
	{
		global $conf;
		$db = db_connection();

		$sql = $db->sql( 'SELECT id,name FROM {{group}}' );

		return $sql->getAssoc( $sql );
	}


	// Lesen Gruppe aus der Datenbank
	function load()
	{
		$db = db_connection();

		$sql = $db->sql( 'SELECT * FROM {{group}}'.
		                ' WHERE id={groupid}' );
		$sql->setInt( 'groupid',$this->groupid );

		$row = $sql->getRow( $sql );
		if	( count($row) > 0 )
			$this->name = $row['name'    ];
		else
			$this->name = '';
	}


	// Lesen einer Gruppe aus der Datenbank
	public static function loadWithName( $name )
	{
		$db = db_connection();

		$sql = $db->sql( 'SELECT * FROM {{group}}'.
		                ' WHERE name={name}' );
		$sql->setString('name',$name );

		$row = $sql->getRow( $sql );
		if	( count($row) > 0 )
		{
			$group = new Group( $row['id'] );
			$group->load();
			
			return $group;
		}
		else
		{
			throw new ObjectNotFoundException( "Group does not exist: ".$name);
		}
	}


	// Speichern Benutzer in der Datenbank
	function save()
	{
		if	( empty($this->name) )
			$this->name = lang('GLOBAL_GROUP').' '.$this->groupid;
			
		$db = db_connection();

		// Gruppe speichern		
		$sql = $db->sql( 'UPDATE {{group}} '.
		                'SET name = {name} '.
		                'WHERE id={groupid}' );
		$sql->setString( 'name'  ,$this->name    );
		$sql->setInt   ('groupid',$this->groupid );

		// Datenbankabfrage ausfuehren
		$sql->query( $sql );
	}


	/**
	 * Rueckgabe aller Eigenschaften
	 * @return Array
	 */
	function getProperties()
	{
		return Array( 'name'   =>$this->name,
		              'groupid'=>$this->groupid );
	}


	// Gruppe hinzufuegen
	function add( $name = '' )
	{
		$db = db_connection();

		if	( $name != '' )
			$this->name = $name;

		$sql = $db->sql('SELECT MAX(id) FROM {{group}}');
		$this->groupid = intval($sql->getOne($sql))+1;
		
		// Gruppe hinzuf?gen
		$sql = $db->sql( 'INSERT INTO {{group}} '.
		                '(id,name) VALUES( {groupid},{name} )');
		$sql->setInt   ('groupid',$this->groupid );
		$sql->setString('name'   ,$this->name    );

		// Datenbankbefehl ausfuehren
		$sql->query( $sql );
	}


	// Gruppe entfernen
	function delete()
	{
		$db = db_connection();

		// Berechtigungen zu dieser Gruppe loeschen
		$sql = $db->sql( 'DELETE FROM {{acl}} '.
		                'WHERE groupid={groupid}' );
		$sql->setInt   ('groupid',$this->groupid );
		$sql->query( $sql );


		// Alle Gruppenzugehoerigkeiten zu dieser Gruppe loeschen
		$sql = $db->sql( 'DELETE FROM {{usergroup}} '.
		                'WHERE groupid={groupid}' );
		$sql->setInt   ('groupid',$this->groupid );
		$sql->query($sql);

		// Gruppe loeschen
		$sql = $db->sql( 'DELETE FROM {{group}} '.
		                'WHERE id={groupid}' );
		$sql->setInt   ('groupid',$this->groupid );
		$sql->query($sql);
	}


	// Benutzer ermitteln, die Mitglied dieser Gruppe sind
	function getUsers()
	{
		$db = db_connection();

		$sql = $db->sql( 'SELECT {{user}}.id,{{user}}.name FROM {{user}} '.
		                'LEFT JOIN {{usergroup}} ON {{usergroup}}.userid={{user}}.id '.
		                'WHERE {{usergroup}}.groupid={groupid}' );
		$sql->setInt('groupid',$this->groupid );

		return $sql->getAssoc( $sql );
	}
	

	// Benutzer ermitteln, die *nicht* Mitglied dieser Gruppe sind
	function getOtherUsers()
	{
		$db = db_connection();

		$sql = $db->sql( 'SELECT {{user}}.id,{{user}}.name FROM {{user}}'.
		                '   LEFT JOIN {{usergroup}} ON {{usergroup}}.userid={{user}}.id AND {{usergroup}}.groupid={groupid}'.
		                '   WHERE {{usergroup}}.groupid IS NULL' );
		$sql->setInt('groupid'  ,$this->groupid );

		return $sql->getAssoc( $sql );
	}


	// Benutzer einer Gruppe hinzufuegen
	function addUser( $userid )
	{
		$db = db_connection();

		$sql = $db->sql('SELECT MAX(id) FROM {{usergroup}}');
		$usergroupid = intval($sql->getOne($sql))+1;

		$sql = $db->sql( 'INSERT INTO {{usergroup}} '.
		                '       (id,userid,groupid) '.
		                '       VALUES( {usergroupid},{userid},{groupid} )' );
		$sql->setInt('usergroupid',$usergroupid  );
		$sql->setInt('userid'     ,$userid        );
		$sql->setInt('groupid'    ,$this->groupid );

		$sql->query( $sql );
	
	}


	// Benutzer aus Gruppe entfernen
	function delUser( $userid )
	{
		$db = db_connection();

		$sql = $db->sql( 'DELETE FROM {{usergroup}} '.
		                '  WHERE userid={userid} AND groupid={groupid}' );
		$sql->setInt   ('userid'  ,$userid        );
		$sql->setInt   ('groupid' ,$this->groupid );

		$sql->query( $sql );
	}


	// Alle Berechtigungen ermitteln
	function getRights()
	{
		global $SESS,$conf_php;
		$db = db_connection();
		$var = array();

		// Alle Projekte lesen
		$sql = $db->sql( 'SELECT id,name FROM {{project}}' );
		$projects = $sql->getAssoc( $sql );	

		foreach( $projects as $projectid=>$projectname )
		{
			$var[$projectid] = array();
			$var[$projectid]['name'] = $projectname;
			$var[$projectid]['folders'] = array();
			$var[$projectid]['rights'] = array();

			$sql = $db->sql( 'SELECT {{acl}}.* FROM {{acl}}'.
			                '  LEFT JOIN {{folder}} ON {{acl}}.folderid = {{folder}}.id'.
			                '  WHERE {{folder}}.projectid={projectid}'.
			                '    AND {{acl}}.groupid={groupid}' );
			$sql->setInt('projectid',$projectid    );
			$sql->setInt('groupid'   ,$this->groupid );
			
			$acls = $sql->getAll( $sql );

			foreach( $acls as $acl )
			{
				$aclid = $acl['id'];
				$folder = new Folder( $acl['folderid'] );
				$folder->load();
				$var[$projectid]['rights'][$aclid] = $acl;
				$var[$projectid]['rights'][$aclid]['foldername'] = implode(' &raquo; ',$folder->parentfolder( false,true ));
				$var[$projectid]['rights'][$aclid]['delete_url'] = 'user.'.$conf_php.'?useraction=delright&aclid='.$aclid;
			}
			
			$sql = $db->sql( 'SELECT id FROM {{folder}}'.
			                '  WHERE projectid={projectid}' );
			$sql->setInt('projectid',$projectid);
			$folders = $sql->getCol( $sql );

			$var[$projectid]['folders'] = array();

			foreach( $folders as $folderid )
			{
				$folder = new Folder( $folderid );
				$folder->load();
				$var[$projectid]['folders'][$folderid] = implode(' &raquo; ',$folder->parentfolder( false,true ));
			}

			asort( $var[$projectid]['folders'] );
		}
		
		return $var;
	}
	
	
	// Berechtigung der Gruppe hinzufuegen
	function addRight( $data )
	{
		global $REQ,$SESS;
		$db = db_connection();
		
		$sql = $db->sql('INSERT INTO {{acl}} '.
		               '(userid,groupid,folderid,`read`,`write`,`create`,`delete`,publish) '.
		               'VALUES({userid},{groupid},{folderid},{read},{write},{create},{delete},{publish})');
		               
		$sql->setNull('userid');
		$sql->setInt ('groupid',$this->groupid);
		$sql->setInt ('projectid',$SESS['projectid']);
		$sql->setInt ('folderid',$data['folderid']);

		$sql->setInt ('read'   ,$data['read'   ]);
		$sql->setInt ('write'  ,$data['write'  ]);
		$sql->setInt ('create' ,$data['create' ]);
		$sql->setInt ('delete' ,$data['delete' ]);
		$sql->setInt ('publish',$data['publish']);
	
		// Datenbankabfrage ausf?hren
		$sql->query( $sql );
	}

	
	
	/**
	 * Ermitteln aller Berechtigungen dieser Gruppe.<br>
	 * Diese Daten werden auf der Gruppenseite in der Administration angezeigt.
	 *
	 * @return unknown
	 */
	function getAllAcls()
	{
		$db = db_connection();
		$sql = $db->sql( 'SELECT {{acl}}.*,{{object}}.projectid,{{language}}.name AS languagename FROM {{acl}}'.
		                '  LEFT JOIN {{object}} '.
		                '         ON {{object}}.id={{acl}}.objectid '.
		                '  LEFT JOIN {{language}} '.
		                '         ON {{language}}.id={{acl}}.languageid '.
		                '  WHERE ( {{acl}}.groupid={groupid} OR ({{acl}}.userid IS NULL AND {{acl}}.groupid IS NULL) )'.
		                '  ORDER BY {{object}}.projectid,{{acl}}.languageid' );
		$sql->setInt  ( 'groupid'    ,$this->groupid );

		$aclList = array();

		foreach( $sql->getAll( $sql ) as $row )
		{
			$acl = new Acl();
			$acl->setDatabaseRow( $row );
			$acl->projectid    = $row['projectid'   ];
			if	( intval($acl->languageid) == 0 )
				$acl->languagename = lang('GLOBAL_ALL_LANGUAGES');
			else
				$acl->languagename = $row['languagename'];
			$aclList[] = $acl;
		}
		
		return $aclList;
	}
	


	// Berechtigung entfernen
	function delRight( $aclid )
	{
		$sql = $db->sql('DELETE FROM {{acl}} WHERE id={aclid}');
		$sql->setInt( 'aclid',$aclid );
	
		// Datenbankabfrage ausf?hren
		$sql->query( $sql );
	}
}

?>