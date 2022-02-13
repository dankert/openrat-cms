<?php

namespace cms\action;

use cms\base\Language as L;
use cms\base\Startup;
use util\Session;

/**
 * Response.
 */
class Response
{
	protected $header  = [];

	protected $errors  = [];
	protected $notices = [];
	protected $output  = [];
	protected $status  = Action::NOTICE_OK;
	public    $success = true;

	public function addHeader( $name, $value ) {
		$this->header[$name] = $value;
	}


	public function addOutput( $name, $value ) {
		$this->output[$name] = $value;
	}
	public function addOutputList( $list ) {
		$this->output += $list;
	}


	/**
	 * Getting the response data as an array.
	 *
	 * @return array
	 */
	public function getOutputData()
	{
		return [
			'output'        => $this->output,
			'notices'       => $this->notices, // notices
			'errors'        => $this->errors,  // fieldnames with validation errors
			'status'        => $this->status,  // notice status
			'notice_status' => $this->status,  // same as above, historical reasons
			'success'       => $this->success, // success, true if there are no errors and no notices with status error.
			'session'       => [
				'name'  => session_name(),
				'id'    => session_id(),
				'token' => Session::token()
			],
			'version'       => Startup::VERSION,
			'api'           => Startup::API_LEVEL,
		];
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
	public function addNotice($type, $id, $name, $text, $status = Action::NOTICE_OK, $vars = array(), $log = array())
	{
		$this->status  = ($status == Action::NOTICE_ERROR) ? Action::NOTICE_ERROR : $status;
		$this->success = $this->success && $status != Action::NOTICE_ERROR;

		if ( is_array($log) )
			$log = implode("\n",$log);

		$vars = (array) $vars;

		$this->notices[] = [
			'type'   => $type,
			'id'     => $id  ,
			'name'   => $name,
			'key'    => $text,
			'vars'   => $vars,
			'text'   => L::lang($text, $vars),
			'log'    => $log ,
			'status' => $status];
	}



	public function addError( $errorField ) {
		$this->errors[] = $errorField;
	}


	public function hasHeader($string)
	{
		return array_key_exists($string , $this->header );
	}

}