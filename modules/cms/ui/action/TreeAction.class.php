<?php

namespace cms\ui\action;

use cms\action\Action;
use cms\action\BaseAction;
use cms\model\BaseObject;
use cms\model\Element;
use cms\model\Folder;
use cms\model\Group;
use cms\model\ModelFactory;
use cms\model\Page;
use cms\model\Project;
use cms\model\Template;
use cms\model\User;
use cms\model\Value;
use util\json\JSON;
use util\Tree;
use cms\model\Language;
use cms\model\Model;

use util\Session;

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

class TreeAction extends BaseAction
{
	public $security = Action::SECURITY_GUEST;
	
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

        exit; // no template available.

    }


    /**
     * The path to an object.
     */
    public function pathView() {

        $type = $this->getRequestVar('type');
        $id   = $this->getRequestVar('id',OR_FILTER_ALPHANUM);

        $result = $this->calculatePath( $type, $id );
        $this->setTemplateVar('path'  ,$result );

        $name = $this->calculateName($type, $id);
        $this->setTemplateVar('actual',$this->pathItem($type,$id,$name) );
    }


    /**
     * The path to an object.
     */
    private function calculatePath($type, $id) {

        switch( $type ) {

            case 'projectlist':
                return array();

            case 'configuration':
                return array();

            case 'project':
                return array(
                    $this->pathItem('projectlist',0)
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
                    $this->pathItem('projectlist' ),
                    $this->pathItem('project'   , $o->projectid),
                );

                $parents = array_keys( $o->parentObjectFileNames(true) );
                foreach( $parents as $pid )
                {
                    $f = new Folder($pid);
                    $f->load();
                    $result[] = $this->pathItem('folder'  ,$pid,$f->filename );
                }
                return $result;

            case 'pageelement' :

                $ids = explode('_',$id);
                if	( count($ids) > 1 )
                {
                    list( $pageid, $elementid ) = $ids;
                }

                $p = new Page($pageid);
                $p->load();

                $result= array(
                    $this->pathItem('projectlist' ),
                    $this->pathItem('project'   , $p->projectid),
                );

                $parents = array_keys( $p->parentObjectFileNames(true ) );
                foreach( $parents as $pid ) {
                    $f = new Folder($pid);
                    $f->load();
                    $result[] = $this->pathItem('folder'  ,$pid,$f->filename );
                }
                $result[] = $this->pathItem('page'  ,$id,$p->filename );
                return $result;

            case 'userlist':
            case 'usergroup':
                return array(
                    //$this->pathItem('usergroup' ,0)
                );
            case 'user':
                return array(
                    //$this->pathItem('userandgroups',0),
                    $this->pathItem('userlist',0)
                );
            case 'grouplist':
                return array(
                    //array('type'=>'userandgroups','action'=>'userandgroups','id'=>0)
                );
            case 'group':
                return array(
                    //$this->pathItem('userandgroups',0),
                    $this->pathItem('grouplist'    ,0)
                );

            case 'templatelist':
            case 'languagelist':
            case 'modellist':
                return array(
                    $this->pathItem('projectlist' ,0  ),
                    $this->pathItem('project'     ,$id)
                );

            case 'template':
                $t = new Template( $id );
                $t->load();

                return array(
                    $this->pathItem('projectlist' ,0        ),
                    $this->pathItem('project'     ,$t->projectid),
                    $this->pathItem('templatelist',$t->projectid)
                );

            case 'element':
                $e = new Element( $id );
                $e->load();
                $t = new Template( $e->templateid );
                $t->load();

                return array(
                    $this->pathItem('projectlist' ,0         ),
                    $this->pathItem('project'     ,$t->projectid ),
                    $this->pathItem('templatelist',$t->projectid ),
                    $this->pathItem('template'    ,$t->templateid,$t->name)
                );

            case 'language':
                $l = new Language( $id );
                $l->load();

                return array(
                    $this->pathItem('projectlist' ,0  ),
                    $this->pathItem('project'     ,$l->projectid),
                    $this->pathItem('languagelist',$l->projectid)
                );

            case 'model':
                $m = new Model( $id );
                $m->load();

                return array(
                    $this->pathItem('projectlist' ,0        ),
                    $this->pathItem('project'     ,$m->projectid),
                    $this->pathItem('modellist'   ,$m->projectid)
                );

            default:
                throw new \InvalidArgumentException('Unknown type: '.$type);
        }
    }



    private function outputTreeBranch($branch )
    {
        $json = new JSON();
        echo '<ul class="or-navtree-list">';

        foreach( $branch as $b )
        {
            $hasChildren = isset($b['children']) && !empty($b['children']);

            echo '<li class="or-navtree-node or-navtree-node--'.($hasChildren?'is-open':'is-closed').' or-draggable" data-id="'.$b['internalId'].'" data-type="'.$b['type'].'" data-extra="'.str_replace('"',"'",$json->encode($b['extraId'])).'"><div class="or-navtree-node-control"><i class="tree-icon image-icon image-icon--node-'.($hasChildren?'open':'closed').'"></i></div><div class="clickable"><a href="./#/'.$b['type'].($b['internalId']?'/'.$b['internalId']:'').'" class="entry" data-extra="'.str_replace('"',"'",$json->encode($b['extraId'])).'" data-id="'.$b['internalId'].'" data-action="'.$b['action'].'" data-type="open" title="'.$b['description'].'"><i class="image-icon image-icon--action-'.$b['icon'].'" ></i> '.$b['text'].'</a></div>';

            if   ($hasChildren)
            {
                $this->outputTreeBranch($b['children']);
            }

            echo '</li>';
        }

        echo '</ul>';
    }


    private function pathItem( $action, $id = 0, $name = '' ) {
        return array('type'=>$this->typeToInternal($action),'action'=>$action ,'id'=>$id,'name'=>$name  );
    }


    private function typeToInternal($type)
    {
        switch( $type) {

            case 'projectlist':
                return 'projects';

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

    /**
     * @param $type
     * @param $id
     * @return string
     */
    protected function calculateName($type, $id)
    {
        $name = '';
        $o = ModelFactory::create($type, $id);

        if ($o) {
            $o->load();
            $name = $o->getName();
        }
        return $name;
    }


}
