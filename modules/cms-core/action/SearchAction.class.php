<?php

namespace cms\action;

use cms\model\User;
use cms\model\Value;
use cms\model\Template;
use cms\model\Object;
use cms\model\File;



use Session;
use \Html;



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


define('SEARCH_FLAG_ID'         , 1);
define('SEARCH_FLAG_NAME'       , 2);
define('SEARCH_FLAG_FILENAME'   , 4);
define('SEARCH_FLAG_DESCRIPTION', 8);
define('SEARCH_FLAG_VALUE'      ,16);


/**
 * Action-Klasse fuer die Suchfunktion.
 * 
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */
class SearchAction extends Action
{
	public $security = SECURITY_USER;

	
	/**
	 * leerer Kontruktor
	 */
	function __construct()
	{
        parent::__construct();
	}


	
	public function editView()
	{
		$user = Session::getUser();
		$this->setTemplateVar( 'users'     ,User::listAll() );
		$this->setTemplateVar( 'act_userid',$user->userid   );
	}
	
	/**
	 * Durchf?hren der Suche
	 * und Anzeige der Ergebnisse
	 */
	public function resultView()
	{
		$suchText    = $this->getRequestVar('text');
		$searchFlags = 0;
		
		if	( $this->hasRequestVar('id'         ) ) $searchFlags |= SEARCH_FLAG_ID;
		if	( $this->hasRequestVar('filename'   ) ) $searchFlags |= SEARCH_FLAG_FILENAME;
		if	( $this->hasRequestVar('name'       ) ) $searchFlags |= SEARCH_FLAG_NAME;
		if	( $this->hasRequestVar('description') ) $searchFlags |= SEARCH_FLAG_DESCRIPTION;
		if	( $this->hasRequestVar('content'    ) ) $searchFlags |= SEARCH_FLAG_VALUE;
			
		$this->performSearch($suchText, $searchFlags);

				/*
			case 'lastchange_user':
				$e = new Value();
				
				$language = Session::getProjectLanguage();
				$e->languageid = $language->languageid;
				
				$listObjectIds = $e->getObjectIdsByLastChangeUserId( $this->getRequestVar('userid') );
				break;
		}*/
	}
	
	
	
	/**
	 * Durchf?hren der Suche
	 * und Anzeige der Ergebnisse
	 */
	public function quicksearchView()
	{
		global $conf;

		$text = $this->getRequestVar('search');
		
		$flag        = $conf['search']['quicksearch']['flag'];
		$searchFlags = 0;
		if	( $flag['id'         ] ) $searchFlags |= SEARCH_FLAG_ID; 
		if	( $flag['name'       ] ) $searchFlags |= SEARCH_FLAG_NAME; 
		if	( $flag['filename'   ] ) $searchFlags |= SEARCH_FLAG_FILENAME; 
		if	( $flag['description'] ) $searchFlags |= SEARCH_FLAG_DESCRIPTION; 
		if	( $flag['content'    ] ) $searchFlags |= SEARCH_FLAG_VALUE;
		 
		$this->performSearch($text, $searchFlags);
	}
	
	
	
	/**
	 * Durchf?hren der Suche
	 * und Anzeige der Ergebnisse
	 */
	private function performSearch( $text, $flag)
	{
		global $conf;
	
		$listObjectIds   = array();
		$listTemplateIds = array();
	
		$project = Session::getProject();
		if	( is_object($project) && $project->projectid == -1 )
		{
			$resultList = array();
				
			$user = User::loadWithName($text);
			if	( is_object($user) )
			{
				$userResult = array( 'url'  => Html::url('template','',$templateid),
						'type' => 'user',
						'name' => $user->name,
						'desc' => lang('NO_DESCRIPTION_AVAILABLE'),
						'lastchange_date' => 0 );
			}
			$resultList[] = $userResult;
				
			$this->setTemplateVar( 'result',$resultList );
		}
		else
		{
			if	( $flag & SEARCH_FLAG_ID && Object::available( intval($text) ) )
				$listObjectIds[] = intval( $text );
	
			if	( $flag & SEARCH_FLAG_NAME )
			{
				$o = new Object();
				$listObjectIds += $o->getObjectIdsByName( $text );
			}
	
			if	( $flag & SEARCH_FLAG_DESCRIPTION )
			{
				$o = new Object();
				$listObjectIds += $o->getObjectIdsByDescription( $text );
			}
	
			if	( $flag & SEARCH_FLAG_FILENAME )
			{
				$o = new Object();
				$listObjectIds += $o->getObjectIdsByFilename( $text );
	
				$f = new File();
				$listObjectIds += $f->getObjectIdsByExtension( $text );
			}
				
			// Inhalte durchsuchen
			if	( $flag & SEARCH_FLAG_VALUE )
			{
				$e = new Value();
				$listObjectIds += $e->getObjectIdsByValue( $text );
	
				$template = new Template();
				$listTemplateIds += $template->getTemplateIdsByValue( $text );
			}
				
			$this->explainResult( $listObjectIds, $listTemplateIds );
		}
	
	}
	
	
	/**
	 *
	 */
	private function explainResult( $listObjectIds, $listTemplateIds )
	{
		$resultList = array();
	
		foreach( $listObjectIds as $objectid )
		{
			$o = new Object( $objectid );
			$o->load();
			$resultList[$objectid] = array();
			$resultList[$objectid]['id'  ] = $objectid;
			$resultList[$objectid]['url' ] = Html::url($o->getType(),'',$objectid);
			$resultList[$objectid]['type'] = $o->getType();
			$resultList[$objectid]['name'] = $o->name;
			$resultList[$objectid]['lastchange_date'] = $o->lastchangeDate;
	
			if	( $o->desc != '' )
				$resultList[$objectid]['desc'] = $o->desc;
			else
				$resultList[$objectid]['desc'] = lang('NO_DESCRIPTION_AVAILABLE');
		}
	
		foreach( $listTemplateIds as $templateid )
		{
			$t = new Template( $templateid );
			$t->load();
			$resultList['t'.$templateid] = array();
			$resultList['t'.$templateid]['id'  ] = $templateid;
			$resultList['t'.$templateid]['url' ] = Html::url('template','',$templateid);
			$resultList['t'.$templateid]['type'] = 'template';
			$resultList['t'.$templateid]['name'] = $t->name;
			$resultList['t'.$templateid]['desc'] = lang('NO_DESCRIPTION_AVAILABLE');
			$resultList['t'.$templateid]['lastchange_date'] = 0;
		}
	
		$this->setTemplateVar( 'result',$resultList );
	}
	
}

?>