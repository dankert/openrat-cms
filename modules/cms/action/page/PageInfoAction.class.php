<?php
namespace cms\action\page;
use cms\action\Method;
use cms\action\object\ObjectInfoAction;
use cms\action\PageAction;
use cms\generator\PageContext;
use cms\generator\PageGenerator;
use cms\generator\Producer;
use cms\generator\Publisher;
use cms\model\Template;

class PageInfoAction extends PageAction implements Method {
    public function view() {
		$this->setTemplateVar('id',$this->page->objectid);

		$parentAction = new ObjectInfoAction();
		$parentAction->request = $this->request;
		$parentAction->init();
		$parentAction->view();

		$this->page->load();

		$this->setTemplateVars( $this->page->getProperties() );

        $alias = $this->page->getAliasForLanguage(null);
        $this->setTemplateVar( 'alias', $alias->full_filename() );

        $languages = $this->page->getProject()->getLanguages();
		$models    = $this->page->getProject()->getModels();
        $languagesVars = array();

        foreach( $languages as $id => $name )
        {
            $this->page->languageid = $id;
            $this->page->load();

            $languagesVar = $this->page->getProperties();
            $languagesVar['languagename'] = $name;
            $languagesVar['languageid'  ] = $id;
            $alias = $this->page->getAliasForLanguage( $id );
            $languagesVar['alias'       ] = $alias->full_filename();

            $languagesVars[] = $languagesVar;
        }

        $this->setTemplateVar('languages',$languagesVars );

        $filenames = [];
        foreach( $languages as $languageid=>$language )
        	foreach( $models as $modelid=>$model ) {
        		$pagecontext = new PageContext( $this->page->objectid,Producer::SCHEME_PUBLIC );
        		$pagecontext->languageId = $languageid;
				$pagecontext->modelId    = $modelid;

				$pageGenerator = new PageGenerator( $pagecontext );
				$filenames[] = $pageGenerator->getPublicFilename();
			}

		$this->setTemplateVar('filenames',$filenames );
		$this->setTemplateVar('is_valid' ,$this->page->isValid() );


		if   ( $this->userIsProjectAdmin() )
		{
			$this->setTemplateVar('templateid',$this->page->templateid);
		}

		$template = new Template( $this->page->templateid );
		$template->load();
		$this->setTemplateVar('template_name',$template->name );

		$generator = new PageGenerator( $this->createPageContext( Producer::SCHEME_PUBLIC) );

		$this->setTemplateVar('tmp_filename' ,$generator->getPublicFilename() );
    }
    public function post() {
    }
}
