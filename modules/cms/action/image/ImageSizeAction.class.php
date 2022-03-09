<?php
namespace cms\action\image;
use cms\action\Action;
use cms\action\ImageAction;
use cms\action\Method;
use cms\model\Image;
use cms\model\Name;
use cms\model\Permission;
use language\Messages;
use util\exception\ValidationException;

class ImageSizeAction extends ImageAction implements Method {
	public function getRequiredPermission() {
		return Permission::ACL_WRITE;
	}

    public function view() {
		$this->setTemplateVars( $this->image->getProperties() );
		
		$format = $this->imageFormat();

		if	( $format == 0 )
		{
			$this->addWarningFor( $this->image,Messages::IMAGE_RESIZING_UNKNOWN_TYPE);
		}
			
		$formats = $this->imageFormats();
			
		if	( empty($formats) )
			$this->addWarningFor($this->image,Messages::IMAGE_RESIZING_NOT_AVAILABLE);
		
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
		$width           = $this->request->getNumber('width'         );
		$height          = $this->request->getNumber('height'        );
		$jpegcompression = $this->request->getText('jpeg_compression');
		$format          = $this->request->getText('format'          );
		$factor          = $this->request->getText('factor'          );
		
		if	( $this->request->getText('type') == 'input' &&
			  ! $width      &&
			  ! $height )
		{
			$this->addWarningFor(null,Messages::INPUT_NEW_IMAGE_SIZE);
			throw new ValidationException('width' );
		}
		
		if	( $this->request->isTrue('copy') )
		{
			// Datei neu anlegen.
			$imageFile = new Image();

			$imageFile->filename   = $imageFile->filename.'_resized_'.time();
			$imageFile->persist();
			$imageFile->copyNamesFrom( $this->image->objectid );
			$imageFile->copyValueFromFile( $this->image->objectid );
		}
		else
		{
			$imageFile = $this->image;
		}
		
		if	( $this->request->getText('type') == 'factor')
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

		$this->addNoticeFor($imageFile,Messages::IMAGE_RESIZED);
    }
}
