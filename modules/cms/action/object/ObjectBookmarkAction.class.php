<?php
namespace cms\action\object;
use cms\action\Method;
use cms\action\ObjectAction;
use cms\model\Bookmark;
use language\Messages;

class ObjectBookmarkAction extends ObjectAction implements Method {

    public function view() {

		$bookmark = new Bookmark();
		$bookmark->objectId = $this->baseObject->getId();
		$bookmark->userId   = $this->currentUser->getId();
		$bookmark->load();

		$this->setTemplateVar( 'bookmark',$bookmark->isPersistent() );
	}


    public function post() {

		$bookmark = new Bookmark();
		$bookmark->objectId = $this->baseObject->getId();
		$bookmark->userId   = $this->currentUser->getId();
		$bookmark->load();

		if   ( $this->request->getRequiredNumber("bookmark") )  {
			// Save the bookmark
			$bookmark->persist();
			$this->addNoticeFor( $bookmark, Messages::SAVED);
		}
		else
			// Delete it if it exists
			if   ( $bookmark->isPersistent() ) {

				$bookmark->delete();
				$this->addNoticeFor( $bookmark, Messages::DELETED);
			}

	}
}
