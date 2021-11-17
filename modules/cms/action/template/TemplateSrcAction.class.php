<?php
namespace cms\action\template;
use cms\action\Action;
use cms\action\Method;
use cms\action\RequestParams;
use cms\action\TemplateAction;
use cms\model\Element;
use cms\model\Project;
use cms\model\TemplateModel;
use language\Messages;


class TemplateSrcAction extends TemplateAction implements Method {
    public function view() {
	    $project = new Project( $this->template->projectid );
	    $modelId = $this->request->getModelId();

	    $modelSrc = array();

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

		$this->setTemplateVar( 'modelid',$modelId );
        $this->setTemplateVar( 'source' ,$text    );
        $this->setTemplateVar( 'extension',$templatemodel->extension );
    }


    public function post() {
        $modelId = $this->request->getModelId();

        $templatemodel = new TemplateModel($this->template->templateid, $modelId);
        $templatemodel->load();

        $newSource = $this->request->getRaw('source');

        /*
        // Not useful any more. Technical name of a element should not be changed.
        foreach ($this->template->getElementNames() as $elid => $elname) {
            $newSource = str_replace('{{' . $elname . '}}', '{{' . $elid . '}}', $newSource);
            $newSource = str_replace('{{->' . $elname . '}}', '{{->' . $elid . '}}', $newSource);
            $newSource = str_replace('{{' . \cms\base\Language::lang('TEMPLATE_SRC_IFEMPTY') . ':' . $elname . ':' . \cms\base\Language::lang('TEMPLATE_SRC_BEGIN') . '}}', '{{IFEMPTY:' . $elid . ':BEGIN}}', $newSource);
            $newSource = str_replace('{{' . \cms\base\Language::lang('TEMPLATE_SRC_IFEMPTY') . ':' . $elname . ':' . \cms\base\Language::lang('TEMPLATE_SRC_END') . '}}', '{{IFEMPTY:' . $elid . ':END}}', $newSource);
            $newSource = str_replace('{{' . \cms\base\Language::lang('TEMPLATE_SRC_IFNOTEMPTY') . ':' . $elname . ':' . \cms\base\Language::lang('TEMPLATE_SRC_BEGIN') . '}}', '{{IFNOTEMPTY:' . $elid . ':BEGIN}}', $newSource);
            $newSource = str_replace('{{' . \cms\base\Language::lang('TEMPLATE_SRC_IFNOTEMPTY') . ':' . $elname . ':' . \cms\base\Language::lang('TEMPLATE_SRC_END') . '}}', '{{IFNOTEMPTY:' . $elid . ':END}}', $newSource);
        }
        */

		$templatemodel->src = $newSource;
		$templatemodel->extension = $this->request->getText('extension');
		$templatemodel->persist();

		$this->addNoticeFor($this->template,Messages::SAVED);
    }
}
