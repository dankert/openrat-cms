<?php

namespace cms\action;

use util\exception\ValidationException;
use util\json\JSON;
use util\mail\Mail;
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



	/**
	 * Ermittelt den Inhalt der gew�nschten Request-Variablen.
	 * Falls nicht vorhanden, wird "" zur�ckgegeben.
	 *
	 * @param String $varName Schl�ssel
	 * @return String Inhalt
	 */
	protected function getValue($varName)
	{
		if   ( ! $this->hasKey($varName) )
			return null;

		return $this->parameter[$varName];
	}

	protected function requireVar( $varName )
	{
		if   ( ! $this->hasKey($varName) )
			throw new ValidationException( $varName );

		return;
	}


	public function getAlphanum($varName ) {
		return Text::clean( $this->getValue($varName), 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789.,_-!?%&/()' );
	}


	public function getFilename($varName ) {

		// RFC 1738, Section 2.2:
		// Thus, only alphanumerics, the special characters "$-_.+!*'(),", and
		// reserved characters used for their reserved purposes may be used
		// unencoded within a URL.
		return Text::clean( $this->getValue($varName), 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789$-_.+!*(),\'' );
	}


	/**
	 * Gets a mail adress out of the request.
	 *
	 * Throws a ValidationException if the mail adress is not valid.
	 *
	 * @param $varName
	 * @return String
	 */
	public function getValidMail($varName ) {

		$adress = Text::clean( $this->getValue($varName), 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789._-+@' );

		if   ( ! Mail::checkAddress( $adress ) )
			throw new ValidationException( $varName );

		return $adress;
	}


	public function getRaw($varName ) {
		return $this->getValue( $varName );
	}


	/**
	 * Get required parameter value.
	 *
	 * @param $varName
	 * @return String|null
	 * @throws ValidationException
	 */
	public function getRequiredRaw($varName ) {

		$this->requireVar( $varName );

		return $this->getValue( $varName );
	}


	/**
	 * @param $varName
	 * @return string|null
	 */
	public function getText( $varName ) {

		if   ( ! $this->hasKey($varName ))
			return null;

		// Allow all UTF-8 characters.
		return mb_convert_encoding($this->getValue($varName), 'UTF-8', 'UTF-8');
	}


	/**
	 * Gets the value of the request parameter.
	 *
	 * @param $nameOfRequestParameter
	 * @return String
	 * @throws ValidationException
	 */
	public function getRequiredText( $nameOfRequestParameter ) {

		$this->requireVar( $nameOfRequestParameter );

		return $this->getText( $nameOfRequestParameter );
	}


	/**
	 * Checks if the request contains the parameter.
	 *
	 * @param String $varName Schl�ssel
	 * @return boolean true, falls vorhanden.
	 */
	public function hasKey($varName)
	{
		return isset( $this->parameter[$varName] );
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


	/**
	 * Gets the ID for the current action.
	 *
	 * @return Integer
	 */
	public function getId()
	{
		return $this->getAlphanum( self::PARAM_ID );
	}


	/**
	 * Ermittelt die aktuelle Id aus dem Request.<br>
	 * Um welche ID es sich handelt, ist abh�ngig von der Action.
	 *
	 * @param string $varName name of parameter
	 * @return Integer
	 */
	public function getNumber( $varName )
	{
		if    ( ! $this->hasKey($varName ))
			return null;

		return intval($this->getValue( $varName ));
	}


	/**
	 * Checks if the parameter value is true.
	 *
	 * @param string $varName name of parameter
	 * @return Integer
	 */
	public function isTrue( $varName )
	{
		return boolval($this->getValue( $varName ));
	}




	/**
	 * Ermittelt die aktuelle Id aus dem Request.<br>
	 * Um welche ID es sich handelt, ist abh�ngig von der Action.
	 *
	 * @param string $varName name of parameter
	 * @return Integer
	 */
	public function getRequiredNumber($varName )
	{
		$this->requireVar( $varName );

		return $this->getNumber( $varName );
	}


	public function hasLanguageId()
	{
		return $this->has(self::PARAM_LANGUAGE_ID);
	}

	public function getLanguageId()
	{
		return $this->getNumber(self::PARAM_LANGUAGE_ID);
	}


	public function hasModelId()
	{
		return $this->has(self::PARAM_MODEL_ID);
	}

	public function getModelId()
	{
		return $this->getNumber(self::PARAM_MODEL_ID );
	}


	public function getProjectId()
	{
		return $this->getNumber(self::PARAM_PROJECT_ID );
	}


	public function getDatabaseId()
	{
		return $this->getAlphanum(self::PARAM_DATABASE_ID );
	}


	public function getToken()
	{
		return $this->getAlphanum(self::PARAM_TOKEN );
	}


	public function __toString() {
		return 'Request '.$this->action.'/'.$this->method.'/'.$this->id;
	}
}