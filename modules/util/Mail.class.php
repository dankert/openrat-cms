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
	public $debugLog = array();

	/**
	 * Set to true for debugging.
	 * If true, All SMTP-Commands are written to error log.
	 *
	 * @var bool
	 */
	public $debug = true;
	/**
	 * @var string|string
	 */
	private $mailKey;


	/**
	 * Konstruktor.
	 * Es werden folgende Parameter erwartet
	 * @param String $to Empf�nger
	 * @param string $subjectKey
	 * @param string $mailKey
	 */
	function __construct($to, $subjectKey, $mailKey)
	{
		$mailConfig = Configuration::subset('mail');


		// Zeilenumbruch CR/LF gem. RFC 822.
		$this->nl = chr(13) . chr(10);

		if ( $mailConfig->has('from'))
			$this->from = $this->header_encode($mailConfig->get('from'));

		// Priorit�t definieren (sofern konfiguriert)
		if ($mailConfig->has('priority'))
			$this->header[] = 'X-Priority: ' . $mailConfig->get('priority');

		$this->header[] = 'X-Mailer: ' . $this->header_encode(Startup::TITLE . ' ' . Startup::VERSION);
		$this->header[] = 'Content-Type: text/plain; charset=UTF-8';
		$this->subject = $this->header_encode(Language::lang($subjectKey));
		$this->to = $this->header_encode($to);

		$this->text = $this->nl . wordwrap(Language::lang($mailKey), 70, $this->nl) . $this->nl;

		// Signatur anhaengen (sofern konfiguriert)
		$signature = $mailConfig->get('signature','');
		if ( ! $signature)
			$signature = Configuration::get(['application','name']);

		if ( $signature ) {
			$this->text .= $this->nl . '-- ' . $this->nl;
			$this->text .= $this->nl . $signature;
			$this->text .= $this->nl;
		}

		// Kopie-Empf�nger
		if ( $mailConfig->has('cc'))
			$this->cc = $this->header_encode( implode(', ',$mailConfig->get('cc',[])));

		// Blindkopie-Empf�nger
		if ( $mailConfig->has('bcc'))
			$this->bcc = $this->header_encode( implode(', ',$mailConfig->get('bcc',[])));

		$this->mailKey = $mailKey;
	}


	/**
	 * Kodiert einen Text in das Format "Quoted-printable".<br>
	 * See RFC 2045.
	 * @param string $text Eingabe
	 * @return string Text im quoted-printable-Format
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
	 */
	public function send()
	{
		$mailConfig = Configuration::subset('mail');

		if (strpos($this->to, '@') === FALSE)
			throw new LogicException("E-Mail-Adress does not contain a domain name: " . $this->to);

		$to_domain = explode('@', $this->to)[1];

		// Prüfen gegen die Whitelist
		$white = $mailConfig->get('whitelist',[]);

		if ($white) {
			if (!$this->containsDomain($to_domain, $white)) {
				// Wenn Domain nicht in Whitelist gefunden, dann Mail nicht verschicken.
				throw new LogicException( TextMessage::create('Mail-Domain ${0} is not whitelisted',[$to_domain]));
			}
		}

		// Prüfen gegen die Blacklist
		$black = $mailConfig->get('blacklist',[]);

		if ($black) {
			if ($this->containsDomain($to_domain, $black)) {
				// Wenn Domain in Blacklist gefunden, dann Mail nicht verschicken.
				throw new LogicException( TextMessage::create('Mail-Domain ${0} is blacklisted',[$to_domain]));
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
		if (strtolower($mailConfig->get('client','php')) == 'php') {
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
				throw new LogicException('Mail was NOT accepted by mail(), no further information available. Please look into your system logs.');

		} else {
			// eigenen SMTP-Dialog verwenden.
			$smtpConf = $mailConfig->subset('smtp');

			if ( $smtpConf->has('host')) {
				// Eigenen Relay-Host verwenden.
				$mxHost = $smtpConf->get('host');
				$mxPort = $smtpConf->get('port',25);
			} else {
				// Mail direkt zustellen.
				$mxHost = $this->getMxHost($this->to);

				if (empty($mxHost))
					throw new LogicException( TextMessage::create('No MX-Entry found for ${0}',[$this->to]));

				if ($smtpConf->is('ssl',false))
					$mxPort = 465;
				else
					$mxPort = 25;
			}


			if ($smtpConf->has('localhost')) {
				$myHost = $smtpConf->get('localhost');
			} else {
				$myHost = gethostbyaddr(getenv('REMOTE_ADDR'));
			}

			if ($smtpConf->is('ssl',false))
				$proto = 'ssl';
			else
				$proto = 'tcp';

			//connect to the host and port
			$smtpSocket = fsockopen($proto . '://' . $mxHost, $mxPort, $errno, $errstr, intval($smtpConf['timeout']));

			if (!is_resource($smtpSocket)) {
				throw new LogicException('Connection failed to: ' . $proto . '://' . $mxHost . ':' . $mxPort . ' (' . $errstr . '/' . $errno . ')');
			}

			$smtpResponse = fgets($smtpSocket, 4096);
			if ($this->debug)
				$this->debugLog[] = trim($smtpResponse);

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
				throw new LogicException("No 2xx after HELO, server says: " . $smtpResponse);
			}

			if ($smtpConf['tls']) {
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
			if ( $smtpConf->has('auth_username') && $smtpConf->has('host') ) {
				$smtpResponse = $this->sendSmtpCommand($smtpSocket, "AUTH LOGIN");
				if (substr($smtpResponse, 0, 3) != '334') {
					$this->sendSmtpQuit($smtpSocket);
					throw new LogicException("No 334 after AUTH_LOGIN, server says: " . $smtpResponse);
				}

				if ($this->debug)
					$this->debugLog[] = 'Login for ' . $smtpConf->get('auth_username');

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
			$smtpResponse = $this->sendSmtpCommand($smtpSocket, 'RCPT TO: <' . $this->to . '>');
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

			$this->header[] = 'To: ' . $this->to;
			$this->header[] = 'Subject: ' . $this->subject;
			$this->header[] = 'Date: ' . date('r');
			$this->header[] = 'Message-Id: ' . '<' . getenv('REMOTE_ADDR') . '.' . time() . '.openrat@' . getenv('SERVER_NAME') . '.' . getenv('HOSTNAME') . '>';

			//observe the . after the newline, it signals the end of message
			$smtpResponse = $this->sendSmtpCommand($smtpSocket, implode($this->nl, $this->header) . $this->nl . $this->nl . $text . $this->nl . '.');
			if (substr($smtpResponse, 0, 3) != '250') {
				$this->sendSmtpQuit($smtpSocket);
				throw new LogicException("No 2xx after putting DATA, server says: " . $smtpResponse);
			}

			// say goodbye
			$this->sendSmtpQuit($smtpSocket);
		}
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
		if ($this->debug)
			$this->debugLog[] = 'CLIENT: >>> ' . trim($cmd);
		if (!is_resource($socket)) {
			// Die Verbindung ist geschlossen. Dies kann bei dieser
			// Implementierung eigentlich nur dann passieren, wenn
			// der Server die Verbindung schlie�t.
			// Dieser Client trennt die Verbindung nur nach einem "QUIT".
			$this->debugLog[] = "Connection lost";
			return;
		}

		fputs($socket, $cmd . $this->nl);
		$response = trim(fgets($socket, 4096));
		if ($this->debug)
			$this->debugLog[] = 'SERVER: <<< ' . $response;
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
			$this->debugLog[] = "CLIENT: >>> QUIT";
		if (!is_resource($socket))
			return;
		// Wenn die Verbindung nicht mehr da ist, brauchen wir
		// auch kein QUIT mehr :)


		fputs($socket, 'QUIT' . $this->nl);
		$response = trim(fgets($socket, 4096));
		if ($this->debug)
			$this->debugLog[] = 'SERVER: <<< ' . $response;

		if (substr($response, 0, 3) != '221')
			$this->debugLog[] = 'QUIT FAILED: ' . $response;

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
		$mailConfig = Configuration::subset('mail');

		if (! $mailConfig->has('header_encoding'))
			return $text;

		$woerter = explode(' ', $text);
		$neu = array();


		foreach ($woerter as $wort) {
			$type = strtolower(substr($mailConfig->get('header_encoding','Quoted-printable'), 0, 1));
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


	/**
	 * Stellt fest, ob die E-Mail-Adresse eine gueltige Syntax besitzt.
	 *
	 * Es wird nur die Syntax geprüft. Ob die Adresse wirklich existiert, steht dadurch noch lange
	 * nicht fest. Dazu müsste man die MX-Records auflösen und einen Zustellversuch unternehmen.
	 *
	 * @param $email_address string Adresse
	 * @return true, falls Adresse OK, sonst false
	 */
	public static function checkAddress($email_address)
	{
		// Source: de.php.net/ereg
		return \preg_match("/^[_a-z0-9-+]+(\.[_a-z0-9-+]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $email_address);
	}


	/**
	 * Prüft, ob eine Domain in einer List von Domains enthalten ist.
	 *
	 * @param $checkDomain string zu prüfende Domain
	 * @param $domains string Liste von Domains als kommaseparierte Liste
	 * @return true, falls vorhanden, sonst false
	 */
	private static function containsDomain($checkDomain, $domains)
	{
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

	public function __toString()
	{
		return TextMessage::create('Mail to ${0} with subject key ${1}',[$this->to,$this->mailKey]);
	}
}