<?php
namespace cms\action\template;
use cms\action\Method;
use cms\action\TemplateAction;
use cms\model\Project;
use util\Html;


class TemplateListingAction extends TemplateAction implements Method {

    public function view() {
		$list = array();

        $project = new Project( $this->template->projectid );

		foreach( $project->getTemplates() as $id=>$name )
		{
			$list[$id] = array();
			$list[$id]['name'] = $name;
			$list[$id]['url' ] = Html::url('template','el',$id,array());
		}
		
//		$var['templatemodelid'] = htmlentities( $id   );
//		$var['text']            = htmlentities( $text );
		$this->setTemplateVar('templates',$list);
    }
    public function post() {
    }
}
