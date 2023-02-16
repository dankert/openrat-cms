<?php
namespace cms\action\object;
use cms\action\Method;
use cms\action\ObjectAction;
use cms\model\BaseObject;
use cms\model\Permission;
use cms\model\Tag;
use util\ArrayUtils;

class ObjectTagAction extends ObjectAction implements Method {

    public function view() {

		$this->setTemplateVars( $this->baseObject->getProperties() );

		$myTags  = $this->baseObject->getTags();
		$allTags = $this->baseObject->getProject()->getTags();

		$allTags = ArrayUtils::mapToNewArray( $allTags, function($id,$name) use ($myTags) {
			$this->setTemplateVar('tag'.$id,array_key_exists($id,$myTags) );
			return[ 'tag'.$id => $name ];
		} );

		$this->setTemplateVar('tags',$allTags );
	}


    public function post() {

		$allTags = $this->baseObject->getProject()->getTags();
		$myTags  = $this->baseObject->getTags();

		foreach ( $allTags as $tagId => $tagName ) {
			if   ( $this->request->isTrue('tag'.$tagId) ) {
				if   ( ! array_key_exists( $tagId,$myTags ) ) {
					$tag = new Tag( $tagId );
					$tag->addObject( $this->baseObject->objectid );
				}
			} else {
				if   ( array_key_exists( $tagId,$myTags ) ) {
					$tag = new Tag( $tagId );
					$tag->removeObject( $this->baseObject->objectid );
				}
			}

		}

		$newTags = $this->request->getText('new');
		$newTags = explode(',',$newTags);
		foreach ( $newTags as $newTag ) {

			if   ( ! $newTag )
				continue; // refuse empty tags

			if   ( in_array($newTag,$allTags) ) {
				// the requested tag is already in the project
				if   ( in_array($newTag,$myTags) ) {
					// the requested tag is already bound to this object, so nothing to do here.
				}else {
					$id = array_search($newTag,$allTags);
					$tag = new Tag($id);
					$tag->addObject( $this->baseObject->objectid );
				}
			}else{
				// a new tag will be created
				$tag = new Tag();
				$tag->projectid = $this->baseObject->projectid;
				$tag->name = $newTag;
				$tag->persist();

				$tag->addObject( $this->baseObject->objectid );
			}
		}
    }
}
