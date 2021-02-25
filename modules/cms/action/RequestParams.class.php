<?php

namespace cms\action;

use util\exception\ValidationException;
use util\json\JSON;
use util\Text;
use util\XML;


class RequestParams
{
	const PARAM_TOKEN        = 'token'          ;
	const PARAM_ACTION       = 'action'         ;
	const PARAM_SUBACTION    = 'subaction'      ;
	const PARAM_ID           = 'id'             ;
	const PARAM_OBJECT_ID    = 'objectid'       ;
	const PARAM_LANGUAGE_ID  = 'languageid'     ;
	const PARAM_MODEL_ID     = 'modelid'        ;
	const PARAM_PROJECT_ID   = 'projectid'      ;
	const PARAM_ELEMENT_ID   = 'elementid'      ;
	const PARAM_TEMPLATE_ID  = 'templateid'     ;
	const PARAM_DATABASE_ID  = 'dbid'           ;

	/* Filter Types */
	const FILTER_ALPHA    ='abc';
	const FILTER_ALPHANUM ='abc123';
	const FILTER_FILENAME = 'file';
	const FILTER_MAIL     = 'mail';
	const FILTER_TEXT     = 'text';
	const FILTER_NUMBER   = '123';
	const FILTER_RAW      = 'raw';

	public $action;
	public $method;
	public $id;

	public $isAction;

	private $parameter;

	/**
	 * @var bool
	 */
	public $isUIAction;

	/**
	 * RequestParams constructor.
	 */
	public function __construct()
	{
		$headers = array_change_key_case(getallheaders(), CASE_LOWER);

		// Is this a POST request?
		$this->isAction = @$_SERVER['REQUEST_METHOD'] == 'POST';

		$contenttype = trim(explode( ';',@$headers['content-type'])[0]);

		if   ( !$this->isAction )
			$this->parameter = &$_GET;
		else
			switch( $contenttype ) {
				case 'application/x-www-form-urlencoded': // the most used form url encoding
				case 'multipart/form-data':               // Multipart-Formdata for File uploads
				case '':
					$this->parameter = &$_POST; // Using builtin POST data parsing
					break;

				case 'text/json':
				case 'application/json':
					// parsing the JSON data
					$this->parameter = JSON::decode(file_get_contents("php://input"));
					break;

				case 'text/xml':
				case 'application/xml':
					$this->parameter = (array)simplexml_load_string(file_get_contents("php://input"));
					break;

				default:
					// Unknown content type
					throw new \LogicException('HTTP-POST with unknown content type: ' . $contenttype);
			}

		$this->id     = $this->getRequestId();
		$this->action = $this->getRequestAlphanum(self::PARAM_ACTION   );
		$this->method = $this->getRequestAlphanum(self::PARAM_SUBACTION);
	}



	public function getRequiredRequestVar( $varName, $transcode ) {

		$value = $this->getRequestVar($varName,$transcode);

		if   ( empty( $value ) )
			throw new ValidationException($varName);

		return $value;
	}


	/**
	 * Gets the value of the request parameter.
	 *
	 * @param $nameOfRequestParameter
	 * @return String
	 * @throws ValidationException
	 */
	public function getRequiredText( $nameOfRequestParameter ) {
		return $this->getRequiredRequestVar( $nameOfRequestParameter, self::FILTER_TEXT );
	}

	/**
	 * Ermittelt den Inhalt der gew�nschten Request-Variablen.
	 * Falls nicht vorhanden, wird "" zur�ckgegeben.
	 *
	 * @param String $varName Schl�ssel
	 * @return String Inhalt
	 */
	public function getRequestVar($varName, $transcode = self::FILTER_TEXT)
	{
		if (!isset($this->parameter[$varName]))
			return '';

		return $this->cleanText( $this->parameter[$varName], $transcode );
	}


	public function getRequestAlphanum( $varName ) {
		return $this->getRequestVar( $varName,self::FILTER_ALPHANUM );
	}

	public function cleanText( $value, $transcode )
	{
		switch ($transcode) {
			case self::FILTER_ALPHA:
				$white = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
				break;

			case self::FILTER_ALPHANUM:
				$white = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789.,_-!?%&/()';
				break;

			case self::FILTER_FILENAME:
				// RFC 1738, Section 2.2:
				// Thus, only alphanumerics, the special characters "$-_.+!*'(),", and
				// reserved characters used for their reserved purposes may be used
				// unencoded within a URL.
				$white = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789$-_.+!*(),' . "'";
				break;

			case self::FILTER_MAIL:
				$white = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789._-@';
				break;

			case self::FILTER_TEXT:
				// Allow all UTF-8 characters.
				return mb_convert_encoding($value, 'UTF-8', 'UTF-8');

			case self::FILTER_NUMBER:
				$white = '1234567890.';
				break;

			case self::FILTER_RAW:
				return $value;

			default:
				throw new \LogicException('Unknown request filter', 'not found: ' . $transcode);
		}

		return Text::clean($value, $white);
	}

	/**
	 * Ermittelt, ob der aktuelle Request eine Variable mit dem
	 * angegebenen Namen enth�lt.
	 *
	 * @param String $varName Schl�ssel
	 * @return boolean true, falls vorhanden.
	 */
	public function hasRequestVar($varName)
	{
		return (isset($this->parameter[$varName]) && (!empty($this->parameter[$varName]) || $this->parameter[$varName] == '0'));
	}


	public function getRequiredRequestId( $varName ) {

		$id = intval($this->getRequestVar( $varName ));

		if   ( $id == 0 )
			throw new ValidationException($varName);

		return $id;
	}

	/**
	 * Ermittelt die aktuelle Id aus dem Request.<br>
	 * Um welche ID es sich handelt, ist abh�ngig von der Action.
	 *
	 * @return Integer
	 */
	public function getRequestId()
	{
		if ($this->hasRequestVar('idvar'))
			return intval($this->getRequestVar($this->getRequestVar('idvar')));
		else
			return intval($this->getRequestVar(self::PARAM_ID));
	}


	public function hasLanguageId()
	{
		return $this->hasRequestVar(self::PARAM_LANGUAGE_ID);
	}

	public function getLanguageId()
	{
		return $this->getRequestVar(self::PARAM_LANGUAGE_ID,self::FILTER_NUMBER);
	}

	public function hasModelId()
	{
		return $this->hasRequestVar(self::PARAM_MODEL_ID);
	}

	public function getModelId()
	{
		return $this->getRequestVar(self::PARAM_MODEL_ID,self::FILTER_NUMBER);
	}
	public function getProjectId()
	{
		return $this->getRequestVar(self::PARAM_PROJECT_ID,self::FILTER_NUMBER);
	}

	public function getToken()
	{
		return $this->getRequestVar(self::PARAM_TOKEN,self::FILTER_ALPHANUM);
	}


	public function __toString() {
		return 'Request '.$this->action.'/'.$this->method.'/'.$this->id;
	}
}