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
// Revision 1.4  2004-07-07 20:43:57  dankert
// Neuer Elementtyp: select
//
// Revision 1.3  2004/05/02 14:49:37  dankert
// Einfügen package-name (@package)
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
		$this->element = new Element( $this->getSessionVar('elementid') );
		$this->element->load();
		
		$this->setSessionVar('templateid',$this->element->templateid);
	}


	/**
	 * Ändern des Element-Typs
	 */
	function changetype()
	{
		$this->element->setType( $this->getRequestVar('type') );
		$this->element->load();
	
		$this->callSubAction('edit');
	}


	/**
	 * Anzeigen des Elementes
	 */
	function edit()
	{
		// Name und Beschreibung
		$this->setTemplateVar('name',$this->element->name);
		$this->setTemplateVar('desc',$this->element->desc);
		
		// Die verschiedenen Element-Typen
		$types = array();

		foreach( $this->element->getAvailableTypes() as $t )
		{
			$types[ $t ] = lang('EL_'.$t);
		}
		$this->setTemplateVar('type',$types);
		
		$this->setTemplateVar('default_type',$this->element->type);

		// Abhängig vom aktuellen Element-Typ die Eigenschaften anzeigen
		
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
							break;

						case 'infodate':
							$subtype = Array('date_published',
							                 'date_saved',
							                 'date_created' );
					          break;

						default:
							$subtype = array();
							break;
					}

					foreach( $subtype as $t )
					{
						$subtypes[$t] = lang('EL_'.$this->element->type.'_'.$t);
					}
	
					$this->setTemplateVar('subtype'    ,$subtypes              );
					$this->setTemplateVar('act_subtype',$this->element->subtype);
	
					break;
	
	
				case 'dateformat':

					$ini_date_format = parse_ini_file( CONF_LANGUAGEDIR.'/dateformat.ini.'.CONF_PHP );
					$dateformat = array();

					$this->setTemplateVar('act_dateformat','');

					foreach($ini_date_format as $idx=>$d)
					{
						$dateformat[$idx] = date($d);
						if	( $d == $this->element->dateformat )
							$this->setTemplateVar('act_dateformat',$idx);
					}
	
					$this->setTemplateVar('dateformat'    ,$dateformat               );
					
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
	
					// Ermitteln aller verfügbaren Objekt-IDs
					foreach( Folder::getAllObjectIds() as $id )
					{
						$o = new Object( $id );
						$o->load();
						
						if	( $o->getType() != 'folder' )
						{ 
							$f = new Folder( $o->parentid );
							$f->load();
							
							$objects[ $id ]  = lang( $o->getType() ).': '; 
							$objects[ $id ] .=  implode( ' &raquo; ',$f->parentObjectNames(false,true) ); 
							$objects[ $id ] .= ' &raquo; '.$o->name;
						} 
					}
			
					asort( $objects ); // Sortieren
	
					$this->setTemplateVar('objects',$objects);		
	
					$this->setTemplateVar('act_default_objectid',$this->element->defaultObjectId);
	
					break;


				case 'folderObjectId':

					$folders = array();
	
					// Ermitteln aller verfügbaren Objekt-IDs
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
	
					$this->setTemplateVar('act_folderobjectid'  ,$this->element->folderObjectId  );
	
					break;

				default:
					$this->message('ERROR','not an element property: '.$propertyName );
			}
		}
	
		$this->forward('element');
	}
}

?>