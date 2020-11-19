<?php
namespace cms\action\modellist;
use cms\action\Method;
use cms\action\ModellistAction;
use cms\model\Model;
use cms\model\Project;
use util\Html;

class ModellistEditAction extends ModellistAction implements Method {

	public function view() {
		$project = new Project( $this->project->projectid );

		$list = array();
		foreach( $project->getModelIds() as $id )
		{
			$m = new Model( $id );
			$m->load();

			$list[$id]['id'  ] = $id;
			$list[$id]['name'] = $m->name;

			$list[$id]['is_default'] = $m->isDefault;
			$list[$id]['select_url'] = Html::url('index','model',$id);
		}
		$this->setTemplateVar( 'el',$list );
		$this->setTemplateVar( 'add',$this->userIsAdmin() );
	}

    public function post() {
    }
}
