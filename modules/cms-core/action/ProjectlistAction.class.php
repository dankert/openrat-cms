<?php

namespace cms\action;

use cms\model\Acl;
use cms\model\Folder;
use cms\model\Project;

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
 * Action-Klasse zum Bearbeiten eines Projektes
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */
class ProjectlistAction extends Action
{
	public $security = Action::SECURITY_USER;
	
	function __construct()
	{
        parent::__construct();
	}


	/**
	 * Liste aller Projekte anzeigen.
	 *
	 */
	public function editView()
	{
		// Projekte ermitteln
		$list = array();

		foreach(Project::getAllProjects() as $id=> $name )
		{

            // Schleife ueber alle Projekte
            foreach (Project::getAllProjects() as $id => $name) {

                $project = new Project($id);
                $rootFolder = new Folder($project->getRootObjectId());
                $rootFolder->load();

                // Berechtigt für das Projekt?
                if ($rootFolder->hasRight(Acl::ACL_READ)) {
                    $list[$id]             = array();
                    $list[$id]['id'      ] = $id;
                    $list[$id]['name'    ] = $name;
                }
            }
        }

		$this->setTemplateVar('projects',$list);
		$this->setTemplateVar('add',$this->userIsAdmin());
	}
	
	
	
	function addView()
	{
	    if( ! $this->userIsAdmin() )
	        throw new \SecurityException('user is not allowed to add a project');

		$this->setTemplateVar( 'projects',Project::getAllProjects() );
	}
	

	/**
	 * Projekt hinzufuegen.
	 *
	 */
	function addPost()
	{
	    if( !$this->userIsAdmin())
	        throw new \SecurityException("user is not allowed to add a project");

		if	( !$this->hasRequestVar('type') )
		{
			$this->addValidationError('type');
			$this->callSubAction('add');
			return;
		}
		else
		{
			switch( $this->getRequestVar('type') )
			{
				case 'empty':
					if	( !$this->hasRequestVar('name') )
					{
						$this->addValidationError('name');
						$this->callSubAction('add');
						return;
					}
					$project = new Project();
					$project->name = $this->getRequestVar('name');
					$project->add();
					$this->addNotice('project',$project->name,'ADDED');
					break;
				case 'copy':
					$db = db_connection();
					$project = new Project($this->getRequestVar('projectid'));
					$project->load();
					$project->export($db->id);
					$this->addNotice('project',$project->name,'DONE'); 
					break;
				default:
					throw new \LogicException('Unknown type while adding project '.$this->getRequestVar('type') );
			}
			
		}
	}
	
	
	/**
	 * Ermittelt die letzten Änderungen, die in allen Projekten gemacht worden sind.
	 */
	function historyView()
	{
		$result = Project::getAllLastChanges();
		$this->setTemplateVar('timeline', $result);
	}


}