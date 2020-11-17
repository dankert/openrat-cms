<?php

namespace cms\action;

namespace cms\action;
use cms\generator\PublishPublic;
use cms\model\Acl;
use cms\model\Element;
use cms\model\Page;
use cms\model\Project;
use cms\model\Template;
use cms\model\TemplateModel;
use language\Messages;
use util\exception\ValidationException;
use util\Html;
use util\Session;


// OpenRat Content Management System
// Copyright (C) 2002-2009 Jan Dankert
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
 * Action-Klasse zum Bearbeiten einer Seitenvorlage.
 * 
 * @author Jan Dankert
 * @package openrat.actions
 */

class TemplateAction extends BaseAction
{
	public $security = Action::SECURITY_USER;
	
    /**
     * @var Template
     */
	protected $template;
	private $element;


	function __construct()
	{
        parent::__construct();

    }


    public function init()
    {
		$this->template = new Template( $this->getRequestId() );

		$this->template->load();

		$this->setTemplateVar( 'templateid',$this->template->templateid );

		if	( intval($this->getRequestVar('elementid')) != 0 )
		{
			$this->element = new Element( $this->getRequestVar('elementid') );
			$this->element->load();
			$this->setTemplateVar( 'elementid',$this->element->elementid );
		}
	}

}