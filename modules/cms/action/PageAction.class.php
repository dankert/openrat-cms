<?php

namespace cms\action;

use cms\base\Configuration;
use cms\generator\PageContext;
use cms\generator\PageGenerator;
use cms\generator\Producer;
use cms\generator\Publisher;
use cms\generator\PublishOrder;
use cms\model\Permission;
use cms\model\BaseObject;
use cms\model\Element;
use cms\model\Folder;
use cms\model\Language;
use cms\model\Page;
use cms\model\Project;
use cms\model\Template;
use cms\model\Value;
use configuration\Config;
use logger\Logger;
use util\Html;
use util\Session;


/**
 * Action-Klasse zum Bearbeiten einer Seite
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */

class PageAction extends ObjectAction
{
	public $security = Action::SECURITY_USER;

    /**
     * @var Page
     */
	protected $page;


	function __construct()
	{
	    parent::__construct();

    }


    public function init()
    {
        $page = new Page( $this->request->getId() );
        //$context = new PageContext();
        //$context->sourceObjectId = $page->objectid;

//		if  ( $this->request->hasLanguageId())
//			$context->languageId = $this->request->getLanguageId();
//
//		if  ( $this->request->hasModelId())
//			$context->modelId = $this->request->getModelId();

		$page->load();
//
//        if  ( !$context->languageId )
//			$context->languageId = $page->getProject()->getDefaultLanguageId();
//
//        if  ( !$context->modelId )
//			$context->modelId = $page->getProject()->getDefaultModelId();

//        $page->languageid = $context->languageId;
//        $page->modelid    = $context->modelId
//        $page->context = $context;

		// Hier kann leider nicht das Datum der letzten Änderung verwendet werden,
		// da sich die Seite auch danach ändern kann, z.B. durch Includes anderer
		// Seiten oder Änderung einer Vorlage oder Änderung des Dateinamens einer
		// verlinkten Datei.
		$this->lastModified( time() );

		$this->setBaseObject($page);
    }



	protected function setBaseObject($folder ) {

		$this->page = $folder;

		parent::setBaseObject( $folder );
	}



    protected function setModelAndLanguage()
    {
        $this->setTemplateVar('languages' ,$this->page->getProject()->getLanguages());
        $this->setTemplateVar('languageid',$this->page->getProject()->getDefaultLanguageId() );

        $this->setTemplateVar('models'    ,$this->page->getProject()->getModels()   );
        $this->setTemplateVar('modelid'   ,$this->page->getProject()->getDefaultModelId() );
    }



    protected function createPageContext( $scheme ) {

		$context = new PageContext( $this->page->objectid,$scheme );
		$context->sourceObjectId = $this->page->objectid;

		if  ( $this->request->hasLanguageId())
			$context->languageId = $this->request->getLanguageId();

		if  ( $this->request->hasModelId())
			$context->modelId = $this->request->getModelId();

        if  ( !$context->languageId )
			$context->languageId = $this->page->getProject()->getDefaultLanguageId();

        if  ( !$context->modelId )
			$context->modelId = $this->page->getProject()->getDefaultModelId();

        return $context;
	}

}
