<?php
namespace cms\action\template;
use cms\action\Method;
use cms\action\TemplateAction;
use cms\model\Content;
use cms\model\Element;
use cms\model\Page;
use cms\model\PageContent;
use cms\model\Project;
use cms\model\TemplateModel;
use cms\model\Value;


class TemplateHistoryAction extends TemplateAction implements Method {

	public function view() {

		$project = new Project( $this->template->projectid );
		$models = array();

		foreach( $project->getModels() as $modelId => $modelName )
		{
			$templatemodel = new TemplateModel( $this->template->templateid, $modelId );
			$templatemodel->load();

			$model = [
				'id'     => $modelId,
				'name'   => $modelName,
				'values' => [],
			];

			/** @var Content */
			$content = new Content( $templatemodel->getContentid() );

			foreach($content->getVersionList() as $valueId) {

				$value = new Value();
				$value->loadWithId( $valueId );

				$model['values'][] = [
					'text'       => $value->text,
					'active'     => $value->active,
					'publish'    => $value->publish,
					'user'       => $value->lastchangeUserName,
					'date'       => $value->lastchangeTimeStamp,
					'id'         => $value->getId(),
					'usable'     => ! $value->active,
					'releasable' => $value->active && ! $value->publish,
					'comparable' => true,
				];
			}

			$models[ $modelId ] = $model;
		}

		$this->setTemplateVar('models',$models );
	}

	public function post() {
    }
}
