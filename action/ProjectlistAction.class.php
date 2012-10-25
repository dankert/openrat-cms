<?php
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


/**
 * Action-Klasse zum Bearbeiten eines Projektes
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */
class ProjectlistAction extends Action
{
	public $security = SECURITY_ADMIN;
	
	function ProjectlistAction()
	{
	}


	public function editView()
	{
		$this->nextSubAction('show');
	}

	/**
	 * Liste aller Projekte anzeigen.
	 *
	 */
	public function showView()
	{
		global $conf_php;

		// Projekte ermitteln
		$list = array();

		foreach( Project::getAll() as $id=>$name )
		{
			$list[$id]             = array();
			$list[$id]['url'     ] = Html::url('project','edit',$id);
			$list[$id]['id'      ] = $id;
			$list[$id]['use_url' ] = Html::url('tree'   ,'load',0  ,array('projectid'=>$id,'target'=>'tree'));
			$list[$id]['name'    ] = $name;
		}
		$this->setTemplateVar('el',$list);
	}
	
	
	
	function addView()
	{
		$this->setTemplateVar( 'projects',Project::getAll() );
	}
	

	/**
	 * Projekt hinzufuegen.
	 *
	 */
	function addPost()
	{
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
					$this->project = new Project();
					$this->project->name = $this->getRequestVar('name');
					$this->project->add();
					$this->addNotice('project',$this->project->name,'ADDED'); 
					break;
				case 'copy':
					$db = db_connection();
					$project = new Project($this->getRequestVar('projectid'));
					$project->load();
					$project->export($db->id);
					$this->addNotice('project',$project->name,'DONE'); 
					break;
				default:
					Http::serverError('Unknown type while adding project '.$this->getRequestVar('type') );
			}
			
		}
	}
	
}