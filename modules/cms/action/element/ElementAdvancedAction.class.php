<?php
namespace cms\action\element;
use cms\action\Action;
use cms\action\ElementAction;
use cms\action\Method;
use cms\action\RequestParams;
use cms\base\Configuration;
use cms\model\BaseObject;
use cms\model\Element;
use cms\model\Folder;
use cms\model\Project;
use cms\model\Template;
use language\Messages;
use ReflectionClass;
use ReflectionProperty;
use util\Text;


class ElementAdvancedAction extends ElementAction implements Method {
    public function view() {
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
                                'mime_type',
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
                            $macroFiles = \util\FileUtils::readDir(__DIR__ . '/../../../cms/macros/macro');
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
                            if	( Configuration::subset('security')->is('disable_dynamic_code',true ) )
                                $this->addWarningFor( $this->element, Messages::CODE_DISABLED);

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


    public function post() {
        $ini_date_format = Configuration::subset('date')->get('format',[] );

        if	( $this->request->has('format'))
            $this->element->format = $this->request->getNumber('format');


        if	( $this->request->has('dateformat'))
            $this->element->dateformat  = @$ini_date_format[$this->request->getText('dateformat')];


        if	( $this->request->has('default_longtext'))
            $this->element->defaultText     = $this->request->getText('default_longtext');
        else
            $this->element->defaultText     = $this->request->getText('default_text');

        $this->element->subtype         = $this->request->getText('subtype');

        $this->element->html            = $this->request->has('html');
        $this->element->withIcon        = $this->request->has('with_icon');
        $this->element->allLanguages    = $this->request->has('all_languages');
        $this->element->writable        = $this->request->has('writable');
        $this->element->inherit         = $this->request->has('inherit');

        $this->element->decimals        = $this->request->getText('decimals');
        $this->element->decPoint        = $this->request->getText('dec_point');
        $this->element->thousandSep     = $this->request->getText('thousand_sep');
        $this->element->folderObjectId  = $this->request->getText('folderobjectid'  );
        $this->element->defaultObjectId = $this->request->getText('default_objectid');

        if	( $this->request->has('select_items'))
            $this->element->code         = $this->request->getText('select_items');
        else
            $this->element->code         = $this->request->getRaw('code');

        if	( $this->request->has('name') )
            $this->element->name = $this->request->getText('name');

        if	( $this->request->has('linkelement') )
            $this->element->setPrefix( $this->request->getText('linkelement') );

        if	( $this->request->has('parameters'))
            $this->element->code = $this->request->getText('parameters');

        $this->element->save();
        $this->addNoticeFor( $this->element, Messages::SAVED);

    }
}
