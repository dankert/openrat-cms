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
	
	
	function refresh()
	{
		$this->tree = Session::getTree();
		$this->tree->refresh();
		Session::setTree( $this->tree );
	}
	
	
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
	function load()
	{
		global $SESS;
		$project   = Session::getProject();
		$projectid = $project->projectid; 

		// Erzeugen des Menue-Baums
		//
	
		if	( $projectid == -1 )
		{
			$this->tree = new AdministrationTree();
			
		}
		else
		{
			$this->tree = new ProjectTree();
			$this->tree->projectId = $projectid;

			$SESS[REQ_PARAM_LANGUAGE_ID] = Language::getDefaultId();
			$SESS['modelid'   ] = Model::getDefaultId();
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
	function show()
	{
		$this->tree = Session::getTree();
		
		if	( $this->tree == null )
		{
			Logger::debug("Reloading Tree...");
			$this->load();
		}

		$var = array();
		$var['zeilen'] = $this->outputElement( 0,0,array() );

		$this->setTemplateVars( $var );
	}
}

?>