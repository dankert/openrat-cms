<?php
namespace cms\action\file;
use cms\action\Action;
use cms\action\FileAction;
use cms\action\Method;
use cms\action\PageelementAction;
use cms\model\Content;
use cms\model\Element;
use cms\model\Permission;
use cms\model\Value;
use language\Messages;
use util\exception\SecurityException;

class FileRestoreAction extends FileAction implements Method {

	public function getRequiredPermission()
	{
		return Permission::ACL_WRITE;
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
        $value->publish = false;
        $value->persist();

		$this->addNoticeFor( $this->file,Messages::PAGEELEMENT_USE_FROM_ARCHIVE );
    }
}
