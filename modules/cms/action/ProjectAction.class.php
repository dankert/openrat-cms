<?php

namespace cms\action;

use cms\base\Configuration;
use cms\model\Acl;
use cms\model\Project;
use cms\model\Folder;
use language\Messages;
use logger\Logger;
use util\FileUtils;

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
class ProjectAction extends BaseAction
{
	public $security = Action::SECURITY_ADMIN;

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
			$this->project->name                 = $this->getRequestVar('name'               ,RequestParams::FILTER_ALPHANUM);
			$this->project->url                  = $this->getRequestVar('url'                ,RequestParams::FILTER_ALPHANUM);
			$this->project->target_dir           = $this->getRequestVar('target_dir'         ,RequestParams::FILTER_RAW     );
			$this->project->ftp_url              = $this->getRequestVar('ftp_url'            ,RequestParams::FILTER_RAW     );
			$this->project->ftp_passive          = $this->getRequestVar('ftp_passive'        ,RequestParams::FILTER_RAW     );
			$this->project->cmd_after_publish    = $this->getRequestVar('cmd_after_publish'  ,RequestParams::FILTER_RAW     );
			$this->project->content_negotiation  = $this->getRequestVar('content_negotiation',RequestParams::FILTER_NUMBER  );
			$this->project->cut_index            = $this->getRequestVar('cut_index'          ,RequestParams::FILTER_NUMBER  );
			$this->project->publishFileExtension = $this->getRequestVar('publishFileExtension',RequestParams::FILTER_NUMBER  );
			$this->project->publishPageExtension = $this->getRequestVar('publishPageExtension',RequestParams::FILTER_NUMBER  );
			$this->project->linkAbsolute         = $this->getRequestVar('linksAbsolute'       ,RequestParams::FILTER_NUMBER  ) == '1';

			$this->addNoticeFor($this->project,Messages::SAVED);
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


        $this->setTemplateVar('projectid'       ,$this->project->projectid);
        $this->setTemplateVar('rootobjectid'    ,$this->project->getRootObjectId());
        $this->setTemplateVar('is_project_admin',$this->userIsProjectAdmin());
    }



	/**
	 * Stellt fest, ob der angemeldete Benutzer Projekt-Admin ist.
	 * Dies ist der Fall, wenn der Benutzer PROP-Rechte im Root-Folder hat.
	 * @return bool|int
	 */
	protected function userIsProjectAdmin() {

		$rootFolder = new Folder( $this->project->getRootObjectId() );

		return $rootFolder->hasRight(Acl::ACL_PROP);
	}

	/**
	 * Liste aller Projekte anzeigen.
	 *
	 */
	function listingView()
	{
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
			$projects = array_merge( array("-1"=>\cms\base\Language::lang('ADMINISTRATION')),$projects );

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
		$extraProperties = array(
		    'rootobjectid'  => $this->project->getRootObjectId(),
            'linksAbsolute' => $this->project->linkAbsolute?'1':'0'
        );
		
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
		$this->addNotice('project', 0, $this->project->name, 'DELETED');
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
				$status = empty($this->project->log) ? Action::NOTICE_OK : Action::NOTICE_ERROR;
					
				$this->addNotice('project', 0, $this->project->name, 'DONE', $status, array(), $this->project->log);
				break;
				
			case 'check_limit':
				// Alte Versionen löschen.
				$this->project->checkLimit();
				$this->addNotice('project', 0, $this->project->name, 'DONE');
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
		$conf = Configuration::rawConfig();
		$syncConf = $conf['sync'];
		
		if	( ! $syncConf['enabled'] )
			return;
		
		$syncDir = FileUtils::slashify($syncConf['directory']).$this->project->name;
		
		
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
		$db = \cms\base\DB::get();
		$this->setTemplateVar( 'dbid',$db->id );

		$conf = Configuration::rawConfig();
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
			
			$this->addNotice('project', 0, $this->project->name, 'DONE');
			$this->setTemplateVar('done',true);
		}
	}
	
	
	
	/**
	 * Ausgabe PHPINFO.
	 *
	 */
	function phpinfo()
	{
		$conf = Configuration::rawConfig();
		if	( !@$conf['security']['show_system_info'] )
			Http::sendStatus(403,'Forbidden','Display of system information is disabled by configuration');
			
		phpinfo();
	}

	
	
	
	function infoView()
	{
		$this->setTemplateVar( 'info', $this->project->info() );
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