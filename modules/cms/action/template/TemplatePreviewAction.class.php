<?php
namespace cms\action\template;
use cms\action\Method;
use cms\action\RequestParams;
use cms\action\TemplateAction;
use cms\model\Project;
use util\Html;


class TemplatePreviewAction extends TemplateAction implements Method {

    public function view() {
	    $project = new Project( $this->template->projectid);

        $this->setTemplateVar('models',$project->getModels() );

		$modelId = $this->request->getModelId();
		if   ( ! $modelId )
			$modelId = Project::create( $this->template->projectid )->getDefaultModelId();

        $this->setTemplateVar('modelid'   ,$modelId);

		$this->setTemplateVar('preview_url',Html::url('template','show',$this->template->templateid,array('target'=>'none','modelid'=>$modelId ) ) );
    }
    public function post() {
    }
}
