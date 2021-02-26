<?php
namespace cms\action\folder;
use cms\action\FolderAction;
use cms\action\Method;
use language\Messages;


class FolderRemoveAction extends FolderAction implements Method {

	public function view() {
        $this->setTemplateVar( 'name',$this->folder->filename );
        $this->setTemplateVar( 'hasChildren', $this->folder->hasChildren() );
    }


    public function post() {
        if  ( $this->request->has( 'withChildren'))
            $this->folder->deleteAll();  // Delete with children
        else
            if   ( $this->folder->hasChildren() )
                throw new \util\exception\ValidationException("withChildren",Messages::CONTAINS_CHILDREN);
            else
                $this->folder->delete();  // Only delete current folder.

        $this->addNoticeFor($this->folder, Messages::DELETED);
    }
}
