<?php
// $Id$

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
 * Action-Klasse zur Darstellung des Projekt-Auswahlmenues
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */

define('PROJECTID_ADMIN',-1);

class TreetitleAction extends Action
{
	var $defaultSubAction = 'show';

	function show()
	{
//		$windowMenu = array();
//
//		$windowMenu[] = array( 'text'=>lang('GLOBAL_PROJECTS'),
//		                       'url' =>Html::url('index','projectmenu'),
//		                       'target'=>'_top' );

//		if   ( $this->userIsAdmin() )
//			$windowMenu[] = array( 'text'=>lang('GLOBAL_ADMINISTRATION'),
//			                       'url' =>Html::url('index','administration'),
//			                       'target'=>'_top' );

				
		// Das aktuelle Projekt voreinstellen		
		$project = Session::getProject();
		
		if	( $project->projectid == PROJECTID_ADMIN )
		{
			$this->setTemplateVar( 'text',lang('GLOBAL_ADMINISTRATION') );
			$this->setTemplateVar( 'type','administration' );

//			$windowMenu[] = array( 'text'=>'',
//			                       'url' =>'' );
		}
		else
		{
			$this->setTemplateVar( 'text',$project->name );
			$this->setTemplateVar( 'type','project' );
			
//			// Ermitteln Sprache
//			$language = Session::getProjectLanguage();
//			
//			$windowMenu[] = array( 'text'=>lang('GLOBAL_LANGUAGE').' ('.$language->name.')',
//			                       'url' =>Html::url('main','language'),
//			                       'target'=>'cms_main' );
//	
//			// Ermitteln Projektmodell
//			$model = Session::getProjectModel();
//	
//			$windowMenu[] = array( 'text'=>lang('GLOBAL_MODEL').' ('.$model->name.')',
//			                       'url' =>Html::url('main','model'),
//			                       'target'=>'cms_main' );
		}

//		$this->setTemplateVar('windowMenu',$windowMenu);
		
		// Ausgabe des Templates
//		$this->forward('menu');
	}
	
	
	function checkMenu( $name )
	{
		switch( $name )
		{
			case 'administration':
				return $this->userIsAdmin();
			default:
				return true;
		}
	}
}

?>