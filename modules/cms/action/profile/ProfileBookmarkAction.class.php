<?php
namespace cms\action\profile;
use cms\action\Method;
use cms\action\ProfileAction;
use cms\model\BaseObject;
use cms\model\Bookmark;

class ProfileBookmarkAction extends ProfileAction implements Method {
    public function view() {

		$bookmarkedObjects = array_map( function( $objectId ) {
			// Map the objectid to the object properties
			$o = new BaseObject( $objectId );
			$o->load();
			return $o->getProperties();
		}, Bookmark::getBookmarkedObjectIdsForUser( $this->user->getId() ) );

	    $this->setTemplateVar( 'bookmarks',$bookmarkedObjects );
    }


	/**
	 * Nothing...
	 *
	 * @return void
	 */
    public function post() {

    }
}
