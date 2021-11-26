<?php
namespace cms\action\image;
use cms\action\ImageAction;
use cms\action\Method;
use cms\model\Content;
use cms\model\Project;
use cms\model\Value;


class ImageHistoryAction extends ImageAction implements Method {

	public function view() {

		$project = new Project( $this->image->projectid );
		$values = [];

		/** @var Content */
		$content = new Content( $this->image->contentid );

		foreach( $content->getVersionList() as $valueId ) {

			$value = new Value();
			$value->loadWithId( $valueId );

			$values[] = [
				'text'       => '',
				'active'     => $value->active,
				'publish'    => $value->publish,
				'user'       => $value->lastchangeUserName,
				'date'       => $value->lastchangeTimeStamp,
				'id'         => $value->getId(),
				'usable'     => ! $value->active,
				'releasable' => $value->active && ! $value->publish,
				'comparable' => false,
			];
		}

		$this->setTemplateVar('values',$values );
	}

	public function post()
	{
	}
}
