<?php
// OpenRat Content Management System
// Copyright (C) 2002-2009 Jan Dankert, jandankert@jandankert.de
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
 * Actionklasse zum Anzeigen der Titelleiste.
 * 
 * @author Jan Dankert
 * @package openrat.actions
 */
class TitleAction extends Action
{
	/**
	 * Fuellen der Variablen und Anzeigen der Titelleiste
	 */
	function show()
	{
		$this->setTemplateVar('buildinfo',OR_TITLE.' '.OR_VERSION.' - build '.config('build','build') );

		$db = Session::getDatabase();
		$this->setTemplateVar('dbname',$db->conf['comment'].(readonly()?' ('.lang('readonly').')':''));
		
		$databases = array();
		global $conf;
		foreach( $conf['database'] as $dbid=>$dbconf )
			if	( $dbconf['enabled'])
				$databases[$dbid] = $dbconf['comment'];
		$this->setTemplateVar('databases',$databases);
		
		$user = Session::getUser();		
		$this->setTemplateVar('username'    ,$user->name    );
		$this->setTemplateVar('userfullname',$user->fullname);

		$project = Session::getProject();
		if	( is_object($project) )
		{
			$this->setTemplateVar('projectname',$project->name);
			$this->setTemplateVar('projects' ,Project::getAll()  );
		}		
			
		
		
		$language = Session::getProjectLanguage();
		if	( is_object($language) )
		{
			$this->setTemplateVar('languagename',$language->name);
			$this->setTemplateVar('languages',Language::getAll() );
		}		
		
		$model = Session::getProjectModel();
		if	( is_object($model) )
		{
			$this->setTemplateVar('modelname',$model->name);
			$this->setTemplateVar('models'   ,Model::getAll()    );
		}		
		
		// Urls zum Benutzerprofil und zum Abmelden
		//$this->setTemplateVar('profile_url',Html::url( 'profile'         ));
		//$this->setTemplateVar('logout_url' ,Html::url( 'index','logout'  ));
		
		if	( Session::get('showtree') )
		{
			$this->setTemplateVar('showtree_url' ,Html::url('index','hidetree') );
			$this->setTemplateVar('showtree_text',lang('HIDETREE')       );
		}
		else
		{
			$this->setTemplateVar('showtree_url' ,Html::url('index','showtree') );
			$this->setTemplateVar('showtree_text',lang('SHOWTREE')       );
		}
		
		if	( config('interface','session','auto_extend') )
		{
			$this->setTemplateVar('refresh_url'    ,Html::url('title','show')            );			
			$this->setTemplateVar('refresh_timeout',ini_get('session.gc_maxlifetime')-60 );			
		}
	}
}

?>