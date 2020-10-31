<?php

namespace cms\action;

use util\exception\ValidationException;
use util\Text;


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

	/**
	 * @var bool
	 */
	public $isUIAction;

	/**
	 * RequestParams constructor.
	 */
	public function __construct()
	{
		$this->id         = @$_REQUEST[self::PARAM_ID       ];
		$this->action     = @$_REQUEST[self::PARAM_ACTION   ];
		$this->method     = @$_REQUEST[self::PARAM_SUBACTION];

		// Is this a POST request?
		$this->isAction = @$_SERVER['REQUEST_METHOD'] == 'POST';
	}



	public function getRequiredRequestVar( $varName, $transcode ) {
		$value = $this->getRequestVar($varName,$transcode);

		if   ( empty( $value ) )
			throw new ValidationException($varName);

		return $value;
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
		if($varName == self::PARAM_ID)
			return $this->id;

		if($varName == self::PARAM_ACTION)
			return $this->action;

		if($varName == self::PARAM_SUBACTION)
			return $this->method;

		if (!isset($_REQUEST[$varName]))
			return '';

		return $this->cleanText( $_REQUEST[$varName], $transcode );
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
		return (isset($_REQUEST[$varName]) && (!empty($_REQUEST[$varName]) || $_REQUEST[$varName] == '0'));
	}


	public function getRequiredRequestId( $varName ) {

		$id = intval($this->getRequestVar($this->getRequestVar( $varName )));

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