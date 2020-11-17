<?php
namespace cms\action\file;
use cms\action\Action;
use cms\action\FileAction;
use cms\action\Method;
use cms\model\File;


class FileUncompressAction extends FileAction implements Method {
    public function view() {
    }


    public function post() {
		switch( $this->file->extension )
		{
			case 'gz':
				if	( $this->getRequestVar('replace') )
				{
					if	( strcmp(substr($this->file->loadValue(),0,2),"\x1f\x8b"))
					{
						throw new \LogicException("Not GZIP format (See RFC 1952)");
					}
					$method = ord(substr($this->file->loadValue(),2,1));
					if	( $method != 8 )
					{
						throw new \LogicException("Unknown GZIP method: $method");
					}
					$this->file->value = gzinflate( substr($this->file->loadValue(),10));
					$this->file->parse_filename( $this->file->filename );
					$this->file->save();
					$this->file->saveValue();
				}
				else
				{
					$newFile = new File();
					$newFile->name     = $this->file->name;
					$newFile->parentid = $this->file->parentid;
					$newFile->value    = gzinflate( substr($this->file->loadValue(),10));
					$newFile->parse_filename( $this->file->filename );
					$newFile->add();
				}
				
				break;

			case 'bz2':
				if	( $this->getRequestVar('replace') )
				{
					$this->file->value = bzdecompress($this->file->loadValue());
					$this->file->parse_filename( $this->file->filename );
					$this->file->save();
					$this->file->saveValue();
				}
				else
				{
					$newFile = new File();
					$newFile->name     = $this->file->name;
					$newFile->parentid = $this->file->parentid;
					$newFile->value    = bzdecompress( $this->file->loadValue() );
					$newFile->parse_filename( $this->file->filename );
					$newFile->add();
				}
				
				break;

			default:
				throw new \util\exception\UIException('','cannot uncompress file with extension: ' . $this->file->extension );
		}

		$this->addNotice('file', 0, $this->file->name, 'DONE', Action::NOTICE_OK);
		$this->callSubAction('edit');
    }
}
