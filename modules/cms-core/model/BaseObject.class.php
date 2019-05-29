<?php


namespace cms\model;

use cms\publish\Publish;
use phpseclib\Math\BigInteger;
use Spyc;
use template_engine\components\ElseComponent;

/**
 * Superklasse fuer Objekte im Projektbaum.
 *
 * Dieses Objekt ist die Oberklasse fuer die Klassen Ordner, Datei,
 * Link, Seite usw.
 *
 * @author Jan Dankert
 */
class BaseObject
{
    const TYPEID_FOLDER = 1;
    const TYPEID_FILE   = 2;
    const TYPEID_PAGE   = 3;
    const TYPEID_LINK   = 4;
    const TYPEID_URL    = 5;
    const TYPEID_IMAGE  = 6;
    const TYPEID_TEXT   = 7;
    const TYPEID_ALIAS  = 8;

    const TYPE_FOLDER = 'folder';
    const TYPE_FILE   = 'file'  ;
    const TYPE_PAGE   = 'page'  ;
    const TYPE_LINK   = 'link'  ;
    const TYPE_URL    = 'url'   ;
    const TYPE_IMAGE  = 'image' ;
    const TYPE_TEXT   = 'text'  ;
    const TYPE_ALIAS  = 'alias' ;

    /** eindeutige ID dieses Objektes
     * @see #$objectid
     * @type Integer
     */
    public $id;

    /** eindeutige ID dieses Objektes
     * @type Integer
     */
    public $objectid;

    /** Objekt-ID des Ordners, in dem sich dieses Objekt befindet
     * Kann "null" oder "0" sein, wenn es sich um den Wurzelordner des Projektes handelt
     * @see #$isRoot
     * @type Integer
     */
    public $parentid;

    /** Physikalischer Dateiname des Objektes (bei Links nicht gef?llt)
     * <em>enth?lt nicht die Dateinamen-Erweiterung</em>
     * @type String
     */
    public $filename = '';

    /** Logischer (sprachabhaengiger) Name des Objektes
     * (wird in Tabelle <code>name</code> abgelegt)
     * @type String
     * @deprecated use modelclass Name instead
     */
    var $name = '';

    /** Logische (sprachabhaengige) Beschreibung des Objektes
     * (wird in Tabelle <code>name</code> abgelegt)
     * @type String
     * @deprecated use modelclass Name instead
     */
    var $description = 'none';

    /**
     * @var string
     * @deprecated
     */
    var $desc = '';

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


    public $validFromDate;
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
     * Kennzeichnet den Typ dieses Objektes.
     * Muss den Inhalt OR_FILE, OR_FOLDER, OR_PAGE oder OR_LINK haben.
     * Vorbelegung mit <code>null</code>.
     * @type Integer
     */
    var $type = null;

    /** Kennzeichen ob Objekt den Wurzelordner des Projektes darstellt (parentid ist dann NULL)
     * @type Boolean
     */
    var $isRoot = false;

    /** Sprach-ID
     * @see Language
     * @type Integer
     */
    var $languageid;

    /**
     * Projektmodell-ID
     * @see Projectmodel
     * @type Integer
     */
    var $modelid;

    /**
     * Projekt-ID
     * @see Project
     * @type Integer
     */
    var $projectid;

    /**
     * Dateiname der temporaeren Datei
     * @type String
     */
    var $tmpfile;

    var $aclMask = null;

    public $typeid;

    var $parentfolders = array();

    /**
     * @type String
     */
    public $settings;

    /**
     * Strategy for publishing objects.
     *
     * @var Publish
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
        global $SESS;

        if	( is_numeric($objectid) )
        {
            $this->objectid = $objectid;
            $this->id       = $objectid;
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
            $user     = \Session::getUser();

            if	( $user->isAdmin )
            {
                // Administratoren erhalten eine Maske mit allen Rechten
                $this->aclMask = Acl::ACL_READ +
                    Acl::ACL_WRITE +
                    Acl::ACL_PROP +
                    Acl::ACL_DELETE +
                    Acl::ACL_RELEASE +
                    Acl::ACL_PUBLISH +
                    Acl::ACL_CREATE_FOLDER +
                    Acl::ACL_CREATE_FILE +
                    Acl::ACL_CREATE_LINK +
                    Acl::ACL_CREATE_PAGE +
                    Acl::ACL_GRANT +
                    Acl::ACL_TRANSMIT;
            }
            else
            {
                $this->aclMask = 0;

                $db = db_connection();
                $sqlGroupClause = $user->getGroupClause();
                $sql = $db->sql( <<<SQL
SELECT {{acl}}.* FROM {{acl}}
                 LEFT JOIN {{object}}
                        ON {{object}}.id={{acl}}.objectid
                 WHERE objectid={objectid}
                   AND ( languageid={languageid} OR languageid IS NULL )
                   AND ( {{acl}}.userid={userid} OR $sqlGroupClause
                                                 OR ({{acl}}.userid IS NULL AND {{acl}}.groupid IS NULL) )
SQL
                );

                $sql->setInt  ( 'languageid'  ,$this->languageid       );
                $sql->setInt  ( 'objectid'    ,$this->objectid         );
                $sql->setInt  ( 'userid'      ,$user->userid           );

                foreach($sql->getAll() as $row )
                {
                    $acl = new Acl();
                    $acl->setDatabaseRow( $row );

                    $this->aclMask |= $acl->getMask();
                }
            }
        }

        if	( readonly() )
            // System ist im Nur-Lese-Zustand
            return $type == Acl::ACL_READ && $this->aclMask & $type;
        else
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

        return 'unknown';
    }


    /**
     * Eigenschaften des Objektes. Kann durch Unterklassen erweitert werden.
     * @return array
     */
    public function getProperties()
    {
        return Array( 'id'               =>$this->objectid,
            'objectid'         =>$this->objectid,
            'parentid'         =>$this->parentid,
            'filename'         =>$this->filename,
            'name'             =>$this->name,
            'desc'             =>$this->desc,
            'description'      =>$this->desc,
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
            'isRoot'           =>$this->isRoot,
            'languageid'       =>$this->languageid,
            'modelid'          =>$this->modelid,
            'projectid'        =>$this->projectid,
            'settings'         =>$this->settings,
            'type'             =>$this->getType()  );
    }


    /**
     * Ermitteln des physikalischen Dateipfades, in dem sich das Objekt befindet
     * @return String Pfadangabe, z.B. 'pfad/zu/objekt'
     */
    public function path()
    {
        $alias = $this->getAlias();

        if  ( $alias->filename )
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
        $slug = iconv('utf-8', 'ascii//TRANSLIT', $slug);
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $slug);
        $slug = trim($slug, '-');
        $slug = strtolower($slug);

        return $slug;
    }



    public function getParentFolderId()
    {
        $alias = $this->getAlias();
        if ( $alias->filename )
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
        global $conf;

        $filename = $this->filename;

        $alias = $this->getAlias();
        if ( $alias->filename )
            $filename = $alias->filename;

        if	( $conf['filename']['edit'] && $filename != '' && $filename != $this->objectid )
        {
            // do not change the filename here - otherwise there is a danger of filename collisions.
            //$filename = self::urlify($filename);

            return $filename;
        }

        if	( $this->isFolder )
        {
            $filename = $this->objectid;
        }
        elseif	( $this->orderid == 1              &&
            !empty($conf['filename']['default']) &&
            !$conf['filename']['edit']              )
        {
            $filename = $conf['filename']['default'];
        }
        else
        {
            // Filename is not edited, so we are generating a pleasant filename.
            switch( $conf['filename']['style'] )
            {
                case 'longid':
                    // Eine etwas laengere ID als Dateinamen benutzen
                    $filename = base_convert(str_pad($this->objectid,6,'a'),11,10);
                    break;

                case 'short':
                    // So kurz wie moeglich: Erhoehen der Basis vom 10 auf 36.
                    // Beispiele:
                    // 1  -> 1
                    // 10 -> a
                    $filename = base_convert($this->objectid,10,36);
                    break;

                case 'md5':
                    // MD5-Summe als Dateinamen verwenden
                    // Achtung: Kollisionen sind unwahrscheinlich, aber theoretisch möglich.
                    $filename = md5(md5($this->objectid));
                    break;

                case  'ss':
                    // Imitieren von "StoryServer" URLs. Wers braucht.
                    $filename = '0,'.
                        base_convert(str_pad($this->parentid,3,'a'),11,10).
                        ','.
                        base_convert(str_pad($this->objectid,7,'a'),11,10).
                        ',00';
                    break;

                case  'title':
                    // Achtung: Kollisionen sind möglich.
                    // COLLISION ALARM! THIS IS NOT A GOOD IDEA!
                    $filename = self::urlify($this->name);
                    break;

                case 'id':
                default:
                    // Einfach die Objekt-Id als Dateinamen verwenden.
                    $filename = $this->objectid;
                    break;

            }
        }

        return $filename;
    }



    /**
     * Stellt fest, ob das Objekt mit der angegebenen Id existiert.
     */
    public static function available( $objectid )
    {
        $db = db_connection();

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
     * @throws \ObjectNotFoundException
     */
    function objectLoad()
    {
        $db = db_connection();

        $stmt = $db->sql('SELECT {{object}}.*,' .
            '       {{name}}.name,{{name}}.descr,'.
            '       lastchangeuser.name     as lastchange_username,     '.
            '       lastchangeuser.fullname as lastchange_userfullname, '.
            '       lastchangeuser.mail     as lastchange_usermail,     '.
            '       publisheduser.name      as published_username,     '.
            '       publisheduser.fullname  as published_userfullname, '.
            '       publisheduser.mail      as published_usermail,     '.
            '       createuser.name         as create_username,     '.
            '       createuser.fullname     as create_userfullname, '.
            '       createuser.mail         as create_usermail      '.
            ' FROM {{object}}'.
            ' LEFT JOIN {{name}} '.
            '        ON {{object}}.id={{name}}.objectid AND {{name}}.languageid={languageid} '.
            ' LEFT JOIN {{user}} as lastchangeuser '.
            '        ON {{object}}.lastchange_userid=lastchangeuser.id '.
            ' LEFT JOIN {{user}} as publisheduser '.
            '        ON {{object}}.published_userid=publisheduser.id '.
            ' LEFT JOIN {{user}} as createuser '.
            '        ON {{object}}.create_userid=createuser.id '.
            ' WHERE {{object}}.id={objectid}');
        $stmt->setInt('languageid', $this->languageid);
        $stmt->setInt('objectid'  , $this->objectid  );

        $row = $stmt->getRow();

        if (count($row) == 0)
            throw new \ObjectNotFoundException('object '.$this->objectid.' not found');

        $this->setDatabaseRow( $row );
    }


    /**
     * Lesen der Eigenschaften aus der Datenbank
     * Es werden
     * - die sprachunabhaengigen Daten wie Dateiname, Typ sowie Erstellungs- und Aenderungsdatum geladen
     */
    function objectLoadRaw()
    {
        global $SESS;
        $db = db_connection();

        $sql = $db->sql('SELECT * FROM {{object}}'.
            ' WHERE {{object}}.id={objectid}');
        $sql->setInt('objectid'  , $this->objectid  );
        $row = $sql->getRow();

        if (count($row) == 0)
            throw new \ObjectNotFoundException('objectid not found: '.$this->objectid);

        $this->parentid  = $row['parentid' ];
        $this->filename  = $row['filename' ];
        $this->projectid = $row['projectid'];

        if	( intval($this->parentid) == 0 )
            $this->isRoot = true;
        else
            $this->isRoot = false;

        $this->name = 'n/a';

        $this->create_date       = $row['create_date'];
        $this->create_userid     = $row['create_userid'];
        $this->lastchange_date   = $row['lastchange_date'];
        $this->lastchange_userid = $row['lastchange_userid'];

        $this->isFolder = ( $row['typeid'] == self::TYPEID_FOLDER );
        $this->isFile   = ( $row['typeid'] == self::TYPEID_FILE   );
        $this->isImage  = ( $row['typeid'] == self::TYPEID_IMAGE  );
        $this->isText   = ( $row['typeid'] == self::TYPEID_TEXT   );
        $this->isPage   = ( $row['typeid'] == self::TYPEID_PAGE   );
        $this->isLink   = ( $row['typeid'] == self::TYPEID_LINK   );
        $this->isUrl    = ( $row['typeid'] == self::TYPEID_URL    );
        $this->isAlias  = ( $row['typeid'] == self::TYPEID_ALIAS  );

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

        if	( intval($this->parentid) == 0 )
            $this->isRoot = true;
        else
            $this->isRoot = false;

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

        if	( $this->isRoot )
        {
            $this->name        = $row['name' ];
            $this->desc        = '';
            $this->description = '';
        }
        else
        {
            $this->name        = $row['name' ];
            $this->desc        = $row['descr'];
            $this->description = $row['descr'];
        }

        $this->settings = $row['settings'];

        $this->checkName();
    }



    /**
     * Laden des Objektes
     */
    public function load()
    {
        return self::objectLoad();
    }


    /**
     * Eigenschaften des Objektes in Datenbank speichern
     * @deprecated
     */
    public function objectSave( $ignored = true )
    {
        self::save();
    }

    /**
     * Eigenschaften des Objektes in Datenbank speichern
     */
    public function save()
    {
        $this->setTimestamp();
        $this->checkFilename();

        $stmt = db()->sql( <<<SQL
UPDATE {{object}} SET 
                  parentid          = {parentid},
                  lastchange_date   = {time}    ,
                  lastchange_userid = {userid}  ,
                  filename          = {filename},
                  valid_from        = {validFrom},
                  valid_to          = {validTo},
                  settings          = {settings}
WHERE id={objectid}
SQL
        );


        if	( $this->isRoot )
            $stmt->setNull('parentid');
        else	$stmt->setInt ('parentid',$this->parentid );


        $user = \Session::getUser();
        $this->lastchangeUser = $user;
        $this->lastchangeDate = now();
        $stmt->setInt   ('time'     , $this->lastchangeDate          );
        $stmt->setInt   ('userid'   , $this->lastchangeUser->userid  );
        $stmt->setString('filename' , $this->filename                );
        $stmt->setString('settings' , $this->settings                );
        $stmt->setInt   ('validFrom', $this->validFromDate           );
        $stmt->setInt   ('validTo'  , $this->validToDate             );
        $stmt->setInt   ('objectid' , $this->objectid                );


        $stmt->query();

        $this->setTimestamp();
    }



    /**
     * Aenderungsdatum auf Systemzeit setzen
     */
    public function setTimestamp()
    {
        $db = db_connection();

        $sql = $db->sql('UPDATE {{object}} SET '.
            '  lastchange_date   = {time}  ,'.
            '  lastchange_userid = {userid} '.
            ' WHERE id={objectid}');

        $user = \Session::getUser();
        $this->lastchangeUser = $user;
        $this->lastchangeDate = now();

        $sql->setInt   ('userid'  ,$this->lastchangeUser->userid  );
        $sql->setInt   ('objectid',$this->objectid                );
        $sql->setInt   ('time'    ,$this->lastchangeDate          );

        $sql->query();

    }


    public function setCreationTimestamp()
    {
        $db = db_connection();

        $sql = $db->sql('UPDATE {{object}} SET '.
            '  create_date   = {time}  '.
            ' WHERE id={objectid}');

        $sql->setInt   ('objectid',$this->objectid   );
        $sql->setInt   ('time'    ,$this->createDate );

        $sql->query();
    }


    public function setPublishedTimestamp()
    {
        $db = db_connection();

        $sql = $db->sql('UPDATE {{object}} SET '.
            '  published_date   = {time}  ,'.
            '  published_userid = {userid} '.
            ' WHERE id={objectid}');

        $user = \Session::getUser();
        $this->publishedUser = $user;
        $this->publishedDate = now();

        $sql->setInt   ('userid'  ,$this->publishedUser->userid   );
        $sql->setInt   ('objectid',$this->objectid                );
        $sql->setInt   ('time'    ,$this->publishedDate           );

        $sql->query();
    }


    /**
     * Logischen Namen und Beschreibung des Objektes in Datenbank speichern
     * (wird von objectSave() automatisch aufgerufen)
     *
     * @access private
     */
    public function ObjectSaveName()
    {
        $db = db_connection();

        $sql = $db->sql(<<<SQL
SELECT COUNT(*) FROM {{name}}  WHERE objectid  ={objectid} AND languageid={languageid}
SQL
        );
        $sql->setInt( 'objectid'  , $this->objectid   );
        $sql->setInt( 'languageid', $this->languageid );
        $count = $sql->getOne();

        if ($count > 0)
        {
            $sql = $db->sql( <<<SQL
        UPDATE {{name}} SET 
                         name  = {name},
                         descr = {desc}
                        WHERE objectid  ={objectid}
                          AND languageid={languageid}
SQL
            );
            $sql->setString('name', $this->name);
            $sql->setString('desc', $this->desc);
            $sql->setInt( 'objectid'  , $this->objectid   );
            $sql->setInt( 'languageid', $this->languageid );
            $sql->query();
        }
        else
        {
            $sql = $db->sql('SELECT MAX(id) FROM {{name}}');
            $nameid = intval($sql->getOne())+1;

            $sql = $db->sql('INSERT INTO {{name}}'.'  (id,objectid,languageid,name,descr)'.' VALUES( {nameid},{objectid},{languageid},{name},{desc} )');
            $sql->setInt   ('objectid'  , $this->objectid    );
            $sql->setInt   ('languageid', $this->languageid  );
            $sql->setInt   ('nameid', $nameid    );
            $sql->setString('name'  , $this->name);
            $sql->setString('desc'  , $this->desc);
            $sql->query();
        }
    }

    /**
     * Objekt loeschen. Es muss sichergestellt sein, dass auch das Unterobjekt geloeschet wird.
     * Diese Methode wird daher normalerweise nur vom Unterobjekt augerufen
     * @access protected
     */
    public function objectDelete()
    {
        $db = db_connection();

        $sql = $db->sql( 'UPDATE {{element}} '.
            '  SET default_objectid=NULL '.
            '  WHERE default_objectid={objectid}' );
        $sql->setInt('objectid',$this->objectid);
        $sql->query();

        $sql = $db->sql( 'UPDATE {{value}} '.
            '  SET linkobjectid=NULL '.
            '  WHERE linkobjectid={objectid}' );
        $sql->setInt('objectid',$this->objectid);
        $sql->query();

        $sql = $db->sql( 'UPDATE {{link}} '.
            '  SET link_objectid=NULL '.
            '  WHERE link_objectid={objectid}' );
        $sql->setInt('objectid',$this->objectid);
        $sql->query();


        // Objekt-Namen l?schen
        $sql = $db->sql('DELETE FROM {{name}} WHERE objectid={objectid}');
        $sql->setInt('objectid', $this->objectid);
        $sql->query();

        // Aliases löschen.
        $sql = db()->sql('DELETE FROM {{alias}} WHERE objectid={objectid}');
        $sql->setInt('objectid', $this->objectid);
        $sql->query();

        // ACLs loeschen
        $this->deleteAllACLs();

        // Objekt l?schen
        $sql = $db->sql('DELETE FROM {{object}} WHERE id={objectid}');
        $sql->setInt('objectid', $this->objectid);
        $sql->query();

        $this->objectid = null;
    }


    /**
     * Objekt hinzufuegen.
     *
     * Standardrechte und vom Elternobjekt vererbbare Berechtigungen werden gesetzt.
     */
    function objectAdd()
    {
        self::add();
    }

    /**
     * Objekt hinzufuegen.
     *
     * Standardrechte und vom Elternobjekt vererbbare Berechtigungen werden gesetzt.
     */
    function add()
    {
        // Neue Objekt-Id bestimmen
        $sql = db()->sql('SELECT MAX(id) FROM {{object}}');
        $this->objectid = intval($sql->getOne())+1;

        $this->checkFilename();
        $sql = db()->sql('INSERT INTO {{object}}'.
            ' (id,parentid,projectid,filename,orderid,create_date,create_userid,lastchange_date,lastchange_userid,typeid,settings)'.
            ' VALUES( {objectid},{parentid},{projectid},{filename},{orderid},{time},{createuserid},{createtime},{userid},{typeid},\'\' )');

        if	( $this->isRoot )
            $sql->setNull('parentid');
        else	$sql->setInt ('parentid',$this->parentid );

        $sql->setInt   ('objectid' , $this->objectid );
        $sql->setString('filename' , $this->filename );
        $sql->setString('projectid', $this->projectid);
        $sql->setInt   ('orderid'  , 99999           );
        $sql->setInt   ('time'     , now()           );
        $user = \Session::getUser();
        $sql->setInt   ('createuserid'   , $user->userid   );
        $sql->setInt   ('createtime'     , now()           );
        $user = \Session::getUser();
        $sql->setInt   ('userid'   , $user->userid   );

        $sql->setInt(  'typeid',$this->getTypeid());

        $sql->query();

        // Standard-Rechte fuer dieses neue Objekt setzen.
        // Der angemeldete Benutzer erhaelt alle Rechte auf
        // das neue Objekt. Legitim, denn er hat es ja angelegt.
        $acl = new Acl();
        $acl->userid = $user->userid;
        $acl->objectid = $this->objectid;

        $acl->read   = true;
        $acl->write  = true;
        $acl->prop   = true;
        $acl->delete = true;
        $acl->grant  = true;

        $acl->create_file   = true;
        $acl->create_page   = true;
        $acl->create_folder = true;
        $acl->create_link   = true;

        $acl->add();

        // Aus dem Eltern-Ordner vererbbare Berechtigungen uebernehmen.
        $parent = new BaseObject( $this->parentid );
        foreach( $parent->getAllAclIds() as $aclid )
        {
            $acl = new Acl( $aclid );
            $acl->load();

            if	( $acl->transmit ) // ACL is vererbbar, also kopieren.
            {
                $acl->objectid = $this->objectid;
                $acl->add(); // ... und hinzufuegen.
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

        if	( $this->isRoot )  // Beim Root-Ordner ist es egal, es gibt nur einen.
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
        $sql = db()->sql( <<<SQL
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


    /**
     * Pruefung auf Gueltigkeit des logischen Namens
     */
    function checkName()
    {
        if	( empty($this->name) )
            $this->name = $this->filename;

        if	( empty($this->name) )
            $this->name = $this->objectid;
    }


    function getAllAclIds()
    {
        $db = db_connection();

        $sql = $db->sql( 'SELECT id FROM {{acl}} '.
            '  WHERE objectid={objectid}'.
            '  ORDER BY userid,groupid ASC' );
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
            $acl = new Acl( $aclid );
            $acl->load();
            $acl->delete();
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
        $sql = db()->sql('UPDATE {{object}} '.'  SET orderid={orderid}'.'  WHERE id={objectid}');
        $sql->setInt('objectid', $this->objectid);
        $sql->setInt('orderid', $orderid);

        $sql->query();
    }


    /**
     * ?bergeordnete Objekt-ID dieses Objektes neu speichern
     * die Nr. wird sofort in der Datenbank gespeichert.
     *
     * @param Integer ?bergeordnete Objekt-ID
     */
    public function setParentId( $parentid )
    {
        $db = db_connection();

        $sql = $db->sql('UPDATE {{object}} '.'  SET parentid={parentid}'.'  WHERE id={objectid}');
        $sql->setInt('objectid', $this->objectid);
        $sql->setInt('parentid', $parentid);

        $sql->query();
    }


    public function getDependentObjectIds()
    {
        $db = db_connection();

        $sql = $db->sql( 'SELECT {{page}}.objectid FROM {{value}}'.
            '  LEFT JOIN {{page}} '.
            '    ON {{value}}.pageid = {{page}}.id '.
            '  WHERE linkobjectid={objectid}' );
        $sql->setInt( 'objectid',$this->objectid );

        return $sql->getCol();
    }




    /**
     * Liefert die Link-Ids, die auf das aktuelle Objekt verweisen.
     * @return array Liste der gefundenen Objekt-IDs
     */
    public function getLinksToMe()
    {
        $db = db_connection();

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
    }


    /**
     * Local Settings.
     *
     * @return array
     */
    public function getSettings()
    {
        return Spyc::YAMLLoad($this->settings);
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
        $foid = $this->id;
        $idCache = array();

        while( intval($foid)!=0 )
        {
            $sql = db()->sql( <<<SQL
            
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
        $foid = $this->id;
        $idCache = array();

        while( intval($foid)!=0 )
        {
            $sql = db()->sql( <<<SQL
            
SELECT {{object}}.parentid,{{object}}.id,{{object}}.filename,{{name}}.name FROM {{object}}
  LEFT JOIN {{name}}
         ON {{object}}.id = {{name}}.objectid
        AND {{name}}.languageid = {languageid}  
 WHERE {{object}}.id={parentid}

SQL
            );
            $sql->setInt('languageid',$this->languageid);
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
     * @throws \ObjectNotFoundException
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
        $db = db_connection();

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
        $db = db_connection();

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
        $db = db_connection();

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
        $db = db_connection();

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
        $db = db_connection();

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
        return 'Object-Id '.$this->objectid.' (type='.$this->getType().',filename='.$this->filename.',language='.$this->languageid.', modelid='.$this->modelid.')';
    }


    /**
     * Liefert alle Name-Objekte.
     * @return array
     * @throws \ObjectNotFoundException
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
     * @return Name
     */
    public function getDefaultName()
    {
        $languageId = $this->getProject()->getDefaultLanguageId();

        return $this->getNameForLanguage( $languageId );
    }


    /**
     * @return Name
     */
    public function getNameForLanguage( $languageid )
    {
        $name = new Name();
        $name->objectid   = $this->objectid;
        $name->languageid = $languageid;
        $name->load();

        return $name;
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

            $name->save();
        }

    }

    public function getAlias()
    {
        $alias = new Alias();
        $alias->projectid      = $this->projectid;
        $alias->linkedObjectId = $this->objectid;
        $alias->load();

        return $alias;
    }



    public function isPersistent()
    {
        return intval( $this->objectid ) > 0;
    }

}




