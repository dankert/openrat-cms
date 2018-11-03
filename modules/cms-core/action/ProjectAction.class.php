<?php

namespace cms\action;

use cms\model\Project;
use cms\model\Folder;

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
class ProjectAction extends Action
{
	public $security = SECURITY_ADMIN;

    /**
     * @var Project
     */
	private $project;
	var $defaultSubAction = 'listing';


	function __construct()
	{
        parent::__construct();
    }


    public function init()
    {
		$this->project = new Project( $this->getRequestId() );
		$this->project->load();
	}


	function propPost()
	{
		if	( $this->getRequestVar('name') != '')
		{
			$this->project->name                 = $this->getRequestVar('name'               ,OR_FILTER_ALPHANUM);
			$this->project->url                  = $this->getRequestVar('url'                ,OR_FILTER_ALPHANUM);
			$this->project->target_dir           = $this->getRequestVar('target_dir'         ,OR_FILTER_RAW     );
			$this->project->ftp_url              = $this->getRequestVar('ftp_url'            ,OR_FILTER_RAW     );
			$this->project->ftp_passive          = $this->getRequestVar('ftp_passive'        ,OR_FILTER_RAW     );
			$this->project->cmd_after_publish    = $this->getRequestVar('cmd_after_publish'  ,OR_FILTER_RAW     );
			$this->project->content_negotiation  = $this->getRequestVar('content_negotiation',OR_FILTER_NUMBER  );
			$this->project->cut_index            = $this->getRequestVar('cut_index'          ,OR_FILTER_NUMBER  );
			$this->project->publishFileExtension = $this->getRequestVar('publishFileExtension',OR_FILTER_NUMBER  );
			$this->project->publishPageExtension = $this->getRequestVar('publishPageExtension',OR_FILTER_NUMBER  );

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




	public function editView() {


        $list[] = array(
            'name'=>'content',
            'type'=>'folder',
            'id'  => $this->project->getRootObjectId()
        );
        $list[] = array(
            'name'=>'templates',
            'type'=>'templatelist',
            'id'  => $this->project->projectid
        );
        $list[] = array(
            'name'=>'languages',
            'type'=>'languagelist',
            'id'  => $this->project->projectid
        );
        $list[] = array(
            'name'=>'models',
            'type'=>'modellist',
            'id'  => $this->project->projectid
        );

        $this->setTemplateVar('content',$list);
    }

	/**
	 * Liste aller Projekte anzeigen.
	 *
	 */
	function listingView()
	{
		global $conf_php;

		// Projekte ermitteln
		$list = array();

		foreach(Project::getAllProjects() as $id=> $name )
		{
			$list[$id]             = array();
			$list[$id]['url'     ] = Html::url('project','edit',$id);
			$list[$id]['use_url' ] = Html::url('tree'   ,'load',0  ,array('projectid'=>$id,'target'=>'tree'));
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
	function propView()
	{
		$extraProperties = array('rootobjectid'=>$this->project->getRootObjectId());
		
		$this->setTemplateVars( $this->project->getProperties() + $extraProperties );

	}
	
	
	function removeView()
	{
		$this->setTemplateVar( 'name',$this->project->name );
	}
	
	
	function removePost()
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
	function maintenancePost()
	{
		switch( $this->getRequestVar('type') )
		{
			case 'check_files':
				// Konsistenzprüfungen
				$this->project->checkLostFiles();
				$status = empty($this->project->log) ? OR_NOTICE_OK : OR_NOTICE_ERROR;
					
				$this->addNotice('project',$this->project->name,'DONE',$status,array(),$this->project->log);
				break;
				
			case 'check_limit':
				// Alte Versionen löschen.
				$this->project->checkLimit();
				$this->addNotice('project',$this->project->name,'DONE');
				break;
				
			default:
				$this->addValidationError('type');
				return;
		}
	}

	

	/**
	 * Synchronisation mit dem Dateisystem. 
	 */
	public function syncPost()
	{
		
	}


	/**
	 * Synchronisation mit dem Dateisystem. 
	 */
	public function syncView()
	{
		global $conf;
		$syncConf = $conf['sync'];
		
		if	( ! $syncConf['enabled'] )
			return;
		
		$syncDir = slashify($syncConf['directory']).$this->project->name;
		
		
	}


	/**
	 * Import aus dem Dateisystem. 
	 */
	public function importView()
	{
		
	}


	/**
	 * Import aus dem Dateisystem. 
	 */
	public function importPost()
	{
		
	}


	/**
	 * Export in Dateisystem.
	 */
	public function exportView()
	{
		
	}


	/**
	 * Export in Dateisystem.
	 */
	public function exportPost()
	{
		
	}


	/**
	 * Projekt exportieren.
	 */
	public function copyView()
	{
		
	}
	
	
	/**
	 * Projekt exportieren.
	 */
	public function copyPost()
	{
		$db = db_connection();
		$this->setTemplateVar( 'dbid',$db->id );

		global $conf;
		$dbids = array();
		
		foreach( $conf['database'] as $dbname=>$dbconf )
		{
			if	( is_array($dbconf) && $dbconf['enabled'])
				$dbids[$dbname] = $dbconf['description'];
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

	
	
	
	function infoView()
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
	
	
	/**
	 * Ermittelt die letzten Änderungen, die im aktuellen Projekt gemacht worden sind.
	 */
	public function historyView()
	{
		$result = $this->project->getLastChanges();
	
		$this->setTemplateVar('timeline', $result);
	}
	
	
}