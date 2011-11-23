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
// Revision 1.11  2007-05-24 19:47:48  dankert
// Direktes Ausw?hlen von Sprache/Modell in der Projektauswahlliste.
//
// Revision 1.10  2007-05-08 21:16:20  dankert
// Korrektur und Erweiterung von Hinzuf?gen/Bearbeiten von Sprachen.
//
// Revision 1.9  2007/01/21 22:26:45  dankert
// Korreketur beim Hinzuf?gen/Entfernen von Sprachen.
//
// Revision 1.8  2006/01/29 17:18:59  dankert
// Steuerung der Aktionsklasse ?ber .ini-Datei, dazu umbenennen einzelner Methoden
//
// Revision 1.7  2004/12/25 20:50:13  dankert
// Korrektur Sprach-Aenderung
//
// Revision 1.6  2004/12/19 14:55:00  dankert
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
	function addView()
	{
		global $conf;
		$countryList = $conf['countries'];

		foreach( $this->project->getLanguageIds() as $id )
		{
			if	( $id == $this->language->languageid )
				continue;		

			$l = new Language( $id );
			$l->load();

			unset( $countryList[$l->isoCode] );
		}

		asort( $countryList );		
		$this->setTemplateVar('isocodes'  ,$countryList );
	}
	
	
	function addPost()
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
	}


	/**
	 * Setzen der Sprache als Standardsprache.
	 * Diese Sprache wird benutzt beim Ausw?hlen des Projektes sowie
	 * als Default-Sprache bei mehrsprachigen Webseiten ("content-negotiation") 
	 */
	function setdefault()
	{
		$this->language->setDefault();
	}



	/**
	 * Anzeigen der L�schbest�tigungs-Maske.
	 */
	function removeView()
	{
		$this->setTemplateVar('name'   ,$this->language->name   );
	}
	
	
	/**
	 * L�schen der Sprache.
	 */
	function removePost() 
	{
		if   ( $this->getRequestVar('confirm') == '1' )
			$this->language->delete();
	}
	

	/**
	 * Speichern der Sprache
	 */
	function advancedPost()
	{
		global $conf;

		if	( $this->hasRequestVar('name') )
		{
			$this->language->name    = $this->getRequestVar('name'   );
			$this->language->isoCode = $this->getRequestVar('isocode');
		}
		else
		{
			$countryList = $conf['countries'];
			$iso = $this->getRequestVar('isocode');
			$this->language->name    = $countryList[$iso];
			$this->language->isoCode = strtolower( $iso );
		}
		
		$this->language->save();
	}



	/**
	 * Speichern der Sprache
	 */
	function editPost()
	{
		global $conf;

		if	( $this->hasRequestVar('name') )
		{
			$this->language->name    = $this->getRequestVar('name'   );
			$this->language->isoCode = $this->getRequestVar('isocode');
		}
		else
		{
			$countryList = $conf['countries'];
			$iso = $this->getRequestVar('isocode');
			$this->language->name    = $countryList[$iso];
			$this->language->isoCode = strtolower( $iso );
		}
		
		$this->language->save();
	}



	function listingView()
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
			
			unset( $countryList[strtoupper($l->isoCode)] );
			
			$list[$id] = array();
			$list[$id]['name'   ] = $l->name;
			$list[$id]['isocode'] = $l->isoCode;
			
			if	( $this->userIsAdmin() )
			{
				$list[$id]['url' ] = Html::url('language','edit',$id,
				                               array() );
			
				if	( ! $l->isDefault )
					$list[$id]['default_url'] = Html::url( 'language','setdefault',$id );
			}
				
			if	( $actLanguage->languageid != $l->languageid )
				$list[$id]['select_url']  = Html::url( 'index','language',$id );
		}
		
//		if	( $this->userIsAdmin() )
//		{
//			asort($countryList);
//			$this->setTemplateVar('isocodes',$countryList);
//		}

		$this->setTemplateVar('el',$list);
	}



	function editView()
	{
		global $conf;
		$countryList = $conf['countries'];

		foreach( $this->project->getLanguageIds() as $id )
		{
			if	( $id == $this->language->languageid )
				continue;		

			$l = new Language( $id );
			$l->load();

			unset( $countryList[$l->isoCode] );
		}

		asort( $countryList );		
		$this->setTemplateVar('isocodes'  ,$countryList               );
		$this->setTemplateVar('isocode'   ,strtoupper($this->language->isoCode) );
	}
	


	function advancedView()
	{
		$this->setTemplateVar('isocode',$this->language->isoCode);
		$this->setTemplateVar('name'   ,$this->language->name   );
	}
	
	
	
	

	function checkmenu( $menu )
	{
		switch( $menu )
		{
			case 'remove':
				$actLanguage = Session::getProjectLanguage();
				return
					!readonly()                          && 
					$this->userIsAdmin()                 &&
					isset($this->language) &&
					count( $this->language->getAll() ) >= 2 &&
					$actLanguage->languageid != $this->language->languageid;
				
			case 'add':
				return
					!readonly() && $this->userIsAdmin();
					
			default:
				return true;
		}
	}
}