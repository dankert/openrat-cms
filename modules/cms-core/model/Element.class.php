<?php
namespace cms\model;


/**
 * Diese Objektklasse stellt ein Element das.
 *
 * Ein Element ist ein Platzhalter in einem Template und kann verschiedenen
 * Typs sein, z.B. Text oder ein Bild.
 *
 * @author Jan Dankert
 * @package openrat.objects
 */
class Element
{
    const ELEMENT_TYPE_DATE     =  1;
    const ELEMENT_TYPE_NUMBER   =  2;
    const ELEMENT_TYPE_TEXT     =  3;
    const ELEMENT_TYPE_INFO     =  4;
    const ELEMENT_TYPE_INFODATE =  5;
    const ELEMENT_TYPE_LINK     =  6;
    const ELEMENT_TYPE_LONGTEXT =  7;
    const ELEMENT_TYPE_CODE     =  8;
    const ELEMENT_TYPE_DYNAMIC  =  9;
    const ELEMENT_TYPE_SELECT   = 10;
    const ELEMENT_TYPE_COPY     = 11;
    const ELEMENT_TYPE_LINKINFO = 12;
    const ELEMENT_TYPE_LINKDATE = 13;
    const ELEMENT_TYPE_INSERT   = 14;

    const ELEMENT_FORMAT_TEXT     = 0;
    const ELEMENT_FORMAT_HTML     = 1;
    const ELEMENT_FORMAT_WIKI     = 2;
    const ELEMENT_FORMAT_MARKDOWN = 3;

    const ELEMENT_FLAG_HTML_ALLOWED  =  1;
    const ELEMENT_FLAG_ALL_LANGUAGES =  2;
    const ELEMENT_FLAG_WRITABLE      =  4;
    const ELEMENT_FLAG_WITH_ICON     =  8;
    const ELEMENT_FLAG_INHERIT       = 16;

    /**
	 * Eindeutige ID dieses Elementes
	 * @type Integer
	 */
	var $elementid;

	/**
	 * Template-ID zu der dieses Elementes geh?rt
	 * @type Integer
	 */
	var $templateid;

	/**
	 * Typ des Elementes
	 * Folgende Typen sind moeglich:
	 * <ul>
	 * <li>text</li>
	 * <li>longtext</li>
	 * <li>select</li>
	 * <li>number</li>
	 * <li>link</li>
	 * <li>date</li>
	 * <li>insert</li>
	 * <li>linkinfo</li>
	 * <li>linkdate</li>
	 * <li>code</li>
	 * <li>info</li>
	 * <li>infodate</li>
	 * </ul>
	 *
	 * @type String
     * @deprecated use #typeid
	 */
	var $type;

    /**
     *
     * Type of the element. Must be a constant value of ELEMENT_TYPE_*.
     * @var integer Type of element
     */
	public $typeid;

	/**
	 * Logischer Name dieses Elementes
	 * @type String
	 */
	var $name;

	/**
	 * Eingabefeld-Bezeichnung für dieses Element.
	 * @type String
	 */
	var $label;

	/**
	 * Beschreibung zu diesem Element
	 * Zu jedem Element kann eine Beschreibung hinterlegt werden, die dem Redakteur bei der Bearbeitung
	 * der Inhalte als Bearbeitungshilfe dienen kann.
	 * @type String
	 */
	var $desc;

	/**
	 * Objekt-ID eines Ordners, aus diesem Ordner (samt Unterordner)
	 * k?nnen zu verlinkende Objekte ausgew?hlt werden
	 * @type Integer
	 */
	var $folderObjectId = 0;

	/**
	 * Vorausgew�hltes Objekt.
	 * @type Integer
	 */
	var $defaultObjectId = 0;

	/**
	 * Schalter ob dieses Element von Redakteuren bearbeiten werden kann
	 * @type Boolean
	 */
	var $writable;

    /**
     * values are inherited from parent nodes.
     * @var bool
     */
	public $inherit;

	/**
	 * Schalter, ob dieses Element in allen Sprachen den gleichen Inhalt haben soll
	 * @type Boolean
	 */
	var $allLanguages;

	public static $readonlyElementTypeIds = array(
	    self::ELEMENT_TYPE_COPY,self::ELEMENT_TYPE_LINKINFO,self::ELEMENT_TYPE_LINKDATE,self::ELEMENT_TYPE_INFO,self::ELEMENT_TYPE_INFODATE,self::ELEMENT_TYPE_CODE,self::ELEMENT_TYPE_DYNAMIC
    );


	/**
	 * Untertyp.
	 *
	 * @var String
	 */
	var $subtype = '';
	var $withIcon = false;
	var $dateformat = 'r';

	/*
	 * @deprecated use format.
	 */
	var $wiki   = false;

	public $format = self::ELEMENT_FORMAT_TEXT;

	var $html = false;
	var $decimals = 0;
	var $decPoint = '.';
	var $thousandSep = '';
	var $code = '';
	var $defaultText = '';


	/**
	 * Im Konstruktor wird die Element-Id gesetzt
	 * @param Integer Element-Id
	 */
	function __construct( $elementid=0 )
	{
		if	( intval($elementid)!=0 )
			$this->elementid = $elementid;
	}


	/**
	 * Hinzuf?gen eines Elementes
	 * Das aktuelle Element wird in die Datenbank geschrieben.
	 */
	function add()
	{
		$db = db_connection();

		$sql = $db->sql('SELECT MAX(id) FROM {{element}}');
		$this->elementid = intval($sql->getOne())+1;

		$sql = $db->sql( 'INSERT INTO {{element}}'.
		                ' (id,templateid,name,descr,typeid,flags) '.
		                " VALUES ( {elementid},{templateid},{name},{description},{typeid},{flags} ) " );

		$flags = 0;
        $flags += self::ELEMENT_FLAG_WRITABLE * intval($this->writable);

        $sql->setInt    ( 'elementid'  ,$this->elementid  );
		$sql->setString ( 'name'       ,$this->name       );
		$sql->setString ( 'label'      ,$this->label      );
		$sql->setInt    ( 'typeid'     ,$this->typeid     );
		$sql->setInt    ( 'templateid' ,$this->templateid );
		$sql->setBoolean( 'flags'      ,$flags            );
		$sql->setString ( 'description',$this->desc       );

		$sql->query();
	}


    /**
     * Lesen des Elementes aus der Datenbank
     * Alle Eigenschaften des Elementes werden aus der Datenbank gelesen
     * @throws \ObjectNotFoundException
     */
	function load()
	{
		if	( intval($this->elementid) != 0 )
		{
			$db = db_connection();
			$sql = $db->sql( <<<SQL
SELECT * FROM {{element}}
 WHERE id={elementid}
SQL
);
			$sql->setInt( 'elementid',$this->elementid );
			$this->setDatabaseRow( $sql->getRow() );
		}
	}


    /**
     * @param $prop
     * @throws \ObjectNotFoundException
     */
    function setDatabaseRow($prop )
	{
		if	( count($prop) <= 0 )
			throw new \ObjectNotFoundException("Element not found");

		$this->elementid      = $prop['id'        ];
		$this->templateid     = $prop['templateid'];
		$this->name           = $prop['name'      ];
		$this->label          = $prop['label'     ];
		$this->desc           = $prop['descr'     ];
        $this->typeid         = $prop['typeid'    ];
        $this->type           = Element::getAvailableTypes()[ $this->typeid ]; // name of type
        $this->subtype        = $prop['subtype'   ];

		$this->dateformat     = $prop['dateformat'];
		$this->wiki           = $prop['format'] == self::ELEMENT_FORMAT_WIKI;
		$this->format         = $prop['format'];
		$this->withIcon       = $prop['flags'] & self::ELEMENT_FLAG_WITH_ICON;
		$this->html           = $prop['flags'] & self::ELEMENT_FLAG_HTML_ALLOWED;
		$this->allLanguages   = $prop['flags'] & self::ELEMENT_FLAG_ALL_LANGUAGES;
		$this->writable       = $prop['flags'] & self::ELEMENT_FLAG_WRITABLE;
		$this->inherit        = $prop['flags'] & self::ELEMENT_FLAG_INHERIT;

		if	( !$this->writable)
			$this->withIcon = false;

		$this->decimals         = intval( $prop['decimals'        ] );
		$this->decPoint         = strval( $prop['dec_point'       ] );
		$this->thousandSep      = strval( $prop['thousand_sep'    ] );
		$this->code             = strval( $prop['code'            ] );
		$this->defaultText      = strval( $prop['default_text'    ] );
		$this->folderObjectId   = intval( $prop['folderobjectid'  ] );
		$this->defaultObjectId  = intval( $prop['default_objectid'] );
	}


	/**
	 * Abspeichern des Elementes
	 * Das aktuelle Element wird in der Datenbank gespeichert
	 */
	function save()
	{
		$db = db_connection();

		$sql = $db->sql( 'UPDATE {{element}}'.
		                ' SET templateid      = {templateid},'.
		                '     name            = {name},'.
		                '     label           = {label},'.
		                '     descr           = {desc},'.
		                '     typeid          = {typeid},'.
		                '     subtype         = {subtype},'.
		                '     dateformat      = {dateformat},'.
		                '     flags           = {flags},'.
		                '     format          = {format},'.
		                '     decimals        = {decimals},'.
		                '     dec_point       = {decPoint},'.
		                '     thousand_sep    = {thousandSep},'.
		                '     code            = {code},'.
		                '     default_text    = {defaultText},'.
		                '     folderobjectid  = {folderObjectId},'.
		                '     default_objectid= {defaultObjectId}'.
		                ' WHERE id={elementid}'      );

        $flags = 0;
        $flags += self::ELEMENT_FLAG_WITH_ICON     * intval($this->withIcon    );
        $flags += self::ELEMENT_FLAG_HTML_ALLOWED  * intval($this->html        );
        $flags += self::ELEMENT_FLAG_ALL_LANGUAGES * intval($this->allLanguages);
        $flags += self::ELEMENT_FLAG_WRITABLE      * intval($this->writable    );
        $flags += self::ELEMENT_FLAG_INHERIT       * intval($this->inherit     );

        $sql->setInt    ( 'elementid'       ,$this->elementid        );
		$sql->setInt    ( 'templateid'      ,$this->templateid       );
		$sql->setString ( 'name'            ,$this->name             );
		$sql->setString ( 'label'           ,$this->label            );
		$sql->setString ( 'desc'            ,$this->desc             );
		$sql->setInt    ( 'typeid'          ,$this->typeid           );
		$sql->setString ( 'subtype'         ,$this->subtype          );
		$sql->setString ( 'dateformat'      ,$this->dateformat       );
		$sql->setInt    ( 'flags'           ,$flags                  );
		$sql->setInt    ( 'format'          ,$this->format           );
		$sql->setInt    ( 'decimals'        ,$this->decimals         );
		$sql->setString ( 'decPoint'        ,$this->decPoint         );
		$sql->setString ( 'thousandSep'     ,$this->thousandSep      );
		$sql->setString ( 'code'            ,$this->code             );
		$sql->setString ( 'defaultText'     ,$this->defaultText      );

		if	( intval($this->folderObjectId)==0 )
			$sql->setNull( 'folderObjectId' );
		else	$sql->setInt ( 'folderObjectId'  ,$this->folderObjectId   );

		if	( intval($this->defaultObjectId)==0 )
			$sql->setNull( 'defaultObjectId' );
		else	$sql->setInt ( 'defaultObjectId' ,$this->defaultObjectId  );

		$sql->query();
	}



	/**
	 * Setzt ein Prefix vor den Elementnamen.
	 * @param String Prefix
	 */
	function setPrefix( $prefix )
	{
		if	( strrpos($this->name,'%') === FALSE )
			$name = $this->name;
		else
			list( $oldprefix,$name ) = explode('%',$this->name.'%');

		$this->name = $prefix.'%'.$name;
	}


	/**
	 * Loeschen des Elementes und aller Inhalte
	 */
	public function delete()
	{
		$db = db_connection();

		// Inhalte loeschen.
        // notwendig, damit die Fremdschlüsselbeziehungen auf diesen Element aufgehoben werden.
		$this->deleteValues();

		// Element loeschen
		$sql = $db->sql('DELETE FROM {{element}} '.
		               '  WHERE id={elementid}'   );
		$sql->setInt( 'elementid',$this->elementid );

		$sql->query();
	}


	/**
	 * L?schen aller Seiteninhalte mit diesem Element
	 * Das Element wird nicht gel?scht.
	 */
	public function deleteValues()
	{
		$db = db_connection();

		// Alle Inhalte mit diesem Element l?schen
		$sql = $db->sql('DELETE FROM {{value}} '.
		               '  WHERE elementid={elementid}'   );
		$sql->setInt( 'elementid',$this->elementid );
		$sql->query();
	}


	/**
	 * Abhaengig vom Element-Typ werden die zur Darstellung notwendigen Eigenschaften ermittelt.
	 * @return array
	 */
	function getRelatedProperties()
	{
		$prp = array('text'    =>array('inherit','withIcon','allLanguages','writable','html','defaultText','format'),
		             'longtext'=>array('inherit','withIcon','allLanguages','writable','html','defaultText','format'),
		             'select'  =>array('inherit','withIcon','allLanguages','writable','defaultText','code'),
		             'number'  =>array('inherit','withIcon','allLanguages','writable','decPoint','decimals','thousandSep'),
		             'link'    =>array('inherit','subtype','withIcon','allLanguages','writable','linktype','folderObjectId','defaultObjectId'),
		             'date'    =>array('inherit','withIcon','allLanguages','writable','dateformat','defaultText'),
		             'list'    =>array('inherit','subtype','withIcon','allLanguages','writable','folderObjectId','defaultObjectId'),
		             'insert'  =>array('inherit','subtype','withIcon','allLanguages','writable','folderObjectId','defaultObjectId'),
		             'copy'    =>array('inherit','prefix','name','defaultText'),
		             'linkinfo'=>array('prefix','subtype','defaultText'),
		             'linkdate'=>array('prefix','subtype','dateformat'),
		             'code'    =>array('code'),
		             'dynamic' =>array('subtype','code'),
		             'info'    =>array('subtype'),
		             'infodate'=>array('subtype','dateformat') );
		return $prp[ $this->getTypeName() ];
	}



	function getDefaultValue()
	{
		switch(  $this->type )
		{
			case 'text':
			case 'longtext':
				return $this->defaultText;

			case 'number';
				return '0';

			default:
		}

		return lang('EL_TYPE_'.$this->type);

	}

    /**
     * Ermitteln aller benutzbaren Elementtypen.
     *
     * @return array id->name
     */
    public static function getAvailableTypes()
    {
        return array(
            self::ELEMENT_TYPE_TEXT => 'text',
            self::ELEMENT_TYPE_LONGTEXT => 'longtext',
            self::ELEMENT_TYPE_SELECT => 'select',
            self::ELEMENT_TYPE_NUMBER => 'number',
            self::ELEMENT_TYPE_LINK => 'link',
            self::ELEMENT_TYPE_DATE => 'date',
            self::ELEMENT_TYPE_INSERT => 'insert',
            self::ELEMENT_TYPE_COPY => 'copy',
            self::ELEMENT_TYPE_LINKINFO => 'linkinfo',
            self::ELEMENT_TYPE_LINKDATE => 'linkdate',
            self::ELEMENT_TYPE_CODE => 'code',
            self::ELEMENT_TYPE_DYNAMIC => 'dynamic',
            self::ELEMENT_TYPE_INFO => 'info',
            self::ELEMENT_TYPE_INFODATE => 'infodate'
        );
    }


    /**
     * Ermitteln aller benutzbaren Elementtypen.
     *
     * @return array id->name
     */
    public static function getAvailableFormats()
    {
        return array(
            self::ELEMENT_FORMAT_TEXT => 'text',
            self::ELEMENT_FORMAT_WIKI => 'wiki',
            self::ELEMENT_FORMAT_HTML => 'html',
            self::ELEMENT_FORMAT_MARKDOWN => 'markdown'
        );
    }


	/**
	 * Ermittelt die Klasse des Element-Typs.<br>
	 * Entweder "info", "text" oder "dynamic".
	 *
	 * @return String
	 */
	function getTypeClass()
	{
		switch( $this->type )
		{
			case 'text':
			case 'longtext':
			case 'select':
			case 'number':
			case 'link':
			case 'date':
			case 'list':
			case 'insert':
				return 'text';

			case 'code':
			case 'dynamic':
				return 'dynamic';

			case 'copy':
			case 'info':
			case 'infodate':
			case 'linkinfo':
			case 'linkdate':
            default:
				return 'info';
		}
	}


	function getSelectItems()
	{
		$parameters = explode( "\n",$this->code );
		$items      = array();

		foreach( $parameters as $it )
		{
			$paar        = explode( ":",$it,2 );
			$param_name  = trim($paar[0]);

			if	( count($paar) > 1 )
				$param_value = trim($paar[1]);
			else
				$param_value = trim($paar[0]);

			// Wenn Inhalt mit "'" beginnt und mit "'" aufhoert, dann diese Zeichen abschneiden
			if	( substr($param_value,0,1) == "'" && substr($param_value,strlen($param_value)-1,1) == "'" )
				$param_value = substr($param_value,1,strlen($param_value)-2);

			$items[$param_name] = $param_value;
		}
		return $items;
	}


	function getDynamicParameters()
	{
		$parameters = explode( "\n",$this->code );
		$items      = array();

		foreach( $parameters as $it )
		{
			$paar = explode( ":",$it,2 );
			if	( count($paar) > 1 )
			{
				$param_name  = trim($paar[0]);
				$param_value = trim($paar[1]);

//				// Wenn Inhalt mit "'" beginnt und mit "'" aufhoert, dann diese Zeichen abschneiden
//				if	( substr($param_value,0,1) == "'" && substr($param_value,strlen($param_value)-1,1) == "'" ) 
//					$param_value = substr($param_value,1,strlen($param_value)-2); 

				if	( !empty($param_value) )
					$items[$param_name] = $param_value;
			}
		}
		return $items;
	}


	/**
	 * Ermittelt, ob das Element beschreibbar ist.
	 * Bestimmte Typen (z.B. Info-Felder) sind nie beschreibbar, dann wird immer false zur?ckgegeben.
	 * Ansonsten wird ermittelt, ob dieses Element als beschreibbar markiert ist.
	 */
	function isWritable()
	{
		// Bei bestimmten Feldern immer false zurueckgeben
		if	( in_array($this->typeid,Element::$readonlyElementTypeIds) )
			return false;

		return $this->writable;
	}


    /**
     * The technical name of this element type.
     *
     * @return String
     */
	public function getTypeName() {
        return Element::getAvailableTypes()[ $this->typeid ]; // name of type

    }
}

?>