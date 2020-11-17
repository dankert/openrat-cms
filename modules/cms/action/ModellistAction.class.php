<?php

namespace cms\action;

use cms\model\Model;
use cms\model\Project;
use util\Html;

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
class ModellistAction extends BaseAction
{
    /**
     * @var Project
     */
    protected $project;

	public $security = Action::SECURITY_USER;


    function __construct()
	{
        parent::__construct();
    }


    public function init()
    {

        $this->project = new Project( $this->request->getRequestId());
    }


	function showView()
	{
		$project = new Project( $this->project->projectid );

		$list = array();
		foreach( $project->getModelIds() as $id )
		{
			$m = new Model( $id );
			$m->load();

            $list[$id]['id'  ] = $id;
            $list[$id]['name'] = $m->name;

            $list[$id]['is_default'] = $m->isDefault;
			$list[$id]['select_url'] = Html::url('index','model',$id);
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
		$model->projectid = $this->getRequestVar('projectid');
		$model->name      = $this->getRequestVar('name');
		$model->add();
		
		// Wenn kein Namen eingegeben, dann einen setzen.
		if	( empty($model->name) )
		{
			// Name ist "Variante <id>"
			$model->name = \cms\base\Language::lang('MODEL').' '.$model->modelid;
			$model->save();
		}
	}
	
}