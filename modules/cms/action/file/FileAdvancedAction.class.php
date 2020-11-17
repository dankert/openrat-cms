<?php
namespace cms\action\file;
use cms\action\FileAction;
use cms\action\Method;
use cms\action\RequestParams;
use cms\model\BaseObject;
use util\exception\ValidationException;


class FileAdvancedAction extends FileAction implements Method {


    public function view() {
		// Eigenschaften der Datei uebertragen
		$this->setTemplateVar( 'extension',$this->file->extension );
		$this->setTemplateVar( 'type'     ,$this->file->type      );
		$this->setTemplateVar( 'types'    ,[
			BaseObject::TYPEID_FILE  => \cms\base\Language::lang('file' ),
			BaseObject::TYPEID_IMAGE => \cms\base\Language::lang('image'),
			BaseObject::TYPEID_TEXT  => \cms\base\Language::lang('text' )
		] );
    }


    public function post() {

        $this->file->extension = $this->getRequestVar('extension'  ,RequestParams::FILTER_FILENAME);

		$typeid = $this->getRequestVar('type',RequestParams::FILTER_NUMBER  );

		if   ( ! in_array($typeid,[BaseObject::TYPEID_FILE,BaseObject::TYPEID_IMAGE,BaseObject::TYPEID_TEXT]))
			throw new ValidationException('type');

        $this->file->typeid = $typeid;
        $this->file->updateType();
        $this->file->save();

        $this->addNotice($this->file->getType(), 0, $this->file->filename, 'PROP_SAVED', 'ok');
    }
}
