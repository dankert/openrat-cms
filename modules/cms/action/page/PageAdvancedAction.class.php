<?php
namespace cms\action\page;
use cms\action\Method;
use cms\action\object\ObjectInfoAction;
use cms\action\PageAction;
use cms\generator\PageGenerator;
use cms\generator\Producer;
use cms\model\Permission;
use cms\model\Template;

class PageAdvancedAction extends PageAction implements Method {
    public function view() {

		$parentAction = new ObjectInfoAction();
		$parentAction->request = $this->request;
		$parentAction->init();
		$parentAction->view();

		$this->page->load();

		$this->setTemplateVars( $this->page->getProperties() );

        if   ( $this->userIsProjectAdmin() )
		{
			$this->setTemplateVar('templateid',$this->page->templateid);
		}

		$template = new Template( $this->page->templateid );
		$template->load();
		$this->setTemplateVar('template_name',$template->name );
    }
    public function post() {
    }

	public function getRequiredPermission()
	{
		return Permission::ACL_READ;
	}

}
