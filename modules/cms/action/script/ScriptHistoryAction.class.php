<?php
namespace cms\action\script;
use cms\action\Method;
use cms\action\ScriptAction;
use cms\action\TextAction;
use cms\model\Content;
use cms\model\Project;
use cms\model\TemplateModel;
use cms\model\Value;


class ScriptHistoryAction extends ScriptAction implements Method {

	public function view() {

		$project = new Project( $this->script->projectid );
		$values = [];

		/** @var Content */
		$content = new Content( $this->script->contentid );

		foreach( $content->getVersionList() as $valueId ) {

			$value = new Value();
			$value->loadWithId( $valueId );

			$values[] = [
				'text'       => $value->file,
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

		$this->setTemplateVar('values',$values );
	}

	public function post()
	{
	}
}
