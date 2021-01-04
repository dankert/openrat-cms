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
	public $groupid   = 0;
	public $parentid  = null;

	public $name     = '';


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
	 * Read all descendant groups.
	 */
	public function getAllDescendantsIds()
	{
		$children = [];

		foreach( $this->getChildrenIds() as $groupid ) {
			$children[] = $groupid;
			$childGroup = new Group( $groupid );
			$children = array_merge( $children, $childGroup->getAllDescendantsIds() );
		}

		return $children;
	}


	public function getParentGroups() {

		$parents = [];

		if   ( $this->parentid ) {
			$parents[] = $this->parentid;
			$parentGroup = new Group( $this->parentid );
			$parentGroup->load();
			$parents = array_merge( $parents, $parentGroup->getParentGroups() );
		}

		return $parents;
	}

	/**
	 * Read all direct child groups of this group.
	 */
	public function getChildrenIds()
	{
		$stmt = Db::sql( 'SELECT id FROM {{group}} WHERE parentid = {parentid}' );
		$stmt->setInt('parentid',$this->groupid );

		return $stmt->getCol();
	}

	/**
	 * Read all root groups.
	 *
	 * Root groups are groups without a parent group.
	 */
	public static function getRootGroups()
	{
		$stmt = Db::sql( 'SELECT id,name FROM {{group}} WHERE parentid IS NULL' );

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
		if	( count($row) > 0 )  {
			$this->name     = $row['name'    ];
			$this->parentid = $row['parentid'];
		}
		else {
			$this->name    = '';
			$this->groupid = null;
		}

	}


	public function getParentGroup()
	{
		return new Group($this->parentid);
	}

	public function getParentGroupIds() {
		$sql = Db::sql( 'SELECT id,parentid FROM {{group}}'.
			' WHERE id={groupid}' );
		$sql->setInt( 'groupid',$this->parentid );

		$row = $sql->getRow();
		if	( count($row) > 0 )  {
			$this->name     = $row['name'    ];
			$this->parentid = $row['parentid'];
		}
		else {
			$this->name    = '';
			$this->groupid = null;
		}

	}


    /**
     * Read a group.
     * @param $name string name of the group
     * @return Group|null
     */
	public static function loadWithName( $name )
	{
		$sql = Db::sql( <<<SQL
	SELECT id FROM {{group}}
	 WHERE name={name}
SQL
		);
		$sql->setString('name',$name );

		$row = $sql->getRow();

		if	( $row ) {
			$group = new Group($row['id']);
			$group->load();

			return $group;
		}

		return null;
	}


    /**
     * Save a group.
     */
	public function save()
	{
		// Recursion check.
		$descendantGroupoIds = $this->getAllDescendantsIds();
		if   ( $this->parentid == $this->groupid || in_array($this->parentid, $descendantGroupoIds ))
			throw new \LogicException('parent group is not allowed to be one of the descendant groups');

		if	( empty($this->name) )
			$this->name = \cms\base\Language::lang('GROUP').' '.$this->groupid;

		// Gruppe speichern
		$sql = Db::sql( <<<SQL
			UPDATE {{group}}
		          SET name     = {name},
			          parentid = {parentid}
		                WHERE id={groupid}
SQL
		);
		$sql->setInt      ('groupid' ,$this->groupid );
		$sql->setString   ('name'    ,$this->name    );
		$sql->setIntOrNull('parentid',$this->parentid);

		// Datenbankabfrage ausfuehren
		$sql->query();
	}


	/**
	 * Rueckgabe aller Eigenschaften
	 * @return array
	 */
	function getProperties()
	{
		return [ 'name'    =>$this->name,
		         'groupid' =>$this->groupid,
				 'parentid'=>$this->parentid
		];
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
	 * @return mixed
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
			$permission = new Permission();
			$permission->setDatabaseRow( $row );
			$permission->projectid    = $row['projectid'   ];
			if	( intval($permission->languageid) == 0 )
				$permission->languagename = \cms\base\Language::lang('ALL_LANGUAGES');
			else
				$permission->languagename = $row['languagename'];
			$aclList[] = $permission;
		}

		return $aclList;
	}


    public function getName()
    {
        return $this->name;
    }

	public function getId()
	{
		return $this->groupid;
	}

}