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
// Revision 1.8  2004-12-19 15:20:27  dankert
// Korrektur delete()
//
// Revision 1.7  2004/11/28 19:25:51  dankert
// Anpassen an neue Sprachdatei-Konventionen
//
// Revision 1.6  2004/11/28 11:22:55  dankert
// Speichern einer Berechtigung fuer "alle"
//
// Revision 1.5  2004/11/15 21:02:32  dankert
// Erzeugen einer Bitmaske der Berechtigungsbits
//
// Revision 1.4  2004/11/10 22:45:06  dankert
// Neue Methode: getTrueProperties()
//
// Revision 1.3  2004/05/02 14:41:31  dankert
// Einf?gen package-name (@package)
//
// Revision 1.2  2004/04/30 20:36:25  dankert
// Neu: Freigabe
//
// Revision 1.1  2004/04/24 15:15:12  dankert
// Initiale Version
//
// --------------------------------------------------------------------------- 

define('ACL_READ'         ,1   );
define('ACL_WRITE'        ,2   );
define('ACL_PROP'         ,4   );
define('ACL_DELETE'       ,8   );
define('ACL_RELEASE'      ,16  );
define('ACL_PUBLISH'      ,32  );
define('ACL_CREATE_FOLDER',64  );
define('ACL_CREATE_FILE'  ,128 );
define('ACL_CREATE_LINK'  ,256 );
define('ACL_CREATE_PAGE'  ,512 );
define('ACL_GRANT'        ,1024);
define('ACL_TRANSMIT'     ,2048);

/**
 * Darstellen einer Berechtigung (ACL "Access Control List")
 * Die Berechtigung zu einem Objekt wird mit einer Liste dieser Objekte dargestellt
 *
 * Falls es mehrere ACLs zu einem Objekt gibt, werden die Berechtigung-Flags addiert.
 *
 * @version $Revision$
 * @author $Author$
 * @package openrat.objects
 */
class Acl
{
	/**
	  * eindeutige ID dieser ACL
	  * @type Integer
	  */
	var $aclid;

	/**
	  * ID des Objektes, f?r das diese Berechtigung gilt
	  * @type Integer
	  */
	var $objectid   = 0;

	/**
	  * ID des Benutzers
	  * ( = 0 falls die Berechtigung f?r eine Gruppe gilt)
	  * @type Integer
	  */
	var $userid     = 0;

	/**
	  * ID der Gruppe
	  * ( = 0 falls die Berechtigung f?r einen Benutzer gilt)
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
	  * Name des Benutzers, f?r den diese Berechtigung gilt
	  * @type String
	  */
	var $username   = '';

	/**
	  * Name der Gruppe, f?r die diese Berechtigung gilt
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
	  * Objekt l?schen
	  * @type Boolean
	  */
	var $delete        = false;

	/**
	  * Objektinhalt freigeben
	  * @type Boolean
	  */
	var $release       = false;

	/**
	  * Objekt ver?ffentlichen
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
	  * Verkn?pfung anlegen
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
	 * Laden einer ACL inklusive Benutzer-, Gruppen- und Sprachbezeichnungen
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
		
		$this->setDatabaseRow( $row );		

		if	( intval($this->languageid)==0 )
			$this->languagename = lang('GLOBAL_ALL_LANGUAGES');
		else	$this->languagename = $row['languagename'];
		$this->username     = $row['username'    ];
		$this->groupname    = $row['groupname'   ];
	}


	/**
	 * Laden einer ACL (ohne verknuepfte Namen)
	 */
	function loadRaw()
	{
		$db = db_connection();
		
		$sql = new Sql( 'SELECT * '.
		                '  FROM {t_acl} '.
		                '  WHERE {t_acl}.id={aclid}' );

		$sql->setInt('aclid',$this->aclid);
		
		$row = $db->getRow( $sql->query );

		$this->setDatabaseRow( $row );		
	}


	/**
	 * Setzt die Eigenschaften des Objektes mit einer Datenbank-Ergebniszeile
	 *
	 * @param row Ergebniszeile aus ACL-Datenbanktabelle
	 */
	function setDatabaseRow( $row )
	{
		$this->aclid         =   $row['id'];

		$this->write         = ( $row['is_write'        ] == '1' );
		$this->prop          = ( $row['is_prop'         ] == '1' );
		$this->delete        = ( $row['is_delete'       ] == '1' );
		$this->release       = ( $row['is_release'      ] == '1' );
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
	}

	function getProperties()
	{
		return Array( 'read'         => true,
		              'write'        => $this->write,
		              'prop'         => $this->prop,
		              'create_folder'=> $this->create_folder,
		              'create_file'  => $this->create_file,
		              'create_link'  => $this->create_link,
		              'create_page'  => $this->create_page,
		              'delete'       => $this->delete,
		              'release'      => $this->release,
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


	/**
	 * Erzeugt eine Bitmaske mit allen Berechtigungen
	 */
	function getMask()
	{
		// intval(boolean) erzeugt numerisch 0 oder 1
		$this->mask =  ACL_READ;   // immer lesen
		$this->mask += ACL_WRITE         *intval($this->write        );
		$this->mask += ACL_PROP          *intval($this->prop         );
		$this->mask += ACL_DELETE        *intval($this->delete       );
		$this->mask += ACL_RELEASE       *intval($this->release      );
		$this->mask += ACL_PUBLISH       *intval($this->publish      );
		$this->mask += ACL_CREATE_FOLDER *intval($this->create_folder);
		$this->mask += ACL_CREATE_FILE   *intval($this->create_file  );
		$this->mask += ACL_CREATE_LINK   *intval($this->create_link  );
		$this->mask += ACL_CREATE_PAGE   *intval($this->create_page  );
		$this->mask += ACL_GRANT         *intval($this->grant        );
		$this->mask += ACL_TRANSMIT      *intval($this->transmit     );
		Logger::trace('mask of acl'.$this->aclid.': '.$this->mask );
		return $this->mask;
	}


	function getTrueProperties()
	{
		$erg = array('read');
		if	( $this->write         ) $erg[] = 'write';
		if	( $this->prop          ) $erg[] = 'prop';
		if	( $this->create_folder ) $erg[] = 'create_folder';
		if	( $this->create_file   ) $erg[] = 'create_file';
		if	( $this->create_link   ) $erg[] = 'create_link';
		if	( $this->create_page   ) $erg[] = 'create_page';
		if	( $this->delete        ) $erg[] = 'delete';
		if	( $this->release       ) $erg[] = 'release';
		if	( $this->publish       ) $erg[] = 'publish';
		if	( $this->grant         ) $erg[] = 'grant';
		if	( $this->transmit      ) $erg[] = 'transmit';

		return $erg;
	}


	function delete()
	{
		$db = db_connection();
		
		$sql = new Sql( 'DELETE FROM {t_acl} '.
		                ' WHERE id      = {aclid}   '.
		                '   AND objectid= {objectid}' );

		$sql->setInt('aclid'   ,$this->aclid   );
		$sql->setInt('objectid',$this->objectid);
		
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
		                ' (id,userid,groupid,objectid,is_write,is_prop,is_create_folder,is_create_file,is_create_link,is_create_page,is_delete,is_release,is_publish,is_grant,is_transmit,languageid)'.
		                ' VALUES( {aclid},{userid},{groupid},{objectid},{write},{prop},{create_folder},{create_file},{create_link},{create_page},{delete},{release},{publish},{grant},{transmit},{languageid} )' );

		$sql->setInt('aclid'   ,$this->aclid   );
		$sql->setInt('objectid',$this->objectid);
		
		if	( intval($this->groupid) == 0 )
			$sql->setNull('groupid');
		else
			$sql->setInt ('groupid',$this->groupid);
		
		if	( intval($this->userid) == 0 )
			$sql->setNull('userid');
		else
			$sql->setInt ('userid',$this->userid);

		$sql->setBoolean('is_default'   ,$this->isDefault     );
		$sql->setBoolean('prop'         ,$this->prop          );
		$sql->setBoolean('write'        ,$this->write         );
		$sql->setBoolean('delete'       ,$this->delete        );
		$sql->setBoolean('release'      ,$this->release       );
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


//	function getACLsFromUserId( $userid )
//	{
//		$db = db_connection();
//		
//		$sql = new Sql( 'SELECT id FROM {t_acl} '.
//		                '  WHERE userid={userid}');
//		$sql->setInt('userid',$userid);
//
//		return $db->getCol( $sql->query );
//	}
//
//
//	function getACLsFromGroupId( $groupid )
//	{
//		$db = db_connection();
//		
//		$sql = new Sql( 'SELECT id FROM {t_acl} '.
//		                '  WHERE groupid={groupid}' );
//		$sql->setInt('groupid',$groupid);
//
//		return $db->getCol( $sql->query );
//	}
}