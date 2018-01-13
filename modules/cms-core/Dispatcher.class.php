<?php

/*
 * Loading and calling the action class (the "controller").
 */
namespace cms;

use BadMethodCallException;
use cms\action\Action;
use Configuration;
use DomainException;
use Http;
use http\Exception;
use language\Language;
use Logger;
use LogicException;
use ObjectNotFoundException;
use OpenRatException;
use SecurityException;
use Session;

$conf = array();
$SESS = array();
$FILES = array();

/**
 * Dispatcher for all cms actions.
 *
 * @package cms
 */
class Dispatcher
{
    public $action;
    public $subaction;

    private $isAction;

    /**
     * @return array data for the client
     */
    public function doAction()
    {
        define('PRODUCTION', config('production'));
        define('DEVELOPMENT', !PRODUCTION);

        // Start the session. All classes should have been loaded up to now.
        session_start();

        global $SESS;
        $SESS = &$_SESSION;

        global $FILES;
        $FILES = &$_FILES;

        $this->checkConfiguration();

        // Vorhandene Konfiguration aus der Sitzung lesen.
        global $conf;
        $conf = Session::getConfig();

        // Nachdem die Konfiguration gelesen wurde, kann nun der Logger benutzt werden.
        require_once(OR_MODULES_DIR . "logger/require." . PHP_EXT);
        $this->initializeLogger();


        if (!empty($conf['security']['umask']))
            umask(octdec($conf['security']['umask']));

        if (!empty($conf['interface']['timeout']))
            set_time_limit(intval($conf['interface']['timeout']));

        $this->checkPostToken();

        define('FILE_SEP', $conf['interface']['file_separator']);

        // Is this a POST request?
        $this->isAction = $_SERVER['REQUEST_METHOD'] == 'POST';

        $this->connectToDatabase();
        $this->startDatabaseTransaction();

        try{

            $result = $this->callActionMethod();
        }
        catch(Exception $e)
        {
            // In case of exception, rolling back the transaction
            try
            {
                $this->rollbackDatabaseTransaction();
            }
            catch(Exception $re)
            {
                Logger::warn("rollback failed:".$e->getMessage());
            }

            throw $e;
        }

        $this->commitDatabaseTransaction();

        if  ( DEVELOPMENT )
        Logger::trace('Output' . "\n" . print_r($result, true));

        // Weitere Variablen anreichern.
        $result['session'] = array('name' => session_name(), 'id' => session_id(), 'token' => token());
        $result['version'] = OR_VERSION;
        $result['api'] = '2';


        // Yes, closing the session flushes the session data and unlocks other waiting requests.
        // Now another request is able to be executed.
        Session::close();

        // Ablaufzeit für den Inhalt auf aktuelle Zeit setzen.
        header('Expires: ' . substr(date('r', time() - date('Z')), 0, -5) . 'GMT', false);

        return $result;
    }

    /**
     * Prüft, ob die Actionklasse aufgerufen werden darf.
     *
     * @param $do Action
     * @throws SecurityException falls der Aufruf nicht erlaubt ist.
     */
    private function checkAccess($do)
    {
        switch (@$do->security) {
            case SECURITY_GUEST:
                // Ok.
                break;
            case SECURITY_USER:
                if (!is_object($do->currentUser))
                    throw new SecurityException('No user logged in, but this action requires a valid user');
                break;
            case SECURITY_ADMIN:
                if (!is_object($do->currentUser) || !$do->currentUser->isAdmin)
                    throw new SecurityException('This action requires administration privileges, but user ' . $do->currentUser->name . ' is not an admin');
                break;
            default:
        }

    }

    private function checkPostToken()
    {
        global $REQ;
        if (config('security', 'use_post_token') && $_SERVER['REQUEST_METHOD'] == 'POST' && @$REQ[REQ_PARAM_TOKEN] != token()) {
            Logger::error('Token mismatch: Needed ' . token() . ' but got ' . @$REQ[REQ_PARAM_TOKEN] . '. Maybe an attacker?');
            throw new SecurityException("Token mismatch");
        }
    }

    /**
     * Logger initialisieren.
     */
    private function initializeLogger()
    {
        $logConfig = config('log');

        Logger::$messageFormat = $logConfig['format'];
        Logger::$filename = $logConfig['file'];
        Logger::$dateFormat = $logConfig['date_format'];
        Logger::$nsLookup = $logConfig['ns_lookup'];

        $cname = 'LOGGER_LOG_' . strtoupper($logConfig['level']);
        if (defined($cname))
            Logger::$level = constant($cname);


        Logger::$messageCallback = function () {
            $action = Session::get('action');
            if (empty($action))
                $action = '-';

            $action = Session::get('action');
            if (empty($action))
                $action = '-';

            $user = Session::getUser();
            if (is_object($user))
                $username = $user->name;
            else
                $username = '-';

            return array('user' => $username, 'action' => $action);
        };
        Logger::init();
    }

    private function checkConfiguration()
    {
        $conf = Session::getConfig();

        // Konfiguration lesen.
        // Wenn Konfiguration noch nicht in Session vorhanden oder die Konfiguration geändert wurde (erkennbar anhand des Datei-Datums)
        // dann die Konfiguration neu einlesen.
        if (!is_array($conf) || $conf['config']['auto_reload'] && Configuration::lastModificationTime() > $conf['config']['last_modification_time']) {

            // Da die Konfiguration neu eingelesen wird, sollten wir auch die Sitzung komplett leeren.
            if (is_array($conf) && $conf['config']['session_destroy_on_config_reload'])
                session_unset();

            // Fest eingebaute Standard-Konfiguration laden.
            require(OR_MODULES_DIR . 'util/config-default.php');
            $conf = createDefaultConfig();

            $customConfig = Configuration::load();
            $conf = array_replace_recursive($conf, $customConfig);


            $conf['build'] = parse_ini_file('build.ini');
            $conf['version'] = parse_ini_file('version.ini');
            // Sprache lesen

            if ($conf['i18n']['use_http'])
                // Die vom Browser angeforderten Sprachen ermitteln
                $languages = Http::getLanguages();
            else
                // Nur Default-Sprache erlauben
                $languages = array();

            if (isset($_COOKIE['or_language']))
                $languages = array($_COOKIE['or_language']) + $languages;

            // Default-Sprache hinzufuegen.
            // Wird dann verwendet, wenn die vom Browser angeforderten Sprachen
            // nicht vorhanden sind
            $languages[] = $conf['i18n']['default'];
            $available = explode(',', $conf['i18n']['available']);

            foreach ($languages as $l) {
                if (!in_array($l, $available))
                    continue; // language is not configured as available.

                $lang = Language::getLanguage( $l,PRODUCTION);
                $conf['language'] = $lang;
                $conf['language']['language_code'] = $l;
                break;
            }


            if (!isset($conf['language']))
                throw new \LogicException('no language found! (languages=' . implode(',', $languages) . ')');

            // Schreibt die Konfiguration in die Sitzung. Diese wird anschliessend nicht
            // mehr veraendert.
            Session::setConfig($conf);
        }

    }

    /**
     * @return array
     */
    private function callActionMethod()
    {
        global $REQ;
        $actionClassName = ucfirst($this->action) . 'Action';
        $actionClassNameWithNamespace = 'cms\\action\\' . $actionClassName;

        if (!class_exists($actionClassNameWithNamespace))
        {
            // Laden der Action-Klasse.
            require_once(__DIR__. '/action/' . $actionClassName . '.class.php');
        }

        // Erzeugen der Action-Klasse
        /* @type $do \cms\action\Action */
        $do = new $actionClassNameWithNamespace;

        $do->actionClassName = $actionClassName;
        $do->actionName = $this->action;
        $do->subActionName = $this->subaction;

        if (isset($REQ[REQ_PARAM_ID]))
            define('OR_ID', $REQ[REQ_PARAM_ID]);
        else
            define('OR_ID', '');

        $do->init();

        $this->checkAccess($do);

        if ($this->isAction) {
            // POST-Request => ...Post() wird aufgerufen.
            $subactionMethodName = $this->subaction . 'Post';
        } else {
            // GET-Request => ...View() wird aufgerufen.
            $subactionMethodName = $this->subaction . 'View';
            // Daten werden nur angezeigt, die Sitzung kann also schon geschlossen werden.
            if ($this->action != 'index') // In Index wird die Perspektive manipuliert.
                Session::close();
        }

        Logger::debug("Executing {$this->action}/{$this->subaction}/" . @$REQ[REQ_PARAM_ID]);

        if (!method_exists($do, $subactionMethodName))
            throw new BadMethodCallException("Method '$subactionMethodName' does not exist");

        $do->$subactionMethodName(); // <== Executing the Action

        // The action is able to change its method name.
        $this->subaction = $do->subActionName;

        $result = $do->getOutputData();

        return $result;
    }

    /**
     * Startet die Verbindung zur Datenbank.
     */
    private function connectToDatabase()
    {
        // Connect to database
        //
        $db = Session::getDatabase();

        if (is_object($db)) {

            $ok = $db->connect();
            if (!$ok)
                throw new DomainException('Database is not available: ' . $db->error);

            Session::setDatabase($db);
        }

    }


    /**
     * Eröffnet eine Transaktion.
     */
    private function startDatabaseTransaction()
    {
        // Verbindung zur Datenbank
        //
        $db = Session::getDatabase();

        if (is_object($db)) {
            // Transactions are only needed for POST-Request
            // GET-Request do only read from the database and have no need for transactions.
            if  ( $this->isAction )
                $db->start();
        }

    }


    private function commitDatabaseTransaction()
    {
        $db = db_connection();

        if (is_object($db))
            // Transactions were only started for POST-Request
            if($this->isAction)
                $db->commit();
    }



    private function rollbackDatabaseTransaction()
    {
        $db = db_connection();

        if (is_object($db))
            // Transactions were only started for POST-Request
            if($this->isAction)
                $db->rollback();
    }
}