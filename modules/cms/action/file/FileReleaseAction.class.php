<?php
namespace cms\action\file;
use cms\action\ContentAction;
use cms\action\FileAction;
use cms\action\Method;
use cms\action\PageelementAction;
use cms\model\Content;
use cms\model\Permission;
use cms\model\Value;
use language\Messages;
use LogicException;
use util\exception\SecurityException;

class FileReleaseAction extends FileAction implements Method {

	public function getRequiredPermission()
	{
		return Permission::ACL_RELEASE;
	}

	public function view() {
    }

    public function post() {

		$content = new Content( $this->file->contentid );
		$versionList = $content->getVersionList();

		$value = new Value();
		$value->valueid = $this->request->getRequiredNumber('valueid');

		if   ( ! in_array( $value->valueid, $versionList ))
			throw new SecurityException( 'value-id is not contained in the version list of this file' );

		$value->loadWithId( $value->valueid );

		// Inhalt wieder herstellen, in dem er neu gespeichert wird.
		$value->valueid = null;
		$value->publish = true;
		$value->persist();

		$this->addNoticeFor( $this->file,Messages::PAGEELEMENT_RELEASED );
    }
}
