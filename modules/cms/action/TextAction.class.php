<?php


namespace cms\action;

use cms\model\BaseObject;

use cms\model\Text;
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
 * Action-Klasse zum Bearbeiten einer Datei
 * @author Jan Dankert
 */
class TextAction extends FileAction
{
	public $security = Action::SECURITY_USER;

	private $text;

	/**
	 * Konstruktor
	 */
	function __construct()
	{
		parent::__construct();
	}


	public function init()
	{

		$text = new Text($this->getRequestId());
		$text->load();

		$this->setBaseObject( $text );
	}



	protected function setBaseObject( $text ) {

		$this->text = $text;

		parent::setBaseObject( $text );
	}


	public function valuePost()
	{
		$this->text->value = $this->getRequestVar('value', RequestParams::FILTER_RAW);
		$this->text->saveValue();

		$this->addNotice($this->text->getType(), 0, $this->text->name, 'VALUE_SAVED', 'ok');
		$this->text->setTimestamp();
	}


	/**
	 * Only needed because there is a special template for text nodes.
	 */
	public function valueView()
	{
		parent::valueView();
	}


	/**
	 * Only needed because there is a special template for text nodes.
	 */
	public function showView() {

		parent::showView();
	}

	/**
	 * Only needed because there is a special template for text nodes.
	 */
	public function previewView()
	{
		parent::previewView();
	}
}
