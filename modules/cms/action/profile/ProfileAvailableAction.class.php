<?php
namespace cms\action\profile;
use cms\action\Action;
use cms\action\Method;
use cms\action\ProfileAction;
use util\ClassName;

class ProfileAvailableAction extends ProfileAction implements Method {

	public $security = Action::SECURITY_GUEST; // Available for all

    public function view() {

		$action = $this->request->getText('queryaction');

		$viewMethods = array_filter( [
			// All UI-related methods (reachable via dropdown menus)
			'pub',
			'info',
			'prop',
			'history',
			'rights',
			'add',
			'pw',
			'memberships',
			'advanced',
			'switch',
			'changetemplate',
			'src',
			'size',
			'settings',
			'archive',
			'rights',
			'remove',
			'preview',
			'order'
			],
			function ($methodName) use ($action) {

				// Filter existent methods
				while( true ) {
					$actionClassName = new ClassName( ucfirst($action) . ucfirst($methodName) . 'Action');
					$actionClassName->addNamespace( ['cms','action',$action] );

					if ( $actionClassName->exists() )
						return true;

					$baseActionClassName = new ClassName( ucfirst($action) . 'Action' );
					$baseActionClassName->addNamespace( ['cms','action'] );

					if ( ! $baseActionClassName->exists() )
						return false;

					if   ( ! $baseActionClassName->getParent()->exists() )
						return false;

					$action = strtolower( $baseActionClassName->dropNamespace()->dropSuffix('Action')->get() );
				}
			});

		$this->setTemplateVar('views', $viewMethods);
    }


    public function post() {
    }
}
