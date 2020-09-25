<?php


namespace util;

require __DIR__.'/Less.php';

/**
 * Wrapper for 3rd-party Less parser.
 */
class Less
{

	private $less;


	public function __construct( $var )
	{
		$this->less = new \Less_Parser( $var );
	}


	public function parse( $str, $file_uri = null )
	{
		$this->less->parse($str, $file_uri);
	}
	public function parseFile( $filename, $uri_root = '', $returnRoot = false )
	{
		$this->less->parseFile( $filename, $uri_root, $returnRoot );
	}
	public function ModifyVars( $var )
	{
		$this->less->ModifyVars($var );
	}
	public function getCss()
	{
		return $this->less->getCss();
	}

}