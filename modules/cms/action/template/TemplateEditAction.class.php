<?php
namespace cms\action\template;
use cms\action\Method;
use cms\action\TemplateAction;
use cms\api\Model;
use cms\api\Template;
use cms\model\Element;
use cms\model\Project;
use cms\model\TemplateModel;


class TemplateEditAction extends TemplateAction implements Method {
    public function view() {
		// Elemente laden
		$list = array();
		$apiTemplate = new Template();
	
		foreach( $this->template->getElementIds() as $elid )
		{
			$element = new Element( $elid );
			$element->load();

			$apiElement = new \cms\api\Element();
			$apiElement->id = $elid;
			$apiElement->name = $element->getName();
			$apiElement->description = $element->desc;
			$apiElement->type = $element->getTypeName();
			$apiElement->typeid = $element->typeid;
			$apiTemplate->elements[] = $apiElement;

			$list[$elid] = array();
			$list[$elid]['id'         ] = $elid;
			$list[$elid]['name'       ] = $element->name;
			$list[$elid]['description'] = $element->desc;
			$list[$elid]['type'       ] = $element->getTypeName();
			$list[$elid]['typeid'     ] = $element->typeid;

			unset( $element );
		}
		#$this->setTemplateVar('elements',$list);
		
		
        $project = new Project( $this->template->projectid );


        $models = array();

        foreach( $project->getModels() as $modelId => $modelName )
        {
            $templateModel = new TemplateModel( $this->template->templateid, $modelId );
            $templateModel->load();

			$apiTemplateModel = new \cms\api\TemplateModel();
			$apiTemplateModel->id = $modelId;
			$apiTemplateModel->name = $modelName;
			$apiTemplateModel->source = $templateModel->getSource();
			$apiTemplateModel->format = $templateModel->format;
			$apiTemplate->templateModels[] = $apiTemplateModel;

            $models[ $modelId ] = array(
                'name'    => $modelName,
                'source'  => $templateModel->getSource(),
                'format'  => $templateModel->format,
                'modelid' => $modelId
            );
        }

        #$this->setTemplateVar( 'models',$models );
		return $apiTemplate;


    }
    public function post() {
    }
}
