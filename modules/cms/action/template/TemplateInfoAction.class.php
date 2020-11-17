<?php
namespace cms\action\template;
use cms\action\Method;
use cms\action\TemplateAction;
use cms\model\Page;


class TemplateInfoAction extends TemplateAction implements Method {
    public function view() {
		$pages = array();
		$pageids = $this->template->getDependentObjectIds();
		
		foreach( $pageids as $pageid )
		{
			$page = new Page($pageid);
			$page->load();

			$pages[$pageid] = $page->filename;
		}
		
		$this->setTemplateVar('pages',$pages);
		$this->setTemplateVar('id'   ,$this->template->getId()   );
		$this->setTemplateVar('name' ,$this->template->getName() );
    }
    public function post() {
    }
}
