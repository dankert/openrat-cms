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
// Revision 1.6  2004-12-19 14:55:00  dankert
// Korrektur der Laenderlisten
//
// Revision 1.5  2004/12/13 22:17:51  dankert
// URL-Korrektur
//
// Revision 1.4  2004/11/27 13:06:44  dankert
// Ausgabe von Meldungen
//
// Revision 1.3  2004/11/10 22:37:23  dankert
// Korrektur Auswahl-Url
//
// Revision 1.2  2004/05/02 14:49:37  dankert
// Einf?gen package-name (@package)
//
// Revision 1.1  2004/04/24 15:14:52  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------


/**
 * Action-Klasse f?r die Bearbeitung einer Sprache
 * @version $Id$
 * @author  $Author$
 * @package openrat.actions
 */
class LanguageAction extends Action
{
	var $defaultSubAction = 'listing';

	/**
	 * Zu bearbeitende Sprache, wird im Kontruktor instanziiert
	 * @type Language
	 */
	var $language;
	var $project;


	/**
	 * Konstruktor
	 */
	function LanguageAction()
	{
		if	( $this->getRequestId() != 0 )
		{
			$this->language = new Language( $this->getRequestId() );
			$this->language->load();
		}
		
		$this->project = Session::getProject();
	}


	/**
	 * Sprache hinzufuegen
	 */
	function add()
	{
		global $conf;
		$countryList = $conf['countries'];
		
		// Hinzufuegen einer Sprache
		$iso = 	$this->getRequestVar('isocode');
		$language = new Language();
		$language->projectid = $this->project->projectid;
		$language->isoCode   = $iso;
		$language->name      = $countryList[$iso];
		$language->add();
		
		$this->callSubAction( 'listing' );
	}


	/**
	 * Setzen der Sprache als Standardsprache.
	 * Diese Sprache wird benutzt beim Ausw?hlen des Projektes sowie
	 * als Default-Sprache bei mehrsprachigen Webseiten ("content-negotiation") 
	 */
	function setdefault()
	{
		$this->language->setDefault();

		$this->callSubAction( 'listing' );
	}


	/**
	 * Speichern der Sprache
	 */
	function save()
	{
		global $conf;
		$countryList = $conf['countries'];

		if   ( $this->hasRequestVar('delete') )
		{
			$this->language->delete();
			$this->callSubAction( 'listing' );
		}
		else
		{
			$iso = 	$this->getRequestVar('isocode');
			$this->language->iso  = $iso;
			$this->language->name = $countryList[$iso];
			$this->language->save();
	
		}

		$this->callSubAction( 'listing' );
	}



	function listing()
	{
		global $conf;
		$countryList = $conf['countries'];

		$list = array();
		
		$actLanguage = Session::getProjectLanguage();
		$this->setTemplateVar('act_languageid',$actLanguage->languageid);
	
		foreach( $this->project->getLanguageIds() as $id )
		{
			$l = new Language( $id );
			$l->load();
			
			unset( $countryList[$l->isoCode] );
			
			$list[$id] = array();
			$list[$id]['name'] = $l->name;
			
			if	( $this->userIsAdmin() )
			{
				$list[$id]['url' ] = Html::url('language','edit',$id);
			
				if	( ! $l->isDefault )
					$list[$id]['default_url'] = Html::url( 'language','setdefault',$id );
			}
				
			if	( $this->getSessionVar('languageid') != $l->languageid )
				$list[$id]['select_url']  = Html::url( 'index','language',$id );
		}
		
		if	( $this->userIsAdmin() )
		{
			asort($countryList);
			$this->setTemplateVar('isocodes',$countryList);
		}

		$this->setTemplateVar('el',$list);

		$this->forward('language_list');
	}



	function edit()
	{
		global $conf;
		$countryList = $conf['countries'];

		if   ( count($this->language->getAll()) >= 2 )
			$this->setTemplateVar('delete',true );
		else
			$this->setTemplateVar('delete',false);

		foreach( $this->project->getLanguageIds() as $id )
		{
			if	( $id == $this->language->languageid )
				continue;		

			$l = new Language( $id );
			$l->load();

			unset( $countryList[$l->isoCode] );
		}

		asort( $countryList );		
		$this->setTemplateVar('isocodes'   ,$countryList               );
		$this->setTemplateVar('languageid' ,$this->language->languageid);
		$this->setTemplateVar('act_isocode',$this->language->isoCode   );

		$this->forward('language_edit');
	}
}