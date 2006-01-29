<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// OpenRat Content Management System
// Copyright (C) 2002-2004 Jan Dankert, cms@jandankert.de
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
// ---------------------------------------------------------------------------
// $Log$
// Revision 1.13  2006-01-29 17:18:27  dankert
// Steuerung der Aktionsklasse ?ber .ini-Datei, dazu umbenennen einzelner Methoden
//
// Revision 1.12  2006/01/17 22:43:02  dankert
// Der Einstellungsknoten hei?t nun "date-formats" statt "date_formats"
//
// Revision 1.11  2005/04/21 19:08:44  dankert
// Vorbelegung fuer "list"-Element
//
// Revision 1.10  2005/01/03 19:37:15  dankert
// Bei dynamic-Elementen einfaches Array erzeugen
//
// Revision 1.9  2004/12/30 23:31:27  dankert
// Korrektur userIsAdmin()
//
// Revision 1.8  2004/12/26 20:20:40  dankert
// Konstante FILE_SEP benutzen
//
// Revision 1.7  2004/12/19 14:53:11  dankert
// Verwenden von getRequestId()
//
// Revision 1.6  2004/12/15 23:22:37  dankert
// *** empty log message ***
//
// Revision 1.5  2004/10/06 09:54:43  dankert
// Neuer Elementtyp: dynamic
//
// Revision 1.4  2004/07/07 20:43:57  dankert
// Neuer Elementtyp: select
//
// Revision 1.3  2004/05/02 14:49:37  dankert
// Einf?gen package-name (@package)
//
// Revision 1.2  2004/04/24 17:41:51  dankert
// Subtypes von Info geaendert
//
// Revision 1.1  2004/04/24 15:14:52  dankert
// Initiale Version
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
	 * Speichern der Element-Eigenschaften
	 */
	function saveproperties()
	{
		global $conf;
		$ini_date_format = $conf['date-formats'];
	
		foreach( $this->element->getRelatedProperties() as $propertyName )
		{
			switch( $propertyName )
			{
				case 'dateformat':
					$this->element->dateformat   = $ini_date_format[$this->getRequestVar('dateformat')];
					break;

				case 'subtype':
					$this->element->subtype      = $this->getRequestVar('subtype');
					break;

				case 'defaultText':
					$this->element->defaultText  = $this->getRequestVar('default_text');
					break;

				case 'wiki':
					$this->element->wiki         = $this->getRequestVar('wiki') != '';
					break;

				case 'html':
					$this->element->html         = $this->getRequestVar('html') != '';
					break;

				case 'withIcon':
					$this->element->withIcon     = $this->getRequestVar('with_icon') != '';
					break;

				case 'allLanguages':
					$this->element->allLanguages = $this->getRequestVar('all_languages') != '';
					break;

				case 'writable':
					$this->element->writable     = $this->getRequestVar('writable') != '';
					break;

				case 'decimals':
					$this->element->decimals     = $this->getRequestVar('decimals');
					break;

				case 'decPoint':
					$this->element->decPoint     = $this->getRequestVar('dec_point');
					break;

				case 'thousandSep':
					$this->element->thousandSep  = $this->getRequestVar('thousand_sep');
					break;

				case 'folderObjectId':
					$this->element->folderObjectId  = $this->getRequestVar('folderobjectid'  );
					break;

				case 'defaultObjectId':
					$this->element->defaultObjectId = $this->getRequestVar('default_objectid');
					break;

				case 'code':
					$this->element->code          = $this->getRequestVar('code'            );
					break;
			}
		}
		$this->element->save();
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
		{
			$types[ $t ] = lang('EL_'.$t);
		}

		// Code-Element nur fuer Administratoren (da voller Systemzugriff!)		
		if	( !$this->userIsAdmin() )
			unset( $types['code'] );
		
		$this->setTemplateVar('types',$types);
		
		$this->setTemplateVar('type',$this->element->type);
	}
	
	
	function properties()
	{
		global $conf;
		// Abh?ngig vom aktuellen Element-Typ die Eigenschaften anzeigen
		
		$properties = $this->element->getRelatedProperties();

		// Eigenschaften Info-Datum
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
							$subtype = Array('db_id',
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
							$subtype = Array('date_published',
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

						default:
							$subtype = array();
							break;
					}

					if	( $convertToLang == true )
					{
						foreach( $subtype as $t )
						{
							$subtypes[$t] = lang('EL_'.$this->element->type.'_'.$t);
						}
					}
	
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
											echo "Ja";
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
}

?>