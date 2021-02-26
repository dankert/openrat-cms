<?php
namespace cms\action\file;
use cms\action\Action;
use cms\action\FileAction;
use cms\action\Method;
use cms\action\RequestParams;
use cms\model\File;
use language\Messages;


class FileCompressAction extends FileAction implements Method {
    public function view() {
		$formats = array();
		foreach( $this->getCompressionTypes() as $t )
			$formats[$t] = \cms\base\Language::lang('compression_'.$t);

		$this->setTemplateVar('formats'       ,$formats    );
    }
    public function post() {
		$format = $this->request->getVar('format',RequestParams::FILTER_ALPHANUM);
		
		switch( $format )
		{
			case 'gz':
				if	( $this->request->getVar('replace',RequestParams::FILTER_NUMBER)=='1' )
				{
					$this->file->value = gzencode( $this->file->loadValue(),1 );
					$this->file->parse_filename( $this->file->filename.'.'.$this->file->extension.'.gz',FORCE_GZIP );
					$this->file->save();
					$this->file->saveValue();
					
				}
				else
				{
					$newFile = new File();
					$newFile->name     = $this->file->name;
					$newFile->parentid = $this->file->parentid;
					$newFile->value    = gzencode( $this->file->loadValue(),1 );
					$newFile->parse_filename( $this->file->filename.'.'.$this->file->extension.'.gz',FORCE_GZIP );
					$newFile->persist();
				}
				
				break;

			case 'bzip2':
				if	( $this->request->getText('replace')=='1' )
				{
					$this->file->value = bzcompress( $this->file->loadValue() );
					$this->file->parse_filename( $this->file->filename.'.'.$this->file->extension.'.bz2' );
					$this->file->save();
					$this->file->saveValue();
					
				}
				else
				{
					$newFile = new File();
					$newFile->name     = $this->file->name;
					$newFile->parentid = $this->file->parentid;
					$newFile->value    = bzcompress( $this->file->loadValue() );
					$newFile->parse_filename( $this->file->filename.'.'.$this->file->extension.'.bz2' );
					$newFile->persist();
				}
				
				break;
			default:
				throw new \util\exception\UIException('unknown compress type: ' . $format );
		}

		$this->addNoticeFor( $this->file, Messages::DONE);
    }
}
