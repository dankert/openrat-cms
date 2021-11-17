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
use cms\base\Startup;
use LogicException;

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
class SmtpClient implements Client
{
	/**
	 * Newline characters as defined in RFC 822.
	 */
	const NL = "\r\n";

	/**
	 * Mail absenden.
	 * Die E-Mail wird versendet.
	 */
	public function send( $to, $subject, $body, $headers)
	{
		$mailConfig = Configuration::subset('mail');

		// Mail versenden
		// eigenen SMTP-Dialog verwenden.
		$smtpConf = $mailConfig->subset('smtp');

		$relayConfig = $smtpConf->subset('relay');

		if ( $relayConfig->has('host')) {
			// Eigenen Relay-Host verwenden.
			$mxHost = $relayConfig->get('host');
			$mxPort = $relayConfig->get('port',25);
		} else {
			// Mail direkt zustellen.
			$mxHost = $this->getMxHost($to);

			if (empty($mxHost))
				throw new LogicException( TextMessage::create('No MX-Entry found for ${0}',[$to]));

			if ($smtpConf->is('ssl',false))
				$mxPort = 465;
			else
				$mxPort = 25;
		}


		// gets the server hostname (necessary for the HELO command)
		$myHost = $smtpConf->get('hostname', gethostname() );

		if ($smtpConf->is('ssl',false))
			$proto = 'ssl';
		else
			$proto = 'tcp';

		//connect to the host and port
		$smtpSocket = fsockopen($proto . '://' . $mxHost, $mxPort, $errno, $errstr, $smtpConf->get('timeout',30 ) );

		if (!is_resource($smtpSocket)) {
			throw new LogicException('Connection failed to: ' . $proto . '://' . $mxHost . ':' . $mxPort . ' (' . $errstr . '/' . $errno . ')');
		}

		$smtpResponse = fgets($smtpSocket, 4096);

		if (substr($smtpResponse, 0, 3) != '220') {
			throw new LogicException('No 220: ' . trim($smtpResponse) );
		}

		if (!is_resource($smtpSocket)) {
			throw new LogicException('Connection failed to: ' . $smtpConf['host'] . ':' . $smtpConf['port'] . ' (' . $smtpResponse . ')' );
		}

		//you have to say HELO again after TLS is started
		$smtpResponse = $this->sendSmtpCommand($smtpSocket, 'HELO ' . $myHost);

		if (substr($smtpResponse, 0, 3) != '250') {
			$this->sendSmtpQuit($smtpSocket);
			throw new LogicException('No 2xx after HELO as host "'.$myHost.'", server says: ' . $smtpResponse);
		}

		if ($smtpConf->is('tls')) {
			$smtpResponse = $this->sendSmtpCommand($smtpSocket, 'STARTTLS');
			if (substr($smtpResponse, 0, 3) == '220') {
				// STARTTLS ist gelungen.
				//you have to say HELO again after TLS is started
				$smtpResponse = $this->sendSmtpCommand($smtpSocket, 'HELO ' . $myHost);

				if (substr($smtpResponse, 0, 3) != '250') {
					$this->sendSmtpQuit($smtpSocket);
					throw new LogicException("No 2xx after HELO, server says: " . $smtpResponse );
				}
			} else {
				// STARTTLS ging in die Hose. Einfach weitermachen.
			}
		}

		// request for auth login
		if ( $smtpConf->has('auth_username') && $relayConfig->has('host') ) {
			$smtpResponse = $this->sendSmtpCommand($smtpSocket, "AUTH LOGIN");
			if (substr($smtpResponse, 0, 3) != '334') {
				$this->sendSmtpQuit($smtpSocket);
				throw new LogicException("No 334 after AUTH_LOGIN, server says: " . $smtpResponse);
			}

			//send the username
			$smtpResponse = $this->sendSmtpCommand($smtpSocket, base64_encode($smtpConf->get('auth_username')));
			if (substr($smtpResponse, 0, 3) != '334') {
				$this->sendSmtpQuit($smtpSocket);
				throw new LogicException("No 3xx after setting username, server says: " . $smtpResponse);
			}

			//send the password
			$smtpResponse = $this->sendSmtpCommand($smtpSocket, base64_encode($smtpConf->get('auth_password')));
			if (substr($smtpResponse, 0, 3) != '235') {
				$this->sendSmtpQuit($smtpSocket);
				throw new LogicException("No 235 after sending password, server says: " . $smtpResponse );
			}
		}

		//email from
		$smtpResponse = $this->sendSmtpCommand($smtpSocket, 'MAIL FROM: <' . $mailConfig->get('from') . '>');
		if (substr($smtpResponse, 0, 3) != '250') {
			$this->sendSmtpQuit($smtpSocket);
			throw new LogicException("No 2xx after MAIL_FROM, server says: " . $smtpResponse);
		}

		//email to
		$smtpResponse = $this->sendSmtpCommand($smtpSocket, 'RCPT TO: <' . $to . '>');
		if (substr($smtpResponse, 0, 3) != '250') {
			$this->sendSmtpQuit($smtpSocket);
			throw new LogicException("No 2xx after RCPT_TO, server says: " . $smtpResponse);
		}

		//the email
		$smtpResponse = $this->sendSmtpCommand($smtpSocket, "DATA");
		if (substr($smtpResponse, 0, 3) != '354') {
			$this->sendSmtpQuit($smtpSocket);
			throw new LogicException("No 354 after DATA, server says: " . $smtpResponse);
		}

		$headers[] = 'To: ' . $to;
		$headers[] = 'Subject: ' . $subject;
		$headers[] = 'Date: ' . date('r');
		$headers[] = 'Message-Id: ' . '<' . getenv('REMOTE_ADDR') . '.' . time() . '.openrat@' . getenv('SERVER_NAME') . '.' . getenv('HOSTNAME') . '>';

		//observe the . after the newline, it signals the end of message
		$smtpResponse = $this->sendSmtpCommand($smtpSocket, implode(self::NL, $headers) . self::NL . self::NL . $body . self::NL . '.');
		if (substr($smtpResponse, 0, 3) != '250') {
			$this->sendSmtpQuit($smtpSocket);
			throw new LogicException("No 2xx after putting DATA, server says: " . $smtpResponse);
		}

		// say goodbye
		$this->sendSmtpQuit($smtpSocket);
	}


	/**
	 * Sendet ein SMTP-Kommando zum SMTP-Server.
	 *
	 * @access private
	 * @param Resource $socket TCP/IP-Socket zum SMTP-Server
	 * @param string $cmd SMTP-Kommando
	 * @return Server-Antwort
	 */
	private function sendSmtpCommand($socket, $cmd)
	{
		if (!is_resource($socket))
			// Die Verbindung ist geschlossen. Dies kann bei dieser
			// Implementierung eigentlich nur dann passieren, wenn
			// der Server die Verbindung schlie�t.
			// Dieser Client trennt die Verbindung nur nach einem "QUIT".
			throw new LogicException("Connection lost");

		fputs($socket, $cmd . self::NL);
		$response = trim(fgets($socket, 4096));
		return $response;
	}


	/**
	 * Sendet ein QUIT zum SMTP-Server, wartet die Antwort ab und
	 * schlie�t danach die Verbindung.
	 *
	 * @param Resource Socket
	 */
	private function sendSmtpQuit($socket)
	{

		if (!is_resource($socket))
			return;
		// Wenn die Verbindung nicht mehr da ist, brauchen wir
		// auch kein QUIT mehr :)


		fputs($socket, 'QUIT' . self::NL);
		$response = trim(fgets($socket, 4096));

		if (substr($response, 0, 3) != '221')
			throw new LogicException("No 221 after QUIT, server says: " . $response);

		fclose($socket);
	}



	/**
	 * Ermittelt den MX-Eintrag zu einer E-Mail-Adresse.<br>
	 * Es wird der Eintrag mit der h�chsten Priorit�t ermittelt.
	 *
	 * @param String E-Mail-Adresse des Empf�ngers.
	 * @return MX-Eintrag
	 */
	private function getMxHost($to)
	{
		list($user, $host) = explode('@', $to . '@');

		if (empty($host)) {
			throw new LogicException( TextMessage::create('Illegal mail address ${0}: No hostname found',[$to]) );
		}

		list($host) = explode('>', $host);

		$mxHostsName = array();
		$mxHostsPrio = array();
		getmxrr($host, $mxHostsName, $mxHostsPrio);

		$mxList = array();
		foreach ($mxHostsName as $id => $mxHostName) {
			$mxList[$mxHostName] = $mxHostsPrio[$id];
		}
		asort($mxList);
		return key($mxList);
	}
}