<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
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
// ---------------------------------------------------------------------------
// $Log$
// Revision 1.4  2004-11-10 22:40:14  dankert
// Neue Funktion zur Projektauswahl nach dem Login
//
// Revision 1.3  2004/05/19 21:12:49  dankert
// Korrektur listing()
//
// Revision 1.2  2004/05/02 14:49:37  dankert
// Einf?gen package-name (@package)
//
// Revision 1.1  2004/04/24 15:14:52  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------


/**
 * Action-Klasse zum Bearbeiten eines Projektes
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */
class ProjectAction extends Action
{
	var $project;
	var $defaultSubAction = 'listing';


	function ProjectAction()
	{
		if	( intval($this->getSessionVar('projectid'))!=0 )
		{
			$this->project = new Project( $this->getSessionVar('projectid') );
			$this->project->load();
		}
	}


	function save()
	{
		if   ( $this->getRequestVar('delete') != '' )
		{
			// Gesamtes Projekt l?schen
			$this->project->delete();

			$this->setTemplateVar('tree_refresh',true);
		}
		else
		{
			$this->project->name                = $this->getRequestVar('name'               );
			$this->project->target_dir          = $this->getRequestVar('target_dir'         );
			$this->project->ftp_url             = $this->getRequestVar('ftp_url'            );
			$this->project->ftp_passive         = $this->getRequestVar('ftp_passive'        );
			$this->project->cmd_after_publish   = $this->getRequestVar('cmd_after_publish'  );
			$this->project->content_negotiation = $this->getRequestVar('content_negotiation');
			$this->project->cut_index           = $this->getRequestVar('cut_index'          );

			$this->project->save(); // speichern
		}
		
		$this->callSubAction('listing');
	}


	function add()
	{
		// Projekt hinzufuegen
		$this->project->name = $this->getRequestVar('name');
		$this->project->add();

		$this->setTemplateVar('tree_refresh',true);

		$this->callSubAction('edit');
	}


	function listing()
	{
		global $conf_php;

		// Projekte ermitteln
		$list = array();

		foreach( $this->project->getAll() as $id=>$name )
		{
			$list[$id]         = array();
			$list[$id]['url' ] = Html::url(array('action'=>'main','callAction'=>'project','callSubaction'=>'edit','projectid'=>$id));
			$list[$id]['name'] = $name;
		}
		$this->setTemplateVar('el',$list);
	
		$this->forward('project_list');
	}


	function select()
	{
		$user     = Session::getUser();
		$projects = $user->projects;

		// Administrator sieht Administrationsbereich
		if   ( $user->isAdmin )
			$projects = array_merge( array("-1"=>lang('ADMINISTRATION')),$projects );

		// Projekte ermitteln
		$list = array();

		foreach( $projects as $id=>$name )
		{
			$list[$id]         = array();
			$list[$id]['url' ] = Html::url(array('action'=>'index','subaction'=>'show','projectid'=>$id));
			$list[$id]['name'] = $name;
		}
		$this->setTemplateVar('el',$list);
	
		$this->forward('project_select');
	}


	function edit()
	{
		// Projekt laden
		$this->setTemplateVars( $this->project->getProperties() );

		$this->forward('project_edit');

	}
}