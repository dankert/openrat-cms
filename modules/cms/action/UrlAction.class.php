<?php

namespace cms\action;

use cms\model\Url;
use language\Messages;


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
	public $security = Action::SECURITY_USER;

    /**
     * @var Url
     */
	protected $url;

	/**
	 * Konstruktor
	 */
	function __construct()
	{
        parent::__construct();

    }


    public function init()
    {
		$url = new Url( $this->getRequestId() );
		$url->load();

		$this->setBaseObject( $url );
    }

	protected function setBaseObject( $url ) {

		$this->url = $url;

		parent::setBaseObject( $url );
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
			$this->addNotice('url', 0, $this->url->name, 'DELETED');
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
            $this->addNotice('url', 0, $this->url->filename, 'DELETED', Action::NOTICE_OK);
        }
        else
        {
            $this->addNotice('url', 0, $this->url->filename, 'CANCELED', Action::NOTICE_WARN);
        }
    }


	/**
	 * Abspeichern der Eigenschaften
	 */
	public function valuePost()
	{
        $this->url->url = $this->getRequestVar('url');
        $this->url->save();

        $this->addNoticeFor( $this->url,Messages::SAVED );
	}



	public function valueView()
	{
		$this->setTemplateVars( $this->url->getProperties() );

		// Typ der Verknuepfung
		$this->setTemplateVar('type'            ,$this->url->getType()     );
		$this->setTemplateVar('url'             ,$this->url->url           );
	}


	public function editView()
	{
		$this->setTemplateVars( $this->url->getProperties() );

		// Typ der Verknuepfung
		$this->setTemplateVar('type'            ,$this->url->getType()     );
		$this->setTemplateVar('url'             ,$this->url->url           );
	}


	public function showView()
    {
        // Angabe Content-Type
        header('Content-Type: text/html' );

        header('X-Url-Id: '   .$this->url->urlid );
        header('X-Id: '       .$this->url->id    );
        header('Content-Description: '.$this->url->filename() );

        echo '<html><body>';
        echo '<h1>'.$this->url->filename.'</h1>';
        echo '<hr />';
        echo '<a href="'.$this->url->url.'">'.$this->url->url.'</a>';
        echo '</body></html>';

        exit;

    }



    /**
     * Vorschau anzeigen
     */
    function previewView()
    {
        $this->setTemplateVar('preview_url',$this->url->url );
    }


}