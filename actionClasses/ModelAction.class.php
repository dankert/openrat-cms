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
// Revision 1.1  2004-04-24 15:14:52  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------


class ModelAction extends Action
{
	var $defaultSubAction = 'listing';
	var $model;


	function ModelAction()
	{
		$this->model = new Model();
		
		if	( intval($this->getSessionVar('modelid')) != 0 )
		{
			$this->model->modelid = $this->getSessionVar('modelid');
			$this->model->load();
		}
	}


	function add()
	{
		$model = new Model();
		$model->add( $this->getRequestVar('name') );
	
		$this->setTemplateVar('tree_refresh',true);
		
		$this->callSubAction('edit');
	}


	// Speichern eines Modells
	function save()
	{
		if   ( $this->getRequestVar('name') != '' )
		{
			if   ( $this->getRequestVar('delete') != '' )
			{
				$this->model->delete();

				$this->callSubAction('listing');
			}
			else
			{
				$this->model->name = $this->getRequestVar('name');
				$this->model->save();
				
				$this->callSubAction('listing');
			}
		}
	
		// Baum aktualisieren
		$this->setTemplateVar('tree_refresh',true);

		$this->callSubAction('listing');
	}


	function setDefault()
	{
		if	( !$this->userIsAdmin() ) exit();

		$this->model->setDefault();
	
		$this->callSubAction('listing');
	}


	function select()
	{
		$this->setSessionVar('projectmodelid',$this->getRequestVar('projectmodelid'));

		$this->callSubAction('listing');
	}


	function listing()
	{
		global $conf_php;

		$var['act_modelid'] = $this->getSessionVar('modelid');
	
		$list = array();
		foreach( $this->model->getAll() as $id=>$name )
		{
			$m = new Model( $id );
			$m->load();

			$list[$id]['name'] = $m->name;
			
			if	( $this->userIsAdmin() )
				$list[$id]['url' ] = 'do.'.$conf_php.'?modelaction=edit&modelid='.$id;

			if	( ! $m->isDefault && $this->userIsAdmin() )
				$list[$id]['default_url'] = 'modelaction=default&modelid='.$id;

			if	( $this->getSessionVar('modelid') != $m->modelid )
				$list[$id]['select_url' ] = 'modelaction=select&modelid='.$id;
		}
		$this->setTemplateVar( 'el',$list );
		$this->setTemplateVar( 'add',$this->userIsAdmin() );
	
		$this->forward('model_list');
	}


	function edit()
	{
		if   ( count( $this->model->getAll() ) >= 2 )
			$this->setTemplateVar('delete',true );
		else	$this->setTemplateVar('delete',false);

		$this->model->load();
	
		$this->setTemplateVars( $this->model->getProperties() );
	
		$this->forward('model_edit');
	}
}