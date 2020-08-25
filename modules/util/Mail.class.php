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

namespace util;

use Adresse;
use LogicException;
use util\Text;
use unknown_type;
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
class Mail
{
	private $from    = '';
	private $to      = '';
	private $bcc     = '';
	private $cc      = '';
	private $subject = '';
	private $text    = '';
	private $header  = array();
	private $nl      = '';
	private $vars    = [];

	/**
	 * Falls beim Versendern der E-Mail etwas schiefgeht, steht hier drin
	 * die technische Fehlermeldung.
	 *
	 * @var array Fehler
	 */
	var $error = array();

	/**
	 * Set to true for debugging.
	 * If true, All SMTP-Commands are written to error log.
	 *
	 * @var bool
	 */
	var $debug = true;


	/**
	 * Konstruktor.
	 * Es werden folgende Parameter erwartet
	 * @param String $to Empf�nger
	 * @param String der Textschl�ssel
	 * @return Mail
	 */
	function __construct($to, $text)
	{
		global $conf;

		// Zeilenumbruch CR/LF gem. RFC 822.
		$this->nl = chr(13) . chr(10);

		if (!empty($conf['mail']['from']))
			$this->from = $this->header_encode($conf['mail']['from']);

		// Priorit�t definieren (sofern konfiguriert)
		if (!empty($conf['mail']['priority']))
			$this->header[] = 'X-Priority: ' . $conf['mail']['priority'];

		$this->header[] = 'X-Mailer: ' . $this->header_encode(OR_TITLE . ' ' . OR_VERSION);
		$this->header[] = 'Content-Type: text/plain; charset=UTF-8';
		$this->subject = $this->header_encode(lang('mail_subject_' . $text));
		$this->to = $this->header_encode($to);

		$this->text = $this->nl . wordwrap(str_replace(';', $this->nl, lang('mail_text_' . $text)), 70, $this->nl) . $this->nl;

		// Signatur anhaengen (sofern konfiguriert)
		$signature = $conf['mail']['signature'];
		if (empty($signature))
			$signature = $conf['application']['name'];

		if (!empty($signature)) {
			$this->text .= $this->nl . '-- ' . $this->nl;
			$this->text .= str_replace(';', $this->nl, $signature);
			$this->text .= $this->nl;
		}

		// Kopie-Empf�nger
		if (!empty($conf['mail']['cc']))
			$this->cc = $this->header_encode($conf['mail']['cc']);

		// Blindkopie-Empf�nger
		if (!empty($conf['mail']['bcc']))
			$this->bcc = $this->header_encode($conf['mail']['bcc']);
	}


	/**
	 * Kodiert einen Text in das Format "Quoted-printable".<br>
	 * See RFC 2045.
	 * @param String $text Eingabe
	 * @return Text im quoted-printable-Format
	 */
	private function quoted_printable_encode($text)
	{
		$text = str_replace(' ', '=20', $text);

		for ($i = 128; $i <= 255; $i++) {
			$text = str_replace(chr($i), '=' . dechex($i), $text);
		}

		return $text;
	}


	/**
	 * Setzen einer Variablen in den Mail-Inhalt.
	 */
	public function setVar($varName, $varInhalt)
	{
		$this->vars[ $varName ] = $varInhalt;
	}


	/**
	 * Mail absenden.
	 * Die E-Mail wird versendet.
	 *
	 * @return boolean Erfolg
	 */
	public function send()
	{
		global $conf;

		if (strpos($this->to, '@') === FALSE)
			throw new LogicException("E-Mail-Adress does not contain a domain name: " . $this->to);

		$to_domain = explode('@', $this->to)[1];

		// Prüfen gegen die Whitelist
		$white = @$conf['mail']['whitelist'];

		if (!empty($white)) {
			if (!$this->containsDomain($to_domain, $white)) {
				// Wenn Domain nicht in Whitelist gefunden, dann Mail nicht verschicken.
				$this->error[] = 'Mail-Domain is not whitelisted';
				return false;
			}
		}

		// Prüfen gegen die Blacklist
		$black = @$conf['mail']['blacklist'];

		if (!empty($black)) {
			if ($this->containsDomain($to_domain, $black)) {
				// Wenn Domain in Blacklist gefunden, dann Mail nicht verschicken.
				$this->error[] = 'Mail-Domain is blacklisted';
				return false;
			}
		}

		// Header um Adressangaben erg�nzen.
		if (!empty($this->from))
			$this->header[] = 'From: ' . $this->from;

		if (!empty($this->cc))
			$this->header[] = 'Cc: ' . $this->cc;

		if (!empty($this->bcc))
			$this->header[] = 'Bcc: ' . $this->bcc;

		// Evaluate variables in mail data
		$resolver = new VariableResolver();
		$resolver->addDefaultResolver( function($key) {
			return $this->vars[$key];
		} );
		$text = $resolver->resolveVariables( $this->text );

		// Mail versenden
		if (strtolower(@$conf['mail']['client']) == 'php') {
			// PHP-interne Mailfunktion verwenden.
			$result = @mail($this->to,                 // Empf�nger
				$this->subject,            // Betreff
				$text,               // Inhalt
				// Lt. RFC822 müssen Header mit CRLF enden.
				// ABER: Der Parameter "additional headers" verlangt offenbar \n am Zeilenende.
				implode("\n", $this->header));
			if (!$result)
				// Die E-Mail wurde nicht akzeptiert.
				// Genauer geht es leider nicht, da mail() nur einen boolean-Wert
				// zur�ck liefert.
				$this->error[] = 'Mail was NOT accepted by mail()';

			return $result;
		} else {
			// eigenen SMTP-Dialog verwenden.
			$smtpConf = $conf['mail']['smtp'];

			if (!empty($smtpConf['host'])) {
				// Eigenen Relay-Host verwenden.
				$mxHost = $smtpConf['host'];
				$mxPort = intval($smtpConf['port']);
			} else {
				// Mail direkt zustellen.
				$mxHost = $this->getMxHost($this->to);

				if (empty($mxHost)) {
					$this->error[] = "No MX-Entry found. Mail could not be sent.";
					return false;
				}

				if ($smtpConf['ssl'])
					$mxPort = 465;
				else
					$mxPort = 25;
			}


			if (!empty($smtpConf['localhost'])) {
				$myHost = $smtpConf['localhost'];
			} else {
				$myHost = gethostbyaddr(getenv('REMOTE_ADDR'));
			}

			if ($smtpConf['ssl'])
				$proto = 'ssl';
			else
				$proto = 'tcp';

			//connect to the host and port
			$smtpSocket = fsockopen($proto . '://' . $mxHost, $mxPort, $errno, $errstr, intval($smtpConf['timeout']));

			if (!is_resource($smtpSocket)) {
				$this->error[] = 'Connection failed to: ' . $proto . '://' . $mxHost . ':' . $mxPort . ' (' . $errstr . '/' . $errno . ')';
				return false;
			}

			$smtpResponse = fgets($smtpSocket, 4096);
			if ($this->debug)
				$this->error[] = trim($smtpResponse);

			if (substr($smtpResponse, 0, 3) != '220') {
				$this->error[] = 'No 220: ' . trim($smtpResponse);
				return false;
			}

			if (!is_resource($smtpSocket)) {
				$this->error[] = 'Connection failed to: ' . $smtpConf['host'] . ':' . $smtpConf['port'] . ' (' . $smtpResponse . ')';
				return false;
			}

			//you have to say HELO again after TLS is started
			$smtpResponse = $this->sendSmtpCommand($smtpSocket, 'HELO ' . $myHost);

			if (substr($smtpResponse, 0, 3) != '250') {
				$this->error[] = "No 2xx after HELO, server says: " . $smtpResponse;
				$this->sendSmtpQuit($smtpSocket);
				return false;
			}

			if ($smtpConf['tls']) {
				$smtpResponse = $this->sendSmtpCommand($smtpSocket, 'STARTTLS');
				if (substr($smtpResponse, 0, 3) == '220') {
					// STARTTLS ist gelungen.
					//you have to say HELO again after TLS is started
					$smtpResponse = $this->sendSmtpCommand($smtpSocket, 'HELO ' . $myHost);

					if (substr($smtpResponse, 0, 3) != '250') {
						$this->error[] = "No 2xx after HELO, server says: " . $smtpResponse;
						$this->sendSmtpQuit($smtpSocket);
						return false;
					}
				} else {
					// STARTTLS ging in die Hose. Einfach weitermachen.
				}
			}

			// request for auth login
			if (isset($smtpConf['auth_username']) && !empty($smtpConf['host']) && !empty($smtpConf['auth_username'])) {
				$smtpResponse = $this->sendSmtpCommand($smtpSocket, "AUTH LOGIN");
				if (substr($smtpResponse, 0, 3) != '334') {
					$this->error[] = "No 334 after AUTH_LOGIN, server says: " . $smtpResponse;
					$this->sendSmtpQuit($smtpSocket);
					return false;
				}

				if ($this->debug)
					$this->error[] = 'Login for ' . $smtpConf['auth_username'];

				//send the username
				$smtpResponse = $this->sendSmtpCommand($smtpSocket, base64_encode($smtpConf['auth_username']));
				if (substr($smtpResponse, 0, 3) != '334') {
					$this->error[] = "No 3xx after setting username, server says: " . $smtpResponse;
					$this->sendSmtpQuit($smtpSocket);
					return false;
				}

				//send the password
				$smtpResponse = $this->sendSmtpCommand($smtpSocket, base64_encode($smtpConf['auth_password']));
				if (substr($smtpResponse, 0, 3) != '235') {
					$this->error[] = "No 235 after sending password, server says: " . $smtpResponse;
					$this->sendSmtpQuit($smtpSocket);
					return false;
				}
			}

			//email from
			$smtpResponse = $this->sendSmtpCommand($smtpSocket, 'MAIL FROM: <' . $conf['mail']['from'] . '>');
			if (substr($smtpResponse, 0, 3) != '250') {
				$this->error[] = "No 2xx after MAIL_FROM, server says: " . $smtpResponse;
				$this->sendSmtpQuit($smtpSocket);
				return false;
			}

			//email to
			$smtpResponse = $this->sendSmtpCommand($smtpSocket, 'RCPT TO: <' . $this->to . '>');
			if (substr($smtpResponse, 0, 3) != '250') {
				$this->error[] = "No 2xx after RCPT_TO, server says: " . $smtpResponse;
				$this->sendSmtpQuit($smtpSocket);
				return false;
			}

			//the email
			$smtpResponse = $this->sendSmtpCommand($smtpSocket, "DATA");
			if (substr($smtpResponse, 0, 3) != '354') {
				$this->error[] = "No 354 after DATA, server says: " . $smtpResponse;
				$this->sendSmtpQuit($smtpSocket);
				return false;
			}

			$this->header[] = 'To: ' . $this->to;
			$this->header[] = 'Subject: ' . $this->subject;
			$this->header[] = 'Date: ' . date('r');
			$this->header[] = 'Message-Id: ' . '<' . getenv('REMOTE_ADDR') . '.' . time() . '.openrat@' . getenv('SERVER_NAME') . '.' . getenv('HOSTNAME') . '>';

			//observe the . after the newline, it signals the end of message
			$smtpResponse = $this->sendSmtpCommand($smtpSocket, implode($this->nl, $this->header) . $this->nl . $this->nl . $text . $this->nl . '.');
			if (substr($smtpResponse, 0, 3) != '250') {
				$this->error[] = "No 2xx after putting DATA, server says: " . $smtpResponse;
				$this->sendSmtpQuit($smtpSocket);
				return false;
			}

			// say goodbye
			$this->sendSmtpQuit($smtpSocket);
			return true;
		}
	}


	/**
	 * Sendet ein SMTP-Kommando zum SMTP-Server.
	 *
	 * @access private
	 * @param Resource $socket TCP/IP-Socket zum SMTP-Server
	 * @param unknown_type $cmd SMTP-Kommando
	 * @return Server-Antwort
	 */
	private function sendSmtpCommand($socket, $cmd)
	{
		if ($this->debug)
			$this->error[] = 'CLIENT: >>> ' . trim($cmd);
		if (!is_resource($socket)) {
			// Die Verbindung ist geschlossen. Dies kann bei dieser
			// Implementierung eigentlich nur dann passieren, wenn
			// der Server die Verbindung schlie�t.
			// Dieser Client trennt die Verbindung nur nach einem "QUIT".
			$this->error[] = "Connection lost";
			return;
		}

		fputs($socket, $cmd . $this->nl);
		$response = trim(fgets($socket, 4096));
		if ($this->debug)
			$this->error[] = 'SERVER: <<< ' . $response;
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

		if ($this->debug)
			$this->error[] = "CLIENT: >>> QUIT";
		if (!is_resource($socket))
			return;
		// Wenn die Verbindung nicht mehr da ist, brauchen wir
		// auch kein QUIT mehr :)


		fputs($socket, 'QUIT' . $this->nl);
		$response = trim(fgets($socket, 4096));
		if ($this->debug)
			$this->error[] = 'SERVER: <<< ' . $response;

		if (substr($response, 0, 3) != '221')
			$this->error[] = 'QUIT FAILED: ' . $response;

		fclose($socket);
	}


	/**
	 * Umwandlung von 8-bit-Zeichen in MIME-Header gemaess RFC 2047.<br>
	 * Header d�rfen nur 7-bit-Zeichen enthalten. 8-bit-Zeichen m�ssen kodiert werden.
	 *
	 * @param String $text
	 * @return String
	 */
	private function header_encode($text)
	{
		global $conf;

		if (empty($conf['mail']['header_encoding']))
			return $text;

		$woerter = explode(' ', $text);
		$neu = array();


		foreach ($woerter as $wort) {
			$type = strtolower(substr($conf['mail']['header_encoding'], 0, 1));
			$neu_wort = '';

			if ($type == 'b')
				$neu_wort = base64_encode($wort);
			elseif ($type == 'q')
				$neu_wort = $this->quoted_printable_encode($wort);
			else
				throw new LogicException('Mail-Configuration broken: UNKNOWN Header-Encoding type: ' . $type);

			if (strlen($wort) == strlen($neu_wort))
				$neu[] = $wort;
			else
				$neu[] = '=?UTF-8?' . $type . '?' . $neu_wort . '?=';
		}

		return implode(' ', $neu);
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
			$this->error[] = 'Illegal mail address - No hostname found.';
			return "";
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


	/**
	 * Stellt fest, ob die E-Mail-Adresse eine gueltige Syntax besitzt.
	 *
	 * Es wird nur die Syntax geprüft. Ob die Adresse wirklich existiert, steht dadurch noch lange
	 * nicht fest. Dazu müsste man die MX-Records auflösen und einen Zustellversuch unternehmen.
	 *
	 * @param $email_address Adresse
	 * @return true, falls Adresse OK, sonst false
	 */
	function checkAddress($email_address)
	{
		// Source: de.php.net/ereg
		return ereg("^[-A-Za-z0-9_]+[-A-Za-z0-9_.]*[@]{1}[-A-Za-z0-9_]+[-A-Za-z0-9_.]*[.]{1}[A-Za-z]{2,5}$", $email_address);
	}


	/**
	 * Prüft, ob eine Domain in einer List von Domains enthalten ist.
	 *
	 * @param $checkDomain string zu prüfende Domain
	 * @param $domain_list string Liste von Domains als kommaseparierte Liste
	 * @return true, falls vorhanden, sonst false
	 */
	private static function containsDomain($checkDomain, $domain_list)
	{
		$domains = explode(',', $domain_list);

		foreach ($domains as $domain) {
			$domain = trim($domain);

			if (empty($domain))
				continue;

			if ($domain == substr($checkDomain, -strlen($domain))) {
				return true;
			}
		}
		return false;
	}
}


?>
