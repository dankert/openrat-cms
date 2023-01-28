<?php
namespace cms\action\template;
use cms\action\Action;
use cms\action\Method;
use cms\action\RequestParams;
use cms\action\TemplateAction;
use cms\model\Element;
use cms\model\Project;
use cms\model\TemplateModel;
use language\Messages;


class TemplateSrcAction extends TemplateAction implements Method {
    public function view() {
	    $modelId = $this->request->getModelId();

        $templateModel = new TemplateModel( $this->template->templateid, $modelId );
        $templateModel->load();

		$this->setTemplateVar( 'modelid'  ,$modelId                    );
        $this->setTemplateVar( 'source'   ,$templateModel->getSource() );
        $this->setTemplateVar( 'extension',$templateModel->extension   );
        $this->setTemplateVar( 'format'   ,$templateModel->getFormat() );
    }


	/**
	 * Saving template source.
	 */
    public function post() {
        $modelId = $this->request->getModelId();

        $templatemodel = new TemplateModel($this->template->templateid, $modelId);
        $templatemodel->load();

        $newSource = $this->request->getRaw('source');

		$templatemodel->src = $newSource;
		$templatemodel->extension = $this->request->getText('extension');
		$templatemodel->public    = $this->request->isTrue('release');
		$templatemodel->format    = $this->request->getNumber('format');
		$templatemodel->persist();

		$this->addNoticeFor($this->template,Messages::SAVED);
    }
}
