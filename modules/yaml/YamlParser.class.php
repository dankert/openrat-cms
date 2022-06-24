<?php
namespace yaml;

use template_engine\components\html\component_else\ElseComponent;
use util\ArrayUtils;

class YamlParser
{
	private $indentChar  = ' '; // Standard: 2 Spaces
	private $indentCount = 2;   // Standard: 2 Spaces

	private $filter = null;

	public function __construct()
	{
	}

	public function addFilter( $filterfunction ) {
		$this->filter = $filterfunction;
	}

	public function setIdent( $char,$count ) {
		$this->indentChar  = $char;
		$this->indentCount = $count;
	}


	public function parse( $source ) {
		$line = 1;

		$lines = [];

		$sourceLines = explode("\n",$source);

		$openArrays = [];
		$lastIndent = 0;
		foreach( $sourceLines as $sourceLine ) {

			// Check indentation of this line
			$ident = 0;
			while( substr($sourceLine,0,$this->indentCount ) == str_repeat( $this->indentChar, $this->indentCount ) ) {
				$sourceLine = substr( $sourceLine, $this->indentCount );
				$ident++;
			}



		}
	}





	public function dump( $data ) {
		return $this->dumpInternal($data,0);
	}

	private function dumpInternal( $data,$depth ) {

		if   ( is_null($data) )
			return '~';
		if   ( is_string($data) )
			return '"'.$data.'"';
		if   ( is_numeric( $data ) )
			return "".$data;

		if   ( is_array( $data ) ) {

			$output = '';
			$indent = "\n".str_repeat($this->indent,$depth);

			if   ( $this->isAssoc($data) )

				foreach( $data as $k => $v ) {
					$output = $indent.$k.': '.$this->dumpInternal($v,$depth+1);
				}
			else
				foreach( $data as $v ) {
					$output = $indent.'- '.$this->dumpInternal($v,$depth+1);
				}
				return $output;
		}

		if   ( is_object( $data ) ) {

			$output = '';
			$indent = "\n".str_repeat($this->indent,$depth);

			foreach( get_object_vars($data) as $k => $v ) {
				$output = $indent . $k . ': ' . $this->dumpInternal($v, $depth + 1);
			}
			return $output;
		}

		throw new \Exception("unknown type ".gettype($data) );
	}


	private function isAssoc($arr)
	{
		if (array() === $arr) return false;
		return array_keys($arr) !== range(0, count($arr) - 1);
	}
}