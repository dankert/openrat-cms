<?php

namespace cms\action;

use cms\model\Image;
use util\Html;


/**
 * Action-Klasse zum Bearbeiten eines Bildes.
 * @author Jan Dankert
 * @version $Revision$
 * @package openrat.actions
 */
class ImageAction extends FileAction
{
	/**
	 * @var Image
	 */
	protected $image;

	/**
	 * Konstruktor
	 */
	public function __construct()
	{
        parent::__construct();

    }


    public function init()
    {
		$image = new Image( $this->request->getId() );
		$image->load();

        $this->setBaseObject( $image );

    }


    protected function setBaseObject( $image ) {
		$this->image = $image;

		parent::setBaseObject($image);
	}



    protected function imageFormat()
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



    protected function imageExt()
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



    protected function imageFormats()
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
