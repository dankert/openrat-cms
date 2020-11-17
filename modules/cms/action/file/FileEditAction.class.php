<?php
namespace cms\action\file;
use cms\action\FileAction;
use cms\action\Method;
use util\exception\ValidationException;
use util\Upload;


class FileEditAction extends FileAction implements Method {
    public function view() {
		// MIME-Types aus Datei lesen
		$this->setTemplateVars( $this->file->getProperties() );
    }
    public function post() {
		$upload = new Upload();

		if   ( $upload->isAvailable() )
        {
            // File received as attachement.
            try
            {
                $upload->processUpload();
            }
            catch( \Exception $e )
            {
                throw $e;
            }

            $this->file->filename  = $upload->filename;
            $this->file->extension = $upload->extension;
            $this->file->size      = $upload->size;
            $this->file->save();

            $this->file->value = $upload->value;
            $this->file->saveValue();
        }
		elseif( $this->hasRequestVar('value') )
        {
            // File value received
            $this->file->value = $this->getRequestVar('value');

            if   ( strtolower($this->getRequestVar('encoding')) == 'base64')
                // file value is base64-encoded
                $this->file->value = base64_decode($this->file->value);

            $this->file->saveValue();
        }
        else
        {
            // No file received.
            throw new ValidationException('value');
        }

        $this->file->setTimestamp();

		$this->addNotice($this->file->getType(), 0, $this->file->filename, 'VALUE_SAVED', 'ok');
    }
}
