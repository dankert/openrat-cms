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

namespace wikiparser\renderer;

use cms\base\Startup;
use cms\model\BaseObject;
use cms\model\File;
use cms\model\Image;
use Pdf;

require(__DIR__ . '/fpdf/fpdf.php');
require(__DIR__ . '/fpdf/Pdf.class.php');

class PdfRenderer
{
	var $linkedObjectIds = array();

	/**
	 *
	 * @var array
	 */
	var $footnotes = array();

	var $pdf;

	var $url;


	/**
	 * Rendert ein Dokument-Element.
	 *
	 * @param Object $child Element
	 * @return String
	 */
	function renderElement($child)
	{
		$conf = \cms\base\Configuration::rawConfig();

		switch (strtolower(get_class($child))) {
			case 'tableofcontentelement':
				break;

			case 'rawelement':
				$this->pdf->Write(5, $child->src);

				break;

			case 'textelement':

				$this->pdf->Write(5, $child->text, $this->url);
				$this->url = '';
				break;

			case 'footnoteelement':
				break;

			case 'macroelement':
				break;

			case 'codeelement':
				$this->pdf->ln(10);
				$this->pdf->SetFont('Courier', '', 12);
				break;

			case 'quoteelement':
				$this->pdf->SetFont('Arial', 'I', 12);
				break;


			case 'paragraphelement':
				$this->pdf->ln(10);
				break;

			case 'speechelement':
				$this->pdf->SetFont('Arial', 'I', 12);
				break;

			case 'linebreakelement':
				$this->pdf->ln(5);
				break;

			case 'linkelement':
				$this->url = $child->getUrl();
				$this->pdf->SetTextColor(0, 0, 255); // Blau.
				break;

			case 'imageelement':
				if (BaseObject::available($child->objectId)) {
					$this->pdf->ln(5);
					// Breite/oe�he des Bildes bestimmen.
					$image = new Image($child->objectId);

					$image->load();
					$image->write();
					$image->getImageSize();
					// $image->width;
					// $image->height;

					$this->pdf->Image($image->getCache()->getFilename(), $this->pdf->GetX(), $this->pdf->GetY(), 0, 0, $image->extension());
					$this->pdf->ln($image->height / 2.5);
					$this->pdf->ln(5);

					unset($image);
				}
				break;

			case 'strongelement':
				$this->pdf->SetFont('Arial', 'B', 12);

				break;

			case 'emphaticelement':
				$this->pdf->SetFont('Arial', 'I', 12);
				break;

			case 'insertedelement':
				$this->pdf->SetTextColor(0, 255, 0);
				break;

			case 'removedelement':
				$this->pdf->SetTextColor(255, 0, 0);
				break;

			case 'headlineelement':
				$this->pdf->ln(20 - (2 * $child->level));
				$this->pdf->SetFontSize(20 - (2 * $child->level));

				break;

			case 'tableelement':
				$this->pdf->ln(20);
				break;

			case 'tablelineelement':
				$this->pdf->ln(20);
				break;

			case 'definitionlistelement':
				//$this->pdf->ln(10);
				break;

			case 'definitionitemelement':
				$this->pdf->ln(10);
				if (!empty($child->key)) {
					$this->pdf->SetFont('', 'U');
					$this->pdf->Write(5, $child->key);
					$this->pdf->SetFont('', '');
				}
				$this->pdf->Write(5, ': ');

			case 'tablecellelement':
				break;

			case 'teletypeelement':
				$this->pdf->SetFont('Courier', '', 12);
				break;

			case 'listelement':
				$this->pdf->ln(5);
				break;

			case 'numberedlistelement':
				$this->pdf->ln(5);
				break;

			case 'listentryelement':
				$this->pdf->ln(5);
				$this->pdf->Write(5, '- ');
				break;

			default:
				break;
		}

		foreach ($child->children as $c) {
			$this->renderElement($c);
		}

		$this->pdf->SetFont('Arial', '', 12);
		$this->pdf->SetTextColor(0, 0, 0);
	}


	/**
	 * Rendering des Dokumentes.<br>
	 *
	 * @return String
	 */
	function render()
	{
		$this->pdf = new Pdf();
		$this->pdf->AddPage();
		$this->pdf->SetCreator(Startup::TITLE);
		$this->pdf->SetFont('Arial', '', 12);

		#$this->footnotes    = array();

		foreach ($this->children as $child)
			$this->renderElement($child);

		#foreach( $this->footnotes as $child )
		#	$this->renderElement( $child );

		return $this->pdf->Output('', 'S');
	}
}

?>