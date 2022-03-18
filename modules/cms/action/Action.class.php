<?php

namespace cms\action;

use cms\base\Configuration;
use cms\base\Language as L;
use cms\model\ModelBase;
use cms\model\User;
use language\Messages;
use logger\Logger;
use util\Cookie;
use util\ClassUtils;
use util\exception\SecurityException;
use util\Session;
use util\text\TextMessage;


/**
 * Eltern-Klasse fuer alle Actions.
 *
 * Diese Klasse stellt grundlegende action-uebergreifende Methoden
 * bereit.
 * Dient als Ueberklasse fuer alle abgeleiteten Action-Klassen in
 * diesem Package bzw. Verzeichnis.
 *
 * @author Jan Dankert
 * @package openrat.actions
 * @abstract
 */
abstract class Action
{
	const NOTICE_OK    = 'ok';
	const NOTICE_INFO  = 'info';
	const NOTICE_WARN  = 'warning';
	const NOTICE_ERROR = 'error';

	/**
	 * Checks if the actual action is allowed.
	 */
	abstract function checkAccess();


	/**
	 * The Response to the actual request.
	 *
	 * @var Response
	 */
	public $response;

	/**
	 * Current user.
	 *
	 * @var User User
	 */
	public $currentUser;

	/**
	 * Request.
	 *
	 * @var RequestParams
	 */
	public $request;


	/**
	 * Will be called by the Dispatcher right after the conStruction of this class instance.
	 */
	public function init()
	{

	}


	public function __construct()
	{
		$this->currentUser = Session::getUser();
		$this->response    = new Response();
	}



	/**
	 * Setzt eine Variable f�r die Oberfl�che.
	 *
	 * @param String $varName Schl�ssel
	 * @param Mixed $value
	 */
	protected function setTemplateVar($varName, $value)
	{
		$this->response->addOutput( $varName, $value );
	}


	/**
	 * Setzt eine Liste von Variablen f�r die Oberfl�che.
	 *
	 * @param array $varList Output variables
	 */
	protected function setTemplateVars($varList)
	{
		$this->response->addOutputList( $varList );
	}


	/**
	 * Adding a HTTP header.
	 *
	 * @param $name
	 * @param $value
	 */
	protected function addHeader( $name, $value ) {
		$this->response->addHeader( $name, $value );
	}


	/**
	 * Sets the content security policy.
	 *
	 * @param $csp string content security policy as array
	 */
	protected function setContentSecurityPolicy( $csp ) {
		$this->response->setContentSecurityPolicy( $csp );
	}


	/**
	 * Sets the content type.
	 *
	 * @param $type
	 */
	protected function setContentType( $type ) {
		$this->response->setContentType( $type );
	}

	/**
	 * F�gt einen Validierungsfehler hinzu.
	 *
	 * @param String $name Name des validierten Eingabefeldes
	 * @param String Textschl�ssel der Fehlermeldung (optional)
	 */
	public function addValidationError($name, $message = Messages::COMMON_VALIDATION_ERROR, $vars = array() )
	{
		if ( ! empty($message) )
			$this->addErrorFor( null, $message, $vars );

		$this->response->addError( $name );
	}


	/**
	 * @param $baseObject ModelBase
	 * @param $key String
	 * @param array $vars
	 * @param string|array $message
	 */
	protected function addNoticeFor($baseObject,$key,$vars = array(), $message='') {
		$this->addNoticeInternal($baseObject, $key, Action::NOTICE_OK, $vars, $message);
	}

	/**
	 * @param $baseObject ModelBase
	 * @param $key String
	 * @param array $vars
	 * @param string $message
	 */
	protected function addInfoFor($baseObject,$key,$vars = array(), $message='') {
		$this->addNoticeInternal($baseObject, $key, Action::NOTICE_INFO, $vars, $message);
	}

	/**
	 * @param $baseObject ModelBase
	 * @param $key String
	 * @param array $vars
	 * @param string $message
	 */
	protected function addWarningFor($baseObject,$key,$vars = array(), $message='') {
		$this->addNoticeInternal($baseObject, $key, Action::NOTICE_WARN, $vars, $message);
	}

	/**
	 * @param $baseObject ModelBase
	 * @param $key String
	 * @param array $vars
	 * @param string $message
	 */
	protected function addErrorFor($baseObject,$key,$vars = array(), $message='') {

		$this->addNoticeInternal( $baseObject, $key, Action::NOTICE_ERROR, $vars, $message);
	}



	private function addNoticeInternal($baseObject,$key,$noticeType,$vars, $message) {

		if	( is_object($baseObject) ) {
			$type = strtolower(ClassUtils::getSimpleClassName($baseObject));
			$id   = $baseObject->getId();
			$name = $baseObject->getName();
		} else {
			$type = '';
			$id   = '';
			$name = '';
		}

		$this->response->addNotice($type,$id,$name, $key, $noticeType, $vars, $message);
	}



	public function getResponse() {
		return $this->response;
	}


	/**
	 * Has the current user administration rights?
	 *
	 * @return boolean true, if current user is an administrator
	 */
	protected function userIsAdmin()
	{
		$user = $this->getUserFromSession();

		return is_object($user) && $user->isAdmin;
	}


	/**
	 * Ermitteln des Benutzerobjektes aus der Session
	 * @return User
	 */
	protected function getUserFromSession()
	{
		return Session::getUser();
	}


	/**
	 * Returns the current user id if there is one.
	 * @return int|null
	 */
	protected function getCurrentUserId() {

		$user = $this->getUserFromSession();
		if   ( $user )
			return $user->userid;
		else
			return null;
	}

	/**
	 * Using the HTTP-Caching, the "Conditional GET".
	 *
	 * The HTTP-header "Last-Modified" is set.
	 *
	 * Ist der Inhalt der Seite nicht neuer, so wird der Inhalt
	 * der Seite nicht ausgegeben, sondern nur HTTP-Status 304
	 * ("304 not modified") gesetzt.
	 * Der Rest der Seite muss dann nicht mehr erzeugt werden,
	 * wodurch die Performance stark erhoeht werden kann.
	 *
	 * Credits: Thanks to Charles Miller
	 * @see http://fishbowl.pastiche.org/2002/10/21/http_conditional_get_for_rss_hackers
	 *
	 * Found here:
	 * @see http://simon.incutio.com/archive/2003/04/23/conditionalGet
	 *
	 * @param $time int Last modification timestamp of this resource
	 * @param $expirationDuration int Gültigkeitsdauer
	 */
	protected function lastModified($time, $expirationDuration = 0)
	{
		if   ( DEVELOPMENT )
			return;

		// Is HTTP-Cache enabled by config?
		if ( ! Configuration::subset('cache')->is('conditional_get',true) )
			return;

		$expires      = substr(date('r', time() + $expirationDuration - date('Z')), 0, -5) . 'GMT';
		$lastModified = substr(date('r', $time - date('Z')), 0, -5) . 'GMT';
		$etag         = '"' . base_convert($time, 10, 36) . '"'; // a short representation of the unix timestamp.

		// Header senden
		$this->addHeader('Expires'       , $expires);
		$this->addHeader('Last-Modified' , $lastModified);
		$this->addHeader('ETag'          , $etag);

		// Die vom Interpreter sonst automatisch gesetzten
		// Header uebersteuern
		$this->addHeader('Cache-Control','must-revalidate');
		$this->addHeader('Pragma'       ,'');

		// See if the client has provided the required headers
		$if_modified_since = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ? stripslashes($_SERVER['HTTP_IF_MODIFIED_SINCE']) : false;
		$if_none_match     = isset($_SERVER['HTTP_IF_NONE_MATCH']    ) ? stripslashes($_SERVER['HTTP_IF_NONE_MATCH'    ]) : false;

		// Bug in Apache 2.2, mod_deflat adds '-gzip' to E-Tag
		if (substr($if_none_match, -6) == '-gzip"')
			$if_none_match = substr($if_none_match, 0, -6) . '"';

		// At least one of the headers is there - check them
		if ($if_none_match && $if_none_match != $etag)
			return; // etag is there but doesn't match

		if ($if_modified_since && $if_modified_since != $lastModified)
			return; // if-modified-since is there but doesn't match

		if (!$if_modified_since && !$if_none_match)
			return;

		// Der entfernte Browser bzw. Proxy holt die Seite nun aus seinem Cache
		header('HTTP/1.0 304 Not Modified');
		exit;  // Sofortiges Skript-Ende
	}


	/**
	 * Last used username.
	 */
	const COOKIE_USERNAME = 'or_username';
	/**
	 * Login token.
	 */
	const COOKIE_TOKEN    = 'or_token';

	/**
	 * Database id.
	 */
	const COOKIE_DB_ID    = 'or_dbid';

	/**
	 * Sets a cookie.
	 *
	 * @param $name string cookie name
	 * @param $value string cookie value, null or empty to delete
	 */
	protected function setCookie($name, $value = '' ) {

		Cookie::set( $name, $value );
	}
}
