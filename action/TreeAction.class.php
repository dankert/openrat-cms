<?php
// ---------------------------------------------------------------------------
// DaCMS Content Management System
// Copyright (C) 2002 Jan Dankert, jandankert@jandankert.de
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

/**
 * Action-Klasse zum Laden/Anzeigen des Navigations-Baumes
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */

class TreeAction extends Action
{
	public $security = SECURITY_USER;
	
	var $tree;


	/**
	 * ?ffnen aller Baumelemente
	 */
	function openall()
	{
		$this->tree = Session::getTree();
		$this->tree->all();
		Session::setTree( $this->tree );
	}
	
	
//	function refresh()
//	{
//		$this->tree = Session::getTree();
//		$this->tree->refresh();
//		Session::setTree( $this->tree );
//	}
	
	
	/**
	 * ?ffnen eines Baumelementes
	 */
	function open()
	{
		$this->tree = Session::getTree();
		$this->tree->open( $this->getRequestId() );
		Session::setTree( $this->tree );
	}
	
	
	/**
	 * Schlie?en eines Baumelementes
	 */
	function close()
	{
		$this->tree = Session::getTree();
		$this->tree->close( $this->getRequestId() );
		Session::setTree( $this->tree );
	}
	
		
	/**
	 * Neues Laden des Baumes
	 */
	private function load()
	{
		global $SESS;

		$project = Session::getProject();
		$projectid = $project->projectid;

		if	( $projectid == -1 )
		{
			$this->tree = new AdministrationTree();
//			Session::setProjectLanguage(null);
//			Session::setProjectModel(null);
//			Session::setProject(null);
		}
		else
		{
//			$project = new Project($projectid);
//			$project->load();
//			Session::setProject($project);
	
			$this->tree = new ProjectTree();
			$this->tree->projectId = $projectid;

//			$language = new Language( Language::getDefaultId() );
//			$language->load();
//			Session::setProjectLanguage( $language );
//			
//			$model = new Model( Model::getDefaultId() );
//			$model->load();
//			Session::setProjectModel( $model ); 
		}

		Session::setTree( $this->tree );
	}

	
	/**
	 * Liefert ein Array mit allen Zeilen des Baumes.
	 * 
	 * Ruft sich intern rekursiv auf.
	 * 
	 * @param $elId
	 * @param $tiefe
	 * @param $isLast
	 * @return unknown_type
	 */
	function outputElement( $elId,$tiefe,$isLast )
	{
		$treeElement = $this->tree->elements[$elId]; 

		$zeilen = array();
		$zeile  = array();

		global $class;
		$zeile['class'] = $class;
		if	( $this->getRequestId() == $elId )
			$zeile['class'] = 'opened';
		if	( $this->getRequestId() == $elId )
			$class ='active';
		
		if   ( !isset($tree_last) )
			$tree_last=array();
	
	     $zeile['cols'] = array();
	
		for	( $i=1; $i<=$tiefe-1; $i++ )
		{
			if   ( $isLast[$i] )
				$zeile['cols'][] = 'blank';
			else
				$zeile['cols'][] = 'line';
		}

		if	( $tiefe == 0 )
		{
		}
		elseif   ( $treeElement->type != "" )
		{
			if   ( count($treeElement->subElementIds) == 0 )
			{
	               if   ( $isLast[$tiefe] )
	                    $zeile['image'] = 'plus_end';
	               else $zeile['image'] = 'plus';

	               $zeile['image_url'     ] = Html::url('tree','open',$elId);
	               $zeile['image_url_desc'] = lang('TREE_OPEN_ELEMENT');
	          }
	          else
	          {
	               if   ( $isLast[$tiefe] )
	                    $zeile['image'] = 'minus_end';
	               else $zeile['image'] = 'minus';

	               $zeile['image_url'     ] = Html::url('tree','close',$elId);
	               $zeile['image_url_desc'] = lang('TREE_CLOSE_ELEMENT');
	          }
	     }
	     else
	     {
	          if   ( $isLast[$tiefe] )
	               $zeile['image'] = 'none_end';
	          else $zeile['image'] = 'none';
	     }
	     

	
		$zeile['icon'] = $treeElement->icon;
		$zeile['text'] = $treeElement->text;
		$zeile['desc'] = $treeElement->description;
		$zeile['name'] = $elId;

		// Url setzen
		if   ( $treeElement->url != "" )
			$zeile['url']  = $treeElement->url;

		// HTML-Target setzen
		if   ( $treeElement->target != "" )
			$zeile['target'] = $treeElement->target;
		else
			$zeile['target'] = 'cms_main';
		
		$zeile['colspan'] = 20 - count( $zeile['cols'] ) - intval(isset($zeile['image']));

		$zeilen[] = $zeile;
		// Rekursiv alle Unter-Elemente lesen
		$nr = 0;
		foreach( $this->tree->elements[$elId]->subElementIds as $subElementId )
		{
			$nr++;
			if   ( $nr == count($this->tree->elements[$elId]->subElementIds) )
				$isLast[$tiefe+1] = true;
			else $isLast[$tiefe+1] = false;

			// Rekursiver Aufruf
			$zeilen = array_merge( $zeilen,$this->outputElement( $subElementId,$tiefe+1,$isLast ) );
		}

		if	( $this->getRequestId() == $elId )
			$class ='';
		
		return $zeilen;
	}
	
	
	/**
	 * Anzeigen des Baumes
	 */
	public function showView()
	{
		//if	( $this->hasRequestVar('projectid') )
		$this->load();
			
		$project = Session::getProject();
		if	( is_object($project) )
		{
			$this->setTemplateVar('projectname',$project->name);
		}
		
		$this->tree = Session::getTree();
		
		//if	( $this->getRequestVar('target')!='tree' )
			$this->tree->refresh();
		
		$var = array();
		$var['zeilen'] = $this->outputElement( 0,0,array() );

		$this->setTemplateVars( $var );
	}
	
	
	/**
	 * Anzeigen des Baumes fuer asynchrone Anfragen.
	 */
	function loadAll()
	{
		$this->tree = Session::getTree();
		
		$this->setTemplateVar( 'lines',$this->outputElement( 0,0,array() ) );
		$this->setTemplateVar( 'tree',$this->tree->elements                ); 
	}

	/**
	 * Anzeigen des Baumes fuer asynchrone Anfragen.
	 */
	public function loadEntryView()
	{
		$this->tree = Session::getTree();
		
		$this->setTemplateVar( 'lines',$this->outputElement( 0,0,array() ) );
		$this->setTemplateVar( 'tree',$this->tree->elements                ); 
	}

	
	
	/**
	 * Anzeigen des Baumes fuer asynchrone Anfragen.
	 */
	public function loadBranchView()
	{
		$this->tree = Session::getTree();
		
		if	( !is_object($this->tree) ) {
			$this->setTemplateVar('notice','fuck, kein Baum');
			return;
		}
		
		$type = $this->getRequestVar('type');
		
		$this->tree->tempElements = array();
		
		if	( intval($this->getRequestVar('id')) != 0 )
			$this->tree->$type( $this->getRequestId() );
		else
			$this->tree->$type();
			
		$branch = array();
		foreach( $this->tree->tempElements as $element )
		{
			$branch[] = get_object_vars($element);
		}
		
		$this->setTemplateVar( 'branch',$branch ); 
	}
	

	/**
	 * Inhalt des Projektes anzeigen.
	 */
	private function content()
	{
		if	( $this->hasRequestVar('projectid') )
			$this->load();
		
		// Nichts - denn der Baum lädt sich über AJAX selbst.
	}
	

	/**
	 * Projekt-Einstellungen anzeigen.
	 */
	public function settingsView()
	{
		$this->setTemplateVar( 'languages' ,Language::getAll()                        );
		$this->setTemplateVar( 'languageid',Session::getProjectLanguage()->languageid );
		$this->setTemplateVar( 'models'    ,Model::getAll()                           );
		$this->setTemplateVar( 'modelid'   ,Session::getProjectModel()->modelid       );
	}
	
	public function settingsPost()
	{
		$language = new Language( $this->getRequestVar(REQ_PARAM_LANGUAGE_ID,OR_FILTER_NUMBER) );
		$language->load();
		Session::setProjectLanguage( $language );

		$model = new Model( $this->getRequestVar(REQ_PARAM_MODEL_ID,OR_FILTER_NUMBER) );
		$model->load();
		Session::setProjectModel( $model );
		
		$this->addNotice('language',$language->name,'DONE',OR_NOTICE_OK);
		$this->addNotice('model'   ,$model->name   ,'DONE',OR_NOTICE_OK);
	}
	
}

?>