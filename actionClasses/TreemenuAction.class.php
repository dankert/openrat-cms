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

class TreemenuAction extends Action
{
	var $defaultSubAction = 'show';

	function show()
	{
		$this->setTemplateVar('css_body_class','menu');
		
		$user     = Session::getUser();
		$projects = $user->projects;

		// Administrator sieht Administrationsbereich
		if   ( $user->isAdmin )
			$projects = array("-1"=>lang('GLOBAL_ADMINISTRATION')) + $projects;

		$this->setTemplateVar('projects',$projects);

		// Das aktuelle Projekt voreinstellen		
		$project = Session::getProject();
		if	( is_object( $project ) )
			$this->setTemplateVar( 'act_projectid',$project->projectid );

		// Ermitteln Sprache
		$language = Session::getProjectLanguage();
		$this->setTemplateVar('language_name',$language->name);
		$this->setTemplateVar('language_url' ,Html::url( 'main','language' ));

		// Ermitteln Projektmodell
		$model = Session::getProjectModel();
		$this->setTemplateVar('projectmodel_name',$model->name);
		$this->setTemplateVar('projectmodel_url' ,Html::url( 'main','model' ));


		// Ausgabe des Templates
		$this->forward('tree_menu');
	}
}

?>