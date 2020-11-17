<?php
namespace cms\action\base;
use cms\action\BaseAction;
use cms\action\Method;
use cms\ui\action\TitleAction;
use util\ClassName;

class TitleAvailableAction extends TitleAction implements Method {
    public function view() {

    	$action = $this->getRequestVar('queryaction');

		$viewMethods = array_filter( ['pub','prop','history','rights','add','pw','memberships','advanced','changeto','changetemplate','src','size','maintanance','settings','archive','rights','delete','preview'],
			function ($methodName) use ($action) {
			// Filter existent methods
			$className = new ClassName( ucfirst($action).ucfirst($methodName).'Action');
			$className->addNamespace( ['cms']['action'][$action]);

			return $className->exists();
		});

		$this->setTemplateVar('views', $viewMethods);
    }

    public function post() {
    }
}
