<?php
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
 * Action-Klasse zum Bearbeiten eines Projetmodells
 * 
 * @author Jan Dankert
 * @package openrat.actions
 */
class ModellistAction extends Action
{
	public $security = SECURITY_USER;
	
	function ModellistAction()
	{
		if	( $this->getRequestId() != 0 )
		{
			$this->model = new Model( $this->getRequestId() );
			$this->model->load();
		}
		
		$this->project = Session::getProject();
	}


	function showView()
	{
		global $conf_php;
		$actModel = Session::getProjectModel();

//		$var['act_modelid'] = $this->getSessionVar('modelid');
	
		$list = array();
		foreach( $this->project->getModelIds() as $id )
		{
			$m = new Model( $id );
			$m->load();

			$list[$id]['name'] = $m->name;
			
			if	( $this->userIsAdmin() )
				$list[$id]['id' ] = $id;

			if	( ! $m->isDefault && $this->userIsAdmin() )
				$list[$id]['default_url'] = Html::url('model','setdefault',$id);

			if	( $actModel->modelid != $m->modelid )
				$list[$id]['select_url' ] = Html::url('index','model',$id);
		}
		$this->setTemplateVar( 'el',$list );
		$this->setTemplateVar( 'add',$this->userIsAdmin() );
	}


	/**
	 * Bearbeiten der Variante.
	 * Ermitteln aller Eigenschaften der Variante.
	 */
	function editView()
	{
		$this->nextSubAction('show');
	}
	
	
	
	
	function addView()
	{
	}


	function addPost()
	{
		$model = new Model();
		$model->projectid = $this->project->projectid;
		$model->name      = $this->getRequestVar('name');
		$model->add();
		
		// Wenn kein Namen eingegeben, dann einen setzen.
		if	( empty($model->name) )
		{
			// Name ist "Variante <id>"
			$model->name = lang('MODEL').' '.$model->modelid;
			$model->save();
		}
	}
	
}