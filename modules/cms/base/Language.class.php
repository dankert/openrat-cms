<?php
// OpenRat Content Management System
// Copyright (C) 2002-2012 Jan Dankert, cms@jandankert.de
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.

use logger\Logger;
use util\text\variables\VariableResolver;

class Language
{
	public static function registerFunctions()
	{

			/**
			 * Diese Funktion stellt ein Wort in der eingestellten
			 * Sprache zur Verfuegung.
			 *
			 * @var String Name der Sprachvariablen
			 * @var Array Liste (Assoziatives Array) von Variablen
			 *
			 * @package openrat.functions
			 */
			function lang($textVar, $vars = array())
			{
				global $conf;
				$lang = $conf['language'];

				$text = strtoupper($textVar);

				// Abfrage, ob Textvariable vorhanden ist
				if (isset($lang[$text])) {
					$text = $lang[$text];

					// Fill in variables
					if ($vars) {
						$resolver = new VariableResolver();

						// Resolve variable
						$resolver->addDefaultResolver(function ($var) use ($vars) {
							return @$vars[$var];
						});

						$text = $resolver->resolveVariables($text);
					}

					return $text;
				}

				// Wenn Textvariable nicht vorhanden ist, dann als letzten Ausweg nur den Variablennamen zurueckgeben
				Logger::warn('Message-Key not found: ' . $textVar);
				return ('?' . $textVar . '?');
			}


			/**
			 * Diese Funktion stellt ein Wort in der eingestellten
			 * Sprache zur Verfuegung. Sonderzeichen werden als HTML maskiert.
			 *
			 * @param $key
			 * @return unknown_type
			 * @package openrat.functions
			 * @var String Name der Sprachvariablen
			 * @var Array Liste (Assoziatives Array) von Variablen
			 *
			 */
			function langHtml($key, $vars = array())
			{

				return encodeHtml(lang($key, $vars));
			}

			/**
			 * Ersetzt alle Zeichen mit dem Ordinalwert > 127 mit einer HTML-Maskierung.
			 *
			 * @return String
			 */
			function encodeHtml($text)
			{
				return translateutf8tohtml($text);
			}

			function escapeHtml($text)
			{
				return translateutf8tohtml(htmlentities($text));
			}


	// Source: http://de.php.net/manual/de/function.htmlentities.php#96648
	// Thx to silverbeat!
	// When using UTF-8 as a charset, htmlentities will only convert 1-byte and 2-byte characters.
	// Use this function if you also want to convert 3-byte and 4-byte characters:
	// converts a UTF8-string into HTML entities
			function translateutf8tohtml($txt)
			{
				//$txt = html_entity_decode($txt);
				$txt2 = '';
				for ($i = 0; $i < strlen($txt); $i++) {
					$o = ord($txt{$i});
					if ($o < 128) {
						// 0..127: raw
						$txt2 .= $txt{$i};
					} else {
						$o1 = 0;
						$o2 = 0;
						$o3 = 0;
						if ($i < strlen($txt) - 1) $o1 = ord($txt{$i + 1});
						if ($i < strlen($txt) - 2) $o2 = ord($txt{$i + 2});
						if ($i < strlen($txt) - 3) $o3 = ord($txt{$i + 3});
						$hexval = 0;
						if ($o >= 0xc0 && $o < 0xc2) {
							// INVALID --- should never occur: 2-byte UTF-8 although value < 128
							$hexval = $o1;
							$i++;
						} elseif ($o >= 0xc2 && $o < 0xe0 && $o1 >= 0x80) {
							// 194..223: 2-byte UTF-8
							$hexval |= ($o & 0x1f) << 6;   // 1. byte: five bits of 1. char
							$hexval |= ($o1 & 0x3f);   // 2. byte: six bits of 2. char
							$i++;
						} elseif ($o >= 0xe0 && $o < 0xf0 && $o1 >= 0x80 && $o2 >= 0x80) {
							// 224..239: 3-byte UTF-8
							$hexval |= ($o & 0x0f) << 12;  // 1. byte: four bits of 1. char
							$hexval |= ($o1 & 0x3f) << 6;  // 2.+3. byte: six bits of 2.+3. char
							$hexval |= ($o2 & 0x3f);
							$i += 2;
						} elseif ($o >= 0xf0 && $o < 0xf4 && $o1 >= 0x80) {
							// 240..244: 4-byte UTF-8
							$hexval |= ($o & 0x07) << 18; // 1. byte: three bits of 1. char
							$hexval |= ($o1 & 0x3f) << 12; // 2.-4. byte: six bits of 2.-4. char
							$hexval |= ($o2 & 0x3f) << 6;
							$hexval |= ($o3 & 0x3f);
							$i += 3;
						} else {
							// don't know ... just encode
							$hexval = $o;
						}
						$hexstring = dechex($hexval);
						if (strlen($hexstring) % 2) $hexstring = '0' . $hexstring;
						$txt2 .= '&#x' . $hexstring . ';';
					}
				}
				$result = $txt2;

				return $result;
			}


			/**
			 * Diese Funktion prueft, ob ein Sprachelement vorhanden ist
			 *
			 * @var String Name der Sprachvariablen
			 *
			 * @package openrat.functions
			 */
			function hasLang($text)
			{
				$text = strtoupper($text);

				global $conf;
				$lang = $conf['language'];

				return isset($lang[$text]);
		}
	}
}