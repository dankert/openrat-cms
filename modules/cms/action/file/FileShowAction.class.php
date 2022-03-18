<?php
namespace cms\action\file;
use cms\action\FileAction;
use cms\action\Method;
use cms\base\Configuration;
use cms\generator\FileContext;
use cms\generator\FileGenerator;
use cms\generator\FileHistoryContext;
use cms\generator\FileHistoryGenerator;
use cms\generator\Producer;
use cms\model\File;
use cms\model\Value;
use util\exception\SecurityException;


class FileShowAction extends FileAction implements Method {

    public function view() {

		$valueId = $this->request->getNumber('valueid');

		if   ( $valueId ) {
			$value = new Value();
			$value->loadWithId( $valueId );
			if   ( $value->contentid != $this->file->contentid )
				throw new SecurityException('Content-Id does not match');

			$fileHistoryContext = new FileHistoryContext($this->file->objectid, $valueId );
			$generator          = new FileHistoryGenerator( $fileHistoryContext );
		} else {
			$fileContext = new FileContext($this->file->objectid, Producer::SCHEME_PREVIEW );
			$generator   = new FileGenerator( $fileContext );
		}


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

			$this->setContentType( $mime_type );
			$this->addHeader('Content-Encoding','gzip' );
		}
		else
		{
			// Angabe Content-Type
			$this->setContentType($generator->getMimeType() );
		}

		// Image should be displayed inline.
		// Filename is used if the user agent is saving the file.
		$this->addHeader('Content-Disposition'      ,'inline; filename='.$this->file->filename() );
		$this->addHeader('Content-Transfer-Encoding','binary' );
		$this->addHeader('Content-Description'      ,$this->file->filename() );


		// Groesse des Bildes in Bytes
		// Der Browser hat so die Moeglichkeit, einen Fortschrittsbalken zu zeigen
		$this->addHeader('Content-Length',$this->file->size );


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
