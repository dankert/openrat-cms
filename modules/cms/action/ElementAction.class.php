<?php

namespace cms\action;


use cms\base\Configuration;
use cms\model\BaseObject;
use cms\model\Element;
use cms\model\Folder;
use cms\model\Project;
use cms\model\Template;
use ReflectionClass;
use ReflectionProperty;
use util\Text;


/**
 * Action-Klasse fuer die Bearbeitung eines Template-Elementes.
 * 
 * @author Jan Dankert
 */
class ElementAction extends BaseAction
{
	public $security = Action::SECURITY_USER;

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
}

