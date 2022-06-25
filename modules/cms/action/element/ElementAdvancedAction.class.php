<?php
namespace cms\action\element;
use cms\action\Action;
use cms\action\ElementAction;
use cms\action\Method;
use cms\action\RequestParams;
use cms\base\Configuration;
use cms\generator\ValueGenerator;
use cms\model\BaseObject;
use cms\model\Element;
use cms\model\Folder;
use cms\model\Project;
use cms\model\Template;
use language\Messages;
use ReflectionClass;
use ReflectionProperty;
use util\FileUtils;
use util\Text;


class ElementAdvancedAction extends ElementAction implements Method {

	const PROP_INHERIT = 'inherit';
	const PROP_WITHICON = 'withIcon';
	const PROP_ALL_LANGUAGES = 'allLanguages';
	const PROP_WRITABLE = 'writable';
	const PROP_HTML = 'html';
	const PROP_DEFAULT_TEXT = 'defaultText';
	const PROP_FORMAT = 'format';
	const PROP_LINKTYPE = 'linktype';
	const PROP_FOLDER_OBJECTID ='folderObjectId';
	const PROP_DEFAULT_OBJECTID ='defaultObjectId';
	const PROP_SUBTYPE = 'subtype';
	const PROP_DECPOINT = 'decPoint';
	const PROP_DECIMALS = 'decimals';
	const PROP_THOUSANDSEP = 'thousandSep';
	const PROP_CODE = 'code';
	const PROP_DATEFORMAT = 'dateformat';
	const PROP_PREFIX = 'prefix';
	const PROP_NAME = 'name';

	public function view() {

        $this->setTemplateVar('type',$this->element->getTypeName() );

        // Abhaengig vom aktuellen Element-Typ die Eigenschaften anzeigen
        foreach( $this->getRelatedProperties() as $propertyName )
        {
            switch( $propertyName )
            {
                case self::PROP_WITHICON:
                    $this->setTemplateVar('with_icon'    ,$this->element->withIcon    );
                    break;

                case self::PROP_ALL_LANGUAGES:
                    $this->setTemplateVar('all_languages',$this->element->allLanguages);
                    break;

                case self::PROP_WRITABLE:
                    $this->setTemplateVar('writable'     ,$this->element->writable    );
                    break;

                case self::PROP_INHERIT:
                    $this->setTemplateVar('inherit'     ,$this->element->inherit      );
                    break;

                case self::PROP_HTML:
                    $this->setTemplateVar('html'       ,$this->element->html          );
                    break;

                case self::PROP_SUBTYPE:

                    $convertToLang = false;
                    switch( $this->element->typeid )
                    {
                        case Element::ELEMENT_TYPE_INFO:
                            $subtypes = [
                            	ValueGenerator::INFO_DB_ID,
                                ValueGenerator::INFO_DB_NAME,
                                ValueGenerator::INFO_PROJECT_ID,
                                ValueGenerator::INFO_PROJECT_NAME,
                                ValueGenerator::INFO_LANGUAGE_ID,
                                ValueGenerator::INFO_LANGUAGE_ISO,
                                ValueGenerator::INFO_LANGUAGE_NAME,
                                ValueGenerator::INFO_PAGE_ID,
                                ValueGenerator::INFO_PAGE_NAME,
                                ValueGenerator::INFO_PAGE_DESC,
                                ValueGenerator::INFO_PAGE_FULLFILENAME,
                                ValueGenerator::INFO_PAGE_FILENAME,
                                ValueGenerator::INFO_PAGE_EXTENSION,
                                ValueGenerator::INFO_EDIT_URL,
                                ValueGenerator::INFO_EDIT_FULLURL,
                                ValueGenerator::INFO_LASTCHANGE_USER_USERNAME,
                                ValueGenerator::INFO_LASTCHANGE_USER_FULLNAME,
                                ValueGenerator::INFO_LASTCHANGE_USER_MAIL,
                                ValueGenerator::INFO_LASTCHANGE_USER_DESC,
                                ValueGenerator::INFO_LASTCHANGE_USER_TEL,
                                ValueGenerator::INFO_CREATION_USER_USERNAME,
                                ValueGenerator::INFO_CREATION_FULLNAME,
                                ValueGenerator::INFO_CREATION_MAIL,
                                ValueGenerator::INFO_CREATION_DESC,
                                ValueGenerator::INFO_CREATION_TEL,
                                ValueGenerator::INFO_ACT_USERNAME,
                                ValueGenerator::INFO_ACT_FULLNAME,
                                ValueGenerator::INFO_ACT_MAIL,
                                ValueGenerator::INFO_ACT_DESC,
                                ValueGenerator::INFO_ACT_TEL,
                                ValueGenerator::INFO_PUB_USERNAME,
                                ValueGenerator::INFO_PUB_FULLNAME,
                                ValueGenerator::INFO_PUB_MAIL,
                                ValueGenerator::INFO_PUB_DESC,
                                ValueGenerator::INFO_PUB_TEL
							];
                            $convertToLang = true;
                            break;

                        case Element::ELEMENT_TYPE_INFODATE:
                        case Element::ELEMENT_TYPE_LINKDATE:
                            $subtypes = [
                            	ValueGenerator::INFO_DATE_PUBLISHED,
								ValueGenerator::INFO_DATE_SAVED,
								ValueGenerator::INFO_DATE_CREATED,
							];
                            $convertToLang = true;
                            break;

                        case Element::ELEMENT_TYPE_LINK:
                            $subtypes = [
								ValueGenerator::LINK_FILE_,
                                ValueGenerator::LINK_IMAGE,
                                ValueGenerator::LINK_IMAGE_DATE_URI,
                                ValueGenerator::LINK_PAGE,
                                ValueGenerator::LINK_FOLDER,
                                ValueGenerator::LINK_LINK
							];
                            $convertToLang = true;
                            break;

                        case Element::ELEMENT_TYPE_CODE:

                            $subtypes = [
                                ValueGenerator::CODE_PHP,
                                ValueGenerator::CODE_SCRIPT,
                                ValueGenerator::CODE_MUSTACHE,
							];
                            $convertToLang = true;
                            break;

                        case Element::ELEMENT_TYPE_LINKINFO:
                            $subtypes = [
								ValueGenerator::LINKINFO_WIDTH,
								ValueGenerator::LINKINFO_HEIGHT,
								ValueGenerator::LINKINFO_ID,
								ValueGenerator::LINKINFO_NAME,
								ValueGenerator::LINKINFO_DESCRIPTION,
								ValueGenerator::LINKINFO_MIME_TYPE,
								ValueGenerator::INFO_LASTCHANGE_USER_USERNAME,
								ValueGenerator::INFO_LASTCHANGE_USER_FULLNAME,
								ValueGenerator::INFO_LASTCHANGE_USER_MAIL,
								ValueGenerator::INFO_LASTCHANGE_USER_DESC,
								ValueGenerator::INFO_LASTCHANGE_USER_TEL,
								ValueGenerator::INFO_CREATION_USER_USERNAME,
								ValueGenerator::INFO_CREATION_FULLNAME,
								ValueGenerator::INFO_CREATION_MAIL,
								ValueGenerator::INFO_CREATION_DESC,
								ValueGenerator::INFO_CREATION_TEL,
								ValueGenerator::INFO_PUB_USERNAME,
								ValueGenerator::INFO_PUB_FULLNAME,
								ValueGenerator::INFO_PUB_MAIL,
								ValueGenerator::INFO_PUB_DESC,
								ValueGenerator::INFO_PUB_TEL,
								ValueGenerator::INFO_FILENAME,
								ValueGenerator::INFO_FULL_FILENAME
							];
                            $convertToLang = true;
                            break;

                        case Element::ELEMENT_TYPE_INSERT:
                            $subtypes = [
                            	ValueGenerator::INSERT_INLINE,
								ValueGenerator::INSERT_SSI,
								ValueGenerator::INSERT_ESI,
							];
                            $convertToLang = true;
                            break;

                        case Element::ELEMENT_TYPE_DATA:
                        	break;

                        case Element::ELEMENT_TYPE_COORD:
                            $subtypes = [
								ValueGenerator::COORD_OLC,
								ValueGenerator::COORD_COORDINATES,
							];
                            $convertToLang = true;
                            break;

                        case Element::ELEMENT_TYPE_DYNAMIC:

                            $files = Array();
                            $macroFiles = FileUtils::readDir(__DIR__ . '/../../../cms/macros/macro');
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


                case self::PROP_DATEFORMAT:

                    $ini_date_format = Configuration::subset('date')->get('format',[]);
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
                case self::PROP_DEFAULT_TEXT:

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


                case self::PROP_FORMAT:
                    $this->setTemplateVar('format', $this->element->format );

                    $formats = Element::getAvailableFormats();

                    // Für einfache Textelemente gibt es keinen HTML-Editor
                    if	( $this->element->typeid != Element::ELEMENT_TYPE_LONGTEXT )
                        unset( $formats[ Element::ELEMENT_FORMAT_HTML ] );

                    //foreach( $formats as $t=>$v )
                    //    $formats[$t] = array('lang'=>'EL_PROP_FORMAT_'.$v);

                    $this->setTemplateVar('formatlist', $formats);
                    break;

                case self::PROP_LINKTYPE:
                    $this->setTemplateVar('linktype', $this->element->wiki );
                    $this->setTemplateVar('linktypelist', array('page','file','link') );
                    break;

                case self::PROP_PREFIX:
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

                case self::PROP_NAME:

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
                case self::PROP_CODE:

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
                            if	( Configuration::subset('security')->is('disable_dynamic_code',true ) )
                                $this->addWarningFor( $this->element, Messages::CODE_DISABLED);

                            $this->setTemplateVar('code',$this->element->code);
                            break;

						default:
							$this->setTemplateVar('code',$this->element->code);
                    }
                    break;


                case self::PROP_DECIMALS:
                    $this->setTemplateVar('decimals'     ,$this->element->decimals    );
                    break;

                case self::PROP_DECPOINT:
                    $this->setTemplateVar('dec_point'    ,$this->element->decPoint    );
                    break;

                case self::PROP_THOUSANDSEP:
                    $this->setTemplateVar('thousand_sep' ,$this->element->thousandSep );
                    break;


                // Eigenschaften Link
                case self::PROP_DEFAULT_OBJECTID:

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

                        if	( !$o->isRoot() )
                        {
                            $f = new Folder( $o->parentid );
                            $f->load();
                            $names = $f->parentObjectNames(false,true);
                            foreach( $names as $fid=>$name )
                                $names[$fid] = Text::maxLength($name,15,'..',STR_PAD_BOTH);
                            $objects[ $id ] .= implode( \util\Text::FILE_SEP,$names );
                        }

                        $objects[ $id ] .= \util\Text::FILE_SEP.$o->getName();
                    }

                    asort( $objects ); // Sortieren

                    $this->setTemplateVar('objects',$objects);

                    $this->setTemplateVar('default_objectid',$this->element->defaultObjectId);

                    break;


                case self::PROP_FOLDER_OBJECTID:


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


    public function post() {

        $this->request->handleNumber('format',function($value) {
			$this->element->format = $value;
		});


        $this->request->handleText('dateformat',function($value) {
			$this->element->dateformat = @Configuration::subset('date')->get('format',[] )[$value];
		});


        $this->request->handleText('default_longtext',function($value) {
			$this->element->defaultText = $value;
		});
        $this->request->handleText('default_text',function($value) {
			$this->element->defaultText = $value;
		});

		$this->request->handleText('subtype',function($value) {
			$this->element->subtype = $value;
		});

		$this->request->handleBool('html',function($value) {
			$this->element->html = $value;
		});
		$this->request->handleBool('with_icon',function($value) {
			$this->element->withIcon = $value;
		});
		$this->request->handleBool('all_languages',function($value) {
			$this->element->allLanguages = $value;
		});
		$this->request->handleBool('writable',function($value) {
			$this->element->writable = $value;
		});
		$this->request->handleBool('inherit',function($value) {
			$this->element->inherit = $value;
		});

		$this->request->handleText('decimals',function($value) {
			$this->element->decimals = $value;
		});
		$this->request->handleText('dec_point',function($value) {
			$this->element->decPoint = $value;
		});
		$this->request->handleText('thousand_sep',function($value) {
			$this->element->thousandSep = $value;
		});
		$this->request->handleText('folderobjectid',function($value) {
			$this->element->folderObjectId = $value;
		});
		$this->request->handleText('default_objectid',function($value) {
			$this->element->defaultObjectId = $value;
		});


		$this->request->handleText('select_items',function($value) {
			$this->element->code = $value;
		});
		$this->request->handleText('code',function($value) {
			$this->element->code = $value;
		});

		$this->request->handleText('name',function($value) {
			$this->element->name = $value;
		});
		$this->request->handleText('linkelement',function($value) {
			$this->element->setPrefix( $value );
		});
		$this->request->handleText('parameters',function($value) {
			$this->element->code = $value;
		});

        $this->element->save();
        $this->addNoticeFor( $this->element, Messages::SAVED);

    }



	/**
	 * Abhaengig vom Element-Typ werden die zur Darstellung notwendigen Eigenschaften ermittelt.
	 * @return string[]
	 */
	protected function getRelatedProperties()
	{
		$relatedProperties = [
			Element::ELEMENT_TYPE_TEXT     => [self::PROP_INHERIT,self::PROP_WITHICON,self::PROP_ALL_LANGUAGES,self::PROP_WRITABLE,self::PROP_HTML,self::PROP_DEFAULT_TEXT,self::PROP_FORMAT,self::PROP_CODE],
			Element::ELEMENT_TYPE_LONGTEXT => [self::PROP_INHERIT,self::PROP_WITHICON,self::PROP_ALL_LANGUAGES,self::PROP_WRITABLE,self::PROP_HTML,self::PROP_DEFAULT_TEXT,self::PROP_FORMAT,self::PROP_CODE],
			Element::ELEMENT_TYPE_SELECT   => [self::PROP_INHERIT,self::PROP_WITHICON,self::PROP_ALL_LANGUAGES,self::PROP_WRITABLE,self::PROP_DEFAULT_TEXT,self::PROP_CODE],
			Element::ELEMENT_TYPE_NUMBER   => [self::PROP_INHERIT,self::PROP_WITHICON,self::PROP_ALL_LANGUAGES,self::PROP_WRITABLE,self::PROP_DECPOINT,self::PROP_DECIMALS,self::PROP_THOUSANDSEP,self::PROP_CODE],
			Element::ELEMENT_TYPE_CHECKBOX => [self::PROP_INHERIT,self::PROP_WITHICON,self::PROP_ALL_LANGUAGES,self::PROP_WRITABLE,self::PROP_CODE],
			Element::ELEMENT_TYPE_LINK     => [self::PROP_INHERIT,self::PROP_SUBTYPE,self::PROP_WITHICON,self::PROP_ALL_LANGUAGES,self::PROP_WRITABLE,self::PROP_LINKTYPE,self::PROP_FOLDER_OBJECTID,self::PROP_DEFAULT_OBJECTID,self::PROP_CODE],
			Element::ELEMENT_TYPE_DATE     => [self::PROP_INHERIT,self::PROP_WITHICON,self::PROP_ALL_LANGUAGES,self::PROP_WRITABLE,self::PROP_DATEFORMAT,self::PROP_DEFAULT_TEXT,self::PROP_CODE],
			Element::ELEMENT_TYPE_INSERT   => [self::PROP_INHERIT,self::PROP_SUBTYPE,self::PROP_WITHICON,self::PROP_ALL_LANGUAGES,self::PROP_WRITABLE,self::PROP_FOLDER_OBJECTID,self::PROP_DEFAULT_OBJECTID],
			Element::ELEMENT_TYPE_COPY     => [self::PROP_INHERIT,self::PROP_PREFIX,self::PROP_NAME,self::PROP_DEFAULT_TEXT],
			Element::ELEMENT_TYPE_LINKINFO => [self::PROP_PREFIX,self::PROP_SUBTYPE,self::PROP_DEFAULT_TEXT,self::PROP_CODE],
			Element::ELEMENT_TYPE_LINKDATE => [self::PROP_PREFIX,self::PROP_SUBTYPE,self::PROP_DATEFORMAT,self::PROP_CODE],
			Element::ELEMENT_TYPE_CODE     => [self::PROP_SUBTYPE,self::PROP_CODE],
			Element::ELEMENT_TYPE_DYNAMIC  => [self::PROP_SUBTYPE,self::PROP_CODE],
			Element::ELEMENT_TYPE_INFO     => [self::PROP_SUBTYPE],
			Element::ELEMENT_TYPE_INFODATE => [self::PROP_SUBTYPE,self::PROP_DATEFORMAT,self::PROP_CODE],
			Element::ELEMENT_TYPE_DATA     => [self::PROP_INHERIT,self::PROP_WITHICON,self::PROP_ALL_LANGUAGES,self::PROP_WRITABLE,self::PROP_CODE],
			Element::ELEMENT_TYPE_COORD    => [self::PROP_INHERIT,self::PROP_WITHICON,self::PROP_ALL_LANGUAGES,self::PROP_WRITABLE,self::PROP_SUBTYPE,self::PROP_CODE],
		];

		return $relatedProperties[ $this->element->typeid ];
	}

}
