<?php
namespace cms\action\file;
use cms\action\FileAction;
use cms\action\Method;
use cms\action\RequestParams;
use cms\generator\FileContext;
use cms\generator\FileGenerator;
use cms\model\BaseObject;
use cms\model\Permission;
use language\Messages;
use util\exception\ValidationException;


class FileAdvancedAction extends FileAction implements Method {


    public function view() {
		// Eigenschaften der Datei uebertragen
		$this->setTemplateVar( 'extension',$this->file->extension );
		$this->setTemplateVar( 'mimetype' ,$this->getMimeType() );

		$this->setTemplateVar( 'type'     ,$this->file->type      );
		$this->setTemplateVar( 'types'    ,[
			BaseObject::TYPEID_FILE  => \cms\base\Language::lang('file'  ),
			BaseObject::TYPEID_IMAGE => \cms\base\Language::lang('image' ),
			BaseObject::TYPEID_TEXT  => \cms\base\Language::lang('text'  ),
			BaseObject::TYPEID_SCRIPT=> \cms\base\Language::lang('script')
		] );
    }


    public function post() {

        $this->file->extension = $this->request->getFilename('extension');

		$typeid = $this->request->getNumber('type' );

		if   ( ! in_array($typeid,[BaseObject::TYPEID_FILE,BaseObject::TYPEID_IMAGE,BaseObject::TYPEID_TEXT]))
			throw new ValidationException('type');

        $this->file->typeid = $typeid;
        $this->file->updateType();
        $this->file->save();

		$this->addNoticeFor( $this->file, Messages::PROP_SAVED);
    }


	public function getRequiredPermission()
	{
		return Permission::ACL_PROP;
	}
}
