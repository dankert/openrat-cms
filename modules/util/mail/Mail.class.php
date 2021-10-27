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

namespace util\mail;

use cms\base\Configuration;
use cms\base\Language;
use cms\base\Startup;
use LogicException;
use util\mail\client\SendmailClient;
use util\mail\client\SmtpClient;
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
	/**
	 * Newline characters as defined in RFC 822.
	 */
	const NL = "\r\n";

	private $from    = '';
	private $to      = '';
	private $bcc     = '';
	private $cc      = '';
	private $subject = '';
	private $text    = '';
	private $header  = array();
	private $vars    = [];

	/**
	 * @var string
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


		if ( $mailConfig->has('from'))
			$this->from = $this->header_encode($mailConfig->get('from'));

		// Priorit�t definieren (sofern konfiguriert)
		if ($mailConfig->has('priority'))
			$this->header[] = 'X-Priority: ' . $mailConfig->get('priority');

		$this->header[] = 'X-Mailer: ' . $this->header_encode(Startup::TITLE );
		$this->header[] = 'Content-Type: text/plain; charset=UTF-8';
		$this->subject = $this->header_encode(Language::lang($subjectKey));
		$this->to = $this->header_encode($to);

		$this->text = self::NL . wordwrap(Language::lang($mailKey), 70, self::NL) . self::NL;

		// Signatur anhaengen (sofern konfiguriert)
		$signature = $mailConfig->get('signature',Configuration::subset('application')->get('name',Startup::TITLE) );

		$this->text .= self::NL . '-- ' . self::NL;
		$this->text .= self::NL . $signature;
		$this->text .= self::NL;

		// copy
		if ( $mailConfig->has('cc'))
			$this->cc = $this->header_encode( implode(', ',$mailConfig->get('cc',[])));

		// blind copy
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
		if (in_array(strtolower($mailConfig->get('client','php')),['php','sendmail']))
			$client = new SendmailClient();
		else
			$client = new SmtpClient();

		$client->send(
			$this->to,                 // Empf�nger
			$this->subject,            // Betreff
			$text,                     // Inhalt
			$this->header
		);

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