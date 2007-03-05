<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// OpenRat Content Management System
// Copyright (C) 2002-2004 Jan Dankert, cms@jandankert.de
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
//
// ---------------------------------------------------------------------------

/**
 * Action-Klasse fuer die Bearbeitung eines Template-Elementes
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */
class ElementAction extends Action
{
	var $element;

	/**
	 * Konstruktor
	 */
	function ElementAction()
	{
		if	( $this->getRequestId() == 0 )
			die('no element-id available');

		$this->element = new Element( $this->getRequestId() );
		$this->element->load();

		$this->setTemplateVar( 'elementid' ,$this->element->elementid   );
	}



	/**
	 * Umbenennen des Elementes
	 */
	function savename()
	{
		$this->element->name = $this->getRequestVar('name'       );
		$this->element->desc = $this->getRequestVar('description');

		$this->element->save();
		$this->element->load();
	}



	/**
	 * Umbenennen des Elementes
	 */
	function remove()
	{
	}
	
	
	/**
	 * Umbenennen des Elementes
	 */
	function delete()
	{
		if ( $this->hasRequestVar('deletevalues') )
		{
			$this->element->deleteValues();
		}
		elseif ( $this->hasRequestVar('delete') )
		{
			$this->element->delete();
		}
	}



	/**
	 * Aendern des Element-Typs
	 */
	function savetype()
	{
		if	( !$this->userIsAdmin() && $this->getRequestVar('type') == 'code' )
		{
			// Code-Elemente fuer Nicht-Administratoren nicht benutzbar
		}
		else
		{
			// Neuen Typ setzen und speichern
			$this->element->setType( $this->getRequestVar('type') );
		}
	}


	/**
	 * Anzeigen des Elementes
	 */
	function name()
	{

		// Name und Beschreibung
		$this->setTemplateVar('name'       ,$this->element->name);

		$this->setTemplateVar('description',$this->element->desc);
	}
	
	
	
	function type()
	{
		// Die verschiedenen Element-Typen
		$types = array();

		foreach( $this->element->getAvailableTypes() as $t )
			$types[ $t ] = lang('EL_'.$t);

		// Code-Element nur fuer Administratoren (da voller Systemzugriff!)		
		if	( !$this->userIsAdmin() )
			unset( $types['code'] );
		
		// Liste aller Elementtypen
		$this->setTemplateVar('types',$types);
		
		// Aktueller Typ
		$this->setTemplateVar('type',$this->element->type);
	}
	
	
	function properties()
	{
		global $conf;
		
//		Html::debug($this->element);

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
							$subtypes = Array('date_published',
							                 'date_saved',
							                 'date_created' );
							$convertToLang = true;
							break;

						case 'dynamic':
							
							$files = Array();
							$handle = opendir ('./dynamicClasses');
							while ( $file = readdir($handle) )
							{
								$file = substr($file,0,strlen($file)-10);
								if	( $file != '' )
									$files[$file] = $file;
							}
							closedir($handle);

							$subtypes = $files;
							break;

						case 'copy':
							$subtypes = array();
							break;

						default:
							$subtypes = array();
							break;
					}

					if	( $convertToLang == true )
					{
						foreach( $subtypes as $t )
						{
							$subtypes[$t] = lang('EL_'.$this->element->type.'_'.$t);
						}
					}
					
					// Variable $subtype muss existieren, um Anzeige des Feldes zu erzwingen.
					if (!isset($this->element->subtype))
						$this->element->subtype='';
	
					$this->setTemplateVar('subtypes',$subtypes              );
					$this->setTemplateVar('subtype' ,$this->element->subtype);
	
					break;
	
	
				case 'dateformat':

					$ini_date_format = $conf['date-formats'];
					$dateformat = array();

					$this->setTemplateVar('dateformat','');

					foreach($ini_date_format as $idx=>$d)
					{
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
				
				
				case 'wiki':
					$this->setTemplateVar('wiki',$this->element->wiki        );
					//Html::debug($this->templateVars);
					break;
				
				
				case 'html':
					$this->setTemplateVar('html',$this->element->html        );
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
										if	( in_array($paramName,array('objectid','output','parameters','description')) )
											continue;
 
										if	( isset( $dynEl->$paramName ) )
										{
											$paramList[$paramName] = $dynEl->$paramName;

											$parameters .= $paramName.':';
											if	( !empty($old[$paramName]) )
												$parameters .= $old[$paramName];
											$parameters .= "\n";
										}
									}
									
									$this->setTemplateVar('dynamic_class_description',$dynEl->description );
									$this->setTemplateVar('dynamic_class_parameters' ,$paramList );
									$this->setTemplateVar('parameters',htmlentities($parameters) );
								}
							}
							
							break;

						case 'code':
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
	
					// Ermitteln aller verfuegbaren Objekt-IDs
					foreach( Folder::getAllObjectIds() as $id )
					{
						$o = new Object( $id );
						$o->load();
						
						switch( $this->element->type )
						{
							case 'list':
								if	( !$o->isFolder )
									continue 2;
								break;

							case 'link':
								if	( !$o->isPage && !$o->isFile )
									continue 2;
								break;
							
							default:
								continue 2;
						}

						$objects[ $id ]  = lang( 'GLOBAL_'.$o->getType() ).': ';
						
						if	( !$o->isRoot )
						{
							$f = new Folder( $o->parentid );
							$f->load();
							$objects[ $id ] .= implode( FILE_SEP,$f->parentObjectNames(false,true) ); 
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
						$o = new Object( $id );
						$o->load();
						
						$folders[ $id ] = '';
						if	( !$o->isRoot )
						{
							$f = new Folder( $o->parentid );
							$f->load();
							$folders[ $id ] = implode( ' &raquo; ',$f->parentObjectNames(true,true) );
							$folders[ $id ] .= ' &raquo; ';
						} 
						$folders[ $id ] .= $o->name;
					}
			
					asort( $folders ); // Sortieren
	
					$this->setTemplateVar('folders',$folders);		
	
					$this->setTemplateVar('folderobjectid'  ,$this->element->folderObjectId  );
	
					break;

				default:
					$this->message('ERROR','not an element property: '.$propertyName );
			}
		}
	}


	
	/**
	 * Speichern der Element-Eigenschaften
	 */
	function saveproperties()
	{
		global $conf;
		$ini_date_format = $conf['date-formats'];
	
		if	( $this->hasRequestVar('dateformat'))
			$this->element->dateformat  = $ini_date_format[$this->getRequestVar('dateformat')];
		$this->element->subtype         = $this->getRequestVar('subtype');
		
		if	( $this->hasRequestVar('default_longtext'))
			$this->element->defaultText     = $this->getRequestVar('default_longtext');
		else
			$this->element->defaultText     = $this->getRequestVar('default_text');
		$this->element->wiki            = $this->getRequestVar('wiki') != '';
		$this->element->html            = $this->getRequestVar('html') != '';
		$this->element->withIcon        = $this->getRequestVar('with_icon') != '';
		$this->element->allLanguages    = $this->getRequestVar('all_languages') != '';
		$this->element->writable        = $this->getRequestVar('writable') != '';
		$this->element->decimals        = $this->getRequestVar('decimals');
		$this->element->decPoint        = $this->getRequestVar('dec_point');
		$this->element->thousandSep     = $this->getRequestVar('thousand_sep');
		$this->element->folderObjectId  = $this->getRequestVar('folderobjectid'  );
		$this->element->defaultObjectId = $this->getRequestVar('default_objectid');
		$this->element->code            = $this->getRequestVar('code'            );

		$this->addNotice('element',$this->element->name,'SAVED');
		$this->element->save();
		
//		Html::debug($this->element);
	}
}

?>