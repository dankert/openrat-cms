<?php

namespace cms\action;

use cms\model\Folder;
use cms\model\Image;
use cms\model\Object;
use cms\model\File;

use Http;
use \Html;
use Upload;


/**
 * Action-Klasse zum Bearbeiten eines Bildes.
 * @author Jan Dankert
 * @version $Revision$
 * @package openrat.actions
 */
class ImageAction extends FileAction
{
	public $security = SECURITY_USER;

	var $image;

	/**
	 * Konstruktor
	 */
	public function __construct()
	{
        parent::__construct();

		$this->image = new Image( $this->getRequestId() );
		$this->image->load();

		$this->file = $this->image;
	}


	
	/**
	 * Anzeigen des Inhaltes
	 */
    public function sizeView()
	{
		$this->setTemplateVars( $this->image->getProperties() );
		
		$format = $this->imageFormat();

		if	( $format == 0 )
		{
			$this->addNotice( 'image','','IMAGE_RESIZING_UNKNOWN_TYPE',OR_NOTICE_WARN);
		}
			
		$formats = $this->imageFormats();
			
		if	( empty($formats) )
			$this->addNotice( 'image','','IMAGE_RESIZING_NOT_AVAILABLE',OR_NOTICE_WARN);
		
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


	

	/**
	 * Bildgroesse eines Bildes aendern
	 */
	public function sizePost()
	{
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
			$imageFile->name       = lang('copy_of').' '.$imageFile->name;
			$imageFile->desription = lang('copy_of').' '.$imageFile->description;
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

		$this->addNotice($imageFile->getType(),$imageFile->name,'IMAGE_RESIZED','ok');
	}



    private function imageFormat()
    {
        if	( ! function_exists( 'imagetypes' ) )
            return 0;

        $ext      = strtolower($this->image->getRealExtension());
        $types    = imagetypes();
        $formats  = array( 'gif' =>IMG_GIF,
            'jpg' =>IMG_JPG,
            'jpeg'=>IMG_JPG,
            'png' =>IMG_PNG );

        if	( !isset($formats[$ext]) )
            return 0;

        if	( $types & $formats[$ext] )
            return $formats[$ext];

        return 0;
    }



    private function imageExt()
    {
        switch( $this->imageFormat() )
        {
            case IMG_GIF:
                return 'GIF';
            case IMG_JPG:
                return 'JPEG';
            case IMG_PNG:
                return 'PNG';
        }
    }



    private function imageFormats()
    {
        if	( ! function_exists( 'imagetypes' ) )
            return array();

        $types    = imagetypes();
        $formats  = array( IMG_GIF => 'gif',
            IMG_JPG => 'jpeg',
            IMG_PNG => 'png' );
        $formats2 = $formats;

        foreach( $formats as $b=>$f )
            if	( !($types & $b) )
                unset( $formats2[$b] );

        return $formats2;
    }


}
