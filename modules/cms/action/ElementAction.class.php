<?php

namespace cms\action;


use cms\model\Element;
use cms\model\Project;
use cms\model\Template;
use cms\model\Folder;
use cms\model\BaseObject;
use ReflectionClass;
use ReflectionProperty;
use util\Text;



/**
 * Action-Klasse fuer die Bearbeitung eines Template-Elementes.
 * 
 * @author Jan Dankert
 */
class ElementAction extends BaseAction
{
	public $security = Action::SECURITY_USER;

    /**
     * @var Element
     */
	private $element;

    private $template;

    /**
	 * Konstruktor
	 */
	function __construct()
	{
        parent::__construct();

    }


    public function init()
    {
        if	( $this->getRequestId() == 0 )
			throw new \util\exception\ValidationException('no element-id available');

		$this->element = new Element( $this->getRequestId() );
		$this->element->load();

		$this->setTemplateVar( 'elementid' ,$this->element->elementid   );
	}



	/**
	 * Umbenennen des Elementes
	 */
	public function removeView()
	{
		$this->setTemplateVar( 'name' ,$this->element->name );
	}
	
	
	/**
	 * Entfernen des Elementes
	 */
	public function removePost()
	{
		if	( !$this->hasRequestVar('confirm') )
			throw new \util\exception\ValidationException('confirm');

		$type = $this->getRequestVar('type','abc');
		
		if ( $type == 'value' )
		{
		    // Nur Inhalte löschen
			$this->element->deleteValues();
			$this->addNotice('element',$this->element->name,'DELETED',Action::NOTICE_OK);
		}
		elseif ( $type == 'all' )
		{
		    // Element löschen
			$this->element->delete();
			$this->addNotice('element',$this->element->name,'DELETED',Action::NOTICE_OK);
		}
	}



	/**
	 * Aendern des Element-Typs
	 */
	public function advancedPost()
	{
        $conf = \cms\base\Configuration::rawConfig();
        $ini_date_format = \cms\base\Configuration::config('date','format');


        if	( $this->hasRequestVar('format'))
            $this->element->format = $this->getRequestId('format');


        if	( $this->hasRequestVar('dateformat'))
            $this->element->dateformat  = $ini_date_format[$this->getRequestVar('dateformat')];


        if	( $this->hasRequestVar('default_longtext'))
            $this->element->defaultText     = $this->getRequestVar('default_longtext',RequestParams::FILTER_TEXT);
        else
            $this->element->defaultText     = $this->getRequestVar('default_text',RequestParams::FILTER_TEXT);

        $this->element->subtype         = $this->getRequestVar('subtype');

        $this->element->html            = $this->hasRequestVar('html');
        $this->element->withIcon        = $this->hasRequestVar('with_icon');
        $this->element->allLanguages    = $this->hasRequestVar('all_languages');
        $this->element->writable        = $this->hasRequestVar('writable');
        $this->element->inherit         = $this->hasRequestVar('inherit');

        $this->element->decimals        = $this->getRequestVar('decimals');
        $this->element->decPoint        = $this->getRequestVar('dec_point');
        $this->element->thousandSep     = $this->getRequestVar('thousand_sep');
        $this->element->folderObjectId  = $this->getRequestVar('folderobjectid'  );
        $this->element->defaultObjectId = $this->getRequestVar('default_objectid');

        if	( $this->hasRequestVar('select_items'))
            $this->element->code         = $this->getRequestVar('select_items');
        else
            $this->element->code         = $this->getRequestVar('code'            ,RequestParams::FILTER_RAW);

        if	( $this->hasRequestVar('name') )
            $this->element->name = $this->getRequestVar('name');

        if	( $this->hasRequestVar('linkelement') )
            $this->element->setPrefix( $this->getRequestVar('linkelement') );

        if	( $this->hasRequestVar('parameters'))
            $this->element->code = $this->getRequestVar('parameters',RequestParams::FILTER_RAW);

        $this->element->save();
        $this->addNotice('element',$this->element->name,'SAVED');

    }


	public function advancedView()
	{
        $conf = \cms\base\Configuration::rawConfig();
        $this->setTemplateVar('type',$this->element->getTypeName() );

        // Abhaengig vom aktuellen Element-Typ die Eigenschaften anzeigen
        $properties = $this->element->getRelatedProperties();

        foreach( $this->element->getRelatedProperties() as $propertyName )
        {
            switch( $propertyName )
            {
                case 'withIcon':
                    $this->setTemplateVar('with_icon'    ,$this->element->withIcon    );
                    break;

                case 'allLanguages':
                    $this->setTemplateVar('all_languages',$this->element->allLanguages);
                    break;

                case 'writable':
                    $this->setTemplateVar('writable'     ,$this->element->writable    );
                    break;

                case 'inherit':
                    $this->setTemplateVar('inherit'     ,$this->element->inherit      );
                    break;

                case 'html':
                    $this->setTemplateVar('html'       ,$this->element->html          );
                    break;

                case 'subtype':

                    $convertToLang = false;
                    switch( $this->element->typeid )
                    {
                        case Element::ELEMENT_TYPE_INFO:
                            $subtypes = Array('db_id',
                                'db_name',
                                'project_id',
                                'project_name',
                                'language_id',
                                'language_iso',
                                'language_name',
                                'page_id',
                                'page_name',
                                'page_desc',
                                'page_fullfilename',
                                'page_filename',
                                'page_extension',
                                'edit_url',
                                'edit_fullurl',
                                'lastch_user_username',
                                'lastch_user_fullname',
                                'lastch_user_mail',
                                'lastch_user_desc',
                                'lastch_user_tel',
                                'create_user_username',
                                'create_user_fullname',
                                'create_user_mail',
                                'create_user_desc',
                                'create_user_tel',
                                'act_user_username',
                                'act_user_fullname',
                                'act_user_mail',
                                'act_user_desc',
                                'act_user_tel' );
                            $convertToLang = true;
                            break;

                        case Element::ELEMENT_TYPE_INFODATE:
                        case Element::ELEMENT_TYPE_LINKDATE:
                            $subtypes = Array('date_published',
                                'date_saved',
                                'date_created' );
                            $convertToLang = true;
                            break;

                        case Element::ELEMENT_TYPE_LINK:
                            $subtypes = Array(
                                'file',
                                'image',
                                'image_data_uri',
                                'page',
                                'folder',
                                'link' );
                            $convertToLang = true;
                            break;

                        case Element::ELEMENT_TYPE_LINKINFO:
                            $subtypes = Array('width',
                                'height',
                                'id',
                                'name',
                                'description',
                                'mime-type',
                                'lastch_user_username',
                                'lastch_user_fullname',
                                'lastch_user_mail',
                                'lastch_user_desc',
                                'lastch_user_tel',
                                'create_user_username',
                                'create_user_fullname',
                                'create_user_mail',
                                'create_user_desc',
                                'create_user_tel',
                                'filename',
                                'full_filename' );
                            $convertToLang = true;
                            break;

                        case Element::ELEMENT_TYPE_INSERT:
                            $subtypes = Array('inline',
                                'ssi'     );
                            $convertToLang = true;
                            break;

                        case Element::ELEMENT_TYPE_DYNAMIC:

                            $files = Array();
                            $macroFiles = \util\FileUtils::readDir(__DIR__ . '/../../cms/macros/macro');
                            foreach( $macroFiles as $macroFile )
                            {
                                $file = substr($macroFile,0,strlen($macroFile)-10);
                                if	( $file != '' )
                                    $files[$file] = $file;
                            }

                            $subtypes = $files;
                            break;

                        default:
                            $subtypes = array();
                            break;
                    }

                    if	( $convertToLang )
                    {
                        foreach( $subtypes as $t=>$v )
                        {
                            unset($subtypes[$t]);
                            $subtypes[$v] = \cms\base\Language::lang('EL_'.$this->element->getTypeName().'_'.$v);
                        }
                    }

                    // Variable $subtype muss existieren, um Anzeige des Feldes zu erzwingen.
                    if (!isset($this->element->subtype))
                        $this->element->subtype='';

                    $this->setTemplateVar('subtypes',$subtypes              );
                    $this->setTemplateVar('subtype' ,$this->element->subtype);

                    break;


                case 'dateformat':

                    //$ini_date_format = \cms\base\Configuration::config('date','format');
                    //$ini_date_format = \cms\base\Configuration::Conf()->subset('date')->get('format');
                    $ini_date_format = \cms\base\Configuration::config()->subset('date')->get('format');
                    $dateformat = array();

                    $this->setTemplateVar('dateformat','');

                    foreach($ini_date_format as $idx=>$d)
                    {
                        if	( strpos($d,'%')!==FALSE )
                            $dateformat[$idx] = strftime($d);
                        else
                            $dateformat[$idx] = date($d);
                        if	( $d == $this->element->dateformat )
                            $this->setTemplateVar('dateformat',$idx);
                    }

                    $this->setTemplateVar('dateformats',$dateformat);

                    break;


                // Eigenschaften Text und Text-Absatz
                case 'defaultText':

                    switch( $this->element->typeid )
                    {
                        case Element::ELEMENT_TYPE_LONGTEXT:
                            $this->setTemplateVar('default_longtext',$this->element->defaultText );
                            break;

                        case Element::ELEMENT_TYPE_SELECT:
                        case Element::ELEMENT_TYPE_TEXT:
                            $this->setTemplateVar('default_text'    ,$this->element->defaultText );
                            break;
                    }
                    break;


                case 'format':
                    $this->setTemplateVar('format', $this->element->format );

                    $formats = Element::getAvailableFormats();

                    // Für einfache Textelemente gibt es keinen HTML-Editor
                    if	( $this->element->typeid != Element::ELEMENT_TYPE_LONGTEXT )
                        unset( $formats[ Element::ELEMENT_FORMAT_HTML ] );

                    //foreach( $formats as $t=>$v )
                    //    $formats[$t] = array('lang'=>'EL_PROP_FORMAT_'.$v);

                    $this->setTemplateVar('formatlist', $formats);
                    break;

                case 'linktype':
                    $this->setTemplateVar('linktype', $this->element->wiki );
                    $this->setTemplateVar('linktypelist', array('page','file','link') );
                    break;

                case 'prefix':
                    $t = new Template( $this->element->templateid );

                    $elements = array();
                    foreach( $t->getElements() as $element )
                    {
                        if	( $element->type == 'link' )
                            $elements[$element->name] = $element->name;
                    }
                    unset($t);

                    $this->setTemplateVar('linkelements',$elements );

                    list($linkElementName,$targetElementName) = explode('%',$this->element->name.'%');
                    $this->setTemplateVar('linkelement',$linkElementName );

                    break;

                case 'name':

                    $names = array();

                    $template = new Template( $this->element->templateid );
                    $template->load();
                    $project = new Project( $template->projectid );

                    foreach( $project->getTemplates() as $tid=>$name )
                    {
                        $t = new Template( $tid );
                        $t->load();

                        foreach( $t->getElements() as $element )
                        {
                            if	( !in_array($element->type,array('copy','linkinfo','link')) )
                                $names[$element->name] = $t->name.' - '.$element->name.' ('.\cms\base\Language::lang('EL_'.$element->type).')';
                        }
                        unset($t);
                    }


                    $this->setTemplateVar('names',$names );

                    list($linkElementName,$targetElementName) = explode('%',$this->element->name.'%');
                    $this->setTemplateVar('name',$targetElementName );
                    break;

                // Eigenschaften PHP-Code
                case 'code':

                    switch( $this->element->typeid )
                    {

                        case Element::ELEMENT_TYPE_SELECT:
                            $this->setTemplateVar('select_items',$this->element->code );
                            break;

                        case Element::ELEMENT_TYPE_DYNAMIC:

                            $className = '\\cms\\macros\\macro\\'.ucfirst($this->element->subtype);

							$description = '';
							$paramList   = array();
							$parameters  = array();

							if	( class_exists($className) )
							{
								$dynEl = new $className;

								$description = $dynEl->description;

								$old = $this->element->getDynamicParameters();

								$reflect = new ReflectionClass($dynEl);
								$props   = $reflect->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED);
								foreach( get_object_vars($dynEl) as $paramName=>$paramValue )
								{
									$paramList[$paramName] = print_r( $paramValue, true);

									if	( @$old[$paramName] )
										$parameters[$paramName] = $old[$paramName];
									else
										$parameters[$paramName] = $paramValue;
								}

							}

							$this->setTemplateVar('dynamic_class_description',$description );
							$this->setTemplateVar('dynamic_class_parameters' ,$paramList          );
							$this->setTemplateVar('parameters'               , \util\YAML::dump($parameters)  );


                            break;

                        case Element::ELEMENT_TYPE_CODE:
                            if	( $conf['security']['disable_dynamic_code'] )
                                $this->addNotice('element',$this->element->name,'CODE_DISABLED',Action::NOTICE_WARN);

                            $this->setTemplateVar('code',$this->element->code);
                            break;
                    }
                    break;


                case 'decimals':
                    $this->setTemplateVar('decimals'     ,$this->element->decimals    );
                    break;

                case 'decPoint':
                    $this->setTemplateVar('dec_point'    ,$this->element->decPoint    );
                    break;

                case 'thousandSep':
                    $this->setTemplateVar('thousand_sep' ,$this->element->thousandSep );
                    break;


                // Eigenschaften Link
                case 'defaultObjectId':

                    $objects = array();

                    $template = new Template( $this->element->templateid );
                    $template->load();
                    $project = new Project( $template->projectid );

                    // Ermitteln aller verfuegbaren Objekt-IDs
                    foreach( $project->getAllObjectIds() as $id )
                    {
                        $o = new BaseObject( $id );
                        $o->load();

                        switch( $this->element->typeid )
                        {
                            case Element::ELEMENT_TYPE_LINK:
                                if	( ! in_array( $o->typeid, array(BaseObject::TYPEID_PAGE,BaseObject::TYPEID_IMAGE,BaseObject::TYPEID_FILE,BaseObject::TYPEID_LINK,BaseObject::TYPEID_URL,BaseObject::TYPEID_TEXT ) ) )
                                    continue 2;
                                break;
                            //Change tobias
                            case Element::ELEMENT_TYPE_INSERT:
                                if	( ! in_array( $o->typeid, array(BaseObject::TYPEID_FOLDER,BaseObject::TYPEID_PAGE,BaseObject::TYPEID_IMAGE,BaseObject::TYPEID_FILE,BaseObject::TYPEID_LINK,BaseObject::TYPEID_URL,BaseObject::TYPEID_TEXT ) ) )
                                    continue 2;
                                break;
                            //Change tobias end
                            default:
                                continue 2;
                        }

                        $objects[ $id ]  = \cms\base\Language::lang( $o->getType() ).': ';

                        if	( !$o->isRoot )
                        {
                            $f = new Folder( $o->parentid );
                            $f->load();
                            $names = $f->parentObjectNames(false,true);
                            foreach( $names as $fid=>$name )
                                $names[$fid] = Text::maxLength($name,15,'..',STR_PAD_BOTH);
                            $objects[ $id ] .= implode( FILE_SEP,$names );
                        }

                        $objects[ $id ] .= FILE_SEP.$o->name;
                    }

                    asort( $objects ); // Sortieren

                    $this->setTemplateVar('objects',$objects);

                    $this->setTemplateVar('default_objectid',$this->element->defaultObjectId);

                    break;


                case 'folderObjectId':


                    // Ermitteln aller verf?gbaren Objekt-IDs
                    $template = new Template( $this->element->templateid );
                    $template->load();
                    $project = new Project( $template->projectid );

                    $folders = $project->getAllFlatFolders();
                    $this->setTemplateVar('folders',$folders);

                    $this->setTemplateVar('folderobjectid'  ,$this->element->folderObjectId  );

                    break;

                default:
                    throw new \LogicException('Unknown element property: '.$propertyName );
            }
        }
	}
	

	
	/**
	 * Auswahlmaske f�r weitere Einstellungen zum Template-Element.
	 *
	 */
	function infoView()
	{
		$this->setTemplateVar('id'  ,$this->element->elementid );
		$this->setTemplateVar('name',$this->element->name );
		$this->setTemplateVar('type',$this->element->getTypeName() );
	}
	
	/**
	 * Auswahlmaske f�r weitere Einstellungen zum Template-Element.
	 *
	 */
	function propView()
	{
        // Name und Beschreibung
        $this->setTemplateVar('name'       ,$this->element->name);
        $this->setTemplateVar('label'      ,$this->element->label);

        $this->setTemplateVar('description',$this->element->desc);

        // Die verschiedenen Element-Typen
        $types = array();

        foreach( Element::getAvailableTypes() as $typeId=>$typeKey )
            $types[ $typeId ] = 'EL_'.$typeKey;

        // Code-Element nur fuer Administratoren (da voller Systemzugriff!)
        if	( !$this->userIsAdmin() )
            unset( $types['code'] );

        // Liste aller Elementtypen
        $this->setTemplateVar('types',$types);

        // Aktueller Typ
        $this->setTemplateVar('typeid',$this->element->typeid);
	}


	
	/**
	 * Speichern der Element-Eigenschaften.
	 */
	public function propPost()
	{
        if	( !$this->userIsAdmin() && $this->getRequestVar('type') == 'code' )
            // Code-Elemente fuer Nicht-Administratoren nicht benutzbar
            throw new \util\exception\ValidationException('type');

        $this->element->typeid = $this->getRequestId('typeid');

        $this->element->name = $this->getRequestVar('name'       ,RequestParams::FILTER_ALPHANUM);
        $this->element->label= $this->getRequestVar('label'      ,RequestParams::FILTER_TEXT);
        $this->element->desc = $this->getRequestVar('description',RequestParams::FILTER_TEXT);

        $this->element->save();

        $this->addNotice('element',$this->element->name,'SAVED',Action::NOTICE_OK);
	}
}

