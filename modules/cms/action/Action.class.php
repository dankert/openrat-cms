<?php

namespace cms\action;

use cms\base\Configuration;
use cms\base\Language as L;
use cms\model\ModelBase;
use cms\model\User;
use logger\Logger;
use util\Cookie;
use util\ClassUtils;
use util\Session;


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
class Action
{
	const SECURITY_GUEST = 1; // Jeder (auch nicht angemeldete) dürfen diese Aktion ausführen
	const SECURITY_USER  = 2; // Angemeldete Benutzer dürfen diese Aktion ausführen
	const SECURITY_ADMIN = 3; // Nur Administratoren dürfen diese Aktion ausführen

	const NOTICE_OK    = 'ok';
	const NOTICE_INFO  = 'info';
	const NOTICE_WARN  = 'warning';
	const NOTICE_ERROR = 'error';

	public $security = self::SECURITY_USER; // Default.

	protected $templateVars = [
		'errors'  => [],
		'notices' => [],
		'output'  => []
	];

	/**
	 * Current user.
	 *
	 * @var User User
	 */
	public $currentUser;

	/**
	 * Request
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
	}



	/**
	 * Setzt eine Variable f�r die Oberfl�che.
	 *
	 * @param String $varName Schl�ssel
	 * @param Mixed $value
	 */
	protected function setTemplateVar($varName, $value)
	{
		$this->templateVars['output'][$varName] = $value;
	}


	/**
	 * Setzt eine Liste von Variablen f�r die Oberfl�che.
	 *
	 * @param array $varList Assoziatives Array
	 */
	protected function setTemplateVars($varList)
	{
		foreach ($varList as $name => $value) {
			$this->setTemplateVar($name, $value);
		}
	}


	/**
	 * F�gt einen Validierungsfehler hinzu.
	 *
	 * @param String $name Name des validierten Eingabefeldes
	 * @param String Textschl�ssel der Fehlermeldung (optional)
	 */
	public function addValidationError($name, $message = "COMMON_VALIDATION_ERROR", $vars = array(), $log = array())
	{
		if (!empty($message))
			$this->addNotice('', 0, '', $message, Action::NOTICE_ERROR, $vars, $log);

		$this->templateVars['errors'][] = $name;
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

		$this->addNotice($type,$id,$name, $key, $noticeType, $vars, $message);
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
	private function addNotice($type, $id, $name, $text, $status = Action::NOTICE_OK, $vars = array(), $log = array())
	{
		if ($status === true)
			$status = Action::NOTICE_OK;
		elseif ($status === false)
			$status = Action::NOTICE_ERROR;

		$this->templateVars['notice_status'] = $status;
		$this->templateVars['status'] = $status;
		$this->templateVars['success'] = ($status == Action::NOTICE_ERROR ? 'false' : 'true');

		if ( is_array($log) )
			$log = implode("\n",$log);

		if (!is_array($vars))
			$vars = array($vars);

		$this->templateVars['notices'][] = [
			'type'   => $type,
			'id'     => $id  ,
			'name'   => $name,
			'key'    => $text,
			'vars'   => $vars,
			'text'   => L::lang($text, $vars),
			'log'    => $log ,
			'status' => $status];
	}


	/**
	 * Getting the output data.
	 *
	 * @return array[]
	 */
	public function getOutputData()
	{
		return $this->templateVars;
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
		header('Expires: '       . $expires);
		header('Last-Modified: ' . $lastModified);
		header('ETag: '          . $etag);

		// Die vom Interpreter sonst automatisch gesetzten
		// Header uebersteuern
		header('Cache-Control: must-revalidate');
		header('Pragma:');

		// See if the client has provided the required headers
		$if_modified_since = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ? stripslashes($_SERVER['HTTP_IF_MODIFIED_SINCE']) : false;
		$if_none_match = isset($_SERVER['HTTP_IF_NONE_MATCH']) ? stripslashes($_SERVER['HTTP_IF_NONE_MATCH']) : false;

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
	 * @param $max int max Anzahl der Sekunden, die die Seite im Browsercache bleiben darf
	 */
	protected function maxAge($max = 3600)
	{
		// Die Header "Last-Modified" und "ETag" wurden bereits in der
		// Methode "lastModified()" gesetzt.

		header('Expires: ' . substr(date('r', time() - date('Z') + $max), 0, -5) . 'GMT');
		header('Pragma: '); // 'Pragma' ist Bullshit und
		// wird von den meisten Browsern ignoriert.
		header('Cache-Control: public, max-age=' . $max . ", s-maxage=" . $max);
	}


	/**
	 * Language ISO code.
	 */
	const COOKIE_LANGUAGE = 'or_language';

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
	 * Timezone offset
	 */
	const COOKIE_TIMEZONE_OFFSET = 'or_timezone_offset';


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
