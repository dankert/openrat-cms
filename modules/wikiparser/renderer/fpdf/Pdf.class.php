<?php

namespace wikiparser\renderer\fpdf;


use FPDF;

require(__DIR__.'/fpdf.php');

/**
 *
 */
class Pdf extends FPDF
{
	public function __construct($orientation = 'P', $unit = 'mm', $size = 'A4')
	{
		parent::__construct($orientation, $unit, $size);

		// defaults
		$this->fontpath = __DIR__.'/../font/';
		$this->SetFont('Arial', '', 12);
		$this->SetTextColor(0, 0, 0);
		$this->SetCreator( \cms\base\Startup::TITLE,true );
	}

	/**
	 * Get Output as string.
	 * @param $dest
	 * @param $name
	 * @param $isUTF8
	 * @return string
	 */
	public function Output($dest = '', $name = '', $isUTF8 = false)
	{
		return parent::Output('S','',true);
	}
}

