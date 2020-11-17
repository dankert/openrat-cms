<?php
namespace cms\action\template;
use cms\action\Method;
use cms\action\RequestParams;
use cms\action\TemplateAction;
use cms\model\Element;
use cms\model\Project;
use cms\model\TemplateModel;


class TemplateShowAction extends TemplateAction implements Method {
    public function view() {
		$modelId = $this->request->getRequestVar(RequestParams::PARAM_MODEL_ID);
		if   ( ! $modelId )
			$modelId = Project::create( $this->template->projectid )->getDefaultModelId();

		$templatemodel = new TemplateModel($this->template->templateid, $modelId);
		$templatemodel->load();

		header('Content-Type: '.$templatemodel->mimeType().'; charset=UTF-8' );
		$text = $templatemodel->src;
	
		foreach( $this->template->getElementIds() as $elid )
		{
			$element = new Element( $elid );
			$element->load();

			$text = str_replace('{{'.$elid.'}}',$element->name,
			                    $text );
			$text = str_replace('{{->'.$elid.'}}','',
			                    $text );

			$text = str_replace('{{IFEMPTY:'.$elid.':BEGIN}}','',
			                    $text );
			$text = str_replace('{{IFEMPTY:'.$elid.':END}}','',
			                    $text );

			$text = str_replace('{{IFNOTEMPTY:'.$elid.':BEGIN}}','',
			                    $text );
			$text = str_replace('{{IFNOTEMPTY:'.$elid.':END}}','',
			                    $text );
			                    
			unset( $element );
		}
	
		$this->setTemplateVar('text',$text);
    }


    public function post() {
    }
}
