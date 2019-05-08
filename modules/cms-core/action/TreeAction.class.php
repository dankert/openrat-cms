<?php

namespace cms\action;

use cms\model\BaseObject;
use cms\model\Element;
use cms\model\Template;
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
	public $security = Action::SECURITY_USER;
	
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

        try
        {
            $method    = new \ReflectionMethod($tree,$type);
            if	( $this->hasRequestVar('id'))
                $method->invoke($tree, $this->getRequestVar('id') );
            else
                $method->invoke($tree); // <== Executing the Action
        }
        catch (\ReflectionException $re)
        {
            throw new \LogicException('Treemethod not found: '.$type);
        }


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


    /**
     * The path to an object.
     */
    public function pathView() {

        $type = $this->getRequestVar('type');
        $id   = $this->getRequestId();

        $result = $this->calculatePath( $type, $id );

        $this->setTemplateVar('path'  ,$result );

        $this->setTemplateVar('actual',array(
            'type'=>$this->typeToInternal($type),
            'id'=>$id)
        );
    }


    /**
     * The path to an object.
     */
    private function calculatePath($type, $id) {

        switch( $type ) {

            case 'projectlist':
                return array();

            case 'project':
                return array(
                    array('type'=>'projects','id'=>0)
                );
            case 'folder':
            case 'link'  :
            case 'url'   :
            case 'page'  :
            case 'file'  :
            case 'image' :
                $o = new BaseObject( $id );
                $o->load();

                $result= array(
                    array('type'=>'projects'  ,'id'=>0 ),
                    array('type'=>'project'   ,'id'=>$o->projectid),
                );

                $parents = array_keys( $o->parentObjectFileNames(true) );
                foreach( $parents as $pid )
                    $result[] = array('type'=>'folder'  ,'id'=>$pid );
                return $result;

            case 'pageelement' :
                $pe = new PageelementAction( $id );
                $pe->init();
                $p = $pe->page;
                $p->load();

                $result= array(
                    array('type'=>'projects'  ,'id'=>0  ),
                    array('type'=>'project'      ,'id'=>$p->projectid),
                );

                $parents = array_keys( $p->parentObjectFileNames(true ) );
                foreach( $parents as $pid )
                    $result[] = array('type'=>'folder'  ,'id'=>$pid );
                $result[] = array('type'=>'page'  ,'id'=>$id );
                return $result;

            case 'userlist':
                return array(
                    array('type'=>'userandgroups','id'=>0)
                );
            case 'user':
                return array(
                    array('type'=>'userandgroups','id'=>0),
                    array('type'=>'users'        ,'id'=>0)
                );
            case 'grouplist':
                return array(
                    array('type'=>'userandgroups','id'=>0)
                );
            case 'group':
                return array(
                    array('type'=>'userandgroups','id'=>0),
                    array('type'=>'groups'       ,'id'=>0)
                );

            case 'templatelist':
            case 'languagelist':
            case 'modellist':
                return array(
                    array('type'=>'projects','id'=>0  ),
                    array('type'=>'project'    ,'id'=>$id)
                );

            case 'template':
                $t = new Template( $id );
                $t->load();

                return array(
                    array('type'=>'projects'  ,'id'=>0  ),
                    array('type'=>'project'   ,'id'=>$t->projectid),
                    array('type'=>'templates' ,'id'=>$t->projectid)
                );

            case 'element':
                $e = new Element( $id );
                $e->load();
                $t = new Template( $e->templateid );
                $t->load();

                return array(
                    array('type'=>'projects'  ,'id'=>0  ),
                    array('type'=>'project'   ,'id'=>$t->projectid),
                    array('type'=>'templates' ,'id'=>$t->projectid),
                    array('type'=>'template'  ,'id'=>$t->templateid)
                );

            case 'language':
                $l = new Language( $id );
                $l->load();

                return array(
                    array('type'=>'projects' ,'id'=>0  ),
                    array('type'=>'project'  ,'id'=>$l->projectid),
                    array('type'=>'languages','id'=>$l->projectid)
                );

            case 'model':
                $m = new Model( $id );
                $m->load();

                return array(
                    array('type'=>'projects'  ,'id'=>0  ),
                    array('type'=>'project'   ,'id'=>$m->projectid),
                    array('type'=>'models'    ,'id'=>$m->projectid)
                );

            default:
                throw new \InvalidArgumentException('Unknown type: '.$type);
        }
    }



    private function outputTreeBranch($branch )
    {
        $json = new \JSON();
        echo '<ul class="or-navtree-list">';

        foreach( $branch as $b )
        {
            $hasChildren = isset($b['children']) && !empty($b['children']);

            echo '<li class="or-navtree-node or-navtree-node--'.($hasChildren?'is-open':'is-closed').' or-draggable" data-id="'.$b['internalId'].'" data-type="'.$b['type'].'" data-extra="'.str_replace('"',"'",$json->encode($b['extraId'])).'"><div class="or-navtree-node-control"><i class="tree-icon image-icon image-icon--node-'.($hasChildren?'open':'closed').'"></i></div><div class="clickable"><a href="./?action='.$b['type'].'&id='.$b['internalId'].'" class="entry" data-extra="'.str_replace('"',"'",$json->encode($b['extraId'])).'" data-id="'.$b['internalId'].'" data-action="'.$b['action'].'" data-type="open" title="'.$b['description'].'"><i class="image-icon image-icon--action-'.$b['icon'].'" ></i> '.$b['text'].'</a></div>';

            if   ($hasChildren)
            {
                $this->outputTreeBranch($b['children']);
            }

            echo '</li>';
        }

        echo '</ul>';
    }

    private function typeToInternal($type)
    {
        switch( $type) {

            case 'userlist':
                return 'users';

            case 'grouplist':
                return 'groups';

            case 'templatelist':
                return 'templates';

            case 'languagelist':
                return 'languages';

            case 'modellist':
                return 'models';

            default:
                return $type;
        }

    }


}

?>