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

namespace cms\base;

use logger\Logger;
use util\text\variables\VariableResolver;

class Language
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
	public static function lang($textVar, $vars = array())
	{
		$conf = \cms\base\Configuration::rawConfig();
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
}