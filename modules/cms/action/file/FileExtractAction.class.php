<?php
namespace cms\action\file;
use cms\action\FileAction;
use cms\action\Method;
use cms\model\File;
use cms\model\Folder;
use language\Messages;
use util\ArchiveTar;
use util\ArchiveUnzip;


class FileExtractAction extends FileAction implements Method {
    public function view() {
		$this->setTemplateVars( $this->file->getProperties() );
    }


    public function post() {
		switch( $this->file->extension )
		{
			case 'tar':
				$folder = new Folder();
				$folder->parentid = $this->file->parentid;
				$folder->name     = $this->file->name;
				$folder->filename = $this->file->filename;
				$folder->persist();
				
				$tar = new ArchiveTar();
				$tar->openTAR( $this->file->loadValue() );
				
				foreach( $tar->files as $file )
				{
					$newFile = new File();
					$newFile->name     = $file['name'];
					$newFile->parentid = $folder->objectid;
					$newFile->value    = $file['file'];
					$newFile->parse_filename( $file['name'] );
					$newFile->lastchangeDate = $file['time'];
					$newFile->persist();

					$this->addNoticeFor( $newFile, Messages::ADDED );
				}
				
				unset($tar);
				
				break;

			case 'zip':
			
				$folder = new Folder();
				$folder->parentid    = $this->file->parentid;
				$folder->name        = $this->file->name;
				$folder->filename    = $this->file->filename;
				$folder->description = $this->file->fullFilename;
				$folder->persist();
				
				$zip = new ArchiveUnzip();
				$zip->open( $this->file->loadValue() );

				$lista = $zip->getList();

				if(sizeof($lista)) foreach($lista as $fileName=>$trash){
					

					$newFile = new File();
					$newFile->name        = basename($fileName);
					$newFile->description = 'Extracted: '.$this->file->fullFilename.' -> '.$fileName;
					$newFile->parentid    = $folder->objectid;
					$newFile->parse_filename( basename($fileName) );

					$newFile->value       = $zip->unzip($fileName);
					$newFile->persist();

					$this->addNoticeFor( $newFile, Messages::ADDED);
					unset($newFile);
				}

				$zip->close();
				unset($zip);
				
				break;

			default:
				throw new \util\exception\UIException([]'cannot extract file with extension: ' . $this->file->extension);
		}
    }
}
