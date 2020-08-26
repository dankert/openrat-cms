<?php

namespace cms\action;

use cms\model\BaseObject;
use cms\model\Folder;
use cms\model\Link;


use util\Html;
use util\Session;

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
	public $security = Action::SECURITY_USER;

    /**
     * @var Link
     */
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
		$link = new Link( $this->getRequestId() );
		$link->load();

		$this->setBaseObject( $link );
	}


	protected function setBaseObject( $link ) {

		$this->link = $link;

		parent::setBaseObject( $link );
	}



	/**
	 * Abspeichern der Eigenschaften
	 */
	function editPost()
	{
        $this->link->linkedObjectId = $this->getRequestVar('targetobjectid');
        $this->link->save();

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




	
    public function removeView()
    {
        $this->setTemplateVar( 'name',$this->link->filename );
    }


    public function removePost()
    {
        if ($this->getRequestVar('delete') != '') {
            $this->link->delete();
            $this->addNotice('link', $this->link->filename, 'DELETED', OR_NOTICE_OK);
        } else {
            $this->addNotice('link', $this->link->filename, 'CANCELED', OR_NOTICE_WARN);
        }
    }


    public function showView()
    {
        header('Content-Type: text/html' );

        header('X-Link-Id: ' .$this->link->linkid );
        header('X-Id: '      .$this->link->id     );
        header('Content-Description: '.$this->link->filename() );

        echo '<html><body>';
        echo '<h1>'.$this->link->filename.'</h1>';
        echo '<hr />';

        try {
            $o = new BaseObject( $this->link->linkedObjectId );
            $o->load();
            echo '<a href="'.Html::url($o->getType(),'show',$o->objectid).'">'.$o->filename.'</a>';
        }
        catch( \ObjectNotFoundException $e ) {
            echo '-';
        }

        echo '</body></html>';

        exit;
    }

}
