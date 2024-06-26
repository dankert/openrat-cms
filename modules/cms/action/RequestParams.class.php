<?php

namespace cms\action;

use util\exception\ValidationException;
use util\json\JSON;
use util\mail\Mail;
use util\Text;
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

	/**
	 * Request headers.
	 * @var array
	 */

	public $headers;
	public $authUser;
	public $authPassword;
	public $authToken;

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

		$this->tryBasicAuthorization();

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
	 * @param $varName string name of request parameter
	 * @param $callback callable only called if the request parameter is given by the client
	 */
	public function handleText( $varName,$callback ) {

		if   ( $this->hasKey($varName ) )
			call_user_func( $callback, $this->getText($varName) );
	}

	/**
	 * @param $varName
	 * @param $callback
	 */
	public function handleNumber( $varName,$callback ) {

		if   ( $this->hasKey($varName ) )
			call_user_func( $callback, $this->getNumber($varName) );
	}

	/**
	 * @param $varName
	 * @param $callback
	 */
	public function handleBool($varName, $callback ) {

		call_user_func( $callback, $this->isTrue($varName) );
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
	 * Gets the value of the request parameter.
	 *
	 * @param $nameOfRequestParameter
	 * @return String
	 * @throws ValidationException
	 */
	public function getNotEmptyText( $nameOfRequestParameter ) {

		if   ( $value = $this->getRequiredText( $nameOfRequestParameter ) )
			return $value;
		else
			return new ValidationException( $nameOfRequestParameter );
	}



	/**
	 * Checks if the request contains the parameter.
	 *
	 * @param String $varName Schl�ssel
	 * @return boolean true, falls vorhanden.
	 */
	protected function hasKey($varName)
	{
		return isset( $this->parameter[$varName] );
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
	 * Ermittelt einen Float-Wert aus dem Request.<br>
	 *
	 * @param string $varName name of parameter
	 * @return Float
	 */
	public function getFloat( $varName )
	{
		if    ( ! $this->hasKey($varName ))
			return null;

		return floatval($this->getValue( $varName ));
	}
	/**
	 * Checks if the parameter value is true.
	 *
	 * @param string $varName name of parameter
	 * @return Integer
	 */
	public function isTrue( $varName )
	{
		return in_array( $this->getValue($varName),['1','true','on']);
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


	public function getLanguageId()
	{
		return $this->getNumber(self::PARAM_LANGUAGE_ID);
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


	/**
	 * Basic Authorization.
	 *
	 * Try login with basic authorization. This is useful for API clients, they to not need to track a session with cookies.
	 */
	private function tryBasicAuthorization()
	{
		if   ( $auth = @$this->headers['authorization'] ) {

			$this->withAuthorization = true;
			list( $type,$value ) = array_pad( explode(' ',$auth),2,'');
			switch( $type ) {
				case 'Basic':
					list($this->authUser,$this->authPassword) = array_pad(explode(':',base64_decode( $value )),2,'' );
					break;
				case 'Bearer':
					$this->authToken = $value;
					break;
				default:
					// Only supporting Basic Auth and Bearer Auth
					error_log('Only supporting Basic and Bearer authorization. Authorization header will be ignored.');
			}

		}
	}
}