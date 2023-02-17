<?php

namespace cms\generator\dsl;

use cms\model\Template;
use dsl\context\BaseScriptableObject;
use wikiparser\renderer\fpdf\Pdf;

class DslPdf extends BaseScriptableObject {

	/**
	 * @var Pdf
	 */
	private $pdf;

	/**
	 * @param Template $template
	 */
	public function __construct()
	{
		$this->pdf = new Pdf();
	}

	public function getOutput() {
		return $this->pdf->Output();
	}

	public function addPage($orientation='', $size='', $rotation=0) {
		$this->pdf->AddPage($orientation, $size, $rotation);
	}
	public function setAuthor( $author ) {
		$this->pdf->SetAuthor( $author );
	}
	public function setSubject( $author ) {

		$this->pdf->SetSubject( $author );
	}

	public function setCreator( $author ) {

		$this->pdf->SetCreator( $author );
	}

	public function setTextColor( $r,$g,$b ) {

		$this->pdf->SetTextColor( $r,$g,$b );
	}

	public function setTitle( $title ) {

		$this->pdf->SetTitle( $title, true );
	}

	public function addText( $text ) {

		$this->pdf->Write( 5,$text );
	}

}