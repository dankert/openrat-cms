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
// Revision 1.2  2004-05-02 14:49:37  dankert
// Einfügen package-name (@package)
//
// Revision 1.1  2004/04/24 15:14:52  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------


/**
 * Action-Klasse für die Bearbeitung einer Sprache
 * @version $Id$
 * @author  $Author$
 * @package openrat.actions
 */
class LanguageAction extends Action
{
	/**
	 * Zu bearbeitende Sprache, wird im Kontruktor instanziiert
	 * @type Language
	 */
	var $language;


	/**
	 * Konstruktor
	 */
	function LanguageAction()
	{
		$this->language = new Language( $this->getSessionVar('languageid') );
		$this->language->load();
	}


	/**
	 * Sprache hinzufügen
	 */
	function add()
	{

		// Hinzufügen einer Sprache	
		$this->language->add( $this->getRequestVar('isocode') );
		$this->setSessionVar('languageid',$this->language->languageid);
		
		$this->callSubAction( 'edit' );
	}


	/**
	 * Setzen der Sprache als Standardsprache.
	 * Diese Sprache wird benutzt beim Auswählen des Projektes sowie
	 * als Default-Sprache bei mehrsprachigen Webseiten ("content-negotiation") 
	 */
	function setDefault()
	{
		$this->language->setDefault();

		$this->callSubAction( 'listing' );
	}


	/**
	 * Speichern der Sprache
	 */
	function save()
	{
		$this->setTemplateVar('tree_refresh',true);

		if   ( $this->getRequestVar('name') != '' )
		{
			if   ( $this->getRequestVar('delete') != '' )
			{
				$this->language->delete();
				$this->setSessionVar('languageid','');

				$this->callSubAction( 'listing' );
			}
			else
			{
				$this->language->name    = $this->getRequestVar('name'   );
				$this->language->isoCode = $this->getRequestVar('isocode');
				$this->language->save();
			}
		}

		$this->callSubAction( 'edit' );
	}



	// Auswählen einer Sprache
	function select()
	{
		$this->setSessionVar('languageid',$this->language->languageid);

		$this->callSubAction( 'listing' );
	}



	function listing()
	{
		global $conf_php;

		$iso = GlobalFunctions::getIsoCodes();

		$list = array();
		$this->setTemplateVar('act_languageid',$this->language->languageid);
	
		foreach( $this->language->getAll() as $id=>$name )
		{
			$l = new Language( $id );
			$l->load();
			
			$list[$id] = array();
			$list[$id]['name'] = $name;
			
			if	( $this->userIsAdmin() )
			{
				$list[$id]['url' ] = 'do.'.$conf_php.'?languageaction=edit&languageid='.$id;
			
				if	( ! $l->isDefault )
					$list[$id]['default_url'] = 'languageaction=setDefault&languageid='.$id;
			}
				
			if	( $this->getSessionVar('languageid') != $l->languageid )
				$list[$id]['select_url']  = 'languageaction=select&languageid='.$id;
		}
		
		if	( $this->userIsAdmin() )
			$this->setTemplateVar('isocodes',$iso);

		$this->setTemplateVar('el',$list);

		$this->forward('language_list');
	}



	function edit()
	{
		if   ( count($this->language->getAll()) >= 2 )
			$this->setTemplateVar('delete',true );
		else	$this->setTemplateVar('delete',false);

		$this->setTemplateVars( $this->language->getProperties() );
	
		$this->forward('language_edit');
	}
}