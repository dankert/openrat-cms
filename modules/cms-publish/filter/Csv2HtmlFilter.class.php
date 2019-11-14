<?php


namespace cms\publish\filter;


class Csv2HtmlFilter extends AbstractFilter
{
	public $withHeader = false;
	public $delimiter = ';';
	public $enclosure = '"';

	public function filter( $value )
	{
		$outputRow = function( $line, $cellTag) {
			return "<tr><$cellTag>".implode("</$cellTag><$cellTag>",str_getcsv( $line,$this->delimiter,$this->enclosure ))."</$cellTag></tr>";

		};

		$lines = explode("\n",$value );

		$out = '';
		$out .= '<table>';

		if   ( $this->withHeader && $lines )
		{
			$out .= '<thead>';
			$out .= $outputRow( array_shift($lines),'th');
			$out .= '</thead>';
		}


		$out .= '<tbody>';
		foreach( $lines as $line )
			$out .= $outputRow( $line,'td');
		$out .= '</tbody>';

		$out .= '</table>';

		return $out;
	}
}