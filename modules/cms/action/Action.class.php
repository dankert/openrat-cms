<?php

namespace {

    class ObjectNotFoundException extends Exception
    {
    }


    define('OR_NOTICE_OK', 'ok');
    define('OR_NOTICE_INFO', 'info');
    define('OR_NOTICE_WARN', 'warning');
    define('OR_NOTICE_ERROR', 'error');

}


namespace cms\action {

    use cms\model\User;
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


        protected function setStyle($style)
        {
            $this->setControlVar("new_style", $style);
        }


        public function __construct()
        {
            //$this->request = new RequestParams();

            $this->currentUser = Session::getUser();

            $this->templateVars['errors'] = array();
            $this->templateVars['notices'] = array();
            $this->templateVars['control'] = array();
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
            global $SESS;

            if (!isset($SESS[$varName]))
                return '';
            else    return $SESS[$varName];
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
            global $SESS;

            $SESS[$varName] = $value;
        }


        /**
         * Ermittelt den Inhalt der gew�nschten Request-Variablen.
         * Falls nicht vorhanden, wird "" zur�ckgegeben.
         *
         * @param String $varName Schl�ssel
         * @return String Inhalt
         */
        protected function getRequestVar($varName, $transcode = OR_FILTER_TEXT)
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
                return intval($this->request->getRequestVar($name,OR_FILTER_NUMBER));
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
         * Setzt eine Variable f�r die Oberfl�che.
         *
         * @param String $varName Schl�ssel
         * @param Mixed $value
         * @deprecated Diese Schicht soll keine Dialog-Logik enthalten.
         */
        protected function setControlVar($varName, $value)
        {
            $this->templateVars['control'][$varName] = $value;
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
                $this->addNotice('', '', $message, OR_NOTICE_ERROR, $vars, $log);

            $this->templateVars['errors'][] = $name;
        }


        public function handleResult($result)
        {
            // TODO -
        }

        /**
         * F�gt ein Meldung hinzu.
         *
         * @param String $type Typ des Objektes, zu dem diese Meldung geh�rt.
         * @param String $name Name des Objektes, zu dem diese Meldung geh�rt.
         * @param String $text Textschl�ssel der Fehlermeldung (optional)
         * @param String $status Einer der Werte OR_NOTICE_(OK|WARN|ERROR)
         * @param array $vars Variablen f�r den Textschl�ssel
         * @param array $log Weitere Hinweistexte f�r diese Meldung.
         */
        protected function addNotice($type, $name, $text, $status = OR_NOTICE_OK, $vars = array(), $log = array())
        {
            if ($status === true)
                $status = OR_NOTICE_OK;
            elseif ($status === false)
                $status = OR_NOTICE_ERROR;

            $this->templateVars['notice_status'] = $status;
            $this->templateVars['status'] = $status;
            $this->templateVars['success'] = ($status == OR_NOTICE_ERROR ? 'false' : 'true');

            if ($status == OR_NOTICE_OK && isset($_COOKIE['or_ignore_ok_notices']))
                return;

            if (!is_array($log))
                $log = array($log);

            if (!is_array($vars))
                $vars = array($vars);

            $this->templateVars['notices'][] = array('type' => $type,
                'name' => $name,
                'key' => 'NOTICE_' . $text,
                'vars' => $vars,
                'text' => lang('NOTICE_' . $text, $vars),
                'log' => $log,
                'status' => $status);
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
         * Benutzen eines sog. "Conditional GET".
         *
         * Diese Funktion setzt einen "Last-Modified"-HTTP-Header.
         * Ist der Inhalt der Seite nicht neuer, so wird der Inhalt
         * der Seite nicht ausgegeben, sondern nur HTTP-Status 304
         * ("304 not modified") gesetzt.
         * Der Rest der Seite muss dann nicht mehr erzeugt werden,
         * wodurch die Performance stark erhoeht werden kann.
         *
         * Credits: Danke an Charles Miller
         * @see http://fishbowl.pastiche.org/2002/10/21/http_conditional_get_for_rss_hackers
         *
         * Gefunden auf:
         * @see http://simon.incutio.com/archive/2003/04/23/conditionalGet
         *
         * @param $time int Letztes Aenderungsdatum des Objektes
         * @param $expirationDuration int Gültigkeitsdauer
         */
        protected function lastModified($time, $expirationDuration = 0)
        {
            if   ( DEVELOPMENT )
                return;
            
            // Conditional-Get eingeschaltet?
            if (!config('cache', 'conditional_get'))
                return;

            $expires = substr(date('r', time() + $expirationDuration - date('Z')), 0, -5) . 'GMT';
            $lastModified = substr(date('r', $time - date('Z')), 0, -5) . 'GMT';
            $etag = '"' . base_convert($time, 10, 36) . '"';

            // Header senden
            header('Expires: ' . $expires);
            header('Last-Modified: ' . $lastModified);
            header('ETag: ' . $etag);

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
         * Erzeugt einen Redirect auf einen bestimmte URL.
         */
        protected function redirect($url)
        {
            $this->setControlVar('redirect', $url);
        }


        protected function setCookie($name,$value='' ) {

            if (empty($value))
                $expire = time(); // Cookie wird gelöscht.
            else
                $expire = time() + 60 * 60 * 24 * config('security', 'cookie', 'expire');

            $secure   = config('security', 'cookie', 'secure');
            $httponly = config('security', 'cookie', 'httponly');
			$samesite = config('security', 'cookie', 'samesite');

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

}