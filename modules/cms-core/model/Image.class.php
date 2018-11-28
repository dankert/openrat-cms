<?php
namespace cms\model;
// OpenRat Content Management System
// Copyright (C) 2002-2012 Jan Dankert, cms@jandankert.de
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.



/**
 * Datei.
 *
 * @author Jan Dankert
 * @package openrat.objects
 */
class Image extends File
{
	/**
	 * Breite eines Bildes. Ist nur verfuegbar, wenn vorher
	 * #getImageSize() aufgerufen wurde.
	 */
	var $width         = null;
	
	/**
	 * Hoehe eines Bildes. Ist nur verfuegbar, wenn vorher
	 * #getImageSize() aufgerufen wurde.
	 */
	var $height        = null;
	

	/**
	 * Konstruktor
	 *
	 * @param Objekt-Id
	 */
	function __construct( $objectid='' )
	{
	    parent::__construct($objectid);

        $this->isImage = true;
        $this->isFile  = false;
    }




	/**
	 * Ermittelt Breite und H�he des Bildes.<br>
	 * Die Werte lassen sich anschlie�end �ber die Eigenschaften "width" und "height" ermitteln.
	 */
	function getImageSize()
	{
		if	( is_null($this->width) )
		{
			$this->write(); // Datei schreiben
			
			// Bildinformationen ermitteln
			$size = getimagesize( $this->tmpfile() );
	
			// Breite und Hoehe des aktuellen Bildes	 
			$this->width  = $size[0]; 
			$this->height = $size[1];
		}
	}



	/**
	 * Veraendert die Bildgroesse eines Bildes
	 *
	 * Diese Methode sollte natuerlich nur bei Bildern ausgefuehrt werden.
	 *
	 * @param Neue Breite
	 * @param Neue Hoehe
	 * @param Bildgr��enfaktor
	 * @param Altes Format als Integer-Konstante IMG_xxx
	 * @param Neues Format als Integer-Konstante IMG_xxx
	 * @param Jpeg-Qualitaet (sofern neues Format = Jpeg)
	 */
	function imageResize( $newWidth,$newHeight,$factor,$oldformat,$newformat,$jpegquality )
	{
		global $conf;

		$this->write(); // Datei schreiben
		
		// Bildinformationen ermitteln
		$size = getimagesize( $this->tmpfile() );

		// Breite und Hoehe des aktuellen Bildes	 
		$oldWidth  = $size[0]; 
		$oldHeight = $size[1];
		$aspectRatio = $oldHeight / $oldWidth; // Seitenverhaeltnis

		// Wenn Breite und Hoehe fehlen, dann Bildgroesse beibehalten
		if	( $newWidth == 0 && $newHeight == 0)
		{
			if	( $factor != 0 && $factor != 1 )
			{
				$newWidth  = $oldWidth  * $factor; 
				$newHeight = $oldHeight * $factor;
				$resizing = true;
			}
			else
			{
				$newWidth  = $oldWidth; 
				$newHeight = $oldHeight;
				$resizing = false;
			}
		}
		else
		{
			$resizing = true;
		}

		// Wenn nur Breite oder Hoehe angegeben ist, dann
		// das Seitenverhaeltnis beibehalten
		if	( $newWidth == 0 )
			$newWidth = $newHeight / $aspectRatio; 
		
		if	( $newHeight == 0 )
			$newHeight = $newWidth * $aspectRatio; 


		switch( $oldformat )
		{
			case IMG_GIF: // GIF

				$oldImage = ImageCreateFromGIF( $this->tmpfile ); 
				break;

			case IMG_JPG: // JPEG

				$oldImage = ImageCreateFromJPEG($this->tmpfile);
				break;

			case IMG_PNG: // PNG

				$oldImage = imagecreatefrompng($this->tmpfile);
				break;

			default:
				die('unsupported image format "'.$this->extension.'", cannot load image. resize failed');
		}

		// Ab Version 2 der GD-Bibliothek sind TrueColor-Umwandlungen moeglich.
		global $conf;
 		$hasTrueColor = $conf['image']['truecolor'];

		switch( $newformat )
		{
			case IMG_GIF: // GIF

				if	( $resizing )
				{
					$newImage = ImageCreate($newWidth,$newHeight); 
					ImageCopyResized($newImage,$oldImage,0,0,0,0,$newWidth,
						$newHeight,$oldWidth,$oldHeight); 
				}
				else
				{
					$newImage = &$oldImage;
				} 

				ImageGIF($newImage, $this->tmpfile() );
				$this->extension = 'gif';

				break;

			case IMG_JPG: // JPEG

				if	( !$resizing )
				{
					$newImage = &$oldImage;
				} 
				elseif   ( $hasTrueColor )
				{
					// Verwende TrueColor (GD2)
					$newImage = imageCreateTrueColor( $newWidth,$newHeight );
					ImageCopyResampled($newImage,$oldImage,0,0,0,0,$newWidth,
					$newHeight,$oldWidth,$oldHeight);
				}
				else
				{
					// GD Version 1.x unterstuetzt kein TrueColor
					$newImage = ImageCreate($newWidth,$newHeight);
	
					ImageCopyResized($newImage,$oldImage,0,0,0,0,$newWidth,
					$newHeight,$oldWidth,$oldHeight);
				}
	
				ImageJPEG($newImage, $this->tmpfile,$jpegquality ); 
				$this->extension = 'jpeg';

				break;

			case IMG_PNG: // PNG

				if	( !$resizing )
				{
					$newImage = &$oldImage;
				} 
				elseif   ( $hasTrueColor )
				{
					// Verwende TrueColor (GD2)
					$newImage = imageCreateTrueColor( $newWidth,$newHeight );
		
					ImageCopyResampled($newImage,$oldImage,0,0,0,0,$newWidth,
					$newHeight,$oldWidth,$oldHeight); 
				}
				else
				{
					// GD Version 1.x unterstuetzt kein TrueColor
					$newImage = ImageCreate($newWidth,$newHeight);
		
					ImageCopyResized($newImage,$oldImage,0,0,0,0,$newWidth,
					$newHeight,$oldWidth,$oldHeight); 
				}
		
				imagepng( $newImage,$this->tmpfile() );
				$this->extension = 'png';
				
				break;
				
			default:
				die('unsupported image format "'.$newformat.'", cannot resize');
		} 

		$f = fopen( $this->tmpfile(), "r" );
		$this->value = fread( $f,filesize($this->tmpfile()) );
		fclose( $f );

		imagedestroy( $oldImage );
		//imagedestroy( $newImage );
	}

}

?>