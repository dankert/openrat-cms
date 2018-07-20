<?php

namespace cms\action;

use Tree;
use cms\model\Language;
use cms\model\Model;

use Session;

// OpenRat Content Management System
// Copyright (C) 2002 Jan Dankert, jandankert@jandankert.de
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
 * Action-Klasse zum Laden/Anzeigen des Navigations-Baumes
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */

class TreeAction extends Action
{
	public $security = SECURITY_USER;
	
	public function __construct()
    {
        parent::__construct();
    }

	/**
	 * Anzeigen des Baumes fuer asynchrone Anfragen.
	 */
	public function loadBranchView()
	{
        $tree = new Tree();

        $type = $this->getRequestVar('type');
		
		if	( intval($this->getRequestVar('id')) != 0 )
			$tree->$type( $this->getRequestId() );
		else
			$tree->$type();
			
		$branch = array();
		foreach($tree->treeElements as $element )
		{
			$branch[] = get_object_vars($element);
		}
		
		$this->setTemplateVar( 'branch',$branch ); 
	}
	

	/**
	 * Projekt-Einstellungen anzeigen.
	 */
	public function settingsView()
	{
		$this->setTemplateVar( 'languages' ,Language::getAll()                        );
		$this->setTemplateVar( 'languageid',Session::getProjectLanguage()->languageid );
		$this->setTemplateVar( 'models'    ,Model::getAll()                           );
		$this->setTemplateVar( 'modelid'   ,Session::getProjectModel()->modelid       );
	}
	
	public function settingsPost()
	{
		$language = new Language( $this->getRequestVar(REQ_PARAM_LANGUAGE_ID,OR_FILTER_NUMBER) );
		$language->load();
		Session::setProjectLanguage( $language );

		$model = new Model( $this->getRequestVar(REQ_PARAM_MODEL_ID,OR_FILTER_NUMBER) );
		$model->load();
		Session::setProjectModel( $model );
		
		$this->addNotice('language',$language->name,'DONE',OR_NOTICE_OK);
		$this->addNotice('model'   ,$model->name   ,'DONE',OR_NOTICE_OK);
		$this->refresh();
	}

	
	public function languagePost()
	{
		$language = new Language( $this->getRequestId() );
		$language->load();
		Session::setProjectLanguage( $language );
	
		$this->addNotice('language',$language->name,'DONE',OR_NOTICE_OK);
		$this->refresh();
	}
	
	
	public function modelPost()
	{
		$model = new Model( $this->getRequestId() );
		$model->load();
		Session::setProjectModel( $model );
	
		$this->addNotice('model'   ,$model->name   ,'DONE',OR_NOTICE_OK);
		$this->refresh();
	}
	
}

?>