<?php
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
namespace util;

use cms\base\DB;
use cms\generator\PageContext;
use cms\model\BaseObject;
use cms\model\Page;
use cms\model\Project;
use util\Session;


/**
 * Service-Klasse fuer allgemeine Interface-Methoden. Insbesondere
 * in Code-Elementen kann und soll auf diese Methoden zurueckgegriffen
 * werden.
 *
 * @author Jan Dankert
 */
class Macro
{
	/**
	 * @var PageContext
	 */
	protected $pageContext;

	/**
	 * @var Page
	 * @deprecated use getPage()
	 */
	protected $page;

	/**
	 * @param $pageContext PageContext
	 */
	public function setPageContext( $pageContext) {
		$this->pageContext = $pageContext;
		$this->page = new Page( $pageContext->objectId );
	}

	/**
	 * Ausführen des Makros. Diese Methode sollte durch die Unterklasse überschrieben werden.
	 */
	public function execute()
	{
		// overwrite this in subclasses
	}


	/**
	 * Holt die aktuellen Datenbankverbindung.
	 */
	protected function db()
	{
		return DB::get();
	}


	/**
	 * Holt die aktuelle Objekt-Id.
	 * @return number
	 */
	protected function getObjectId()
	{
		return $this->pageContext->objectId;
	}


	/**
	 * Holt die aktuelle Seite.
	 * @return \cms\model\Page
	 */
	protected function getPage()
	{
		$page = new Page($this->pageContext->objectId);
		$page->load();

		return $page;
	}


	/**
	 * Holt das aktuelle Objekt.
	 * @return Object
	 */
	protected function &getObject()
	{
		return new Page( $this->pageContext->objectId );
	}


	/**
	 * Ermittelt die Id des Wurzelordners im aktuellen Projekt.
	 */
	protected function getRootObjectId()
	{
		$page = new Page( $this->pageContext->objectId );
		$page->load();
		$project = $page->getProject();
;
		return $project->getRootObjectId();
	}


	/**
	 * Löscht die bisher erzeugte Ausgabe.
	 * @deprecated useless
	 */
	public function delOutput()
	{
	}

	/**
	 * Ergänzt die Standardausgabe um den gewünschten Wert.
	 * @deprecated use echo()
	 */
	public function output($text)
	{
		echo $text;
	}


	/**
	 * Ergänzt die Standardausgabe um den gewünschten Wert. Es wird ein Zeilenendezeichen ergänzt.
	 * @deprecated use echo()
	 */
	public function outputLn($text)
	{
		echo $text . "\n";
	}


	/**
	 * Setzt eine Sitzungsvariable.
	 *
	 * @param String $var
	 * @param Object $value
	 */
	public function setSessionVar($var, $value)
	{
		Session::set($var, $value);
	}


	/**
	 * Ermittelt eine Sitzungsvariable.
	 *
	 * @param String $var
	 * @return string
	 */
	public function getSessionVar($var)
	{
		return Session::get($var);
	}


	/**
	 * Ermittelt den Pfad auf ein Objekt.
	 * @param Object
	 * @return string
	 */
	public function pathToObject($targetObject)
	{
		if (is_numeric($targetObject))
			$targetObject = new BaseObject( $targetObject );

		$targetObject->load();
		$linkFormat = $this->pageContext->getLinkScheme();

		return $linkFormat->linkToObject( new Page( $this->pageContext->sourceObjectId), $targetObject );
	}

}