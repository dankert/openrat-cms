<?php
namespace cms\action\template;
use cms\action\Method;
use cms\action\TemplateAction;
use cms\model\Project;
use cms\model\TemplateModel;
use language\Messages;


class TemplateExtensionAction extends TemplateAction implements Method {
    public function view() {
    }
    public function post() {
        $project = new Project( $this->template->projectid );
        $models = $project->getModels();

        $extensions = array();
        foreach( $models as $modelId => $modelName ) {

            $input = $this->getRequestVar( $modelName );

            // Validierung: Werte dürfen nicht doppelt vorkommen.
            if ( in_array($input, $extensions) )
            {
				$this->addErrorFor($this->template,Messages::DUPLICATE_INPUT);
                throw new \util\exception\ValidationException( $modelName );
            }

            $extensions[ $modelId ] = $input;
        }

        foreach( $models as $modelId => $modelName ) {

            $templatemodel = new TemplateModel($this->template->templateid, $modelId);
            $templatemodel->load();

            $templatemodel->extension = $extensions[ $modelId ];

            $templatemodel->persist();
        }

		$this->addNoticeFor($this->template,Messages::SAVED);
    }
}
