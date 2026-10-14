<?php
namespace cms\action\template;
use cms\action\Method;
use cms\action\TemplateAction;
use cms\action\UiOutClass;
use cms\api\Model;
use cms\api\Template;
use cms\model\Element;
use cms\model\Project;
use cms\model\TemplateModel;


class TemplateEditAction extends TemplateAction implements Method {

	#[UiOutClass(Template::class)]
    public function view() {
		$apiTemplate = new Template(
			$this->template->getId(),
			array(),
			array(),
		);

		// Elemente laden
		foreach( $this->template->getElementIds() as $elid )
		{
			$element = new Element( $elid );
			$element->load();

			$apiTemplate->elements[] = new \cms\api\Element(
				$elid,
				$element->getName(),
				$element->label,
				$element->desc,
				$element->getTypeName(),
				$element->typeid );

			unset( $element );
		}

		
        $project = new Project( $this->template->projectid );

        foreach( $project->getModels() as $modelId => $modelName )
        {
            $templateModel = new TemplateModel( $this->template->templateid, $modelId );
            $templateModel->load();

			$apiTemplate->templateModels[] = new \cms\api\TemplateModel(
				$modelId,
				$modelName,
				$templateModel->getSource(),
				$templateModel->format
			);
        }

		return $apiTemplate;


    }
    public function post() {
    }
}
