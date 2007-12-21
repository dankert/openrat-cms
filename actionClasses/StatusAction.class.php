<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// OpenRat Content Management System
// Copyright (C) 2002-2007 Jan Dankert, jandankert@jandankert.de
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; version 2.
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


/**
 * Action-Klasse fuer die Statusleiste
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */

class StatusAction extends Action
{
	/**
	 */
	function show()
	{
		global $conf;
		$metaList = array();

		$user = Session::getUser();
		if	( is_object($user) )
		{
			// Projekte ermitteln
			$projects = $user->projects;
			$this->setTemplateVar('projects',$projects);
		}
		
		$project = Session::getProject();
		if	( is_object($project) )
		{
			if	( $project->projectid > 0 )
			{
				$this->setTemplateVar('projectid',$project->projectid);
				$this->setTemplateVar('languages',$project->getLanguages());
				$language = Session::getProjectLanguage();
				if	( is_object($language) )
					$this->setTemplateVar('languageid',$language->languageid);
				$this->setTemplateVar('models'   ,$project->getModels()   );
				$model = Session::getProjectModel();
				if	( is_object($model) )
					$this->setTemplateVar('modelid',$model->modelid);

				// TODO: Nur Projekt-Admins
				$this->setTemplateVar('templates',$project->getTemplates());
			}
			else
			{
				$this->setTemplateVar('users' ,User::listAll() );
				$this->setTemplateVar('groups',Group::getAll()  );
			}
		}

	}

}


?>