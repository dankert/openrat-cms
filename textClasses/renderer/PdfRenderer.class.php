<?php

/**
 * Dokument-Objekt.<br>
 * Diese Objekt verkoerpert das Root-Objekt in einem DOM-Baum.<br>
 * <br>
 * Dieses Objekt kann Text parsen und seine Unterobjekte selbst erzeugen.<br>
 * 
 * @author Jan Dankert, $Author$
 * @version $Revision$
 * @package openrat.text
 */

require('textClasses/renderer/fpdf.php');

class PdfRenderer
{
	var $linkedObjectIds = array();
	
	/**
	 *
	 * @var Array
	 */
	var $footnotes       = array();
	
	var $fpdf;
	
	var $url;
	

	/**
	 * Rendert ein Dokument-Element.
	 *
	 * @param Object $child Element
	 * @return String
	 */
	function renderElement( $child )
	{
		global $conf;
		
				switch( strtolower(get_class($child)) )
				{
					case 'tableofcontentelement':
						break;

					case 'rawelement':
						$this->fpdf->Write(5,$child->src);
						
						break;

					case 'textelement':
						
						$this->fpdf->Write(10,$child->text,$this->url);
						$this->url = '';
						break;

					case 'footnoteelement':
						break;

					case 'codeelement':
						break;

					case 'quoteelement':
						$tag = 'blockquote';
						break;


					case 'paragraphelement':
						$this->fpdf->ln(10);
						break;

					case 'speechelement':
						break;

					case 'linebreakelement':
						$this->fpdf->ln(5);
						break;
						
					case 'linkelement':
						$this->url = $child->getUrl();
						break;

					case 'imageelement':
						break;

					case 'strongelement':
						break;

					case 'emphaticelement':
						break;

					case 'insertedelement':
						break;

					case 'removedelement':
						break;

					case 'headlineelement':
						$this->fpdf->ln(20);
						break;

					case 'tableelement':
						break;

					case 'tablelineelement':
						break;

					case 'definitionlistelement':
						break;

					case 'definitionitemelement':
						break;

					case 'tablecellelement':
						break;

					case 'listelement':
						break;
						
					case 'teletypeelement':
						break;
						
					case 'numberedlistelement':
						break;
						
					case 'listentryelement':
						break;

					default:
						break;
				}				

				foreach( $child->children as $c )
				{
					$this->renderElement( $c );
				}
		
	}


	/**
	 * Rendering des Dokumentes.<br>
	 *
	 * @return String
	 */
	function render()
	{
		$this->fpdf = new FPDF();
		$this->fpdf->AddPage();
		$this->fpdf->SetFont('Arial','',12);
		
		$this->footnotes    = array();
		
		foreach( $this->children as $child )
			$this->renderElement( $child );
			
		#foreach( $this->footnotes as $child )
		#	$this->renderElement( $child );

		return $this->fpdf->Output('','S');
	}
}

?>