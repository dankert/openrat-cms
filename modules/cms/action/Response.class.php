<?php

namespace cms\action;

use cms\api\Notice;
use cms\base\Language as L;
use cms\base\Startup;
use logger\Logger;
use util\Session;

/**
 * Response.
 */
class Response
{
	protected array $header  = [];

	protected array $errors  = [];
	protected array $notices = [];
	protected array $output  = [];
	protected string $status  = Action::NOTICE_OK;
	public bool $success = true;

	public function addHeader( $name, $value ) {
		$this->header[$name] = $value;
	}


	public function addOutput( $name, $value ) {
		$this->output[$name] = $value;
	}
	public function addOutputList( $list ) {
		$this->output += $list;
	}


	public function setContentSecurityPolicy( $csp ) {

		// Content Security Policy
		$this->header['Content-Security-Policy'] = implode(';', array_map( function($value,$key) {
				return $key.' '.$value;
			},$csp,array_keys($csp) ));
	}


	/**
	 * Sets the content type.
	 * @param $type string
	 * @param $charset string Default: UTF-8
	 */
	public function setContentType( $type, $charset = Startup::CHARSET) {
		$this->header['Content-Type'] = $type.'; charset=' . $charset;
	}

	/**
	 * Getting the response data as an array.
	 *
	 * @return array
	 */
	public function getOutputData(): array
	{
		return $this->output;
	}


	public function __toString()
	{
		return print_r( $this->getOutputData(),true);
	}

	/**
	 * Outputs all HTTP reponse headers.
	 */
	public function setHTTPHeader() {
		foreach( $this->header as $name=>$value ) {
			header( $name.': '.$value );
		}
	}




	/**
	 * F�gt ein Meldung hinzu.
	 *
	 * @param String $type Typ des Objektes, zu dem diese Meldung geh�rt.
	 * @param $id
	 * @param String $name Name des Objektes, zu dem diese Meldung geh�rt.
	 * @param String $text Textschl�ssel der Fehlermeldung (optional)
	 * @param String $status Einer der Werte Action::NOTICE_(OK|WARN|ERROR)
	 * @param array $vars Variablen f�r den Textschl�ssel
	 * @param string|array $log Weitere Hinweistexte f�r diese Meldung.
	 */
	public function addNotice($type, $id, $name, $text, $status = Action::NOTICE_OK, $vars = array(), $log = array()): void
	{
		$this->status  = ($status == Action::NOTICE_ERROR) ? Action::NOTICE_ERROR : $status;
		$this->success = $this->success && $status != Action::NOTICE_ERROR;

		if ( is_array($log) )
			$log = implode("\n",$log);

		$vars = (array) $vars;

		$this->notices[] = new Notice(
			$type,
			intval($id),
			$name,
			$text,
			$vars,
			L::lang($text, $vars),
			(array) $log,
			$status,
		);

	}



	public function addError( $errorField ) {
		$this->errors[] = $errorField;
	}


	public function hasHeader($string)
	{
		return array_key_exists($string , $this->header );
	}

	/**
	 * @return string
	 */
	public function getStatus(): string
	{
		return $this->status;
	}

	/**
	 * @return array
	 */
	public function getNotices(): array
	{
		return $this->notices;
	}

	/**
	 * @return array
	 */
	public function getErrors(): array
	{
		return $this->errors;
	}
}