<?php

namespace cms\action;

use Tree;
use cms\model\Language;
use cms\model\Model;

use Session;

// OpenRat Content Management System
// Copyright (C) 2002 Jan Dankert, jandankert@jandankert.de
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
 * Action-Klasse zum Laden/Anzeigen des Navigations-Baumes
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */

class TreeAction extends Action
{
	public $security = SECURITY_USER;
	
	public function __construct()
    {
        parent::__construct();
    }

	/**
	 * Anzeigen des Baumes fuer asynchrone Anfragen.
	 */
	public function loadBranchView()
	{

        $type = $this->getRequestVar('type');

        $branch = $this->loadTreeBranch( $type );

		$this->setTemplateVar( 'branch',$branch ); 
	}



	private function loadTreeBranch( $type )
    {
        $tree = new Tree();

        if	( intval($this->getRequestVar('id')) != 0 )
            $tree->$type( $this->getRequestId() );
        else
            $tree->$type();

        $branch = array();
        foreach($tree->treeElements as $element )
        {
            $branch[] = get_object_vars($element);
        }

        return $branch;
    }


    /**
     * Initialer Aufbau des Navigationsbaums.
     */
	public function treeView()
    {
        $branch = $this->loadTreeBranch( 'root' );

        foreach( $branch as $k=>$b )
        {
            if   ( !empty($b['type']) )
                $branch[$k]['children'] = $this->loadTreeBranch( $b['type'] );
            else
                $branch[$k]['children'] = array();
        }

        $this->outputTreeBranch( $branch );

        //$this->setTemplateVar( 'branch',$branch );

    }



    private function outputTreeBranch($branch )
    {
        $json = new \JSON();
        echo '<ul class="tree">';

        foreach( $branch as $b )
        {
            echo '<li class="object" data-id="'.$b['internalId'].'" data-type="'.$b['type'].'"><div class="tree"><div class="arrow"></div></div><a href="./?action='.$b['action'].'&id='.$b['internalId'].'" class="entry" data-extra="'.str_replace('"',"'",$json->encode($b['extraId'])).'" data-id="'.$b['internalId'].'" data-type="'.$b['type'].'" title="'.$b['description'].'"><img src="modules/cms-ui/themes/default/images/icon_'.$b['icon'].'.png" />'.$b['text'].'</a>';

            if   ( isset($b['children']) && !empty($b['children']) )
            {
                $this->outputTreeBranch($b['children']);
            }

            echo '</li>';
        }

        echo '</ul>';
    }

}

?>