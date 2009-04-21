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
	function Image( $file,$x,$y,$a,$b,$type )
	{
		switch( $type )
		{
			case 'png':
			case 'jpeg':
			case 'jpg':
				parent::Image($file,$x,$y,$a,$b,$type);
				break;
			default:
				Logger::warn( 'Imagetype '.$type.' not available in PDF renderer');
				
		}
	}
}

?>
