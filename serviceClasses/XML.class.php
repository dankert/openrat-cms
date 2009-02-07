<?php
/**
 * Multidimensional Array-to-XML.
 *
 * Example:
 * $xml = new XML();
 * header('Content-Type: application/xml');
 * echo $xml->encode( $yourBigArray );
 * exit;
 *
 * Author: Honoré Vasconcelos, Jan Dankert
 *
 * Original from:
 * Clean XML To Array: http://www.phpclasses.org/browse/package/3598.html
 * 
 * License of this class: BSD-Licence.
 * 
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 * Redistributions of source code must retain the above copyright notice, this list
 * of conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this
 * list of conditions and the following disclaimer in the documentation and/or other
 * materials provided with the distribution.
 *
 * Neither the name of the Author(s) nor the names of its contributors may be used
 * to endorse or promote products derived from this software without specific prior
 * written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 * EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
 * PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
 * PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
 * LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 * NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */
class XML
{
	/**
	 * Parse multidimentional array to XML.
	 *
	 * @param array $array
	 * @return String
	 */
	var $XMLtext = '';


	/**
	 * Name of the root element.
	 *
	 * @var String
	 */
	var $root = 'server';

	/*
	 * Char to indent with.
	 *
	 * @var String
	 */
	var $indentChar = "\t";



	/**
	 * Encode a array to XML.
	 *
	 * @param Array $array
	 * @return String (serialized XML)
	 */
	function encode($array)
	{
		//star and end the XML document
		$this->XMLtext="<?xml version=\"1.0\" encoding=\"utf-8\"?>\n<".$this->root.">\n";
		$this->array_transform($array);
		$this->XMLtext .="</".$this->root.">";
		return $this->XMLtext;
	}


	/**
	 * @access private
	 */
	function array_transform($array){
		static $Depth = 0;

		foreach($array as $key => $value)
		{
			if	( ! is_array($value) )
			{
				$Tabs = str_repeat($this->indentChar,$Depth+1);
				if	( is_numeric($key) )
				$kkey = "n$key";
				else
				$kkey = $key;
				$this->XMLtext .= "$Tabs<$kkey id=\"$key\">$value</$key>\n";
			}
			else
			{
				$Depth += 1;
				$Tabs = str_repeat($this->indentChar,$Depth);
				if	( is_numeric($key) )
					$keyval = "n$key";
				else
					$keyval = $key;
				$closekey = $keyval;
				$this->XMLtext.="$Tabs<$keyval>\n";
				$this->array_transform($value);
				$this->XMLtext.="$Tabs</$closekey>\n";
				$Depth -= 1;
					
			}
		}
		return;
	}
}

?>