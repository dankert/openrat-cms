<?php
namespace cms\action\tag;
use cms\action\Method;
use cms\action\ProjectAction;
use cms\action\RequestParams;
use cms\action\TagAction;
use cms\model\Folder;
use language\Messages;

class TagPropAction extends TagAction implements Method {

    public function view() {
		$this->setTemplateVar( 'name', $this->tag->name );

    }

    public function post() {

		$this->tag->name = $this->request->getRequiredText('name' );
		$this->tag->persist();
    }
}
