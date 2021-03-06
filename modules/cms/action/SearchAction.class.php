<?php

namespace cms\action;

use cms\base\Configuration as C;
use cms\model\Permission;
use cms\model\BaseObject;
use cms\model\File;
use cms\model\Project;
use cms\model\Template;
use cms\model\User;
use cms\model\Value;
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
 * Action-Klasse fuer die Suchfunktion.
 * 
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */
class SearchAction extends BaseAction
{
	const FLAG_ID          =  1;
	const FLAG_NAME        =  2;
	const FLAG_FILENAME    =  4;
	const FLAG_DESCRIPTION =  8;
	const FLAG_VALUE       = 16;

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
	 * Query the search
	 *
	 * @param $searchText string search query text
	 * @param $searchFlag int field selector
	 */
	protected function performSearch($searchText, $searchFlag)
	{
		$listObjectIds   = array();
		$listTemplateIds = array();
	
        $resultList = array();


        if	( $searchFlag & self::FLAG_ID )
        {
            if   ( BaseObject::available( intval($searchText) ) )
                $listObjectIds[] = intval( $searchText );

            if  ( $this->userIsAdmin() ) {

                $user = new User( intval($searchText) );

                try {
                    $user->load();

                    $userResult = array( 'url'  => '',
                        'type' => 'user',
                        'id' => $user->userid,
                        'name' => $user->name,
                        'desc' => $user->desc,
                        'lastchange_date' => 0 );
                    $resultList[] = $userResult;
                }
                catch( \util\exception\ObjectNotFoundException $e) {
                    ; // userid is unknown
                }
            }
        }

        if	( $searchFlag & self::FLAG_NAME )
        {
            if  ( $this->userIsAdmin() ) {

                $user = User::loadWithName($searchText,User::AUTH_TYPE_INTERNAL);
                if (is_object($user)) {
                    $userResult = array('url' => '',
                        'type' => 'user',
                        'id' => $user->userid,
                        'name' => $user->name,
                        'desc' => $user->desc,
                        'lastchange_date' => 0);
                    $resultList[] = $userResult;
                }
            }

            $listObjectIds += BaseObject::getObjectIdsByName( $searchText );
        }

        if	( $searchFlag & self::FLAG_DESCRIPTION )
        {
            $listObjectIds += BaseObject::getObjectIdsByDescription( $searchText );
        }

        if	( $searchFlag & self::FLAG_FILENAME )
        {
            $listObjectIds += BaseObject::getObjectIdsByFilename( $searchText );

            $listObjectIds += File::getObjectIdsByExtension( $searchText );
        }

        // Inhalte durchsuchen
        if	( $searchFlag & self::FLAG_VALUE )
        {
            $e = new Value();
            $listObjectIds += $e->getObjectIdsByValue( $searchText );

            $listTemplateIds += Template::getTemplateIdsByValue( $searchText );
        }

        $resultList = array_merge( $resultList, $this->explainResult( $listObjectIds, $listTemplateIds ) );

        $this->setTemplateVar( 'result',$resultList );
    }
	
	
	/**
	 *
	 */
	private function explainResult( $listObjectIds, $listTemplateIds )
	{
		$resultList = array();
	
		foreach( $listObjectIds as $objectid )
		{
			$o = new BaseObject( $objectid );
			$o->load();
            if ($o->hasRight( Permission::ACL_READ ))
                $resultList[] = array(
                    'id'              => $objectid,
                    'type'            => $o->getType(),
                    'name'            => $o->name,
                    'lastchange_date' => $o->lastchangeDate,
                    'desc'            => $o->desc
                );
		}
	
		foreach( $listTemplateIds as $templateid )
		{
			$t = new Template( $templateid );
			$t->load();
			$p = new Project( $t->projectid );
			$o = new BaseObject( $p->getRootObjectId() );
			if ($o->hasRight( Permission::ACL_READ ))
                $resultList[] = array(
                    'id'  => $templateid,
                    'type'=> 'template',
                    'name'=> $t->name,
                    'desc'=> '',
                    'lastchange_date'=> 0
                );
		}
	
		return $resultList;
	}


	public function checkAccess() {
		return true;
	}
}