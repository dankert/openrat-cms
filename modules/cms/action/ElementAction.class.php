<?php

namespace cms\action;


use cms\base\Configuration;
use cms\model\BaseObject;
use cms\model\Element;
use cms\model\Folder;
use cms\model\Permission;
use cms\model\Project;
use cms\model\Template;
use ReflectionClass;
use ReflectionProperty;
use util\exception\SecurityException;
use util\Text;


/**
 * Action-Klasse fuer die Bearbeitung eines Template-Elementes.
 * 
 * @author Jan Dankert
 */
class ElementAction extends BaseAction
{
    /**
     * @var Element
     */
	protected $element;

    private $template;

    /**
	 * Konstruktor
	 */
	function __construct()
	{
        parent::__construct();

    }


    public function init()
    {
        if	( $this->request->getId() == 0 )
			throw new \util\exception\ValidationException('no element-id available');

		$this->element = new Element( $this->request->getId() );
		$this->element->load();

		$this->setTemplateVar( 'elementid' ,$this->element->elementid   );
	}


	/**
	 * User must be an project administrator.
	 */
	public function checkAccess() {
		$template     = new Template( $this->element->templateid );
		$template->load();
		$project      = new Project( $template->projectid );
		$rootFolderId = $project->getRootObjectId();

		$rootFolder = new Folder( $rootFolderId );
		$rootFolder->load();

		if   ( ! $rootFolder->hasRight( Permission::ACL_PROP )  )
			throw new SecurityException();
	}

}

