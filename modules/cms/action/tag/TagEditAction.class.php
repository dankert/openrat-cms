<?php
namespace cms\action\tag;
use cms\action\Action;
use cms\action\Method;
use cms\action\ProjectAction;
use cms\action\TagAction;
use cms\model\Folder;
use cms\model\Permission;
use util\exception\SecurityException;

class TagEditAction extends TagAction implements Method {

    public function view() {

		$this->setTemplateVar('name',$this->tag->name);

		$this->setTemplateVar('objects',array_map(
			function($baseObject) {
				// convert baseObject to array
				return $baseObject->getProperties() + get_object_vars( $baseObject->getDefaultName() );
			},$this->tag->getObjects()
		) );

	}
}
