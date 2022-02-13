<?php

namespace cms\action;

use cms\auth\Auth;
use cms\auth\InternalAuth;
use util\exception\SecurityException;
use util\exception\ValidationException;
use util\json\JSON;
use util\mail\Mail;
use util\Text;
use util\XML;
use util\YAML;


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
	const PARAM_OUTPUT       = 'output'         ;

	public $action;
	public $method;
	public $id;

	public $isAction;

	public $headers;
	public $authUser;
	public $authPassword;

	private $parameter;

	/**
	 * @var bool
	 */
	public $isUIAction;


	/**
	 * @var bool
	 */
	public $withAuthorization;

	/**
	 * RequestParams constructor.
	 */
	public function __construct()
	{
		// Is this a POST request?
		$this->isAction = @$_SERVER['REQUEST_METHOD'] == 'POST';
		$this->headers = array_change_key_case(getallheaders(), CASE_LOWER);

		if   ( @$this->headers['authorization'] ) {
			$this->withAuthorization = true;
			// Only supporting Basic Auth
			// Maybe in the future we will support JWT Bearer tokens...
			if   ( substr( $this->headers['authorization'],0,6 ) == 'Basic ' )
				list($this->authUser,$this->authPassword) = explode(':',base64_decode( substr( $this->headers['authorization'],6) ) );
		}

		$this->setParameterStore();

		$this->id     = $this->getId();
		$this->action = $this->getAlphanum(self::PARAM_ACTION   );
		$this->method = $this->getAlphanum(self::PARAM_SUBACTION);
	}


	/**
	 * Setting the source for request parameters.
	 */
	protected function setParameterStore() {


		$contenttype = trim(explode( ';',@$this->headers['content-type'])[0]);

		if   ( !$this->isAction )
			$this->parameter = &$_GET;
			// GET method in the HTTP/1.1 spec, section 9.3:
			// The GET method means retrieve whatever information ([...]) is identified by the Request-URI.
			// so the request body MUST be ignored here.
		else
			// POST requests are NOT idempotent
			switch( $contenttype ) {
				// These content-types are known by PHP, so we do NOT have to parse them:
				case 'application/x-www-form-urlencoded': // the most used form url encoding
				case 'multipart/form-data':               // Multipart-Formdata for File uploads
				case '':
					$this->parameter = &$_POST; // Using builtin POST data parsing
					break;

				// The request body contains a JSON document
				case 'text/json':
				case 'application/json':
					// parsing the JSON data
					$this->parameter = JSON::decode(file_get_contents("php://input"));
					break;

				case 'text/xml':
				case 'application/xml':
					$this->parameter = (array)simplexml_load_string(file_get_contents("php://input"));
					break;

				case 'application/yaml':
					$this->parameter = YAML::parse(file_get_contents("php://input"));
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


	/**
	 * Redirect to a new action and method.
	 *
	 * @param $action
	 * @param $method
	 */
	public function redirectActionAndMethod( $action, $method ) {

		$this->action = $action;
		$this->method = $method;
	}
}