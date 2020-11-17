<?php
namespace cms\action\image;
use cms\action\Action;
use cms\action\ImageAction;
use cms\action\Method;
use cms\model\Image;

class ImageSizeAction extends ImageAction implements Method {
    public function view() {
		$this->setTemplateVars( $this->image->getProperties() );
		
		$format = $this->imageFormat();

		if	( $format == 0 )
		{
			$this->addNotice('image', 0, '', 'IMAGE_RESIZING_UNKNOWN_TYPE', Action::NOTICE_WARN);
		}
			
		$formats = $this->imageFormats();
			
		if	( empty($formats) )
			$this->addNotice('image', 0, '', 'IMAGE_RESIZING_NOT_AVAILABLE', Action::NOTICE_WARN);
		
		$sizes = array();
		foreach( array(10,25,50,75,100,125,150,175,200,250,300,350,400,500,600,800) as $s )
			$sizes[strval($s/100)] = $s.'%';
			
		$jpeglist = array();
		for ($i=10; $i<=95; $i+=5)
			$jpeglist[$i]=$i.'%';

		$this->setTemplateVar('factors'       ,$sizes      );
		$this->setTemplateVar('jpeglist'      ,$jpeglist   );
		$this->setTemplateVar('formats'       ,$formats    );
		$this->setTemplateVar('format'        ,$format     );
		$this->setTemplateVar('factor'        ,1           );
		
		$this->image->getImageSize();
		$this->setTemplateVar('width' ,$this->image->width  );
		$this->setTemplateVar('height',$this->image->height );
		$this->setTemplateVar('type'  ,'input'             );
    }


    public function post() {
		$width           = intval($this->getRequestVar('width'           ));
		$height          = intval($this->getRequestVar('height'          ));
		$jpegcompression =        $this->getRequestVar('jpeg_compression') ;
		$format          =        $this->getRequestVar('format'          ) ;
		$factor          =        $this->getRequestVar('factor'          ) ;
		
		if	( $this->getRequestVar('type') == 'input' &&
			  ! $this->hasRequestVar('width' )      &&
			  ! $this->hasRequestVar('height') )
		{
			$this->addValidationError('width','INPUT_NEW_IMAGE_SIZE' );
			$this->addValidationError('height','');
			$this->callSubAction('size');
			return;
		}
		
		if	( $this->hasRequestVar('copy') )
		{
			// Datei neu anlegen.
			$imageFile = new Image($this->image->objectid);
			$imageFile->load();
			$imageFile->name       = \cms\base\Language::lang('copy_of').' '.$imageFile->name;
			$imageFile->desription = \cms\base\Language::lang('copy_of').' '.$imageFile->description;
			$imageFile->filename   = $imageFile->filename.'_resized_'.time();
			$imageFile->add();
			$imageFile->copyValueFromFile( $this->image->objectid );
		}
		else
		{
			$imageFile = $this->image;
		}
		
		if	( $this->getRequestVar('type') == 'factor')
		{
			$width  = 0;
			$height = 0;
		}
		else
		{
			$factor = 1;
		}

		$imageFile->write();
		
		$imageFile->imageResize( intval($width),intval($height),$factor,$this->imageFormat(),$format,$jpegcompression );
		$imageFile->setTimestamp();
		$imageFile->save();      // Um z.B. Groesse abzuspeichern
		$imageFile->saveValue();

		$this->addNotice($imageFile->getType(), 0, $imageFile->name, 'IMAGE_RESIZED', 'ok');
    }
}
