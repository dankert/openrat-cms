<?php
namespace cms\action\template;
use cms\action\Method;
use cms\action\TemplateAction;
use cms\model\Element;
use cms\model\Project;
use cms\model\TemplateModel;


class TemplateEditAction extends TemplateAction implements Method {
    public function view() {
		// Elemente laden
		$list = array();
	
		foreach( $this->template->getElementIds() as $elid )
		{
			$element = new Element( $elid );
			$element->load();

			$list[$elid] = array();
			$list[$elid]['id'         ] = $elid;
			$list[$elid]['name'       ] = $element->name;
			$list[$elid]['description'] = $element->desc;
			$list[$elid]['type'       ] = $element->getTypeName();
			$list[$elid]['typeid'     ] = $element->typeid;

			unset( $element );
		}
		$this->setTemplateVar('elements',$list);	
		
		
        $project = new Project( $this->template->projectid );


        $models = array();

        foreach( $project->getModels() as $modelId => $modelName )
        {
            $templatemodel = new TemplateModel( $this->template->templateid, $modelId );
            $templatemodel->load();

            $text = $templatemodel->src;

            foreach( $this->template->getElementIds() as $elid )
            {
                $element = new Element( $elid );
                $element->load();

                // Fix old stuff:
                $text = str_replace('{{'.$elid.'}}',
                    '{{'.$element->name.'}}',
                    $text );
                $text = str_replace('{{->'.$elid.'}}',
                    '{{goto.'.$element->name.'}}',
                    $text );
                $text = str_replace('{{IFEMPTY:'.$elid.':BEGIN}}',
                    '{{^'.$element->name.'}}',
                    $text );
                $text = str_replace('{{IFEMPTY:'.$elid.':END}}',
                    '{{/'.$element->name.'}}',
                    $text );
                $text = str_replace('{{IFNOTEMPTY:'.$elid.':BEGIN}}',
                    '{{#'.$element->name.'}}',
                    $text );
                $text = str_replace('{{IFNOTEMPTY:'.$elid.':END}}',
                    '{{/'.$element->name.'}}',
                    $text );
            }

            $models[ $modelId ] = array(
                'name'    => $modelName,
                'source'  => $text,
                'modelid' => $modelId
            );
        }

        $this->setTemplateVar( 'models',$models );


    }
    public function post() {
    }
}
