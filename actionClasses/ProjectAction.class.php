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
// Revision 1.15  2007-11-05 20:51:03  dankert
// Aufruf von "addValidationError(...)" bei Eingabefehlern.
//
// Revision 1.14  2007-10-04 21:50:37  dankert
// Notiz, wenn Projekt gespeichert.
//
// Revision 1.13  2007-04-21 11:50:50  dankert
// Umbenennung von Im- in Export.
//
// Revision 1.12  2007-04-16 21:25:41  dankert
// Neuer Men?punkt im Projektmen?: Import.
//
// Revision 1.11  2007/01/21 15:00:03  dankert
// Parameter TARGETSUBACTION verwenden.
//
// Revision 1.10  2006/06/01 20:59:27  dankert
// Projektwartung: Suche nach verlorenen Dateien.
//
// Revision 1.9  2006/06/01 20:07:01  dankert
// Neue Methode "maintenance"
//
// Revision 1.8  2006/01/23 23:10:46  dankert
// *** empty log message ***
//
// Revision 1.7  2004/12/26 20:24:16  dankert
// Korrektur Abfrage Berechtigungen
//
// Revision 1.6  2004/12/19 15:16:02  dankert
// div. Korrekturen
//
// Revision 1.5  2004/12/15 23:25:32  dankert
// Anpassung an Session-Funktionen
//
// Revision 1.4  2004/11/10 22:40:14  dankert
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
		if	( $this->getRequestId()!=0 )
		{
			$this->project = new Project( $this->getRequestId() );
			$this->project->load();
		}
		
		
	}


	function save()
	{
		if	( $this->getRequestVar('name') != '')
		{
			$this->project->name                = $this->getRequestVar('name'               );
			$this->project->target_dir          = $this->getRequestVar('target_dir'         );
			$this->project->ftp_url             = $this->getRequestVar('ftp_url'            );
			$this->project->ftp_passive         = $this->getRequestVar('ftp_passive'        );
			$this->project->cmd_after_publish   = $this->getRequestVar('cmd_after_publish'  );
			$this->project->content_negotiation = $this->getRequestVar('content_negotiation');
			$this->project->cut_index           = $this->getRequestVar('cut_index'          );
	
			$this->addNotice('project',$this->project->name,'SAVED','ok');
			$this->project->save(); // speichern
		}
		else
		{
			$this->addValidationError('name');
			$this->callSubAction('edit');
		}
	}



	function add()
	{
	}
	
	
	function addproject()
	{
		// Projekt hinzufuegen
		if	( $this->getRequestVar('name') != '' )
		{
			$this->project = new Project();
			$this->project->name = $this->getRequestVar('name');
			$this->project->add();
		}
		else
		{
			$this->addValidationError('name');
			$this->callSubAction('add');
		}

		$this->callSubAction('listing');
	}


	function listing()
	{
		global $conf_php;

		// Projekte ermitteln
		$list = array();

		foreach( Project::getAll() as $id=>$name )
		{
			$list[$id]             = array();
			$list[$id]['url'     ] = Html::url('main' ,'project',$id,array(REQ_PARAM_TARGETSUBACTION=>'edit'));
			$list[$id]['use_url' ] = Html::url('index','project',$id);
			$list[$id]['name'    ] = $name;
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
			$list[$id]['url' ] = Html::url('index','project',$id);
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
	
	
	function remove()
	{
	}
	
	
	function delete()
	{
		if   ( $this->getRequestVar('delete') != '' )
		{
			// Gesamtes Projekt loeschen
			$this->project->delete();

			$this->setTemplateVar('tree_refresh',true);
		}
		else
		{
			$this->addValidationError('delete');
			$this->callSubAction('remove');
		}
	}
	
	

	function maintenance()
	{
		if	( $this->hasRequestVar('ok') )
		{
			$this->project->checkLostFiles();
			$this->addNotice('project',$this->project->name,'DONE');
			$this->setTemplateVar('done',true);
		}
	}



	/**
	 * Projekt exportieren.
	 */
	function export()
	{
		global $conf;
		$dbids = array();
		
		foreach( $conf['database'] as $dbname=>$dbconf )
		{
			if	( is_array($dbconf) )
				$dbids[$dbname] = $dbconf['comment'];
		}
		$this->setTemplateVar( 'dbids',$dbids );
		
		if	( $this->hasRequestVar('ok') )
		{
			$this->project->export( $this->getRequestVar('dbid') );
			
			$this->addNotice('project',$this->project->name,'DONE');
			$this->setTemplateVar('done',true);
		}
	}
}