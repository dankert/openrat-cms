<?php
namespace cms\action\page;
use cms\action\Method;
use cms\action\PageAction;
use cms\model\Project;
use cms\model\Template;
use util\Html;

class PageChangetemplateAction extends PageAction implements Method {
    public function view() {
		$this->page->load();


        $this->setTemplateVars( $this->page->getProperties() );

		if   ( $this->userIsAdmin() )
		{
			$this->setTemplateVar('template_url',Html::url('template','show',$this->page->templateid));
		}

		$template = new Template( $this->page->templateid );
		$template->load();
		$this->setTemplateVar('template_name',$template->name);

		$templates = Array();
        $project = new Project( $this->page->projectid );
		foreach( $project->getTemplates() as $id=>$name )
		{
			if	( $id != $this->page->templateid )
				$templates[$id]=$name;
		}
		$this->setTemplateVar('templates',$templates);
    }

    public function post() {
    }
}
