<?php
namespace cms\action\project;
use cms\action\Method;
use cms\action\ProjectAction;
use cms\model\Project;
use util\Html;

class ProjectListingAction extends ProjectAction implements Method {
    public function view() {
		// Projekte ermitteln
		$list = array();

		foreach(Project::getAllProjects() as $id=> $name )
		{
			$list[$id]             = array();
			$list[$id]['url'     ] = Html::url('project','edit',$id);
			$list[$id]['use_url' ] = Html::url('tree'   ,'load',0  ,array('projectid'=>$id,'target'=>'tree'));
			$list[$id]['name'    ] = $name;
		}
		$this->setTemplateVar('el',$list);
    }
    public function post() {
    }
}
