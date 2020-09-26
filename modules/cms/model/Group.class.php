<?php
namespace cms\model;
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
use cms\base\DB as Db;
use util\Session;


/**
 * Darstellen einer Benutzergruppe. Eine Gruppe enthaelt beliebig viele Benutzer
 *
 * @version $Revision$
 * @author $Author$
 * @package openrat.objects
 */
class Group extends ModelBase
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
	function __construct( $groupid='' )
	{
		if   ( is_numeric($groupid) )
			$this->groupid = $groupid;
	}


	/**
	* Read all groups
     */
	public static function getAll()
	{
		$stmt = Db::sql( 'SELECT id,name FROM {{group}}' );

		return $stmt->getAssoc();
	}


	/**
     * Lesen Gruppe aus der Datenbank
     */
	public function load()
	{
		$sql = Db::sql( 'SELECT * FROM {{group}}'.
		                ' WHERE id={groupid}' );
		$sql->setInt( 'groupid',$this->groupid );

		$row = $sql->getRow();
		if	( count($row) > 0 )
			$this->name = $row['name'    ];
		else
			$this->name = '';
	}


    /**
     * Read a group.
     * @param $name string name of the group
     * @return Group
     * @throws \ObjectNotFoundException
     */
	public static function loadWithName( $name )
	{
		$sql = Db::sql( 'SELECT * FROM {{group}}'.
		                ' WHERE name={name}' );
		$sql->setString('name',$name );

		$row = $sql->getRow();
		if	( count($row) > 0 )
		{
			$group = new Group( $row['id'] );
			$group->load();
			
			return $group;
		}
		else
		{
			throw new \ObjectNotFoundException( "Group does not exist: ".$name);
		}
	}


    /**
     * Save a group.
     */
	public function save()
	{
		if	( empty($this->name) )
			$this->name = \cms\base\Language::lang('GROUP').' '.$this->groupid;
			
		// Gruppe speichern
		$sql = Db::sql( 'UPDATE {{group}} '.
		                'SET name = {name} '.
		                'WHERE id={groupid}' );
		$sql->setString( 'name'  ,$this->name    );
		$sql->setInt   ('groupid',$this->groupid );

		// Datenbankabfrage ausfuehren
		$sql->query();
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
		$db = \cms\base\DB::get();

		if	( $name != '' )
			$this->name = $name;

		$sql = $db->sql('SELECT MAX(id) FROM {{group}}');
		$this->groupid = intval($sql->getOne())+1;
		
		// Gruppe hinzuf?gen
		$sql = $db->sql( 'INSERT INTO {{group}} '.
		                '(id,name) VALUES( {groupid},{name} )');
		$sql->setInt   ('groupid',$this->groupid );
		$sql->setString('name'   ,$this->name    );

		// Datenbankbefehl ausfuehren
		$sql->query();
	}


	// Gruppe entfernen
	function delete()
	{
		$db = \cms\base\DB::get();

		// Berechtigungen zu dieser Gruppe loeschen
		$sql = $db->sql( 'DELETE FROM {{acl}} '.
		                'WHERE groupid={groupid}' );
		$sql->setInt   ('groupid',$this->groupid );
		$sql->query();


		// Alle Gruppenzugehoerigkeiten zu dieser Gruppe loeschen
		$sql = $db->sql( 'DELETE FROM {{usergroup}} '.
		                'WHERE groupid={groupid}' );
		$sql->setInt   ('groupid',$this->groupid );
		$sql->query();

		// Gruppe loeschen
		$sql = $db->sql( 'DELETE FROM {{group}} '.
		                'WHERE id={groupid}' );
		$sql->setInt   ('groupid',$this->groupid );
		$sql->query();
	}


    /**
     * Get all users of this group.
     * @return array id->name
     */
	function getUsers()
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql( 'SELECT {{user}}.id,{{user}}.name FROM {{user}} '.
		                'LEFT JOIN {{usergroup}} ON {{usergroup}}.userid={{user}}.id '.
		                'WHERE {{usergroup}}.groupid={groupid}' );
		$sql->setInt('groupid',$this->groupid );

		return $sql->getAssoc();
	}
	

	// Benutzer ermitteln, die *nicht* Mitglied dieser Gruppe sind
	function getOtherUsers()
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql( 'SELECT {{user}}.id,{{user}}.name FROM {{user}}'.
		                '   LEFT JOIN {{usergroup}} ON {{usergroup}}.userid={{user}}.id AND {{usergroup}}.groupid={groupid}'.
		                '   WHERE {{usergroup}}.groupid IS NULL' );
		$sql->setInt('groupid'  ,$this->groupid );

		return $sql->getAssoc();
	}


	// Benutzer einer Gruppe hinzufuegen
	function addUser( $userid )
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql('SELECT MAX(id) FROM {{usergroup}}');
		$usergroupid = intval($sql->getOne())+1;

		$sql = $db->sql( 'INSERT INTO {{usergroup}} '.
		                '       (id,userid,groupid) '.
		                '       VALUES( {usergroupid},{userid},{groupid} )' );
		$sql->setInt('usergroupid',$usergroupid  );
		$sql->setInt('userid'     ,$userid        );
		$sql->setInt('groupid'    ,$this->groupid );

		$sql->query();
	
	}


	// Benutzer aus Gruppe entfernen
	function delUser( $userid )
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql( 'DELETE FROM {{usergroup}} '.
		                '  WHERE userid={userid} AND groupid={groupid}' );
		$sql->setInt   ('userid'  ,$userid        );
		$sql->setInt   ('groupid' ,$this->groupid );

		$sql->query();
	}


	// Alle Berechtigungen ermitteln
	function getRights()
	{
		$db = \cms\base\DB::get();
		$var = array();

		// Alle Projekte lesen
		$sql = $db->sql( 'SELECT id,name FROM {{project}}' );
		$projects = $sql->getAssoc();

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
			
			$acls = $sql->getAll();

			foreach( $acls as $acl )
			{
				$aclid = $acl['id'];
				$folder = new Folder( $acl['folderid'] );
				$folder->load();
				$var[$projectid]['rights'][$aclid] = $acl;
				$var[$projectid]['rights'][$aclid]['foldername'] = implode(' &raquo; ',$folder->parentfolder( false,true ));
			}
			
			$sql = $db->sql( 'SELECT id FROM {{folder}}'.
			                '  WHERE projectid={projectid}' );
			$sql->setInt('projectid',$projectid);
			$folders = $sql->getCol();

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
	

	
	/**
	 * Ermitteln aller Berechtigungen dieser Gruppe.<br>
	 * Diese Daten werden auf der Gruppenseite in der Administration angezeigt.
	 *
	 * @return unknown
	 */
	function getAllAcls()
	{
		$db = \cms\base\DB::get();
		$sql = $db->sql( 'SELECT {{acl}}.*,{{object}}.projectid,{{language}}.name AS languagename FROM {{acl}}'.
		                '  LEFT JOIN {{object}} '.
		                '         ON {{object}}.id={{acl}}.objectid '.
		                '  LEFT JOIN {{language}} '.
		                '         ON {{language}}.id={{acl}}.languageid '.
		                '  WHERE ( {{acl}}.groupid={groupid} OR ({{acl}}.userid IS NULL AND {{acl}}.groupid IS NULL) )'.
		                '  ORDER BY {{object}}.projectid,{{acl}}.languageid' );
		$sql->setInt  ( 'groupid'    ,$this->groupid );

		$aclList = array();

		foreach($sql->getAll() as $row )
		{
			$acl = new Acl();
			$acl->setDatabaseRow( $row );
			$acl->projectid    = $row['projectid'   ];
			if	( intval($acl->languageid) == 0 )
				$acl->languagename = \cms\base\Language::lang('ALL_LANGUAGES');
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

    public function getName()
    {
        return $this->name;
    }

}

?>