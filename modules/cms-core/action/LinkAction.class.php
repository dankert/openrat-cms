<?php

namespace cms\action;

use cms\model\Folder;
use cms\model\Link;





use Session;

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
 * Action-Klasse f?r Verkn?pfungen
 * @version $Id$
 * @author $Author$
 * @package openrat.actions
 */
class LinkAction extends ObjectAction
{
	public $security = SECURITY_USER;
	
	private $link;

	/**
	 * Konstruktor
	 */
	function __construct()
	{
        parent::__construct();

    }


    public function init()
    {
		$this->link = new Link( $this->getRequestId() );
		$this->link->load();

		parent::init();
	}



	function remove()
	{
		$this->setTemplateVars( $this->link->getProperties() );
	}
	


	function delete()
	{
		if	( $this->hasRequestVar("delete") )
		{
			$this->link->delete();
			$this->addNotice('link',$this->link->name,'DELETED');
		}
	}
	


	/**
	 * Abspeichern der Eigenschaften
	 */
	function propPost()
	{
		// Wenn Name gefuellt, dann Datenbank-Update
		if   ( $this->getRequestVar('name') != '' )
		{
			// Eigenschaften speichern
			$this->link->name      = $this->getRequestVar('name'       ,'full');
			$this->link->desc      = $this->getRequestVar('description','full');

			$this->link->save();
			$this->link->setTimestamp();
		}
	}


	/**
	 * Abspeichern der Eigenschaften
	 */
	function editPost()
	{
            $this->link->linkedObjectId = $this->getRequestVar('targetobjectid');

			$this->link->save();
			$this->link->setTimestamp();

			$this->addNotice('link',$this->link->name,'SAVED',OR_NOTICE_OK);
	}



	public function editView()
	{
		$this->setTemplateVars( $this->link->getProperties() );

		// Typ der Verknuepfung
		$this->setTemplateVar('type'            ,$this->link->getType()     );
		$this->setTemplateVar('targetobjectid'  ,$this->link->linkedObjectId);
		$this->setTemplateVar('targetobjectname',$this->link->name          );
	}



	function propView()
	{
		$this->setTemplateVars( $this->link->getProperties() );
		$this->setTemplateVar('act_linkobjectid',$this->link->linkedObjectId);
	}
	
	
	
	function infoView()
	{
		$this->setTemplateVars( $this->link->getProperties() );
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
		$tmp = &$structure;
		$nr  = 0;
		
		$folder = new Folder( $this->link->parentid );
		$parents = $folder->parentObjectNames(false,true);
		
		foreach( $parents as $id=>$name)
		{
			unset($children);
			unset($o);
			$children = array();
			$o = array('id'=>$id,'name'=>$name,'type'=>'folder','level'=>++$nr,'children'=>&$children);
			
			$tmp[$id] = &$o;;
			
			unset($tmp);
			
			$tmp = &$children; 
		}
		
		
		
		unset($children);
		unset($id);
		unset($name);
		
		$elementChildren = array();
		
		$tmp[ $this->link->objectid ] = array('id'=>$this->link->objectid,'name'=>$this->link->name,'type'=>'link','self'=>true,'children'=>&$elementChildren);
		
		// 
		//$elementChildren[$id] = array('id'=>$this->page->objectid.'_'.$id,'name'=>$name,'type'=>'pageelement','children'=>array() );
		
		//Html::debug($structure);
		
		$this->setTemplateVar('outline',$structure);
	}
}