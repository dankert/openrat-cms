<?php

namespace cms\action;


use cms\model\Element;
use cms\model\Project;
use cms\model\Template;
use cms\model\Folder;
use cms\model\BaseObject;
use Text;


// OpenRat Content Management System
// Copyright (C) 2002-2012 Jan Dankert, cms@jandankert.de
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; version 2.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.

/**
 * Action-Klasse fuer die Bearbeitung eines Template-Elementes.
 * 
 * @author Jan Dankert
 * @package openrat.actions
 */
class ElementAction extends Action
{
	public $security = SECURITY_USER;
	
	var $element;

    private $template;

    /**
	 * Konstruktor
	 */
	function __construct()
	{
        parent::__construct();

        if	( $this->getRequestId() == 0 )
			die('no element-id available');

		$this->element = new Element( $this->getRequestId() );
		$this->element->load();

		$this->setTemplateVar( 'elementid' ,$this->element->elementid   );
	}



	/**
	 * Umbenennen des Elementes
	 */
	function editPost()
	{
		$this->element->name = $this->getRequestVar('name'       ,OR_FILTER_ALPHANUM);
		$this->element->desc = $this->getRequestVar('description','all'     );

		$this->element->save();
		$this->element->load();
		
		$this->addNotice('element',$this->element->name,'SAVED',OR_NOTICE_OK);
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
		{
			$this->addValidationError('confirm');
			return;
		}
		
		$type = $this->getRequestVar('type','abc');
		
		if ( $type == 'value' )
		{
			$this->element->deleteValues();
			$this->addNotice('element',$this->template->name,'DELETED',OR_NOTICE_OK);
		}
		elseif ( $type == 'all' )
		{
			$this->element->delete();
			$this->addNotice('element',$this->template->name,'DELETED',OR_NOTICE_OK);
		}
	}



	/**
	 * Aendern des Element-Typs
	 */
	public function advancedPost()
	{
		if	( !$this->userIsAdmin() && $this->getRequestVar('type') == 'code' )
		{
			// Code-Elemente fuer Nicht-Administratoren nicht benutzbar
			$this->addNotice('element',$this->template->name,'CANCELED',OR_NOTICE_ERROR);
		}
		else
		{
			// Neuen Typ setzen und speichern
			$this->element->setType( $this->getRequestVar('type') );
			$this->addNotice('element',$this->element->name,'SAVED',OR_NOTICE_OK);
		}
	}


	/**
	 * Anzeigen des Elementes
	 */
	function editView()
	{

		// Name und Beschreibung
		$this->setTemplateVar('name'       ,$this->element->name);

		$this->setTemplateVar('description',$this->element->desc);
	}
	
	
	
	public function advancedView()
	{
		// Die verschiedenen Element-Typen
		$types = array();

		foreach( $this->element->getAvailableTypes() as $typeid=>$t )
			$types[ $typeid ] = 'EL_'.$t;

		// Code-Element nur fuer Administratoren (da voller Systemzugriff!)		
		if	( !$this->userIsAdmin() )
			unset( $types['code'] );
		
		// Liste aller Elementtypen
		$this->setTemplateVar('types',$types);
		
		// Aktueller Typ
		$this->setTemplateVar('type',$this->element->type);
	}
	

	
	/**
	 * Auswahlmaske f�r weitere Einstellungen zum Template-Element.
	 *
	 */
	function infoView()
	{
		$this->setTemplateVar('id'  ,$this->element->elementid );
		$this->setTemplateVar('name',$this->element->name );
	}
	
	/**
	 * Auswahlmaske f�r weitere Einstellungen zum Template-Element.
	 *
	 */
	function propView()
	{
		global $conf;
		$this->setTemplateVar('type',$this->element->type );
		
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

				case 'subtype':

					$convertToLang = false;
					switch( $this->element->type )
					{
						case 'info':
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

						case 'infodate':
						case 'linkdate':
							$subtypes = Array('date_published',
							                 'date_saved',
							                 'date_created' );
							$convertToLang = true;
							break;

						case 'link':
							$subtypes = Array(
							                  'file',
							                  'image',
							                  'image_data_uri',
							                  'page',
							                  'folder',
							                  'link' );
							$convertToLang = true;
							break;

						case 'linkinfo':
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

						case 'insert':
							$subtypes = Array('inline',
							                  'ssi'     );
							$convertToLang = true;
							break;

						case 'dynamic':
									
							$files = Array();
							$handle = opendir ('./macro');
							while ( $file = readdir($handle) )
							{
								$file = substr($file,0,strlen($file)-10);
								if	( $file != '' )
									$files[$file] = $file;
							}
							closedir($handle);

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
							$subtypes[$v] = lang('EL_'.$this->element->type.'_'.$v);
						}
					}
					
					// Variable $subtype muss existieren, um Anzeige des Feldes zu erzwingen.
					if (!isset($this->element->subtype))
						$this->element->subtype='';
	
					$this->setTemplateVar('subtypes',$subtypes              );
					$this->setTemplateVar('subtype' ,$this->element->subtype);
	
					break;
	
	
				case 'dateformat':

					$ini_date_format = $conf['date']['format'];
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
				
					switch( $this->element->type )
					{
						case 'longtext':
							$this->setTemplateVar('default_longtext',$this->element->defaultText );
							break;

						case 'select':
						case 'text':
							$this->setTemplateVar('default_text'    ,$this->element->defaultText );
							break;
					}
					break;
				
				
				case 'htmlwiki':
					if	( !$this->element->wiki && !$this->element->html )
						$format = 'none';
					elseif	( $this->element->wiki && !$this->element->html )
						$format = 'wiki';
					elseif	( !$this->element->wiki && $this->element->html )
						$format = 'html';
					elseif	( $this->element->wiki && $this->element->html )
						$format = 'wiki,html';
						
					$this->setTemplateVar('format', $format );
					
					$formatlist = array();
					$formatlist['none'     ] = 'raw';      // Nur Text, ohne Auszeichnungen
					// Für einfache Textelemente gibt es keinen HTML-Editor
					if	( $this->element->type == 'longtext' )
						$formatlist['html'     ] = 'html'; // Text mit HTML-Editor
					$formatlist['wiki'     ] = 'wiki';     // Text mit Markup, HTML nicht erlaubt
					$formatlist['wiki,html'] = 'wikihtml'; // Text mit Markup, HTML erlaubt
					
					foreach( $formatlist as $t=>$v )
						$formatlist[$t] = array('lang'=>'EL_PROP_'.$v);
					
					$this->setTemplateVar('formatlist', $formatlist );
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
								$names[$element->name] = $t->name.' - '.$element->name.' ('.lang('EL_'.$element->type).')';
						}
						unset($t);
					}
					
					
					$this->setTemplateVar('names',$names );

					list($linkElementName,$targetElementName) = explode('%',$this->element->name.'%');
					$this->setTemplateVar('name',$targetElementName );
					break;

				// Eigenschaften PHP-Code
				case 'code':

					switch( $this->element->type )
					{

						case 'select':
							$this->setTemplateVar('select_items',$this->element->code );
							break;

						case 'dynamic':

							$className = $this->element->subtype;
							$fileName  = OR_DYNAMICCLASSES_DIR.'/'.$className.'.class.'.PHP_EXT;

							if	( is_file( $fileName ) )
							{
								require( $fileName );

								if	( class_exists($className) )
								{
									$dynEl = new $className;

									$desc = array();
									
									$description = $dynEl->description;
									$paramList   = array();

									$old = $this->element->getDynamicParameters();
									$parameters = '';

									foreach( get_object_vars($dynEl) as $paramName=>$paramDesc )
									{
										if	( isset( $dynEl->$paramName ) )
										{
											if	( is_object($dynEl->$paramName))
												continue;
											if	( is_array($dynEl->$paramName))
												continue;
											if	( in_array($paramName,array('output')))
												continue;
											$paramList[$paramName] = $dynEl->$paramName;

											$parameters .= $paramName.':';
											if	( !empty($old[$paramName]) )
												$parameters .= $old[$paramName];
											else
												$parameters .= $dynEl->$paramName;
											$parameters .= "\n";
										}
									}
									
									$this->setTemplateVar('dynamic_class_description',$dynEl->description );
									$this->setTemplateVar('dynamic_class_parameters' ,$paramList          );
									$this->setTemplateVar('parameters'               ,$parameters         );
								}
							}
							
							break;

						case 'code':
							if	( $conf['security']['disable_dynamic_code'] )
								$this->addNotice('element',$this->element->name,'CODE_DISABLED',OR_NOTICE_WARN);
								
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
						
						switch( $this->element->type )
						{
							case 'list':
								if	( !$o->isFolder )
									continue 2;
								break;

							case 'link':
								if	( !$o->isPage && !$o->isFile && !$o->isLink )
									continue 2;
								break;
						        //Change tobias 
							case 'insert':
								if	( !$o->isFolder && !$o->isPage && !$o->isFile && !$o->isLink )
									continue 2;
								break;
							//Change tobias end
							default:
								continue 2;
						}

						$objects[ $id ]  = lang( $o->getType() ).': ';
						
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

					$folders = array();
	
					// Ermitteln aller verf?gbaren Objekt-IDs
					foreach( Folder::getAllFolders() as $id )
					{
						$o = new BaseObject( $id );
						$o->load();
						
						$folders[ $id ] = '';
						if	( !$o->isRoot )
						{
							$f = new Folder( $o->parentid );
							$f->load();
							$names = $f->parentObjectNames(true,true);
							foreach( $names as $fid=>$name )
								$names[$fid] = Text::maxLength($name,15,'..',STR_PAD_BOTH);
							$folders[ $id ] = implode( ' &raquo; ',$names );
							$folders[ $id ] .= ' &raquo; ';
						} 
						$folders[ $id ] .= $o->name;
					}
			
					asort( $folders ); // Sortieren
	
					$this->setTemplateVar('folders',$folders);		
	
					$this->setTemplateVar('folderobjectid'  ,$this->element->folderObjectId  );
	
					break;

				default:
					throw new \LogicException('not an element property: '.$propertyName );
			}
		}
	}


	
	/**
	 * Speichern der Element-Eigenschaften
	 */
	function propPost()
	{
		global $conf;
		$ini_date_format = $conf['date']['format'];
	
		if	( $this->hasRequestVar('dateformat'))
			$this->element->dateformat  = $ini_date_format[$this->getRequestVar('dateformat')];
		$this->element->subtype         = $this->getRequestVar('subtype');
		
		if	( $this->hasRequestVar('default_longtext'))
			$this->element->defaultText     = $this->getRequestVar('default_longtext',OR_FILTER_RAW);
		else
			$this->element->defaultText     = $this->getRequestVar('default_text',OR_FILTER_ALPHANUM);
		$this->element->wiki            = in_array('wiki',explode(',',$this->getRequestVar('format')));
		$this->element->html            = in_array('html',explode(',',$this->getRequestVar('format')));
		$this->element->withIcon        = $this->getRequestVar('with_icon') != '';
		$this->element->allLanguages    = $this->getRequestVar('all_languages') != '';
		$this->element->writable        = $this->getRequestVar('writable') != '';
		$this->element->decimals        = $this->getRequestVar('decimals');
		$this->element->decPoint        = $this->getRequestVar('dec_point');
		$this->element->thousandSep     = $this->getRequestVar('thousand_sep');
		$this->element->folderObjectId  = $this->getRequestVar('folderobjectid'  );
		$this->element->defaultObjectId = $this->getRequestVar('default_objectid');
		if	( $this->hasRequestVar('select_items'))
			$this->element->code         = $this->getRequestVar('select_items');
		else
			$this->element->code         = $this->getRequestVar('code'            ,'raw');

		if	( $this->hasRequestVar('name') )
			$this->element->name = $this->getRequestVar('name');

		if	( $this->hasRequestVar('linkelement') )
			$this->element->setPrefix( $this->getRequestVar('linkelement') );
		
		if	( $this->hasRequestVar('parameters'))
			$this->element->code = $this->getRequestVar('parameters',OR_FILTER_RAW);
		
//		Html::debug($this->element);
		$this->element->save();
		$this->addNotice('element',$this->element->name,'SAVED');
		
	}
}

?>