<?php
namespace cms\action\modellist;
use cms\action\Method;
use cms\action\ModellistAction;
use cms\model\Model;

class ModellistAddAction extends ModellistAction implements Method {
    public function view() {
    }


    public function post() {
		$model = new Model();
		$model->projectid = $this->getRequestVar('projectid');
		$model->name      = $this->getRequestVar('name');
		$model->persist();
		
		// Wenn kein Namen eingegeben, dann einen setzen.
		if	( empty($model->name) )
		{
			// Name ist "Variante <id>"
			$model->name = \cms\base\Language::lang('MODEL').' '.$model->modelid;
			$model->save();
		}
    }
}
