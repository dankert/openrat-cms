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
	const PARAM_LANGUAGE_ID  = 'languageid'     ;
	const PARAM_MODEL_ID     = 'modelid'        ;
	const PARAM_PROJECT_ID   = 'projectid'      ;
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
		// Is this a POST request?
		$this->isAction = @$_SERVER['REQUEST_METHOD'] == 'POST';

		$this->setParameterStore();

		$this->id     = $this->getId();
		$this->action = $this->getAlphanum(self::PARAM_ACTION   );
		$this->method = $this->getAlphanum(self::PARAM_SUBACTION);
	}


	/**
	 * Setting the source for request parameters.
	 */
	protected function setParameterStore() {

		$headers = array_change_key_case(getallheaders(), CASE_LOWER);

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

	}


	public function getRequiredVar($varName, $transcode ) {

		$value = $this->getVar($varName,$transcode);

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
		return $this->getRequiredVar( $nameOfRequestParameter, self::FILTER_TEXT );
	}


	/**
	 * Ermittelt den Inhalt der gew�nschten Request-Variablen.
	 * Falls nicht vorhanden, wird "" zur�ckgegeben.
	 *
	 * @param String $varName Schl�ssel
	 * @return String Inhalt
	 */
	public function getVar($varName, $transcode = self::FILTER_TEXT)
	{
		if (!isset($this->parameter[$varName]))
			return '';

		return $this->cleanText( $this->parameter[$varName], $transcode );
	}


	public function getAlphanum($varName ) {
		return $this->getVar( $varName,self::FILTER_ALPHANUM );
	}

	public function getRaw($varName ) {
		return $this->getVar( $varName,self::FILTER_RAW );
	}

	public function getText($varName ) {
		return $this->getVar( $varName,self::FILTER_TEXT );
	}

	/**
	 * Ermittelt, ob der aktuelle Request eine Variable mit dem
	 * angegebenen Namen enth�lt.
	 *
	 * @param String $varName Schl�ssel
	 * @return boolean true, falls vorhanden.
	 */
	public function has($varName)
	{
		return (isset($this->parameter[$varName]) && (!empty($this->parameter[$varName]) || $this->parameter[$varName] == '0'));
	}


	public function getRequiredId($varName ) {

		$id = intval($this->getVar( $varName ));

		if   ( $id == 0 )
			throw new ValidationException($varName);

		return $id;
	}

	/**
	 * Gets the ID for the current action.
	 *
	 * @return Integer
	 */
	public function getId()
	{
		return intval($this->getNumber( self::PARAM_ID ));
	}



	/**
	 * Ermittelt die aktuelle Id aus dem Request.<br>
	 * Um welche ID es sich handelt, ist abh�ngig von der Action.
	 *
	 * @param string $varName name of parameter
	 * @return Integer
	 */
	public function getNumber($varName )
	{
		return $this->getVar( $varName,self::FILTER_NUMBER );
	}




	public function hasLanguageId()
	{
		return $this->has(self::PARAM_LANGUAGE_ID);
	}

	public function getLanguageId()
	{
		return $this->getVar(self::PARAM_LANGUAGE_ID,self::FILTER_NUMBER);
	}

	public function hasModelId()
	{
		return $this->has(self::PARAM_MODEL_ID);
	}

	public function getModelId()
	{
		return $this->getVar(self::PARAM_MODEL_ID,self::FILTER_NUMBER);
	}
	public function getProjectId()
	{
		return $this->getVar(self::PARAM_PROJECT_ID,self::FILTER_NUMBER);
	}

	public function getToken()
	{
		return $this->getVar(self::PARAM_TOKEN,self::FILTER_ALPHANUM);
	}


	protected function cleanText( $value, $transcode )
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



	public function __toString() {
		return 'Request '.$this->action.'/'.$this->method.'/'.$this->id;
	}
}