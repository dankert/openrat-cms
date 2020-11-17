<?php
namespace cms\action\file;
use cms\action\Action;
use cms\action\FileAction;
use cms\action\Method;


class FileRemoveAction extends FileAction implements Method {
    public function view() {
        $this->setTemplateVar( 'name',$this->file->filename );
    }
    public function post() {
        if   ( $this->getRequestVar('delete') != '' )
        {
            $this->file->delete();
            $this->addNotice('template', 0, $this->file->filename, 'DELETED', Action::NOTICE_OK);
        }
        else
        {
            $this->addNotice('template', 0, $this->file->filename, 'CANCELED', Action::NOTICE_WARN);
        }
    }
}
