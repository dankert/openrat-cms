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
	 */
	var $type;

	/**
	 * Logischer Name dieses Elementes
	 * @type String
	 */
	var $name;

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
	 * Schalter, ob dieses Element in allen Sprachen den gleichen Inhalt haben soll
	 * @type Boolean
	 */
	var $allLanguages;

	var $readonlyElementNames = array('copy','linkinfo','linkdate','info','infodate','code','dynamic');
	
	/**
	 * Untertyp.
	 *
	 * @var String
	 */
	var $subtype = '';
	var $withIcon = false;
	var $dateformat = 'r';
	var $wiki = false;
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
		                ' (id,templateid,name,descr,type,writable) '.
		                " VALUES ( {elementid},{templateid},{name},{description},{type},{writable} ) " );

		$sql->setInt    ( 'elementid'  ,$this->elementid  );
		$sql->setString ( 'name'       ,$this->name       );
		$sql->setString ( 'type'       ,$this->type       );
		$sql->setInt    ( 'templateid' ,$this->templateid );
		$sql->setBoolean( 'writable'   ,$this->writable   );
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
		$this->desc           = $prop['descr'     ];
		$this->type           = $prop['type'      ];
		$this->subtype        = $prop['subtype'   ];

		$this->dateformat     = $prop['dateformat'];
		$this->wiki           = ( $prop['wiki'         ] == '1' );
		$this->withIcon       = ( $prop['with_icon'    ] == '1' );
		$this->html           = ( $prop['html'         ] == '1' );
		$this->allLanguages   = ( $prop['all_languages'] == '1' );
		$this->writable       = ( $prop['writable'     ] == '1' );

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
		                '     descr           = {desc},'.
		                '     type            = {type},'.
		                '     subtype         = {subtype},'.
		                '     with_icon       = {withIcon},'.
		                '     dateformat      = {dateformat},'.
		                '     wiki            = {wiki},'.
		                '     html            = {html},'.
		                '     all_languages   = {allLanguages},'.
		                '     writable        = {writable},'.
		                '     decimals        = {decimals},'.
		                '     dec_point       = {decPoint},'.
		                '     thousand_sep    = {thousandSep},'.
		                '     code            = {code},'.
		                '     default_text    = {defaultText},'.
		                '     folderobjectid  = {folderObjectId},'.
		                '     default_objectid= {defaultObjectId}'.
		                ' WHERE id={elementid}'      );

		$sql->setInt    ( 'elementid'       ,$this->elementid        );
		$sql->setInt    ( 'templateid'      ,$this->templateid       );
		$sql->setString ( 'name'            ,$this->name             );
		$sql->setString ( 'desc'            ,$this->desc             );
		$sql->setString ( 'type'            ,$this->type             );
		$sql->setString ( 'subtype'         ,$this->subtype          );
		$sql->setBoolean( 'withIcon'        ,$this->withIcon         );
		$sql->setString ( 'dateformat'      ,$this->dateformat       );
		$sql->setBoolean( 'wiki'            ,$this->wiki             );
		$sql->setBoolean( 'html'            ,$this->html             );
		$sql->setBoolean( 'writable'        ,$this->writable         );
		$sql->setBoolean( 'allLanguages'    ,$this->allLanguages     );
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
	 * Setzt den Typ des Elementes und schreibt diesen sofort in die Datenbank.
	 * 
	 * @param String Der neue Typ, siehe getAvailableTypes() f?r m?gliche Typen
	 * @see #type
	 */
	function setType( $type )
	{
		$this->type = $type;
		$db = db_connection();
		
		$sql = $db->sql( 'UPDATE {{element}}'.
		                ' SET type            = {type}'.
		                ' WHERE id={elementid}'         );

		$sql->setInt    ( 'elementid',$this->elementid );
		$sql->setString ( 'type'     ,$this->type      );

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
	function delete()
	{
		$db = db_connection();

		// Inhalte l?schen
		$this->deleteValues();

		// Element l?schen
		$sql = $db->sql('DELETE FROM {{element}} '.
		               '  WHERE id={elementid}'   );
		$sql->setInt( 'elementid',$this->elementid );

		$sql->query();
	}


	/**
	 * L?schen aller Seiteninhalte mit diesem Element
	 * Das Element wird nicht gel?scht.
	 */
	function deleteValues()
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
		$prp = array('text'    =>array('withIcon','allLanguages','writable','htmlwiki','defaultText'),
		             'longtext'=>array('withIcon','allLanguages','writable','htmlwiki','defaultText'),
		             'select'  =>array('withIcon','allLanguages','writable','defaultText','code'),
		             'number'  =>array('withIcon','allLanguages','writable','decPoint','decimals','thousandSep'),
		             'link'    =>array('subtype','withIcon','allLanguages','writable','linktype','folderObjectId','defaultObjectId'),
		             'date'    =>array('withIcon','allLanguages','writable','dateformat','defaultText'),
		             'list'    =>array('subtype','withIcon','allLanguages','writable','folderObjectId','defaultObjectId'),
		             'insert'  =>array('subtype','withIcon','allLanguages','writable','folderObjectId','defaultObjectId'),
		             'copy'    =>array('prefix','name','defaultText'),
		             'linkinfo'=>array('prefix','subtype','defaultText'),
		             'linkdate'=>array('prefix','subtype','dateformat'),
		             'code'    =>array('code'),
		             'dynamic' =>array('subtype','code'),
		             'info'    =>array('subtype'),
		             'infodate'=>array('subtype','dateformat') );
		return $prp[ $this->type ];
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
	 * Ermitteln aller benutzbaren Elementtypen
	 * @return array
	 */
	function getAvailableTypes()
	{
		return array('text',
		             'longtext',
		             'select',
		             'number',
		             'link',
		             'date',
		             'insert',
		             'copy',
		             'linkinfo',
		             'linkdate',
		             'code',
		             'dynamic',
		             'info',
		             'infodate');
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
		if	( in_array($this->type,$this->readonlyElementNames) )
			return false;

		return $this->writable;
	}
}

?>