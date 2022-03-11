<?php
namespace cms\action\template;
use cms\action\Action;
use cms\action\Method;
use cms\action\RequestParams;
use cms\action\TemplateAction;
use cms\model\Element;
use cms\model\Project;
use cms\model\Template;
use language\Messages;


class TemplateAddAction extends TemplateAddelAction {
    public function view() {

		$this->request->redirectActionAndMethod('template','addel');
		parent::view();
    }


    public function post() {

		$this->request->redirectActionAndMethod('template','addel');
		parent::post();
    }
}
