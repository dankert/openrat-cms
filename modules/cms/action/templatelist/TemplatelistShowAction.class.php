<?php
namespace cms\action\templatelist;
use cms\action\Method;
use cms\action\TemplatelistAction;

class TemplatelistShowAction extends TemplatelistAction implements Method {
    public function view() {
		$list = array();

		foreach( $this->project->getTemplates() as $id=>$name )
		{
			$list[$id] = array();
			$list[$id]['name'] = $name;
			$list[$id]['id'  ] = $id;
		}
		
		$this->setTemplateVar('templates',$list);
    }


    public function post() {
    }
}
