<?php


namespace cms\model;

use cms\base\Configuration;
use cms\base\DB as Db;
use cms\base\Startup;
use cms\generator\Publisher;
use util\ArrayUtils;
use phpseclib\Math\BigInteger;
use util\text\variables\VariableResolver;
use util\YAML;

/**
 * Base class for all objects in the content tree.
 *
 * @author Jan Dankert
 */
class BaseObject extends ModelBase
{
    const TYPEID_FOLDER = 1;
    const TYPEID_FILE   = 2;
    const TYPEID_PAGE   = 3;
    const TYPEID_LINK   = 4;
    const TYPEID_URL    = 5;
    const TYPEID_IMAGE  = 6;
    const TYPEID_TEXT   = 7;
    const TYPEID_ALIAS  = 8;
    const TYPEID_MACRO  = 9;

    const TYPE_FOLDER = 'folder';
    const TYPE_FILE   = 'file'  ;
    const TYPE_PAGE   = 'page'  ;
    const TYPE_LINK   = 'link'  ;
    const TYPE_URL    = 'url'   ;
    const TYPE_IMAGE  = 'image' ;
    const TYPE_TEXT   = 'text'  ;
    const TYPE_ALIAS  = 'alias' ;
    const TYPE_MACRO  = 'macro' ;

    /** eindeutige ID dieses Objektes
     * @type Integer
     */
    public $objectid;

    /**
	 * Parent-Id.
	 *
	 * Object-Id of the folder, which this objects belongs to.
	 *
     * Is 0 in case of the root folder.
	 *
     * @see #isRoot()
     * @type Integer
     */
    public $parentid = null;

    /** Filename.
	 *
	 * Technical filename of this object without any extension. This name must be unique in a folder.
	 *
     * @type String
     */
    public $filename = '';


    /** Zeitpunkt der Erstellung. Die Variable beinhaltet den Unix-Timestamp.
     * @type Integer
     */
    var $createDate;

    /** Zeitpunkt der letzten Aenderung. Die Variable beinhaltet den Unix-Timestamp.
     * @type Integer
     */
    var $lastchangeDate;

    /** Benutzer, welcher dieses Objekt erstellt hat.
     * @type User
     */
    public $createUser;

    /** Benutzer, welcher dieses Objekt zuletzt geaendert hat.
     * @type User
     */
    public $lastchangeUser;

    /**
     * Benutzer, der das Objekt zuletzt veröffentlicht hat.
     * @var User
     */
    public $publishedUser;
    /**
     * Zeitpunkt der letzten Veröffentlichung.
     * @var Integer
     */
    public $publishedDate;


	/**
	 * Valid from.
	 *
	 * This is a unix-timestamp.
	 *
	 * @var int
	 */
    public $validFromDate;

	/**
	 * Valid to.
	 *
	 * This is a unix-timestamp.
	 *
	 * @var int
	 */
    public $validToDate;

    /**
     * Kennzeichen, ob Objekt ein Ordner ist
     * @type Boolean
     */
    var $isFolder = false;

    /**
     * Kennzeichen, ob Objekt eine binaere Datei ist
     * @type Boolean
     */
    var $isFile = false;

    /**
     * Kennzeichen, ob Objekt ein Bild ist
     * @type Boolean
     */
    var $isImage = false;

    /**
     * Kennzeichen, ob Objekt ein Text ist
     * @type Boolean
     */
    var $isText = false;

    /**
     * Kennzeichen, ob Objekt eine Seite ist
     * @type Boolean
     */
    var $isPage = false;

    /**
     * Kennzeichen, ob Objekt eine Verknuepfung (Link) ist
     * @type Boolean
     */
    var $isLink = false;

    /**
     * Kennzeichen, ob Objekt eine Verknuepfung (Url) ist
     * @type Boolean
     */
    var $isUrl = false;

    /**
     * Kennzeichen, ob Objekt ein Alias ist
     * @type Boolean
     */
    var $isAlias = false;

    /**
     * Kennzeichen, ob Objekt ein Alias ist
     * @type Boolean
     */
    var $isMacro = false;

    /**
     * Kennzeichnet den Typ dieses Objektes.
     * Muss den Inhalt OR_FILE, OR_FOLDER, OR_PAGE oder OR_LINK haben.
     * Vorbelegung mit <code>null</code>.
     * @type Integer
     */
    var $type = null;


    /**
     * Projekt-ID
     * @see Project
     * @type Integer
     */
    public $projectid;


    public $typeid;

	private $aclMask = null;
	private $parentfolders = array();

    /**
     * @type String
     */
    public $settings;

    /**
     * Strategy for publishing objects.
     * @var Publisher
     */
    public $publisher;

    /** <strong>Konstruktor</strong>
     * F?llen des neuen Objektes mit Init-Werten
     * Es werden die Standardwerte aus der Session benutzt, um
     * Sprach-ID, Projektmodell-Id und Projekt-ID zu setzen
     *
     * @param Integer Objekt-ID (optional)
     */
    function __construct($objectid = '')
    {
        if	( is_numeric($objectid) )
        {
            $this->objectid = $objectid;
        }
    }


    /**
     * Kompletten Dateinamen des Objektes erzeugen
     * @return String
     */
    public function full_filename()
    {
        $path = $this->path();

        if ($path != '')
            $path.= '/';

        $path.= $this->filename();

        return $path;
    }

    /**
     * Pruefen einer Berechtigung zu diesem Objekt
     */
    public function hasRight( $type )
    {
        if	( is_null($this->aclMask) )
        {
			$user     = \util\Session::getUser();

			$this->aclMask = 0;

			if  ( ! $user ) {
                // Anonymous

                $sql = Db::sql( <<<SQL
    SELECT * FROM  {{acl}}
             WHERE objectid={objectid}
               AND type = {guest}
SQL
                );

                $sql->setInt  ( 'objectid' ,$this->objectid              );
                $sql->setInt  ( 'guest'    ,Permission::TYPE_GUEST );

                foreach($sql->getAll() as $row )
                {
                    $permission = new Permission();
                    $permission->setDatabaseRow( $row );

                    $this->aclMask |= $permission->getMask();
                }

            }

			elseif	( $user->isAdmin )
            {
                // Administrators got all rights
                $this->aclMask = Permission::ACL_ALL;
            }
            else
            {
            	// Normal user
                $this->aclMask = 0;

                $sqlGroupClause = $user->getGroupClause();
                $sql = Db::sql( <<<SQL
         SELECT * FROM  {{acl}}
                 WHERE objectid={objectid}
                   --AND ( languageid={languageid} OR languageid IS NULL )
                   AND (    type = {user}  AND userid={userid} 
                         OR type = {group} AND $sqlGroupClause
                         OR type = {all}
                         OR type = {guest}
                       )
SQL
                );

                $sql->setInt  ( 'objectid'    ,$this->objectid         );
                $sql->setInt  ( 'userid'      ,$user->userid           );
				$sql->setInt  ( 'user'        ,Permission::TYPE_USER );
				$sql->setInt  ( 'group'       ,Permission::TYPE_GROUP);
				$sql->setInt  ( 'all'         ,Permission::TYPE_AUTH );
				$sql->setInt  ( 'guest'       ,Permission::TYPE_GUEST );

				foreach($sql->getAll() as $row )
                {
                    $permission = new Permission();
                    $permission->setDatabaseRow( $row );

                    $this->aclMask |= $permission->getMask();
                }
            }
        }

        if	( Startup::readonly() )
            // System is readonly.
        	// The maximum permission is readonly.
            $this->aclMask = Permission::ACL_READ && $this->aclMask;

        // Ermittelte Maske auswerten
        return $this->aclMask & $type;
    }


    /**
     * Typ des Objektes ermitteln
     *
     * @return String der Typ des Objektes entweder 'folder','file','page' oder 'link'.
     */
    function getType()
    {
        if ($this->isFolder)
            return self::TYPE_FOLDER;
        if ($this->isFile)
            return self::TYPE_FILE;
        if ($this->isImage)
            return self::TYPE_IMAGE;
        if ($this->isText)
            return self::TYPE_TEXT;
        if ($this->isPage)
            return self::TYPE_PAGE;
        if ($this->isLink)
            return self::TYPE_LINK;
        if ($this->isUrl)
            return self::TYPE_URL;
        if ($this->isAlias)
            return self::TYPE_ALIAS;
        if ($this->isMacro)
            return self::TYPE_MACRO;

        return 'unknown';
    }


    /**
     * Eigenschaften des Objektes. Kann durch Unterklassen erweitert werden.
     * @return array
     */
    public function getProperties()
    {
        return [
			'id'               =>$this->objectid,
            'objectid'         =>$this->objectid,
            'parentid'         =>$this->parentid,
            'filename'         =>$this->filename,
            'create_date'      =>$this->createDate,
            'create_user'      =>$this->createUser->getProperties(),
            'lastchange_date'  =>$this->lastchangeDate,
            'lastchange_user'  =>$this->lastchangeUser->getProperties(),
            'published_date'   =>$this->publishedDate,
            'published_user'   =>$this->publishedUser->getProperties(),
            'isFolder'         =>$this->isFolder,
            'isFile'           =>$this->isFile,
            'isImage'          =>$this->isImage,
            'isText'           =>$this->isText,
            'isLink'           =>$this->isLink,
            'isUrl'            =>$this->isUrl,
            'isPage'           =>$this->isPage,
            'isRoot'           =>$this->isRoot(),
            'projectid'        =>$this->projectid,
            'settings'         =>$this->settings,
            'valid_from_date'  =>$this->validFromDate,
            'valid_to_date'    =>$this->validToDate,
            'type'             =>$this->getType()
		];
    }


    /**
     * Ermitteln des physikalischen Dateipfades, in dem sich das Objekt befindet
     * @return String Pfadangabe, z.B. 'pfad/zu/objekt'
     */
    public function path()
    {
        $alias = $this->getAlias();

        if  ( $alias )
            $folder = new Folder($alias->parentid);
        else
            $folder = new Folder($this->parentid);

        return implode('/', $folder->parentObjectFileNames(false, true));
    }



    /**
     * Creates a slug url out of the filename.
     *
     * @param $filename String Name
     * @return string
     */
    public static function urlify( $filename )
    {
        $slug = $filename;

        // The hard method to replace UTF-8-chars with their alphanumeric replacement.
        $replacements = array(
            // German umlauts
            "\xc3\x84" => 'ae',
            "\xc3\xa4" => 'ae',
            "\xc3\x9c" => 'ue',
            "\xc3\xbc" => 'ue',
            "\xc3\x96" => 'oe',
            "\xc3\xb6" => 'oe',
            "\xc3\x9f" => 'ss',
            "\xe2\x82\xac" => 'eur',
            // Francais
            "\xc3\xa0" => 'a',
            "\xc3\xa1" => 'a',
            "\xc3\xa2" => 'a',
            "\xc3\xa3" => 'a',
            "\xc3\xa5" => 'a',
            "\xc3\xa6" => 'ae',
            "\xc3\xa7" => 'c',
            "\xc3\xa8" => 'e',
            "\xc3\xa9" => 'e',
            "\xc3\xaa" => 'e',
            "\xc3\xab" => 'e',
            "\xc3\xac" => 'i',
            "\xc3\xad" => 'i',
            "\xc3\xae" => 'i',
            "\xc3\xaf" => 'i',
            "\xc3\xb2" => 'o',
            "\xc3\xb3" => 'o',
            "\xc3\xb4" => 'o',
            "\xc3\xb5" => 'o',
            "\xc3\xb8" => 'o',
            "\xc3\xb9" => 'u',
            "\xc3\xba" => 'u',
            "\xc3\xbb" => 'u',
            "\xc3\xbd" => 'y',
            "\xc3\xbf" => 'y',
            "\xc3\x80" => 'a',
            "\xc3\x81" => 'a',
            "\xc3\x82" => 'a',
            "\xc3\x83" => 'a',
            "\xc3\x85" => 'a',
            "\xc3\x86" => 'ae',
            "\xc3\x87" => 'c',
            "\xc3\x88" => 'e',
            "\xc3\x89" => 'e',
            "\xc3\x8a" => 'e',
            "\xc3\x8b" => 'e',
            "\xc3\x8c" => 'i',
            "\xc3\x8d" => 'i',
            "\xc3\x8e" => 'i',
            "\xc3\x8f" => 'i',
            "\xc3\x92" => 'o',
            "\xc3\x93" => 'o',
            "\xc3\x94" => 'o',
            "\xc3\x95" => 'o',
            "\xc3\x98" => 'o',
            "\xc3\x99" => 'u',
            "\xc3\x9a" => 'u',
            "\xc3\x9b" => 'u',
            "\xc3\x9d" => 'y',
        );

        $slug = str_replace(array_keys($replacements), array_values($replacements), $slug);

        // 2nd try is to use iconv with the current locale.
		if ( function_exists('iconv') ) {
			Language::setLocale(Configuration::subset('language')->get('language_code', 'en'));
			// iconv is buggy on alpine 3 and does not support TRANSLIT. So we have to catch the error here.
			$converted = @iconv('utf-8', 'ascii//TRANSLIT', $slug);
			if   ( $converted !== false )
				$slug = $converted;
		}
        // now replace every unpleasant char with a hyphen.
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $slug);

        // trim and lowercase.
        $slug = trim($slug, '-');
        $slug = strtolower($slug);

        return $slug;
    }



    public function getParentFolderId()
    {
        $alias = $this->getAlias();
        if ( $alias )
            return $alias->parentid;
        else
            return $this->parentid;
    }


    /**
     * Ermitteln des Dateinamens und Rueckgabe desselben
     * @return String Dateiname
     */
    public function filename()
    {
        $filenameConfig = Configuration::subset('filename');

        $filename = $this->filename;

        $alias = $this->getAlias();

        if ( $alias )
            $filename = $alias->filename;

        if	( $filenameConfig->is('edit',true) && $filename != '' && $filename != $this->objectid )
        {
            // do not change the filename here - otherwise there is a danger of filename collisions.
            return $filename;
        }

		// Filename is not edited, so we are generating a pleasant filename.
		switch( $filenameConfig->get('style','short' ) )
		{
			case 'longid':
				// Eine etwas laengere ID als Dateinamen benutzen
				return base_convert(str_pad($this->objectid,6,'a'),11,10);
				break;

			case 'longalpha':
				// Eine etwas laengere ID als Dateinamen benutzen
				return base_convert(str_pad($this->objectid,6,'a'),11,36);
				break;

			case 'short':
				// As shortly as possible
				// Examples:
				// 1  -> 1
				// 10 -> a
				return base_convert($this->objectid,10,36);

			case 'md5':   // Removed, because collisions are possible.
			case 'title': // Not possible any more because of the collision danger
			case 'ss':    // Old storyserver crap (removed)
			case 'id':
			default:
				// Taking the object id as filename.
				return $this->objectid;

		}
    }



    /**
     * Stellt fest, ob das Objekt mit der angegebenen Id existiert.
     */
    public static function available( $objectid )
    {
        $db = \cms\base\DB::get();

        // Vielleicht k�nnen wir uns den DB-Zugriff auch ganz sparen.
        if	( !is_numeric($objectid) || $objectid <= 0 )
            return false; // Objekt-Id ung�ltig.

        $sql = $db->sql('SELECT 1 FROM {{object}} '.
            ' WHERE id={objectid}');
        $sql->setInt('objectid'  , $objectid  );

        return intval($sql->getOne()) == 1;
    }


    /**
     * Lesen der Eigenschaften aus der Datenbank
     * Es werden
     * - die sprachunabh?ngigen Daten wie Dateiname, Typ sowie Erstellungs- und ?nderungsdatum geladen
     * - die sprachabh?ngigen Daten wie Name und Beschreibung geladen
     * @throws \util\exception\ObjectNotFoundException
     */
    function objectLoad()
    {
        $db = \cms\base\DB::get();

        $stmt = $db->sql( <<<SQL
			SELECT {{object}}.*,
                   lastchangeuser.name     as lastchange_username,     
                   lastchangeuser.fullname as lastchange_userfullname, 
                   lastchangeuser.mail     as lastchange_usermail,     
                   publisheduser.name      as published_username,     
                   publisheduser.fullname  as published_userfullname, 
                   publisheduser.mail      as published_usermail,     
                   createuser.name         as create_username,     
                   createuser.fullname     as create_userfullname, 
                   createuser.mail         as create_usermail      
             FROM {{object}}
             LEFT JOIN {{user}} as lastchangeuser 
                    ON {{object}}.lastchange_userid=lastchangeuser.id 
             LEFT JOIN {{user}} as publisheduser 
                    ON {{object}}.published_userid=publisheduser.id 
             LEFT JOIN {{user}} as createuser 
                    ON {{object}}.create_userid=createuser.id 
             WHERE {{object}}.id={objectid}
SQL
		);
        $stmt->setInt('objectid'  , $this->objectid  );

        $row = $stmt->getRow();

        if (count($row) == 0)
            throw new \util\exception\ObjectNotFoundException('object '.$this->objectid.' not found');

        $this->setDatabaseRow( $row );
    }


    /**
     * Lesen der Eigenschaften aus der Datenbank
     * Es werden
     * - die sprachunabhaengigen Daten wie Dateiname, Typ sowie Erstellungs- und Aenderungsdatum geladen
     */
    function objectLoadRaw()
    {
        $db = \cms\base\DB::get();

        $sql = $db->sql('SELECT * FROM {{object}}'.
            ' WHERE {{object}}.id={objectid}');
        $sql->setInt('objectid'  , $this->objectid  );
        $row = $sql->getRow();

        if (count($row) == 0)
            throw new \util\exception\ObjectNotFoundException('objectid not found: '.$this->objectid);

        $this->parentid  = $row['parentid' ];
        $this->filename  = $row['filename' ];
        $this->projectid = $row['projectid'];

        $this->createDate       = $row['create_date'      ];
        $this->createUser       = $row['create_userid'    ];
        $this->lastchangeDate   = $row['lastchange_date'  ];
        $this->lastchangeUser   = $row['lastchange_userid'];

        $this->isFolder = ( $row['typeid'] == self::TYPEID_FOLDER );
        $this->isFile   = ( $row['typeid'] == self::TYPEID_FILE   );
        $this->isImage  = ( $row['typeid'] == self::TYPEID_IMAGE  );
        $this->isText   = ( $row['typeid'] == self::TYPEID_TEXT   );
        $this->isPage   = ( $row['typeid'] == self::TYPEID_PAGE   );
        $this->isLink   = ( $row['typeid'] == self::TYPEID_LINK   );
        $this->isUrl    = ( $row['typeid'] == self::TYPEID_URL    );
        $this->isAlias  = ( $row['typeid'] == self::TYPEID_ALIAS  );
        $this->isMacro  = ( $row['typeid'] == self::TYPEID_MACRO  );

    }


	/**
	 * Is this the root object in a project?
	 *
	 * @return bool
	 */
	public function isRoot() {
		return intval($this->parentid) == 0;
	}

    /**
     * Setzt die Eigenschaften des Objektes mit einer Datenbank-Ergebniszeile
     *
     * @param array Ergebniszeile aus Datenbanktabelle
     */
    public function setDatabaseRow( $row )
    {
        if	( count($row)==0 )
            throw new \LogicException('setDatabaseRow() got empty array, oid='.$this->objectid);

        $this->parentid  = $row['parentid' ];
        $this->projectid = $row['projectid'];
        $this->filename  = $row['filename' ];
        $this->orderid   = $row['orderid'  ];

        $this->createDate     = $row['create_date'    ];
        $this->lastchangeDate = $row['lastchange_date'];
        $this->publishedDate  = $row['published_date' ];

        $this->validFromDate  = $row['valid_from' ];
        $this->validToDate    = $row['valid_to'   ];

        $this->createUser = new User();
        $this->createUser->userid       = $row['create_userid'          ];
        if	( !empty($row['create_username']) )
        {
            $this->createUser->name         = $row['create_username'        ];
            $this->createUser->fullname     = $row['create_userfullname'    ];
            $this->createUser->mail         = $row['create_usermail'        ];
        }

        $this->lastchangeUser = new User();
        $this->lastchangeUser->userid   = $row['lastchange_userid'      ];

        if	( !empty($row['lastchange_username']) )
        {
            $this->lastchangeUser->name     = $row['lastchange_username'    ];
            $this->lastchangeUser->fullname = $row['lastchange_userfullname'];
            $this->lastchangeUser->mail     = $row['lastchange_usermail'    ];
        }

        $this->publishedUser = new User();
        $this->publishedUser->userid        = $row['published_userid'      ];

        if	( !empty($row['published_username']) )
        {
            $this->publishedUser->name     = $row['published_username'    ];
            $this->publishedUser->fullname = $row['published_userfullname'];
            $this->publishedUser->mail     = $row['published_usermail'    ];
        }

        $this->typeid = $row['typeid'];

        $this->isFolder = ( $row['typeid'] == self::TYPEID_FOLDER );
        $this->isFile   = ( $row['typeid'] == self::TYPEID_FILE   );
        $this->isImage  = ( $row['typeid'] == self::TYPEID_IMAGE  );
        $this->isText   = ( $row['typeid'] == self::TYPEID_TEXT   );
        $this->isPage   = ( $row['typeid'] == self::TYPEID_PAGE   );
        $this->isLink   = ( $row['typeid'] == self::TYPEID_LINK   );
        $this->isUrl    = ( $row['typeid'] == self::TYPEID_URL    );
        $this->isAlias  = ( $row['typeid'] == self::TYPEID_ALIAS  );
        $this->isMacro  = ( $row['typeid'] == self::TYPEID_MACRO  );

        $this->settings = $row['settings'];
    }



    /**
     * Laden des Objektes
     */
    public function load()
    {
        self::objectLoad();
        return $this;
    }


    /**
     * Eigenschaften des Objektes in Datenbank speichern
     */
    public function save()
    {
        $this->setTimestamp();
        $this->checkFilename();

        $stmt = Db::sql( <<<SQL
UPDATE {{object}} SET 
                  parentid          = {parentid},
                  filename          = {filename},
                  valid_from        = {validFrom},
                  valid_to          = {validTo},
                  settings          = {settings}
WHERE id={objectid}
SQL
        );


        if	( ! $this->parentid )
            $stmt->setNull('parentid');
        else
			$stmt->setInt ('parentid',$this->parentid );


        $user = \util\Session::getUser();
        $this->lastchangeUser = $user;
        $this->lastchangeDate = Startup::now();
        $stmt->setString('filename' , $this->filename                );
        $stmt->setString('settings' , $this->settings                );
        $stmt->setInt   ('validFrom', $this->validFromDate           );
        $stmt->setInt   ('validTo'  , $this->validToDate             );
        $stmt->setInt   ('objectid' , $this->objectid                );


        $stmt->execute();

        $this->setTimestamp();
    }



    /**
     * Aenderungsdatum auf Systemzeit setzen
     */
    public function setTimestamp()
    {
        $db = \cms\base\DB::get();

        $sql = $db->sql('UPDATE {{object}} SET '.
            '  lastchange_date   = {time}  ,'.
            '  lastchange_userid = {userid} '.
            ' WHERE id={objectid}');

        $user = \util\Session::getUser();
        $this->lastchangeUser = $user;
        $this->lastchangeDate = Startup::now();
        $userid = $this->lastchangeUser ? $this->lastchangeUser->userid : null;

        $sql->setIntOrNull('userid'  ,$userid                        );
        $sql->setInt   ('objectid',$this->objectid                );
        $sql->setInt   ('time'    ,$this->lastchangeDate          );

        $sql->execute();

    }


    public function setCreationTimestamp()
    {
        $db = \cms\base\DB::get();

        $sql = $db->sql('UPDATE {{object}} SET '.
            '  create_date   = {time}  '.
            ' WHERE id={objectid}');

        $sql->setInt   ('objectid',$this->objectid   );
        $sql->setInt   ('time'    ,$this->createDate );

        $sql->execute();
    }


    public function setPublishedTimestamp()
    {
        $db = \cms\base\DB::get();

        $sql = $db->sql('UPDATE {{object}} SET '.
            '  published_date   = {time}  ,'.
            '  published_userid = {userid} '.
            ' WHERE id={objectid}');

        $user = \util\Session::getUser();
        $this->publishedUser = $user;
        $this->publishedDate = Startup::now();

        $sql->setInt   ('userid'  ,$this->publishedUser->userid   );
        $sql->setInt   ('objectid',$this->objectid                );
        $sql->setInt   ('time'    ,$this->publishedDate           );

        $sql->execute();
    }



    /**
     * Objekt loeschen. Es muss sichergestellt sein, dass auch das Unterobjekt geloeschet wird.
     * Diese Methode wird daher normalerweise nur vom Unterobjekt augerufen
     * @access protected
     */
    public function delete()
    {
        $db = \cms\base\DB::get();

        $sql = DB::sql( <<<SQL
			UPDATE {{element}}
              SET default_objectid=NULL
              WHERE default_objectid={objectid}
SQL
		);
        $sql->setInt('objectid',$this->objectid);
        $sql->execute();

        $sql = $db->sql( <<<'SQL'
			UPDATE {{value}} 
              SET linkobjectid=NULL 
              WHERE linkobjectid={objectid}
SQL
		);
        $sql->setInt('objectid',$this->objectid);
        $sql->execute();

        $sql = $db->sql( <<<'SQL'
			UPDATE {{link}} 
              SET link_objectid=NULL
              WHERE link_objectid={objectid}
SQL
		);
        $sql->setInt('objectid',$this->objectid);
        $sql->execute();


        // Objekt-Namen l?schen
        $sql = $db->sql(<<<'SQL'
			DELETE FROM {{name}}
			 WHERE objectid={objectid}
SQL
);
        $sql->setInt('objectid', $this->objectid);
        $sql->execute();

        // Aliases löschen.
        $sql = Db::sql(<<<'SQL'
			DELETE FROM {{alias}}
			 WHERE objectid={objectid}
SQL
);
        $sql->setInt('objectid', $this->objectid);
        $sql->execute();

        // ACLs loeschen
        $this->deleteAllACLs();

        // Objekt l?schen
        $sql = $db->sql(<<<'SQL'
			DELETE FROM {{object}}
			 WHERE id={objectid}
SQL
);
        $sql->setInt('objectid', $this->objectid);
        $sql->execute();

        $this->objectid = null;
    }


    /**
     * Objekt hinzufuegen.
     *
     * Standardrechte und vom Elternobjekt vererbbare Berechtigungen werden gesetzt.
     */
    protected function add()
    {
        // Neue Objekt-Id bestimmen
        $sql = Db::sql(<<<'SQL'
			SELECT MAX(id) FROM {{object}}
SQL
		);
        $this->objectid = intval($sql->getOne())+1;

        $this->checkFilename();
        $sql = Db::sql(<<<SQL
			INSERT INTO {{object}}
                    (id,parentid,projectid,filename,orderid,create_date,create_userid,lastchange_date,lastchange_userid,typeid,settings)
            VALUES( {objectid},{parentid},{projectid},{filename},{orderid},{time},{createuserid},{createtime},{userid},{typeid},'' )
SQL
		);

		$user = \util\Session::getUser();
		$currentUserId = $user ? $user->userid : 0;

		if	( !$this->parentid )
            $sql->setNull('parentid');
        else
			$sql->setInt ('parentid',$this->parentid );

        $sql->setInt   ('objectid' , $this->objectid );
        $sql->setString('filename' , $this->filename );
        $sql->setString('projectid', $this->projectid);
        $sql->setInt   ('orderid'  , 99999           );
        $sql->setInt   ('time'     , Startup::now()        );

        $sql->setInt   ('createuserid'   , $currentUserId  );
        $sql->setInt   ('createtime'     , Startup::now()  );
        $sql->setInt   ('userid'   , $currentUserId );

        $sql->setInt(  'typeid',$this->getTypeid());

        $sql->execute();

		$this->grantToActualUser(); // Is this a good idea? don't know ...
		$this->inheritPermissions();
    }


	/**
	 * Set permissions for the actual user for the just added object.
	 *
	 * @return void
	 */
	private function grantToActualUser() {

		$user = \util\Session::getUser();

		if   ( ! $user ) {  // User logged in?

			$permission = new Permission();
			$permission->userid = $user->userid;
			$permission->objectid = $this->objectid;

			$permission->read   = true;
			$permission->write  = true;
			$permission->prop   = true;
			$permission->delete = true;
			$permission->grant  = true;

			$permission->create_file   = true;
			$permission->create_page   = true;
			$permission->create_folder = true;
			$permission->create_link   = true;

			$permission->persist();
		}
	}


	/**
	 * Inherit permissions from parent folder.
	 *
	 * @return void
	 */
	private function inheritPermissions() {
		$parent = new BaseObject( $this->parentid );

		foreach( $parent->getAllAclIds() as $aclid )
		{
			$permission = new Permission( $aclid );
			$permission->load();

			if	( $permission->transmit ) // ACL is vererbbar, also kopieren.
			{
				$permission->aclid = null;
				$permission->objectid = $this->objectid;
				$permission->persist(); // ... und hinzufuegen.
			}
		}
	}

    /**
     * Pruefung auf Gueltigkeit des Dateinamens
     */
    private function checkFilename()
    {
        if	( empty($this->filename) )
            $this->filename = $this->objectid;

        if	( $this->isRoot() )  // Beim Root-Ordner ist es egal, es gibt nur einen.
            return;

        if	( !$this->filenameIsUnique( $this->filename ) )
        {
            // Append some string to filename.
            $this->filename = $this->filename.'-'.base_convert(time(), 10, 36);
        }
    }


    /**
     * Stellt fest, dass der Dateiname im aktuellen Ordner kein weiteres Mal vorkommt.
     * Dies muss vor dem Speichern geprüft werden, ansonsten erfolgt eine Index-Verletzung
     * und der Datensatz kann nicht gespeichert werde.
     *
     * @param $filename
     * @return bool
     */
    private function filenameIsUnique( $filename )
    {
        $sql = Db::sql( <<<SQL
SELECT COUNT(*) FROM {{object}}
WHERE parentid={parentid} AND filename={filename}
AND NOT id = {objectid}
SQL
        );

        $sql->setString('parentid', $this->parentid);
        $sql->setString('filename', $filename      );
        $sql->setString('objectid', $this->objectid);


        return( intval($sql->getOne()) == 0 );
    }


    function getAllAclIds()
    {
        $db = \cms\base\DB::get();

        $sql = $db->sql( <<<'SQL'
			SELECT id FROM {{acl}} 
             WHERE objectid={objectid}
             ORDER BY userid,groupid ASC
SQL
 );
        $sql->setInt('objectid'  ,$this->objectid);

        return $sql->getCol();
    }


    /**
     * Ermitteln aller Berechtigungsstufen.
     */
    function getRelatedAclTypes()
    {
        return( array('read','write','delete','prop','release','publish','create_folder','create_file','create_page','create_link','grant','transmit') );
    }


    /**
     * Ermitteln aller Berechtigungsstufen.
     */
    function getAssocRelatedAclTypes()
    {
        $types  = array();

        foreach( $this->getRelatedAclTypes() as $t )
            $types[$t] = true;

        return $types;
    }

    /**
     * Entfernen aller ACLs zu diesem Objekt
     * @access private
     */
    private function deleteAllACLs()
    {
        foreach( $this->getAllAclIds() as $aclid )
        {
            $permission = new Permission( $aclid );
            $permission->load();
            $permission->delete();
        }
    }



    /**
     * Reihenfolge-Sequenznr. dieses Objektes neu speichern
     * die Nr. wird sofort in der Datenbank gespeichert.
     *
     * @param Integer neue Sequenz-Nr.
     */
    public function setOrderId( $orderid )
    {
        $sql = Db::sql('UPDATE {{object}} '.'  SET orderid={orderid}'.'  WHERE id={objectid}');
        $sql->setInt('objectid', $this->objectid);
        $sql->setInt('orderid', $orderid);

        $sql->execute();
    }


	/**
	 * Reads all direct children of this object.
	 */
	protected function getChildren()
	{
		$stmt = Db::sql(<<<SQL

SELECT id FROM {{object}}
		                 WHERE parentid={objectid}
		                 ORDER BY orderid ASC
SQL
		);

		$stmt->setInt( 'objectid' ,$this->objectid        );

		return $stmt->getCol();
	}


	/**
	 * Reads all descendants.
	 *
	 */
	public function getAllDescendantsIds()
	{
		$descendantIds = array();

		foreach( $this->getChildren() as $id )
		{
			$descendantIds[] = $id;

			$baseObject = new BaseObject( $id );
			$descendantIds = array_merge( $descendantIds, $baseObject->getAllDescendantsIds() );
		}

		return $descendantIds;
	}
    /**
     * ?bergeordnete Objekt-ID dieses Objektes neu speichern
     * die Nr. wird sofort in der Datenbank gespeichert.
     *
     * @param Integer ?bergeordnete Objekt-ID
     */
    public function setParentId( $parentid )
    {

		$descendantsIds = $this->getAllDescendantsIds();

		if	( in_array($parentid,$descendantsIds) || $parentid == $this->objectid )
			throw new \LogicException('new parent may not be a descendant of this node.');

        $db = \cms\base\DB::get();

        $sql = $db->sql('UPDATE {{object}} '.'  SET parentid={parentid}'.'  WHERE id={objectid}');
        $sql->setInt('objectid', $this->objectid);
        $sql->setInt('parentid', $parentid);

        $sql->execute();
    }


	/**
	 * Get all References to this object
	 * @return array
	 */
    public function getDependentObjectIds()
    {
        $stmt = DB::sql( <<<SQL

SELECT {{page}}.objectid FROM {{value}}
              LEFT JOIN {{pagecontent}}
                ON {{value}}.contentid = {{pagecontent}}.contentid
              LEFT JOIN {{page}}
                ON {{pagecontent}}.pageid = {{page}}.id
              WHERE linkobjectid={myobjectid1}
UNION
       SELECT objectid FROM {{link}}
             WHERE link_objectid={myobjectid2}
SQL
		);
        $stmt->setInt( 'myobjectid1',$this->objectid );
        $stmt->setInt( 'myobjectid2',$this->objectid );

        return $stmt->getCol();
    }




    /**
     * Liefert die Link-Ids, die auf das aktuelle Objekt verweisen.
     * @return array Liste der gefundenen Objekt-IDs
	 * @see BaseObject#getDependentObjectIds
     */
    public function getLinksToMe()
    {
        $db = \cms\base\DB::get();

        $sql = $db->sql( 'SELECT objectid FROM {{link}} '.
            ' WHERE link_objectid={myid}' );
        $sql->setInt   ( 'myid'   ,$this->objectid );

        return $sql->getCol();
    }

    private function getTypeid()
    {
        if ($this->isFolder) return self::TYPEID_FOLDER;
        if ($this->isFile  ) return self::TYPEID_FILE;
        if ($this->isImage ) return self::TYPEID_IMAGE;
        if ($this->isText  ) return self::TYPEID_TEXT;
        if ($this->isPage  ) return self::TYPEID_PAGE;
        if ($this->isLink  ) return self::TYPEID_LINK;
        if ($this->isUrl   ) return self::TYPEID_URL;
        if ($this->isAlias ) return self::TYPEID_ALIAS;
        if ($this->isMacro ) return self::TYPEID_MACRO;
    }


    /**
     * Local Settings.
     *
     * @return array
     */
    public function getSettings()
    {
        $settings = YAML::parse($this->settings);

        $resolver = new VariableResolver();
        $resolver->namespaceSeparator = ':';

        // Resolve config variables.
		$resolver->addResolver('config', function ($var) {
                $conf = Configuration::Conf()->getConfig();
                return ArrayUtils::getSubValue($conf,explode('.',$var) );
		});

		$settings = $resolver->resolveVariablesInArray( $settings );

        return $settings;
    }

    /**
     * Inherited Settings.
     *
     * @return array
     */
    public function getTotalSettings()
    {
        $totalSettings = array();

        // cumulate settings of parent objects
        $parentIds = array_keys( $this->parentObjectFileNames(true, false) );
        foreach( $parentIds as $id )
        {
            $parentObject = new BaseObject( $id );
            $parentObject->objectLoad();
            $totalSettings = array_merge($totalSettings,$parentObject->getSettings());
        }

        // add settings from this base object.
        $totalSettings = array_merge($totalSettings,$this->getSettings());

        return $totalSettings;
    }



    /**
     * Liefert alle übergeordneten Ordner.
     *
     * @param bool $with_root Mit Root-Folder?
     * @param bool $with_self Mit dem aktuellen Ordner?
     * @return array
     */
    public function parentObjectFileNames(  $with_root = false, $with_self = false  )
    {
        $foid = $this->objectid;
        $idCache = array();

        while( intval($foid)!=0 )
        {
            $sql = Db::sql( <<<SQL
            
SELECT parentid,id,filename
  FROM {{object}}
 WHERE {{object}}.id={parentid}

SQL
            );
            $sql->setInt('parentid'  ,$foid            );

            $row = $sql->getRow();

            if	( in_array($row['id'],$idCache))
                throw new \LogicException('fatal: parent-rekursion in object-id: '.$this->objectid.', double-parent-id: '.$row['id']);
            else
                $idCache[] = $row['id'];

            $this->addParentfolder( $row['id'],$row['filename'] );
            $foid = $row['parentid'];
        }


        $this->checkParentFolders($with_root,$with_self);

        return $this->parentfolders;
    }

    public function parentObjectNames( $with_root = false, $with_self = false )
    {
        $foid = $this->objectid;
        $idCache = array();

        while( intval($foid)!=0 )
        {
            $sql = Db::sql( <<<SQL
				SELECT {{object}}.parentid,{{object}}.id,{{object}}.filename FROM {{object}}
				 WHERE {{object}}.id={parentid}
SQL
            );
            $sql->setInt('parentid'  ,$foid            );

            $row = $sql->getRow();

            if	( in_array($row['id'],$idCache))
                throw new \LogicException('fatal: parent-rekursion in object-id: '.$this->objectid.', double-parent-id: '.$row['id']);
            else
                $idCache[] = $row['id'];

            $this->addParentfolder( $row['id'],$row['name'],$row['filename'] );
            $foid = $row['parentid'];
        }

        $this->checkParentFolders($with_root,$with_self);

        return $this->parentfolders;
    }


    private function addParentFolder( $id,$name,$filename='' )
    {
        if  ( empty($name) )
            $name = $filename;

        if  ( empty($name) )
            $name = "($id)";

        if	( intval($id) != 0 )
            $this->parentfolders[ $id ] = $name;
    }


    private function checkParentFolders( $with_root, $with_self )
    {
        // Reihenfolge umdrehen
        $this->parentfolders = array_reverse($this->parentfolders,true);

        // Ordner ist bereits hoechster Ordner
//		if   ( count($this->parentfolders) == 2 && $this->isRoot && $with_root && $with_self )
//		{
//			array_pop  ( $this->parentfolders );
//			return;
//		}


        if   ( !$with_root && !empty($this->parentfolders) )
        {
            $keys = array_keys( $this->parentfolders );
            unset( $this->parentfolders[$keys[0]] );
        }

        if   ( !$with_self && !empty($this->parentfolders) )
        {
            $keys = array_keys( $this->parentfolders );
            unset( $this->parentfolders[$keys[count($keys)-1]] );
        }
    }


    /**
     * Liefert das Projekt-Objekt.
     *
     * @return Project
     * @throws \util\exception\ObjectNotFoundException
     */
    public function getProject() {
        return Project::create( $this->projectid );
    }




    /**
     * Es werden Objekte mit einem bestimmten Namen ermittelt
     * @param String Suchbegriff
     * @return array Liste der gefundenen Objekt-IDs
     */
    public static function getObjectIdsByFileName( $text )
    {
        $db = \cms\base\DB::get();

        $sql = $db->sql( 'SELECT id FROM {{object}} '.
            ' WHERE filename LIKE {filename}'.
            '  ORDER BY lastchange_date DESC' );
        $sql->setString( 'filename','%'.$text.'%' );

        return $sql->getCol();
    }


    /**
     * Es werden Objekte mit einem Namen ermittelt
     * @param String Suchbegriff
     * @return array Liste der gefundenen Objekt-IDs
     */
    public static function getObjectIdsByName( $text )
    {
        $db = \cms\base\DB::get();

        $sql = $db->sql( 'SELECT {{object}}.id FROM {{object}} '.
            ' LEFT JOIN {{name}} '.
            '   ON {{object}}.id={{name}}.objectid'.
            ' WHERE {{name}}.name LIKE {name}'.
            '  ORDER BY lastchange_date DESC' );
        $sql->setString( 'name'      ,'%'.$text.'%' );

        return $sql->getCol();
    }


    /**
     * Es werden Objekte mit einer Beschreibung ermittelt
     * @param String Suchbegriff
     * @return array Liste der gefundenen Objekt-IDs
     */
    public static function getObjectIdsByDescription( $text )
    {
        $db = \cms\base\DB::get();

        $sql = $db->sql( 'SELECT {{object}}.id FROM {{object}} '.
            ' LEFT JOIN {{name}} '.
            '   ON {{object}}.id={{name}}.objectid'.
            ' WHERE {{name}}.descr LIKE {desc}'.
            '  ORDER BY lastchange_date DESC' );
        $sql->setString( 'desc'      ,'%'.$text.'%' );

        return $sql->getCol();
    }


    /**
     * Es werden Objekte mit einer UserId ermittelt
     * @param Integer Benutzer-Id der Erstellung
     * @return array Liste der gefundenen Objekt-IDs
     */
    public static function getObjectIdsByCreateUserId( $userid )
    {
        $db = \cms\base\DB::get();

        $sql = $db->sql( 'SELECT id FROM {{object}} '.
            ' WHERE create_userid={userid}'.
            '  ORDER BY lastchange_date DESC' );
        $sql->setInt   ( 'userid'   ,$userid          );

        return $sql->getCol();
    }


    /**
     * Es werden Objekte mit einer UserId ermittelt
     * @param Integer Benutzer-Id der letzten ?nderung
     * @return array Liste der gefundenen Objekt-IDs
     */
    public static function getObjectIdsByLastChangeUserId( $userid )
    {
        $db = \cms\base\DB::get();

        $sql = $db->sql( 'SELECT id FROM {{object}} '.
            ' WHERE lastchange_userid={userid}'.
            '  ORDER BY lastchange_date DESC' );
        $sql->setInt   ( 'userid'   ,$userid          );

        return $sql->getCol();
    }


    /**
     * Stellt fest, ob das Objekt gueltig ist.
     */
    public function isValid()
    {
        $now = time();

        return
            ($this->validFromDate == null || $this->validFromDate < $now) &&
            ($this->validToDate   == null || $this->validToDate   > $now);

    }

    public function __toString()
    {
        return 'Object-Id '.$this->objectid.' (type='.$this->getType().',filename='.$this->filename. ')';
    }


    /**
     * Liefert alle Name-Objekte.
     * @return Name[]
     * @throws \util\exception\ObjectNotFoundException
     */
    public function getNames()
    {
        $names = array();

        foreach( $this->getProject()->getLanguages() as $languageId=>$languageName )
        {
            $name = new Name();
            $name->objectid   = $this->objectid;
            $name->languageid = $languageId;
            $name->load();

            $names[] = $name;
        }

        return $names;
    }


    /**
     * Liefert alle Name-Objekte.
     * @return Name
     * @throws \util\exception\ObjectNotFoundException
     */
    public function getNameForLanguage( $languageId )
    {
        $name = new Name();
        $name->objectid   = $this->objectid;
        $name->languageid = $languageId;
        $name->load();

        return $name;
    }


    /**
     * @return Name
     */
    public function getDefaultName()
    {
        $languageId = $this->getProject()->getDefaultLanguageId();

        $defaultName = $this->getNameForLanguage( $languageId );

		if  ( ! $defaultName->name )
			$defaultName->name = $this->filename;

		return $defaultName;
    }


    /**
     * Name of the object. If not exist, the filename will be used.
     * @return string Name
     */
    public function getName()
    {
        $name = $this->getDefaultName()->name;

        if  ( empty($name))
            $name = $this->filename;

        return $name;
    }


    /**
     * Speichert Namen und Beschreibung für alle Sprachen. Das ist bei der Neuanlage von Objekten ganz praktisch.
     *
     * @param $nam string
     * @param $description string
     */
    public function setNameForAllLanguages($nam, $description)
    {
        foreach( $this->getProject()->getLanguages() as $languageId=>$languageName )
        {
            $name = new Name();
            $name->objectid   = $this->objectid;
            $name->languageid = $languageId;
            $name->load();

            $name->name        = $nam;
            $name->description = $description;

            $name->persist();
        }

    }


	/**
	 * Returns the effective alias. If no alias exists, the actual object is returned.
	 *
	 * @return BaseObject
	 */
    public function getEffectiveAlias() {

		$alias = $this->getAlias();
		if   ( $alias )
			return $alias;
		else
			return $this;
	}



    /**
     * The Alias for this Object or <code>null</code>.
     *
     * @return Alias|null
	 * @deprecated use #getAliasForLanguage
     */
    public function getAlias()
    {
        $alias = $this->getAliasForLanguage( $this->getProject()->getDefaultLanguageId() );

        if   ( !$alias->isPersistent() )
            $alias = $this->getAliasForLanguage( null );

        if   ( !$alias->isPersistent() )
            return null; // no alias found

        return $alias;
    }


    /**
     * Creates an Alias for a specific language.
     * @param int $languageid could be null for the default alias.
     * @return Alias
     * @throws \util\exception\ObjectNotFoundException
     */
    public function getAliasForLanguage( $languageid )
    {
        $alias = new Alias();
        $alias->projectid      = $this->projectid;
        $alias->linkedObjectId = $this->objectid;
        $alias->languageid     = $languageid;
        $alias->load();

        return $alias;
    }



    public function isPersistent()
    {
        return intval( $this->objectid ) > 0;
    }


	/**
	 * Gets the file size
	 * @return int
	 */
	public function getSize()
	{
		return 0;
	}


	public function mimeType()
	{
		return "";
	}


	public function getId()
	{
		return $this->objectid;
	}


	public function copyNamesFrom($sourceObjectId ) {

		$sourceObject = new BaseObject( $sourceObjectId );
		foreach ( $sourceObject->getNames() as $name ) {

			if   ( $name->isPersistent() ) {

				$copiedName = new Name();
				$copiedName->name        = $name->name;
				$copiedName->description = $name->description;
				$copiedName->languageid  = $name->languageid;
				$copiedName->objectid    = $this->objectid;
				$copiedName->persist();
			}
		}
	}
}



