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
		$model->projectid = $this->request->getId();
		$model->name      = $this->request->getText('name');

		$model->persist();

		// if no name is given
		if	( ! $model->name )
		{
			// name is "model <id>"
			$model->name = \cms\base\Language::lang('MODEL').' '.$model->modelid;
			$model->persist();
		}

	}
}
