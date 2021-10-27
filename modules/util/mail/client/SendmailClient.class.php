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

namespace util\mail\client;

use cms\base\Configuration;
use cms\base\Language;
use cms\base\Startup;
use LogicException;
use util\text\TextMessage;
use util\text\variables\VariableResolver;

/**
 * Erzeugen und Versender einer E-Mail gemaess RFC 822.<br>
 * <br>
 * Die E-Mail kann entweder �ber
 * - die interne PHP-Funktion "mail()" versendet werden oder
 * - direkt per SMTP-Protokoll an einen SMTP-Server.<br>
 * Welcher Weg gew�hlt wird, kann konfiguriert werden.<br>
 * <br>
 * Prinzipiell spricht nichts gegen die interne PHP-Funktion mail(), wenn diese
 * aber nicht zu Verf�gung steht oder PHP ungeeignet konfiguriert ist, so kann
 * SMTP direkt verwendet werden. Hierbei sollte wenn m�glich ein Relay-Host
 * eingesetzt werden. Die Mail kann zwar auch direkt an Mail-Exchanger (MX) des
 * Empf�ngers geschickt werden, falls dieser aber Greylisting einsetzt ist eine
 * Zustellung nicht m�glich.<br>
 * <br>
 *
 * @author Jan Dankert
 */
class SendmailClient implements Client
{

	/**
	 * Mail absenden.
	 * Die E-Mail wird versendet.
	 */
	public function send($to, $subject, $body, $headers)
	{

		// PHP-interne Mailfunktion verwenden.
		$result = @mail($to,                 // Empf�nger
			$subject,            // Betreff
			$body,               // Inhalt
			// Lt. RFC822 müssen Header mit CRLF enden.
			// ABER: Der Parameter "additional headers" verlangt offenbar \n am Zeilenende.
			implode("\n", $headers));
		if (!$result)
			// Die E-Mail wurde nicht akzeptiert.
			// Genauer geht es leider nicht, da mail() nur einen boolean-Wert
			// zur�ck liefert.
			throw new LogicException('Mail was NOT accepted by mail(), no further information available. Please look into your system logs.');
	}
}