<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// OpenRat Content Management System
// Copyright (C) 2002-2004 Jan Dankert, cms@jandankert.de
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
// Revision 1.3  2004-11-28 23:55:49  dankert
// Ausgabe performanter
//
// Revision 1.2  2004/05/02 14:49:37  dankert
// Einf?gen package-name (@package)
//
// Revision 1.1  2004/04/24 15:14:52  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------

/**
 * Action-Klasse fuer die Suchfunktion
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */

class SearchAction extends Action
{
	/**
	 * Falls keine Unteraktion ausgew?hlt wurde wird diese genommen
	 * @type String
	 */
	var $defaultSubAction = 'prop';


	/**
	 * leerer Kontruktor
	 */
	function SearchAction()
	{
	}


	/**
	 * Durchf?hren der Suche
	 * und Anzeige der Ergebnisse
	 */
	function search()
	{
		global $conf_php;

		$listObjectIds   = array();
		$listTemplateIds = array();
		
		switch( $this->getRequestVar('searchtype') )
		{
			case 'prop':
			
				switch( $this->getRequestVar('type') )
				{
					case 'id':
						$o = new Object();
						if	( $o->isObjectId($this->getRequestVar('id')) )
							$listObjectIds[] = $this->getRequestVar('id');
						break;

					case 'filename':
						$o = new Object();
						$listObjectIds = $o->getObjectIdsByFilename( $this->getRequestVar('filename') );
						break;

					case 'name':
						$o = new Object();
						$listObjectIds = $o->getObjectIdsByName( $this->getRequestVar('name') );
						break;

					case 'desc':
						$o = new Object();
						$listObjectIds = $o->getObjectIdsByDescription( $this->getRequestVar('desc') );
						break;

					case 'create_user':
						$o = new Object();
						$listObjectIds = $o->getObjectIdsByCreateUserId( $this->getRequestVar('create_userid') );
						break;

					case 'lastchange_user':
						$o = new Object();
						$listObjectIds = $o->getObjectIdsByLastChangeUserId( $this->getRequestVar('lastchange_userid') );
						break;

					case 'extension':
						$f = new File();
						$listObjectIds = $f->getObjectIdsByExtension( $this->getRequestVar('extension') );
						break;
				}
	
				break;


			case 'content':

				switch( $this->getRequestVar('type') )
				{
					case 'value':
						$e = new Value();
						$listObjectIds = $e->getObjectIdsByValue( $this->getRequestVar('text') );

						$template = new Template();
						$listTemplateIds = $template->getTemplateIdsByValue( $this->getRequestVar('text') );
						break;

					case 'lastchange_user':
						$e = new Value();
						$listObjectIds = $e->getObjectIdsByLastChangeUserId( $this->getRequestVar('lastchange_userid') );
						break;
				}
				break;


			default:
				// Fallback:
				// Dialog "Suche nach Eigenschaft" anzeigen.
				$this->callSubAction( 'prop' );
				exit;
		}



		$resultList = array();

		foreach( $listObjectIds as $objectid )
		{
			$o = new Object( $objectid );
			$o->load();
			$resultList[$objectid] = array();
			$resultList[$objectid]['url']  = Html::url(array('action'=>'main','subaction'=>$o->getType(),'objectid'=>$objectid));
			$resultList[$objectid]['type'] = $o->getType();
			$resultList[$objectid]['name'] = $o->name;

			if	( $o->desc != '' )
				$resultList[$objectid]['desc'] = $o->desc;
			else
				$resultList[$objectid]['desc'] = lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');
		}

		foreach( $listTemplateIds as $templateid )
		{
			$t = new Template( $templateid );
			$t->load();
			$resultList['t'.$templateid] = array();
			$resultList['t'.$templateid]['url' ]  = Html::url(array('action'=>'main','subaction'=>'template','templateid'=>$templateid));
			$resultList['t'.$templateid]['type'] = 'tpl';
			$resultList['t'.$templateid]['name'] = $t->name;
			$resultList['t'.$templateid]['desc'] = lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');
		}

		$this->setTemplateVar( 'result',$resultList );

		$this->forward( 'search_result' );
	}
	
	
	function prop()
	{
		$this->setTemplateVar( 'users',User::listAll() );
		$this->forward( 'search_prop' );
	}
	function content()
	{
		$this->setTemplateVar( 'users',User::listAll() );
		$this->forward( 'search_content' );
	}
	function template()
	{
		$this->forward( 'search_template' );
	}
}

?>