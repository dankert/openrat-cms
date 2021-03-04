<?php
namespace cms\action\file;
use cms\action\FileAction;
use cms\action\Method;
use cms\action\RequestParams;
use cms\generator\FileContext;
use cms\generator\FileGenerator;
use cms\model\BaseObject;
use language\Messages;
use util\exception\ValidationException;


class FileAdvancedAction extends FileAction implements Method {


    public function view() {
		// Eigenschaften der Datei uebertragen
		$this->setTemplateVar( 'extension',$this->file->extension );
		$this->setTemplateVar( 'mimetype' ,$this->getMimeType() );

		$this->setTemplateVar( 'type'     ,$this->file->type      );
		$this->setTemplateVar( 'types'    ,[
			BaseObject::TYPEID_FILE  => \cms\base\Language::lang('file' ),
			BaseObject::TYPEID_IMAGE => \cms\base\Language::lang('image'),
			BaseObject::TYPEID_TEXT  => \cms\base\Language::lang('text' )
		] );
    }


    public function post() {

        $this->file->extension = $this->request->getVar('extension'  ,RequestParams::FILTER_FILENAME);

		$typeid = $this->request->getVar('type',RequestParams::FILTER_NUMBER  );

		if   ( ! in_array($typeid,[BaseObject::TYPEID_FILE,BaseObject::TYPEID_IMAGE,BaseObject::TYPEID_TEXT]))
			throw new ValidationException('type');

        $this->file->typeid = $typeid;
        $this->file->updateType();
        $this->file->save();

		$this->addNoticeFor( $this->file, Messages::PROP_SAVED);
    }



}
