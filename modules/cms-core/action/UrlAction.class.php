<?php

namespace cms\action;

use cms\model\Folder;
use cms\model\Url;





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
class UrlAction extends ObjectAction
{
	public $security = SECURITY_USER;
	
	var $url;
	var $defaultSubAction = 'prop';

	/**
	 * Konstruktor
	 */
	function __construct()
	{
        parent::__construct();

    }


    public function init()
    {
		$this->url = new Url( $this->getRequestId() );
		$this->url->load();

        parent::init();
    }



	function remove()
	{
		$this->setTemplateVars( $this->url->getProperties() );
	}
	


	function delete()
	{
		if	( $this->hasRequestVar("delete") )
		{
			$this->url->delete();
			$this->addNotice('url',$this->url->name,'DELETED');
		}
	}



    public function removeView()
    {
        $this->setTemplateVar( 'name',$this->url->filename );
    }


    public function removePost()
    {
        if   ( $this->getRequestVar('delete') != '' )
        {
            $this->url->delete();
            $this->addNotice('url',$this->url->filename,'DELETED',OR_NOTICE_OK);
        }
        else
        {
            $this->addNotice('url',$this->url->filename,'CANCELED',OR_NOTICE_WARN);
        }
    }


	/**
	 * Abspeichern der Eigenschaften
	 */
	function editPost()
	{
        $this->url->url            = $this->getRequestVar('url');
        $this->url->save();
        $this->url->setTimestamp();

        $this->addNotice('url',$this->url->name,'SAVED',OR_NOTICE_OK);
	}



	public function editView()
	{
		$this->setTemplateVars( $this->url->getProperties() );

		// Typ der Verknuepfung
		$this->setTemplateVar('type'            ,$this->url->getType()     );
		$this->setTemplateVar('url'             ,$this->url->url           );
	}


	
	
	public function infoView()
	{
		$this->setTemplateVars( $this->url->getProperties() );
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
		
		$folder = new Folder( $this->url->parentid );
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
		
		$tmp[ $this->url->objectid ] = array('id'=>$this->url->objectid,'name'=>$this->url->name,'type'=>'url','self'=>true,'children'=>&$elementChildren);
		
		// 
		//$elementChildren[$id] = array('id'=>$this->page->objectid.'_'.$id,'name'=>$name,'type'=>'pageelement','children'=>array() );
		
		//Html::debug($structure);
		
		$this->setTemplateVar('outline',$structure);
	}
}