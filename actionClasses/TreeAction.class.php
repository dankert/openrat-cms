<?php
// ---------------------------------------------------------------------------
// $Id$
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
// $Log$
// Revision 1.9  2004-12-15 23:24:58  dankert
// Html::url()-Parameter angepasst
//
// Revision 1.8  2004/11/27 13:08:49  dankert
// Benutzen "id"-Attribut
//
// Revision 1.7  2004/11/10 22:40:49  dankert
// Benutzen der Session-Klasse
//
// Revision 1.6  2004/09/30 20:28:30  dankert
// Titel bei ?ffnen/Schlie?en von Baumzweigen
//
// Revision 1.5  2004/09/07 21:12:30  dankert
// F?llen des Navigationsbaumes mit neuen Klassen
//
// Revision 1.4  2004/05/02 14:49:37  dankert
// Einf?gen package-name (@package)
//
// Revision 1.3  2004/04/25 17:53:37  dankert
// Neue Methode openall()
//
// Revision 1.2  2004/04/25 12:50:11  dankert
// Korrektur: Projektliste
//
// Revision 1.1  2004/04/24 15:14:52  dankert
// Initiale Version
//
// Revision 1.1  2003/09/29 18:19:48  dankert
// erste Version
//
// ---------------------------------------------------------------------------

/**
 * Action-Klasse zum Laden/Anzeigen des Navigations-Baumes
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */

class TreeAction extends Action
{
	var $defaultSubAction = 'load';
	var $tree;


	/**
	 * ?ffnen aller Baumelemente
	 */
	function openall()
	{
	}
	
	
	/**
	 * ?ffnen eines Baumelementes
	 */
	function open()
	{
		$this->tree = Session::getTree();
		$this->tree->open( $this->getRequestId() );
		Session::setTree( $this->tree );

		$this->callSubAction('show');
	}
	
	
	/**
	 * Schlie?en eines Baumelementes
	 */
	function close()
	{
		$this->tree = Session::getTree();
		$this->tree->close( $this->getRequestId() );
		Session::setTree( $this->tree );

		$this->callSubAction('show');
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
		language_read(); // TODO Beim 1. stable-Release entfernen!
	
		if	( $projectid == -1 )
		{
			$this->tree = new AdministrationTree();
			
		}
		else
		{
			$this->tree = new ProjectTree();
			$this->tree->projectId = $projectid;

			$SESS['languageid'] = Language::getDefaultId();
			$SESS['modelid'   ] = Model::getDefaultId();
		}

		Session::setTree( $this->tree );

		// Weiter mit show()
		//
		$this->callSubAction('show');
	}


	function outputElement( $elId,$tiefe,$isLast )
	{
		$treeElement = $this->tree->elements[$elId]; 

		$zeilen = array();
		$zeile  = array();
	
		if   ( !isset($tree_last) )
			$tree_last=array();
	
	     $zeile['cols'] = array();
	
		for	( $i=1; $i<=$tiefe-1; $i++ )
		{
			if   ( $isLast[$i] )
				$zeile['cols'][] = 'blank';
			else $zeile['cols'][] = 'line';
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
		else $zeile['target'] = 'cms_main';


		$zeilen[] = $zeile;
		// Rekursiv alle Unter-Elemente lesen
		$nr = 0;
		foreach( $this->tree->elements[$elId]->subElementIds as $subElementId )
		{
			$nr++;
			if   ( $nr == count($this->tree->elements[$elId]->subElementIds) )
				$isLast[$tiefe+1] = true;
			else $isLast[$tiefe+1] = false;

			$zeilen = array_merge( $zeilen,$this->outputElement( $subElementId,$tiefe+1,$isLast ) );
		}
	          
		return $zeilen;
	}
	
	
	/**
	 * Anzeigen des Baumes
	 */
	function show()
	{
		global
			$tree,
			$SESS,
			$tree_last,
			$var;

		$var['zeilen']=array();

//		echo '<pre>';
//		print_r($tree);
//		echo '</pre>';

		$var['zeilen'] = $this->outputElement( 0,0,array() );

//		echo '<pre>';
//		print_r($var['zeilen']);
//		echo '</pre>';

		$this->setTemplateVars( $var );
		$this->forward('tree');
	}
}

?>