<?php

/*
 * 
 */
class Pdf extends FPDF
{
	/*
	 * Ueberschreibt die FPDF-Methode, damit im Fehlerfall kein die() aufgerufen wird.
	 */
	function Error( $errorText )
	{
		Logger::warn('PDF-Error:'.$errorText);
	}

	/*
	 * Ueberschreibt die FPDF-Methode, damit im Fehlerfall kein die() aufgerufen wird.
	 */
	function Image( $file,$x=null,$y=null,$a=0,$b=0,$type='',$link='' )
	{
		switch( $type )
		{
			case 'png':
			case 'jpeg':
			case 'jpg':
				parent::Image($file,$x,$y,$a,$b,$type,$link);
				break;
			default:
				Logger::warn( 'Imagetype '.$type.' not available in PDF renderer');
				
		}
	}
}

?>
