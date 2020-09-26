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


/**
 * Darstellen einer Sprache. Jeder Seiteninhalt wird einer Sprache zugeordnet.
 *
 * @version $Revision$
 * @author $Author$
 * @package openrat.objects
 */
class Language extends ModelBase
{
	public $languageid;
    public $projectid;

    public $name;
    public $isoCode;
    public $isDefault = false;


	// Konstruktor
	function __construct( $languageid='' )
	{
		if   ( is_numeric($languageid) )
			$this->languageid = $languageid;
	}

    public static function setLocale( $isoCode )
    {
        $localeConf = config()->subset('i18n')->subset('locale');

        if	( $localeConf->has(strtolower($isoCode)) )
        {
            $locale = $localeConf->get(strtolower($isoCode));
            $locale_ok = setlocale(LC_ALL,$locale);
            if	( !$locale_ok )
                // Hat nicht geklappt. Entweder ist das Mapping falsch oder die locale ist
                // nicht korrekt installiert.
                \logger\Logger::warn("Could not set locale '$locale', please check with 'locale -a' if it is installaled correctly");
        }
        else
        {
            setlocale(LC_ALL,'');
        }
    }


    /**
	 * Stellt fest, ob die angegebene Id existiert.
	 */
	function available( $id )
	{
		$db = \cms\base\DB::get();

		$sql = $db->sql('SELECT 1 FROM {{language}} '.
		               ' WHERE id={id}');
		$sql->setInt('id' ,$id  );

		return intval($sql->getOne()) == 1;
	}

	

	/**
     * Lesen aus der Datenbank.
     *
     */
	public function load()
	{
		$stmt = Db::sql( 'SELECT * FROM {{language}}'.
		                ' WHERE id={languageid}' );
		$stmt->setInt( 'languageid',$this->languageid );

		$row = $stmt->getRow();
		
		if	( count($row) > 0 )
		{
			$this->name      =         $row['name'     ];
			$this->isoCode   =         $row['isocode'  ];
			$this->projectid = intval( $row['projectid'] );
			
			$this->isDefault = ( $row['is_default'] == '1' );
		}
	}


	/**
     * Speichern der Sprache in der Datenbank
     */
	public function save()
	{
		$db = \cms\base\DB::get();

		// Gruppe speichern		
		$sql = $db->sql( 'UPDATE {{language}} '.
		                'SET name      = {name}, '.
		                '    isocode   = {isocode} '.
		                'WHERE id={languageid}' );
		$sql->setString( 'name'     ,$this->name    );
		$sql->setString( 'isocode'  ,$this->isoCode );

		$sql->setInt( 'languageid',$this->languageid );

		// Datenbankabfrage ausfuehren
		$sql->query();
	}


	/**
	 * Ermitteln aller Eigenschaften dieser Sprache
	 * @return Array
	 */
	function getProperties()
	{
		return Array( 'name'   =>$this->name,
		              'isocode'=>$this->isoCode );
	}


	/**
	 * Neue Sprache hinzuf?gen
	 */
	function add( $isocode='' )
	{
		global $SESS;
		global $iso;
		$db = \cms\base\DB::get();

		if	( $isocode != '' )
		{
			// Kleiner Trick, damit "no" (Norwegen) in der .ini-Datei stehen kann
			$isocode = str_replace('_','',$isocode);
			
			$this->isocode = $isocode;
			$codes = \util\GlobalFunctions::getIsoCodes();
			$this->name    = $codes[ $isocode ];
		}

		$sql = $db->sql('SELECT MAX(id) FROM {{language}}');
		$this->languageid = intval($sql->getOne())+1;

		// Sprache hinzuf?gen
		$sql = $db->sql( 'INSERT INTO {{language}} '.
		                '(id,projectid,name,isocode,is_default) VALUES( {languageid},{projectid},{name},{isocode},0 )');
		$sql->setInt   ('languageid',$this->languageid );
		$sql->setInt   ('projectid' ,$this->projectid  );
		$sql->setString('name'      ,$this->name       );
		$sql->setString('isocode'   ,$this->isoCode    );

		// Datenbankbefehl ausfuehren
		$sql->query();
	}


	// Diese Sprache als 'default' markieren.
	function setDefault()
	{
		global $SESS;
		$db = \cms\base\DB::get();

		// Zuerst alle auf nicht-Standard setzen
		$sql = $db->sql( 'UPDATE {{language}} '.
		                '  SET is_default = 0 '.
		                '  WHERE projectid={projectid}' );
		$sql->setInt('projectid',$this->projectid );
		$sql->query();
	
		// Jetzt die gew?nschte Sprachvariante auf Standard setzen
		$sql = $db->sql( 'UPDATE {{language}} '.
		                '  SET is_default = 1 '.
		                '  WHERE id={languageid}' );
		$sql->setInt('languageid',$this->languageid );
		$sql->query();
	}


	// Sprache entfernen
	function delete()
	{
		$db = \cms\base\DB::get();

		// Sprache l?schen
//		$sql = $db->sql( 'SELECT COUNT(*) FROM {{language}} WHERE projectid={projectid}' );
//		$sql->setInt( 'projectid',$this->projectid );
//		$count = $sql->getOne( $sql );
//		
//		// Nur l?schen, wenn es mindestens 2 Sprachen gibt
//		if   ( $count >= 2 )
//		{
			// Inhalte mit dieser Sprache l?schen
			$sql = $db->sql( 'DELETE FROM {{value}} WHERE languageid={languageid}' );
			$sql->setInt( 'languageid',$this->languageid );
			$sql->query();

			// Inhalte mit dieser Sprache l?schen
			$sql = $db->sql( 'DELETE FROM {{name}} WHERE languageid={languageid}' );
			$sql->setInt( 'languageid',$this->languageid );
			$sql->query();

			// Sprache l?schen
			$sql = $db->sql( 'DELETE FROM {{language}} WHERE id={languageid}' );
			$sql->setInt( 'languageid',$this->languageid );
			$sql->query();

			// Andere Sprache auf "Default" setzen
			$sql = $db->sql( 'SELECT id FROM {{language}} WHERE projectid={projectid}' );
			$sql->setInt( 'projectid',$this->projectid );
			$new_default_languageid = $sql->getOne();

			$sql = $db->sql( 'UPDATE {{language}} SET is_default=1 WHERE id={languageid}' );
			$sql->setInt( 'languageid',$new_default_languageid );
			$sql->query();
//		}
	}

    public function setCurrentLocale()
    {
        self::setLocale( $this->isoCode );
    }

    public function getName()
    {
        return $this->name;
    }

}

?>