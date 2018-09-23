<?php

namespace cms\action;

use cms\model\Model;



use Session;
use \Html;

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
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */
class ModelAction extends Action
{
	public $security = SECURITY_USER;
	
	var $defaultSubAction = 'listing';
	var $model;


	function __construct()
	{
        parent::__construct();

    }


    public function init()
    {
		$this->model = new Model( $this->getRequestId() );
		$this->model->load();
	}



	public function propView()
    {
        $this->setTemplateVar('name'      ,$this->model->name      );
        $this->setTemplateVar('is_default',$this->model->isDefault );
    }



    /**
     * Speichern der Sprache
     */
    public function propPost()
    {
        if	( $this->hasRequestVar('name') ) {
            $this->model->name = $this->getRequestVar('name');
            $this->model->save();
        }

        if  ( $this->hasRequestVar('is_default') )
            $this->model->setDefault();

        $this->addNotice('model',$this->model->name,'DONE',OR_NOTICE_OK);
    }


	/**
	 * Entfernen der Variante.<br>
	 * Es wird ein Best�tigungsdialog angezeigt.
	 */
	function removeView()
	{
		$this->model->load();

		$this->setTemplateVar( 'name',$this->model->name );
	}
	
	
	/**
	 * Löschen des Models.
	 */
	function removePost() 
	{
		if   ( $this->hasRequestVar('confirm') )
		{
			$this->model->delete();
			$this->addNotice('model',$this->model->name,'DONE',OR_NOTICE_OK);
		}
		else
		{
			$this->addNotice('model',$this->model->name,'NOTHING_DONE',OR_NOTICE_WARN);
		}
	}
	
	
	
	// Speichern eines Modells
	function editPost()
	{
		if   ( $this->getRequestVar('name') != '' )
		{
			$this->model->name = $this->getRequestVar('name');
			$this->model->save();
			$this->addNotice('model',$this->model->name,'SAVED','ok');
		}
		else
		{
			$this->addNotice('model',$this->model->name,'NOT_SAVED','error');
		}
	
		// Baum aktualisieren
//		$this->setTemplateVar('tree_refresh',true);
	}


	function setdefaultPost()
	{
		if	( !$this->userIsAdmin() ) exit();

		$this->model->setDefault();
	
        $this->addNotice('model',$this->model->name,'DONE',OR_NOTICE_OK);
	}


	/**
	 * Bearbeiten der Variante.
	 * Ermitteln aller Eigenschaften der Variante.
	 */
	function editView()
	{
		$this->model->load();
	
		$this->setTemplateVars( $this->model->getProperties() );
	}



	/**
	 * Liefert die Struktur zu diesem Ordner:
	 * - Mit den übergeordneten Ordnern und
	 * - den in diesem Ordner enthaltenen Objekten
	 * 
	 * Beispiel:
	 * <pre>
	 * - A
	 *   - B
	 *     - C (dieser Ordner)
	 *       - Unterordner
	 *       - Seite
	 *       - Seite
	 *       - Datei
	 * </pre> 
	 */
	public function structureView()
	{
		$structure = array();
		$modellistChildren = array();
		
		$structure[0] = array('id'=>'0','name'=>lang('MODELS'),'type'=>'modellist','level'=>1,'children'=>&$modellistChildren);
			
		$modellistChildren[ $this->model->modelid ] = array('id'=>$this->model->modelid,'name'=>$this->model->name,'type'=>'model','self'=>true);
		
		
		//Html::debug($structure);
		
		$this->setTemplateVar('outline',$structure);
	}
}