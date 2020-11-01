<?php


namespace cms\action;

/**
 */
class BaseAction extends Action
{

	public function __construct()
	{
		parent::__construct();
	}


	/**
	 * Gets all available View-Methods in this Action.
	 */
	public function availableView()
	{
		$viewMethods = array_map( function($methodName){
			// Removing the 'View' from the end of the method name
			return substr($methodName,0,strlen($methodName)-4);
		}, array_filter(get_class_methods($this), function ($methodName) {
			// Filter only View methods
			return substr($methodName, -4, 4) == 'View';
		}));

		$this->setTemplateVar('views', $viewMethods);
	}
}