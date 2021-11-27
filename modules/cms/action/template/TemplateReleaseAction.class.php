<?php
namespace cms\action\template;
use cms\action\ContentAction;
use cms\action\Method;
use cms\action\PageelementAction;
use cms\action\TemplateAction;
use cms\model\Permission;
use cms\model\Value;
use language\Messages;
use LogicException;
use util\exception\SecurityException;

class TemplateReleaseAction extends TemplateAction implements Method {


    public function view() {
    }


    public function post() {

		$valueId = $this->request->getRequiredNumber('valueid');

		$this->ensureValueIdIsInAnyTemplate( $valueId );

		$value = new Value();
		$value->valueid = $valueId;
		$value->loadWithId( $value->valueid );

		// Publish value.
		$value->valueid = null;
		$value->publish = true;
		$value->persist();

        $this->addNoticeFor($this->template, Messages::PAGEELEMENT_RELEASED );
    }
}
