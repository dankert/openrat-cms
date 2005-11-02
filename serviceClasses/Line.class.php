<?php

/**
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class Line
{
	var $source;
	var $value;
	
	var $isList         = false;
	var $isNumberedList = false;
	var $indent         = 0;
	
	var $isHeadline          = false;
	var $isHeadlineUnderline = false;
	var $headlineLevel       = 0;
	
	
	var $isTableOfContent = false;
	var $isTable        = false;
	var $isCode         = false;
	var $isQuote        = false;
	var $isQuotePraefix = false;
	
	var $isUnparsed     = false;
	
	var $isEmpty        = false;

	
	
	function Line( $s )
	{
		$this->source = $s;
		$this->value  = $s;
		
		$this->isList         = substr(ltrim($s),0,1) == '-';
		$this->isNumberedList = substr(ltrim($s),0,1) == '#';
		$this->indent         = strlen($s)-strlen(ltrim($s))+1;

		if	( $this->isList || $this->isNumberedList )
			$this->value = ltrim(substr($s,$this->indent));

		$this->level      = strspn( $s,'+' );
		$this->isHeadline = $this->level >= 1;

		if	( $this->isHeadline )
			$this->value = ltrim(substr($s,$this->level));


		$hl = array(1=>'=',2=>'-',3=>'.');
		foreach($hl as $lev=>$char )
		{
			if	( substr($s,0,3)==str_repeat($char,3) )
			{
				$this->isHeadlineUnderline = true;
				$this->level               = intval($lev);
			}
		}
		
		if	( substr($s,0,7)=='##TOC##' )
		{
			$this->isTableOfContent  = true;
			$this->value             = '';
		}
		elseif	( substr($s,0,1)=='|' )
		{
			$this->isTable           = true;
			$this->value             = '';
		}
		elseif	( substr($s,0,1)=='=' && !$this->isHeadlineUnderline )
		{
			$this->isCode            = true;
			$this->value             = '';
		}
		elseif	( trim($s)=='>' )
		{
			$this->isQuote           = true;
		}
		elseif	( substr($s,0,1)=='>' && strlen(trim($s)>1) )
		{
			$this->isQuotePraefix    = true;
			$this->level         = strspn( str_replace(' ','',$s),'>' );
		}
		elseif	( substr($s,0,1)== '`' )
		{
			$this->isUnparsed = true;
			$this->value      = substr($this->value,1);
		}
		elseif	(  $s == '' )
		{
			$this->isEmpty           = true;
		}
	}
}

?>