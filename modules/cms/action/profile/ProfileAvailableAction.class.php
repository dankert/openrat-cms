<?php
namespace cms\action\profile;
use cms\action\Action;
use cms\action\BaseAction;
use cms\action\Method;
use cms\action\ProfileAction;
use logger\Logger;
use util\ClassName;
use util\exception\SecurityException;

class ProfileAvailableAction extends ProfileAction implements Method {

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

					Logger::trace("Trying ".$actionClassName->getName() );
					if ( $actionClassName->exists() ) {
						$n = $actionClassName->getName();
						/**
						 * @var BaseAction
						 */
						$actionMethod = new $n();
						$actionMethod->request = $this->request;
						try {
							$actionMethod->init();
							$actionMethod->checkAccess();
						} catch( SecurityException $e ) {
							Logger::trace("Not allowed to call ".$n);
							return false; // do not throw anything here.
						}
						return true;
					}

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


	public function checkAccess() {
		return true;
	}
}
