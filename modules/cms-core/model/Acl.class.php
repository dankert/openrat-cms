<?php

namespace cms\model;

/**
 * <editor-fold defaultstate="collapsed" desc="license">
 *
 *  OpenRat Content Management System
 *  Copyright (C) 2002-2012 Jan Dankert, cms@jandankert.de

 *  This program is free software; you can redistribute it and/or
 *  modify it under the terms of the GNU General Public License
 *  as published by the Free Software Foundation; either version 2
 *  of the License, or (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program; if not, write to the Free Software
 *  Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 *
 * </editor-fold>
 */







/**
 * Darstellen einer Berechtigung (ACL "Access Control List")
 * Die Berechtigung zu einem Objekt wird mit einer Liste dieser Objekte dargestellt
 *
 * Falls es mehrere ACLs zu einem Objekt gibt, werden die Berechtigung-Flags addiert.
 *
 * @author Jan Dankert
 */
class Acl extends ModelBase
{
    // Definition der Berechtigungs-Flags
    const ACL_READ          =    1;
    const ACL_WRITE         =    2;
    const ACL_PROP          =    4;
    const ACL_DELETE        =    8;
    const ACL_RELEASE       =   16;
    const ACL_PUBLISH       =   32;
    const ACL_CREATE_FOLDER =   64;
    const ACL_CREATE_FILE   =  128;
    const ACL_CREATE_LINK   =  256;
    const ACL_CREATE_PAGE   =  512;
    const ACL_GRANT         = 1024;
    const ACL_TRANSMIT      = 2048;

	/**
	  * eindeutige ID dieser ACL
	  * @type Integer
	  */
	public $aclid;

	/**
	  * ID des Objektes, f?r das diese Berechtigung gilt
	  * @type Integer
	  */
	public $objectid   = 0;

	/**
	  * ID des Benutzers
	  * ( = 0 falls die Berechtigung f?r eine Gruppe gilt)
	  * @type Integer
	  */
	public $userid     = 0;

	/**
	  * ID der Gruppe
	  * ( = 0 falls die Berechtigung f?r einen Benutzer gilt)
	  * @type Integer
	  */
	public $groupid    = 0;

	/**
	  * ID der Sprache
	  * @type Integer
	  */
	public $languageid = 0;

	/**
	  * Name der Sprache
	  * @type String
	  */
	public $languagename = '';

	/**
	  * Es handelt sich um eine Standard-Berechtigung
	  * (Falls false, dann Zugriffs-Berechtigung)
	  * @type Boolean
	  */
	public $isDefault  = false;

	/**
	  * Name des Benutzers, f?r den diese Berechtigung gilt
	  * @type String
	  */
	public $username   = '';

	/**
	  * Name der Gruppe, f?r die diese Berechtigung gilt
	  * @type String
	  */
	public $groupname  = '';

	/**
	  * Inhalt lesen (ist immer wahr)
	  * @type Boolean
	  */
	public $read          = true;

	/**
	  * Inhalt bearbeiten
	  * @type Boolean
	  */
	public $write         = false;

	/**
	  * Eigenschaften bearbeiten
	  * @type Boolean
	  */
	public $prop          = false;

	/**
	  * Objekt l?schen
	  * @type Boolean
	  */
	public $delete        = false;

	/**
	  * Objektinhalt freigeben
	  * @type Boolean
	  */
	public $release       = false;

	/**
	  * Objekt ver?ffentlichen
	  * @type Boolean
	  */
	public $publish       = false;

	/**
	  * Unterordner anlegen
	  * @type Boolean
	  */
	public $create_folder = false;

	/**
	  * Datei anlegen (bzw. hochladen)
	  * @type Boolean
	  */
	public $create_file   = false;

	/**
	  * Verknuepfung anlegen
	  * @type Boolean
	  */
	public $create_link   = false;

	/**
	  * Seite anlegen
	  * @type Boolean
	  */
	public $create_page   = false;

	/**
	  * Berechtigungen vergeben
	  * @type Boolean
	  */
	public $grant = false;

	/**
	  * Berechtigungen an Unterobjekte vererben
	  * @type Boolean
	  */
	public $transmit = false;


    public $projectid;


    /**
	 * Konstruktor.
	 * 
	 * @param Integer Acl-ID
	 */
	public function __construct( $aclid = 0 )
	{
		if	( $aclid != 0 )
			$this->aclid = $aclid;
	}


	/**
	 * Laden einer ACL inklusive Benutzer-, Gruppen- und Sprachbezeichnungen.
	 * Zum einfachen Laden sollte #loadRaw() benutzt werden.
	 */
	public function load()
	{
		$sql = db()->sql( 'SELECT {{acl}}.*,{{user}}.name as username,{{group}}.name as groupname,{{language}}.name as languagename'.
		                '  FROM {{acl}} '.
		                '    LEFT JOIN {{user}}     ON {{user}}.id     = {{acl}}.userid     '.
		                '    LEFT JOIN {{group}}    ON {{group}}.id    = {{acl}}.groupid    '.
		                '    LEFT JOIN {{language}} ON {{language}}.id = {{acl}}.languageid '.
		                '  WHERE {{acl}}.id={aclid}' );

		$sql->setInt('aclid',$this->aclid);
		
		$row = $sql->getRow();
		
		$this->setDatabaseRow( $row );		

		if	( intval($this->languageid)==0 )
			$this->languagename = lang('GLOBAL_ALL_LANGUAGES');
		else	$this->languagename = $row['languagename'];
		$this->username     = $row['username'    ];
		$this->groupname    = $row['groupname'   ];
	}


	/**
	 * Laden einer ACL (ohne verknuepfte Namen).
	 * Diese Methode ist schneller als #load().
	 */
	public function loadRaw()
	{
		$sql = db()->sql( 'SELECT * '.
		                '  FROM {{acl}} '.
		                '  WHERE {{acl}}.id={aclid}' );

		$sql->setInt('aclid',$this->aclid);
		
		$row = $sql->getRow();

		$this->setDatabaseRow( $row );		
	}


	/**
	 * Setzt die Eigenschaften des Objektes mit einer Datenbank-Ergebniszeile.
	 *
	 * @param row Ergebniszeile aus ACL-Datenbanktabelle
	 */
	public function setDatabaseRow( $row )
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

	
	/**
	 * Erzeugt eine Liste aller Berechtigungsbits dieser ACL.
	 * 
	 * @return Array (Schluessel=Berechtigungstyp, Wert=boolean)
	 */
	public function getProperties()
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
	 * Erzeugt eine Liste aller möglichen Berechtigungstypen.
	 * 
	 * @return 0..n-Array
	 */
	public static function getAvailableRights()
	{
		return array( 'read',
		              'write',
		              'prop',
		              'create_folder',
		              'create_file',
		              'create_link',
		              'create_page',
		              'delete',
		              'release',
		              'publish',
		              'grant',
		              'transmit' );

	}


	/**
	 * Erzeugt eine Bitmaske mit den Berechtigungen dieser ACL.
	 * 
	 * @return Integer Bitmaske
	 */
	public function getMask()
	{
		// intval(boolean) erzeugt numerisch 0 oder 1 :)
		$this->mask =  self::ACL_READ;   // immer lesen
		$this->mask += self::ACL_WRITE         *intval($this->write        );
		$this->mask += self::ACL_PROP          *intval($this->prop         );
		$this->mask += self::ACL_DELETE        *intval($this->delete       );
		$this->mask += self::ACL_RELEASE       *intval($this->release      );
		$this->mask += self::ACL_PUBLISH       *intval($this->publish      );
		$this->mask += self::ACL_CREATE_FOLDER *intval($this->create_folder);
		$this->mask += self::ACL_CREATE_FILE   *intval($this->create_file  );
		$this->mask += self::ACL_CREATE_LINK   *intval($this->create_link  );
		$this->mask += self::ACL_CREATE_PAGE   *intval($this->create_page  );
		$this->mask += self::ACL_GRANT         *intval($this->grant        );
		$this->mask += self::ACL_TRANSMIT      *intval($this->transmit     );
		
		\Logger::trace('mask of acl '.$this->aclid.': '.$this->mask );
		return $this->mask;
	}


	/**
	 * Erzeugt eine Liste aller gesetzten Berechtigungstypen.
	 * Beispiel: Array (0:'read',1:'write',2:'transmit')
	 * 
	 * @return 0..n-Array
	 */
	public function getTrueProperties()
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


	
	/**
	 * ACL unwiderruflich loeschen.
	 */
	public function delete()
	{
		$sql = db()->sql( 'DELETE FROM {{acl}} '.
		                ' WHERE id      = {aclid}   '.
		                '   AND objectid= {objectid}' );

		$sql->setInt('aclid'   ,$this->aclid   );
		$sql->setInt('objectid',$this->objectid);
		
		$sql->query();
		
		$this->aclid = 0;
	}


	/**
	 * ACL der Datenbank hinzufügen.
	 */
	public function add()
	{
		if	( $this->delete )
			$this->prop = true;
			
		// Pruefen, ob die ACL schon existiert
		$user_comp     = intval($this->userid    )>0?'={userid}':'IS NULL';
		$group_comp    = intval($this->groupid   )>0?'={groupid}':'IS NULL';
		$language_comp = intval($this->languageid)>0?'={languageid}':'IS NULL';
		
		$stmt = db()->sql( <<<SQL
		SELECT id FROM {{acl}}
		 WHERE userid      $user_comp      AND
		       groupid     $group_comp     AND
		       languageid  $language_comp  AND
		       objectid         = {objectid}      AND
		       is_write         = {write}         AND
		       is_prop          = {prop}          AND
		       is_create_folder = {create_folder} AND
		       is_create_file   = {create_file}   AND
		       is_create_link   = {create_link}   AND
		       is_create_page   = {create_page}   AND
		       is_delete        = {delete}        AND
		       is_release       = {release}       AND
		       is_publish       = {publish}       AND
		       is_grant         = {grant}         AND
		       is_transmit      = {transmit}
SQL
);

		if	( intval($this->userid) > 0 )
			$stmt->setInt ('userid',$this->userid);
		
		if	( intval($this->groupid) > 0 )
			$stmt->setInt ('groupid',$this->groupid);

        if	( intval($this->languageid) > 0 )
            $stmt->setInt ('languageid',$this->languageid);

        $stmt->setInt('objectid',$this->objectid);
        $stmt->setBoolean('write'        ,$this->write         );
        $stmt->setBoolean('prop'         ,$this->prop          );
        $stmt->setBoolean('create_folder',$this->create_folder );
        $stmt->setBoolean('create_file'  ,$this->create_file   );
        $stmt->setBoolean('create_link'  ,$this->create_link   );
        $stmt->setBoolean('create_page'  ,$this->create_page   );
        $stmt->setBoolean('delete'       ,$this->delete        );
        $stmt->setBoolean('release'      ,$this->release       );
        $stmt->setBoolean('publish'      ,$this->publish       );
        $stmt->setBoolean('grant'        ,$this->grant         );
        $stmt->setBoolean('transmit'     ,$this->transmit      );


        $aclid = intval($stmt->getOne());
		if	( $aclid > 0 )
		{
			// Eine ACL existiert bereits, wir übernehmen diese ID
			$this->aclid = $aclid;
			return;
		}

			


		$stmt = db()->sql('SELECT MAX(id) FROM {{acl}}');
		$this->aclid = intval($stmt->getOne())+1;
		
		$stmt = db()->sql( <<<SQL
		INSERT INTO {{acl}} 
		                 (id,userid,groupid,objectid,is_write,is_prop,is_create_folder,is_create_file,is_create_link,is_create_page,is_delete,is_release,is_publish,is_grant,is_transmit,languageid)
		                 VALUES( {aclid},{userid},{groupid},{objectid},{write},{prop},{create_folder},{create_file},{create_link},{create_page},{delete},{release},{publish},{grant},{transmit},{languageid} )
SQL
);

		$stmt->setInt('aclid'   ,$this->aclid   );
		
		if	( intval($this->userid) == 0 )
			$stmt->setNull('userid');
		else
			$stmt->setInt ('userid',$this->userid);
		
		if	( intval($this->groupid) == 0 )
			$stmt->setNull('groupid');
		else
			$stmt->setInt ('groupid',$this->groupid);

		$stmt->setInt('objectid',$this->objectid);
		$stmt->setBoolean('write'        ,$this->write         );
		$stmt->setBoolean('prop'         ,$this->prop          );
		$stmt->setBoolean('create_folder',$this->create_folder );
		$stmt->setBoolean('create_file'  ,$this->create_file   );
		$stmt->setBoolean('create_link'  ,$this->create_link   );
		$stmt->setBoolean('create_page'  ,$this->create_page   );
		$stmt->setBoolean('delete'       ,$this->delete        );
		$stmt->setBoolean('release'      ,$this->release       );
		$stmt->setBoolean('publish'      ,$this->publish       );
		$stmt->setBoolean('grant'        ,$this->grant         );
		$stmt->setBoolean('transmit'     ,$this->transmit      );

		if	( intval($this->languageid) == 0 )
			$stmt->setNull('languageid');
		else
			$stmt->setInt ('languageid',$this->languageid);

		$stmt->query();


	}

    /**
     * Liefert das Projekt-Objekt.
     *
     * @return Project
     * @throws \ObjectNotFoundException
     */
    public function getProject() {
        return Project::create( $this->projectid );
    }


}