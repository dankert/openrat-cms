<?php

namespace cms\action;

use cms\base\Configuration;
use cms\base\Language as L;
use cms\model\BaseObject;
use cms\model\ModelBase;
use cms\model\User;
use util\ClassUtils;
use util\exception\ValidationException;
use util\Html;
use util\Session;
use logger\Logger;
use util\Http;
use util\Text;


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

	protected $templateVars = array( 'output'=>array() );

	/**
	 * Aktuell angemeldeter Benutzer.<br>
	 * Wird im Konstruktor gesetzt.
	 *
	 * @var Object Benutzer
	 */
	var $currentUser;

	/**
	 * @var RequestParams
	 */
	public $request;


	/**
	 * Will be called by the Dispatcher right after the contruction of this class instance.
	 */
	public function init()
	{

	}


	public function __construct()
	{
		$this->currentUser = Session::getUser();

		$this->templateVars['errors'] = array();
		$this->templateVars['notices'] = array();
		$this->templateVars['output'] = array();
	}

	/**
	 * Liest eine Session-Variable
	 *
	 * @param String $varName Schl�ssel
	 * @return mixed
	 */
	protected function getSessionVar($varName)
	{
		return Session::get($varName);
	}


	/**
	 * Setzt eine Session-Variable
	 *
	 * @param string $varName Schluessel
	 * @param mixed $value Inhalt
	 * @return mixed
	 */
	protected function setSessionVar($varName, $value)
	{
		Session::set($varName,$value);
	}


	/**
	 * Ermittelt den Inhalt der gew�nschten Request-Variablen.
	 * Falls nicht vorhanden, wird "" zur�ckgegeben.
	 *
	 * @param String $varName Schl�ssel
	 * @return String Inhalt
	 */
	protected function getRequestVar($varName, $transcode = RequestParams::FILTER_TEXT)
	{
		return $this->request->getRequestVar($varName,$transcode);
	}


	/**
	 * Ermittelt, ob der aktuelle Request eine Variable mit dem
	 * angegebenen Namen enth�lt.
	 *
	 * @param String $varName Schl�ssel
	 * @return boolean true, falls vorhanden.
	 */
	protected function hasRequestVar($varName)
	{
		return $this->request->hasRequestVar($varName);
	}


	/**
	 * Ermittelt die aktuelle Id aus dem Request.<br>
	 * Um welche ID es sich handelt, ist abh�ngig von der Action.
	 *
	 * @return Integer
	 */
	protected function getRequestId( $name = null )
	{
		if ( is_null($name) )
			return $this->request->getRequestId();
		else
			return intval($this->request->getRequestVar($name,RequestParams::FILTER_NUMBER));
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


	public function handleResult($result)
	{
		// TODO -
	}


	/**
	 * @param $baseObject ModelBase
	 * @param $key String
	 * @param array $vars
	 * @param string $message
	 */
	protected function addNoticeFor($baseObject,$key,$vars = array(), $message='') {
		$this->addNotice(strtolower(ClassUtils::getSimpleClassName($baseObject)), $baseObject->getId(), $baseObject->getName(), $key, Action::NOTICE_OK, $vars, array($message));
	}

	/**
	 * @param $baseObject ModelBase
	 * @param $key String
	 * @param array $vars
	 * @param string $message
	 */
	protected function addInfoFor($baseObject,$key,$vars = array(), $message='') {
		$this->addNotice(strtolower(ClassUtils::getSimpleClassName($baseObject)), $baseObject->getId(), $baseObject->getName(), $key, Action::NOTICE_INFO, $vars, array($message));
	}

	/**
	 * @param $baseObject ModelBase
	 * @param $key String
	 * @param array $vars
	 * @param string $message
	 */
	protected function addWarningFor($baseObject,$key,$vars = array(), $message='') {
		$this->addNotice(strtolower(ClassUtils::getSimpleClassName($baseObject)), $baseObject->getId(), $baseObject->getName(), $key, Action::NOTICE_WARN, $vars, array($message));
	}

	/**
	 * @param $baseObject ModelBase
	 * @param $key String
	 * @param array $vars
	 * @param string $message
	 */
	protected function addErrorFor($baseObject,$key,$vars = array(), $message='') {
		$this->addNotice(strtolower(ClassUtils::getSimpleClassName($baseObject)), $baseObject->getId(), $baseObject->getName(), $key, Action::NOTICE_ERROR, $vars, array($message));
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
	 * @param array $log Weitere Hinweistexte f�r diese Meldung.
	 */
	protected function addNotice($type, $id, $name, $text, $status = Action::NOTICE_OK, $vars = array(), $log = array())
	{
		if ($status === true)
			$status = Action::NOTICE_OK;
		elseif ($status === false)
			$status = Action::NOTICE_ERROR;

		$this->templateVars['notice_status'] = $status;
		$this->templateVars['status'] = $status;
		$this->templateVars['success'] = ($status == Action::NOTICE_ERROR ? 'false' : 'true');

		if (!is_array($log))
			$log = array($log);

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


	public function getOutputData()
	{
		return $this->templateVars;
	}

	/**
	 * Ruft eine weitere Subaction auf.
	 *
	 * @param String $subActionName Name der n�chsten Subaction. Es muss eine Methode mit diesem Namen geben.
	 * @deprecated
	 */
	protected function callSubAction($subActionName)
	{
		return;
	}


	/**
	 * Calling another action method.
	 *
	 * @param String $method Name of next method to call.
	 */
	protected function nextSubAction($method)
	{
		Logger::trace("next subaction is '$method'");

		$this->request->method = $method;

		$methodName = $method . ($_SERVER['REQUEST_METHOD'] == 'POST' ? 'Post' : 'View');
		$this->$methodName();
	}


	/**
	 * Ermitteln, ob Benutzer Administratorrechte besitzt
	 * @return Boolean TRUE, falls der Benutzer ein Administrator ist.
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


	protected function setCookie($name,$value='' ) {

		if (empty($value))
			$expire = time(); // Cookie wird gelöscht.
		else
			$expire = time() + 60 * 60 * 24 * Configuration::config('security', 'cookie', 'expire');

		$secure   = Configuration::config('security', 'cookie', 'secure');
		$httponly = Configuration::config('security', 'cookie', 'httponly');
		$samesite = Configuration::config('security', 'cookie', 'samesite');

		$cookieAttributes = [
			rawurlencode($name).'='.rawurlencode($value),
			'Expires='.date('r',$expire),
			'Path='.COOKIE_PATH
		];

		if   ( $secure )
			$cookieAttributes[] = 'Secure';

		if   ( $httponly )
			$cookieAttributes[] = 'HttpOnly';

		$cookieAttributes[] = 'SameSite='.$samesite;

		header('Set-Cookie: '.implode('; ',$cookieAttributes) );
	}
}
