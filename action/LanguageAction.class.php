<?php

namespace cms\action;

use cms\model\Language;
use Session;
use \Html;
// OpenRat Content Management System
// Copyright (C) 2002-2012 Jan Dankert, cms@jandankert.de
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


/**
 * Action-Klasse f?r die Bearbeitung einer Sprache
 * @version $Id$
 * @author  $Author$
 * @package openrat.actions
 */
class LanguageAction extends Action
{
	public $security = SECURITY_USER;
	
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
	function __construct()
	{
		$this->language = new Language( $this->getRequestId() );
		$this->language->load();
		
		$this->project = Session::getProject();
	}


	/**
	 * Setzen der Sprache als Standardsprache.
	 * Diese Sprache wird benutzt beim Ausw?hlen des Projektes sowie
	 * als Default-Sprache bei mehrsprachigen Webseiten ("content-negotiation") 
	 */
	function setdefaultPost()
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
	
	
	function propView()
	{
		$this->nextSubAction('advanced');
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
	
	
	/**
	 * Liefert die Struktur zu diesem Ordner:
	 * - Mit den übergeordneten Ordnern und
	 * - den in diesem Ordner enthaltenen Objekten
	 * 
	 * Beispiel:
	 * <pre>
	 * - A
	 *   - B
	 *     - C (dieser Ordner)
	 *       - Unterordner
	 *       - Seite
	 *       - Seite
	 *       - Datei
	 * </pre> 
	 */
	public function structureView()
	{
		$structure = array();
		$languagelistChildren = array();
		
		$structure[0] = array('id'=>'0','name'=>lang('LANGUAGES'),'type'=>'languagelist','level'=>1,'children'=>&$languagelistChildren);
			
		$languagelistChildren[ $this->language->languageid ] = array('id'=>$this->language->languageid,'name'=>$this->language->name,'type'=>'language','self'=>true);
		
		
		//Html::debug($structure);
		
		$this->setTemplateVar('outline',$structure);
	}
}