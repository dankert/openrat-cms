<?php
namespace cms\action\file;
use cms\action\FileAction;
use cms\action\Method;
use cms\base\Configuration;
use cms\generator\FileContext;
use cms\generator\FileGenerator;
use cms\generator\Producer;
use cms\model\File;


class FileShowAction extends FileAction implements Method {

    public function view() {
		$fileContext = new FileContext($this->file->objectid, Producer::SCHEME_PREVIEW );

		$generator = new FileGenerator( $fileContext);

		$this->lastModified( $this->file->lastchangeDate );

		if	( $this->file->extension == 'gz' )
		{
			$pos = strrpos($this->file->filename,'.');
			if	( $pos === false )
				$ext = '';
			else
				$ext = substr($this->file->filename,$pos+1);

			$ext = strtolower($ext);

			$mime_type = File::$MIME_TYPES[$ext];

			header('Content-Type: '.$mime_type );
			header('Content-Encoding: gzip' );
		}
		else
		{
			// Angabe Content-Type
			header('Content-Type: '.$this->file->mimeType() );
		}

		header('X-File-Id: '   .$this->file->fileid     );
		header('X-Id: '        .$this->file->id         );

		// Angabe Content-Disposition
		// - Bild soll "inline" gezeigt werden
		// - Dateiname wird benutzt, wenn der Browser das Bild speichern moechte
		header('Content-Disposition: inline; filename='.$this->file->filename() );
		header('Content-Transfer-Encoding: binary' );
		header('Content-Description: '.$this->file->filename() );

		//$this->file->write(); // Bild aus Datenbank laden

		// Groesse des Bildes in Bytes
		// Der Browser hat so die Moeglichkeit, einen Fortschrittsbalken zu zeigen
		header('Content-Length: '.$this->file->size );


		if	( $this->request->getAlphanum('encoding') == 'base64')
		{
		    $encodingFunction = function($value) {
		        return base64_encode($value);
            };
			$this->setTemplateVar('encoding', 'base64');
		}
		else {
            $encodingFunction = function($value) {
                return $value;
            };
            $this->setTemplateVar('encoding', 'none');
        }


		// Unterscheidung, ob PHP-Code in der Datei ausgefuehrt werden soll.
		$publishConfig = Configuration::subset('publish');
        $phpActive = ( $publishConfig->get('enable_php_in_file_content')=='auto' && $this->file->getRealExtension()=='php') ||
            $publishConfig->get('enable_php_in_file_content' )===true;

        if	(  $phpActive ) {

            // PHP-Code ausfuehren
            ob_start();
            require( $generator->getCache()->load()->getFilename() );
            $this->setTemplateVar('value',$encodingFunction(ob_get_contents()) );
            ob_end_clean();
        }
        else
            $this->setTemplateVar('value',$encodingFunction( $generator->getCache()->get() ) );
        // Maybe we want some gzip-encoding?
    }


    public function post() {
    }
}
