<?php

namespace cms\action;

use cms\base\Configuration;
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
class LanguageAction extends BaseAction
{
	public $security = Action::SECURITY_USER;
	
	/**
	 * Zu bearbeitende Sprache, wird im Kontruktor instanziiert
	 * @type Language
	 */
	protected $language;


	/**
	 * Konstruktor
	 */
	public function __construct()
	{
        parent::__construct();

    }


    public function init()
    {
		$this->language = new Language( $this->getRequestId() );
		$this->language->load();
	}


	/**
	 * Setzen der Sprache als Standardsprache.
	 * Diese Sprache wird benutzt beim Ausw?hlen des Projektes sowie
	 * als Default-Sprache bei mehrsprachigen Webseiten ("content-negotiation") 
	 */
	public function setdefaultPost()
	{
		$this->language->setDefault();

        $this->addNotice('language', 0, $this->language->name, 'DONE', Action::NOTICE_OK);
    }



	/**
	 * Anzeigen der L�schbest�tigungs-Maske.
	 */
	public function removeView()
	{
		$this->setTemplateVar('name'   ,$this->language->name   );
	}
	
	
	/**
	 * L�schen der Sprache.
	 */
	public function removePost()
	{
		if   ( $this->getRequestVar('confirm') == '1' )
			$this->language->delete();
	}
	
	
	/**
	 * Speichern der Sprache
	 */
	function propPost()
	{
		if	( $this->hasRequestVar('name') )
		{
			$this->language->name    = $this->getRequestVar('name'   );
			$this->language->isoCode = $this->getRequestVar('isocode');
		}
		else
		{
			$countries = Configuration::subset('countries');
			$iso = $this->getRequestVar('isocode');
			$this->language->name    = $countries->get($iso,$iso);
			$this->language->isoCode = strtolower( $iso );
		}

		if  ( $this->hasRequestVar('is_default') )
		    $this->language->setDefault();
		
		$this->language->save();

        $this->addNotice('language', 0, $this->language->name, 'DONE', Action::NOTICE_OK);
	}



	public function infoView()
	{
		$this->setTemplateVars( $this->language->getProperties() );
	}


	function propView()
	{
		$this->setTemplateVar('isocode'   ,$this->language->isoCode   );
		$this->setTemplateVar('name'      ,$this->language->name      );
		$this->setTemplateVar('is_default',$this->language->isDefault );
	}
	
	
	
	
}