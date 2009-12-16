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


	function editAction()
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
			
			$root = new Folder( $this->project->getRootObjectId() );
			$root->setTimestamp();
		}
		else
		{
			$this->addValidationError('name');
			$this->callSubAction('edit');
		}
	}



	function addView()
	{
		$this->setTemplateVar( 'projects',Project::getAll() );
	}
	

	/**
	 * Projekt hinzufuegen.
	 *
	 */
	function addAction()
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
					break;
				case 'copy':
					$db = db_connection();
					$project = new Project($this->getRequestVar('projectid'));
					$project->load();
					$project->export($db->id);
					break;
				default:
					Http::serverError('Unknown type while adding project '.$this->getRequestVar('type') );
			}
			
			$this->addNotice('project',$this->project->name,'ADDED'); 
		}
	}


	/**
	 * Liste aller Projekte anzeigen.
	 *
	 */
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
	}


	/**
	 * Auswaehlen und starten eines Projektes.
	 */
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
	}


	/**
	 * Anzeige der Eigenschaften des Projektes.
	 */
	function editView()
	{
		// Projekt laden
		$this->setTemplateVars( $this->project->getProperties() );

	}
	
	
	function removeView()
	{
		$this->setTemplateVar( 'name',$this->project->name );
	}
	
	
	function removeAction()
	{
		if   ( !$this->hasRequestVar('delete') )
		{
			$this->addValidationError('delete');
			return;
		}
		
		// Gesamtes Projekt loeschen
		$this->project->delete();

		$this->setTemplateVar('tree_refresh',true);
		$this->addNotice('project',$this->project->name,'DELETED'); 
	}
	
	

	/**
	 * Anzeige View fuer Wartung.
	 */
	function maintenanceView()
	{
	}



	/**
	 * Wartung durchfuehren.
	 */
	function maintenanceAction()
	{
		switch( $this->getRequestVar('type') )
		{
			case 'check_files':
				$this->project->checkLostFiles();
				$this->addNotice('project',$this->project->name,'DONE');
				break;
				
			case 'check_limit':
				$this->project->checkLimit();
				$this->addNotice('project',$this->project->name,'DONE');
				break;
				
			default:
				$this->addValidationError('type');
				return;
		}
	}



	/**
	 * Projekt exportieren.
	 */
	function exportView()
	{
		
	}
	
	
	/**
	 * Projekt exportieren.
	 */
	function exportAction()
	{
		$db = db_connection();
		$this->setTemplateVar( 'dbid',$db->id );

		global $conf;
		$dbids = array();
		
		foreach( $conf['database'] as $dbname=>$dbconf )
		{
			if	( is_array($dbconf) && $dbconf['enabled'])
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
	
	
	
	/**
	 * Ausgabe PHPINFO.
	 *
	 */
	function phpinfo()
	{
		global $conf;
		if	( !@$conf['security']['show_system_info'] )
			Http::sendStatus(403,'Forbidden','Display of system information is disabled by configuration');
			
		phpinfo();
	}

	
	
	
	function info()
	{
		$this->setTemplateVar( 'info', $this->project->info() );
	}
	
	
	
	
	/**
	 * @param String $name Menüpunkt
	 * @return boolean true, falls Menüpunkt zugelassen
	 */
	function checkMenu( $name )
	{
		global $conf;
		
		switch( $name )
		{
			case 'remove':
				return     !readonly();
			case 'maintenance':
				return     !readonly();
				
			default:
				return true;
		}	
	}
	
}