<?php
namespace cms\action\tag;
use cms\action\Method;
use cms\action\TagAction;
use language\Messages;

/**
 * Deleting the tag.
 */
class TagRemoveAction extends TagAction implements Method {

    public function view() {

		$this->setTemplateVar( 'name',$this->tag->name );
    }


	/**
	 * Delete the tag.
	 *
	 * @return void
	 */
    public function post() {

		$this->tag->delete();

		$this->addNoticeFor( $this->tag,Messages::DELETED);
    }
}
