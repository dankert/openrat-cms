<?php

/*
 * Loading and calling the action class (the "controller").
 */
namespace cms;

use BadMethodCallException;
use Configuration;
use DomainException;
use Http;
use http\Exception;
use Logger;
use LogicException;
use ObjectNotFoundException;
use OpenRatException;
use SecurityException;
use Session;

$conf = array();
$SESS = array();
$FILES = array();

class Dispatcher
{
    public $action;
    public $subaction;

    /**
     * @return array
     */
    public function doAction()
    {
        // Jetzt erst die Sitzung starten (nachdem alle Klassen zur Verfügung stehen).
        session_start();

        global $SESS;
        $SESS = &$_SESSION;

        global $FILES;
        $FILES = &$_FILES;

        // Vorhandene Konfiguration aus der Sitzung lesen.
        global $conf;
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
                    continue;

                // Pruefen, ob Sprache vorhanden ist.
                $langFile = OR_LANGUAGE_DIR . 'lang-' . $l . '.' . PHP_EXT;

                if (!file_exists($langFile))
                    throw new LogicException("File does not exist: " . $langFile);

                require($langFile);
                $conf['language'] = $lang;
                $conf['language']['language_code'] = $l;
                break;
            }


            if (!isset($conf['language']))
                Http::serverError('no language found! (languages=' . implode(',', $languages) . ')');

            // Schreibt die Konfiguration in die Sitzung. Diese wird anschliessend nicht
            // mehr veraendert.
            Session::setConfig($conf);
        }


// Nachdem die Konfiguration gelesen wurde, kann nun der Logger benutzt werden.
        require_once(OR_MODULES_DIR . "logger/require." . PHP_EXT);

// Logger initialisieren
        Logger::$messageFormat = $conf['log']['format'];
        Logger::$filename = $conf['log']['file'];
        Logger::$dateFormat = $conf['log']['date_format'];
        Logger::$nsLookup = $conf['log']['ns_lookup'];

        $cname = 'LOGGER_LOG_' . strtoupper($conf['log']['level']);
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


        if (!empty($conf['security']['umask']))
            umask(octdec($conf['security']['umask']));

        if (!empty($conf['interface']['timeout']))
            set_time_limit(intval($conf['interface']['timeout']));

        global $REQ;
        if (config('security', 'use_post_token') && $_SERVER['REQUEST_METHOD'] == 'POST' && @$REQ[REQ_PARAM_TOKEN] != token()) {
            Logger::error('Token mismatch: Needed ' . token() . ' but got ' . @$REQ[REQ_PARAM_TOKEN] . '. Maybe an attacker?');
            Http::notAuthorized("Token mismatch", "Token mismatch");
        }



        define('FILE_SEP', $conf['interface']['file_separator']);

        define('TEMPLATE_DIR', OR_THEMES_DIR . $conf['interface']['theme'] . '/templates');
        define('CSS_DIR', OR_THEMES_DIR . $conf['interface']['theme'] . '/css');
        define('IMAGE_DIR', OR_THEMES_DIR . $conf['interface']['theme'] . '/images');

        define('PRODUCTION', $conf['production']);
        define('DEVELOPMENT', !PRODUCTION);

        // Verbindung zur Datenbank
        //
        $db = Session::getDatabase();
        if (is_object($db)) {
            $ok = $db->connect();
            if (!$ok)
                throw new DomainException('Database is not available: ' . $db->error);

            Session::setDatabase($db);
            $db->start();
        }


        $actionClassName = ucfirst($this->action) . 'Action';
        $actionClassNameWithNamespace = 'cms\\action\\' . $actionClassName;

        // Laden der Action-Klasse.
        require_once(OR_ACTIONCLASSES_DIR . '/' . $actionClassName . '.class.php');

        // Erzeugen der Action-Klasse
        try {
            /* @type $do \cms\action\Action */
            $do = new $actionClassNameWithNamespace;
        } catch (ObjectNotFoundException $e) {
            Logger::debug("Object not found: " . $e->__toString());
            throw $e;
        }

        $do->actionClassName = $actionClassName;
        $do->actionName = $this->action;
        $do->subActionName = $this->subaction;

        if (isset($REQ[REQ_PARAM_ID]))
            define('OR_ID', $REQ[REQ_PARAM_ID]);
        else
            define('OR_ID', '');

        $do->init();


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


        $isAction = $_SERVER['REQUEST_METHOD'] == 'POST';

        if ($isAction) {
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

        $result = $do->$subactionMethodName(); // <== Executing the Action

        // The action is able to change its method name.
        $this->subaction = $do->subActionName;

        Logger::trace('Output' . "\n" . print_r($result, true));

        // Weitere Variablen anreichern.
        $result['session'] = array('name' => session_name(), 'id' => session_id(), 'token' => token());
        $result['version'] = OR_VERSION;
        $result['api'] = '2';

        $do->handleResult($result);

        $this->cleanup();

        return $do->getOutputData();

    }

    private function cleanup()
    {

        Session::close();
        global $conf;

        $db = db_connection();

        if (is_object($db))
            $db->commit();

        // Ablaufzeit für den Inhalt auf aktuelle Zeit setzen.
        header('Expires: ' . substr(date('r', time() - date('Z')), 0, -5) . 'GMT', false);

        if ($conf['security']['content-security-policy'])
            header('X-Content-Security-Policy: ' . 'allow  \'self\'; img-src: *; script-src \'self\'; options inline-script');


    }
}