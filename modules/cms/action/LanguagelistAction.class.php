<?php

namespace cms\action;

use cms\base\Configuration;
use cms\model\Language;
use cms\model\Project;
use language\Messages;
use util\Html;


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
class LanguagelistAction extends BaseAction
{
	public $security = Action::SECURITY_USER;

    /**
     * @var Project
     */
    protected $project;


    /**
	 * Konstruktor
	 */
	function __construct()
	{
        parent::__construct();

    }


    public function init()
    {

        $this->project = new Project( $this->request->getRequestId());
	}



	public function showView()
	{
		$countryList = Configuration::Conf()->get('countries',[]);

		$list = array();

		$this->setTemplateVar('act_languageid',0 );



		foreach( $this->project->getLanguageIds() as $id )
		{
			$l = new Language( $id );
			$l->load();
			
			unset( $countryList[strtoupper($l->isoCode)] );
			
			$list[$id] = array();
			$list[$id]['name'   ] = $l->name;
			$list[$id]['isocode'] = $l->isoCode;
			$list[$id]['id'     ] = $id;

            $list[$id]['is_default'] = $l->isDefault;

            $list[$id]['select_url']  = Html::url( 'index','language',$id );
		}
		
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
		$countryList = Configuration::subset('countries')->getConfig();
		
		foreach( $this->project->getLanguageIds() as $id )
		{

			$l = new Language( $id );
			$l->load();

			unset( $countryList[$l->isoCode] );
		}

		asort( $countryList );

		$this->setTemplateVar('isocodes'  ,$countryList );
		$this->setTemplateVar('isocode'  ,'' );
	}


	/**
	 * Adding a language.
	 */
	public function addPost()
	{
		$countryList = Configuration::Conf()->get('countries',[]);
		
		$iso = 	$this->getRequestVar('isocode');
		$language = new Language();
		$language->projectid = $this->project->projectid;
		$language->isoCode   = $iso;
		$language->name      = @$countryList[$iso];
		$language->add();
		
		$this->addNoticeFor($language, Messages::ADDED);
	}

	
}