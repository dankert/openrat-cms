<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
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
// ---------------------------------------------------------------------------
// $Log$
// Revision 1.3  2004-05-19 21:11:04  dankert
// korrektur bei delete()
//
// Revision 1.2  2004/05/02 14:41:31  dankert
// Einf?gen package-name (@package)
//
// ---------------------------------------------------------------------------


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

		$sql = new Sql( 'SELECT id,name FROM {t_group}' );

		return $db->getAssoc( $sql->query );
	}


	// Lesen Benutzer aus der Datenbank
	function load()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT * FROM {t_group}'.
		                ' WHERE id={groupid}' );
		$sql->setInt( 'groupid',$this->groupid );

		$row = $db->getRow( $sql->query );

		$this->name     = $row['name'    ];
	}


	// Speichern Benutzer in der Datenbank
	function save()
	{
		$db = db_connection();

		// Gruppe speichern		
		$sql = new Sql( 'UPDATE {t_group} '.
		                'SET name = {name} '.
		                'WHERE id={groupid}' );
		$sql->setString( 'name'  ,$this->name    );
		$sql->setInt   ('groupid',$this->groupid );

		// Datenbankabfrage ausfuehren
		$db->query( $sql->query );
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

		$sql = new Sql('SELECT MAX(id) FROM {t_group}');
		$this->groupid = intval($db->getOne($sql->query))+1;
		
		// Gruppe hinzuf?gen
		$sql = new Sql( 'INSERT INTO {t_group} '.
		                '(id,name) VALUES( {groupid},{name} )');
		$sql->setInt   ('groupid',$this->groupid );
		$sql->setString('name'   ,$this->name    );

		// Datenbankbefehl ausfuehren
		$db->query( $sql->query );
	}


	// Gruppe entfernen
	function delete()
	{
		$db = db_connection();

		// Berechtigungen zu dieser Gruppe loeschen
		$sql = new Sql( 'DELETE FROM {t_acl} '.
		                'WHERE group={groupid}' );
		$sql->setInt   ('groupid',$this->groupid );
		$db->query( $sql->query );


		// Alle Gruppenzugehoerigkeiten zu dieser Gruppe loeschen
		$sql = new Sql( 'DELETE FROM {t_usergroup} '.
		                'WHERE groupid={groupid}' );
		$sql->setInt   ('groupid',$this->groupid );
		$res = $db->query($sql->query);

		// Gruppe loeschen
		$sql = new Sql( 'DELETE FROM {t_group} '.
		                'WHERE id={groupid}' );
		$sql->setInt   ('groupid',$this->groupid );
		$res = $db->query($sql->query);
	}


	// Benutzer ermitteln, die Mitglied dieser Gruppe sind
	function getUsers()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT {t_user}.id,{t_user}.name FROM {t_user} '.
		                'LEFT JOIN {t_usergroup} ON {t_usergroup}.userid={t_user}.id '.
		                'WHERE {t_usergroup}.groupid={groupid}' );
		$sql->setInt('groupid',$this->groupid );

		return $db->getAssoc( $sql->query );
	}
	

	// Benutzer ermitteln, die *nicht* Mitglied dieser Gruppe sind
	function getOtherUsers()
	{
		$db = db_connection();

		$sql = new Sql( 'SELECT {t_user}.id,{t_user}.name FROM {t_user}'.
		                '   LEFT JOIN {t_usergroup} ON {t_usergroup}.userid={t_user}.id AND {t_usergroup}.groupid={groupid}'.
		                '   WHERE {t_usergroup}.groupid IS NULL' );
		$sql->setInt('groupid'  ,$this->groupid );

		return $db->getAssoc( $sql->query );
	}


	// Benutzer einer Gruppe hinzufuegen
	function addUser( $userid )
	{
		$db = db_connection();

		$sql = new Sql('SELECT MAX(id) FROM {t_usergroup}');
		$usergroupid = intval($db->getOne($sql->query))+1;

		$sql = new Sql( 'INSERT INTO {t_usergroup} '.
		                '       (id,userid,groupid) '.
		                '       VALUES( {usergroupid},{userid},{groupid} )' );
		$sql->setInt('usergroupid',$usergroupid  );
		$sql->setInt('userid'     ,$userid        );
		$sql->setInt('groupid'    ,$this->groupid );

		$db->query( $sql->query );
	
	}


	// Benutzer aus Gruppe entfernen
	function delUser( $userid )
	{
		$db = db_connection();

		$sql = new Sql( 'DELETE FROM {t_usergroup} '.
		                '  WHERE userid={userid} AND groupid={groupid}' );
		$sql->setInt   ('userid'  ,$userid        );
		$sql->setInt   ('groupid' ,$this->groupid );

		$db->query( $sql->query );
	}


	// Alle Berechtigungen ermitteln
	function getRights()
	{
		global $SESS,$conf_php;
		$db = db_connection();
		$var = array();

		// Alle Projekte lesen
		$sql = new Sql( 'SELECT id,name FROM {t_project}' );
		$projects = $db->getAssoc( $sql->query );	

		foreach( $projects as $projectid=>$projectname )
		{
			$var[$projectid] = array();
			$var[$projectid]['name'] = $projectname;
			$var[$projectid]['folders'] = array();
			$var[$projectid]['rights'] = array();

			$sql = new Sql( 'SELECT {t_acl}.* FROM {t_acl}'.
			                '  LEFT JOIN {t_folder} ON {t_acl}.folderid = {t_folder}.id'.
			                '  WHERE {t_folder}.projectid={projectid}'.
			                '    AND {t_acl}.groupid={groupid}' );
			$sql->setInt('projectid',$projectid    );
			$sql->setInt('groupid'   ,$this->groupid );
			
			$acls = $db->getAll( $sql->query );

			foreach( $acls as $acl )
			{
				$aclid = $acl['id'];
				$folder = new Folder( $acl['folderid'] );
				$folder->load();
				$var[$projectid]['rights'][$aclid] = $acl;
				$var[$projectid]['rights'][$aclid]['foldername'] = implode(' &raquo; ',$folder->parentfolder( false,true ));
				$var[$projectid]['rights'][$aclid]['delete_url'] = 'user.'.$conf_php.'?useraction=delright&aclid='.$aclid;
			}
			
			$sql = new Sql( 'SELECT id FROM {t_folder}'.
			                '  WHERE projectid={projectid}' );
			$sql->setInt('projectid',$projectid);
			$folders = $db->getCol( $sql->query );

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
		
		$sql = new SQL('INSERT INTO {t_acl} '.
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
		$db->query( $sql->query );
	}


	// Berechtigung entfernen
	function delRight( $aclid )
	{
		$sql = new SQL('DELETE FROM {t_acl} WHERE id={aclid}');
		$sql->setInt( 'aclid',$aclid );
	
		// Datenbankabfrage ausf?hren
		$db->query( $sql->query );
	}
}

?>