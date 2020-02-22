<?php

namespace util;
/**
 * Multidimensional Array-to-XML.
 *
 * Example:
 * $xml = new XML();
 * header('Content-Type: application/xml');
 * echo $xml->encode( $yourBigArray );
 * exit;
 *
 * Author: Honor� Vasconcelos, Jan Dankert
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
	var $xmlText = '';


	/**
	 * Name of the root element.
	 *
	 * @var String
	 */
	var $root = 'xml';

	/*
	 * Char to indent with.
	 *
	 * @var String
	 */
	var $indentChar = "\t";


	/**
	 * Newline-Char
	 * @var String
	 */
	var $nl = "\n";

	/**
	 * Encode a array to XML.
	 *
	 * @param Array $array
	 * @return String (serialized XML)
	 */
	function encode($array)
	{
		//star and end the XML document
		$this->xmlText = '<?xml version="1.0" encoding="utf-8"?>' . $this->nl;
		$this->xmlText .= '<' . $this->root . '>' . $this->nl;
		$this->array_transform($array, 1);
		$this->xmlText .= '</' . $this->root . '>';

		return $this->xmlText;
	}


	/**
	 * @access private
	 */
	function array_transform($array, $depth)
	{

		foreach ($array as $key => $value) {
			$attr = array();
			if (is_numeric($key)) {
				// Array-Einträge mit numerischen Index können nicht direkt in ein XML-Element
				// umgewandelt werden, da nur-numerische Element-Namen nicht erlaubt sind.
				// Daher verwenden wir dann 'entry' als Elementnamen.
				$attr['id'] = $key;
				$key = 'entry';
			}

			$indent = str_repeat($this->indentChar, $depth);

			if (empty($value)) {
				$this->xmlText .= $indent . $this->shortTag($key, $attr) . $this->nl;
			} elseif (is_object($value)) {
				// Der Inhalt ist ein Array, daher rekursiv verzweigen.
				$this->xmlText .= $indent . $this->openTag($key, $attr) . $this->nl;
				$prop = get_object_vars($value);
				$this->array_transform($prop, $depth + 1); // Rekursiver Aufruf
				$this->xmlText .= $indent . $this->closeTag($key) . $this->nl;
			} elseif (is_array($value)) {
				// Der Inhalt ist ein Array, daher rekursiv verzweigen.
				$this->xmlText .= $indent . $this->openTag($key, $attr) . $this->nl;
				$this->array_transform($value, $depth + 1); // Rekursiver Aufruf
				$this->xmlText .= $indent . $this->closeTag($key) . $this->nl;
			} else {
				// Der Inhalt ist ein einfacher Inhalt (kein Array).
				$this->xmlText .= $indent . $this->openTag($key, $attr);
				$this->xmlText .= $value;
				$this->xmlText .= $this->closeTag($key) . $this->nl;
			}
		}
	}


	function openTag($key, $attr)
	{
		$tag = '<' . $key;
		foreach ($attr as $attr_name => $attr_value)
			$tag .= ' ' . $attr_name . '="' . $attr_value . '"';
		$tag .= '>';
		return $tag;
	}


	function shortTag($key, $attr)
	{
		$tag = '<' . $key;
		foreach ($attr as $attr_name => $attr_value)
			$tag .= ' ' . $attr_name . '="' . $attr_value . '"';
		$tag .= ' />';
		return $tag;
	}


	function closeTag($key)
	{
		return '</' . $key . '>';
	}
}

?>