<?php
namespace cms\action\text;
use cms\action\Method;
use cms\action\TextAction;
use cms\model\Content;
use cms\model\Project;
use cms\model\TemplateModel;
use cms\model\Value;


class TextHistoryAction extends TextAction implements Method {

	public function view() {

		$project = new Project( $this->text->projectid );
		$values = [];

		/** @var Content */
		$content = new Content( $this->text->contentid );

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
