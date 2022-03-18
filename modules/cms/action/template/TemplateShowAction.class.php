<?php
namespace cms\action\template;
use cms\action\Method;
use cms\action\RequestParams;
use cms\action\TemplateAction;
use cms\generator\Producer;
use cms\generator\TemplateGenerator;
use cms\model\Element;
use cms\model\Project;
use cms\model\TemplateModel;


class TemplateShowAction extends TemplateAction implements Method {

    public function view() {

		$tplGenerator = new TemplateGenerator( $this->template->templateid, $this->request->getModelId(), Producer::SCHEME_PREVIEW );

		$this->addHeader('Content-Type',$tplGenerator->getMimeType().'; charset=UTF-8' );

		// Template should have access to the page properties.
		// Template should have access to the settings of this node object.
		$data = [];
		$data['_page'         ] = [];
		$data['_localsettings'] = [];
		$data['_settings'     ] = [];

		/** @var Element $element */
		foreach($this->template->getElements() as $element ) {

			$element->load();
			$data[ $element->name ] = $element->getDefaultValue();
		}

		$this->setTemplateVar('value',$tplGenerator->generateValue( $data ) );
    }
}
