<?php
use cms\model\Language;

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
class LanguagelistAction extends Action
{
	public $security = SECURITY_USER;
	

	/**
	 * Konstruktor
	 */
	function LanguagelistAction()
	{
		$this->project = Session::getProject();
	}



	function showView()
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
				$list[$id]['id' ] = $id;
			
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
		$this->nextSubAction('show');
	}
	
	
	
	
	/**
	 * Sprache hinzufuegen
	 */
	function addView()
	{
		global $conf;
		$countryList = $conf['countries'];
		
		$language = Session::getProjectLanguage();

		foreach( $this->project->getLanguageIds() as $id )
		{
			
			if	( $id == $language->languageid )
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
		
		$this->addNotice('language',$language->name,'ADDED','ok');
	}

	
}