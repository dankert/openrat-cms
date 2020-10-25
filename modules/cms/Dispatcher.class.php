<?php

/*
 * Loading and calling the action class (the "controller").
 */
namespace cms;

use BadMethodCallException;
use cms\action\Action;
use cms\action\RequestParams;
use cms\base\Configuration;
use cms\base\DB;
use cms\base\DefaultConfig;
use cms\base\Startup;
use cms\base\Version;
use configuration\ConfigurationLoader;
use database\Database;
use cms\update\Update;
use language\Messages;
use modules\cms\base\HttpRequest;
use util\Http;
use logger\Logger;
use LogicException;
use util\exception\UIException;
use util\exception\SecurityException;
use util\json\JSON;
use util\Session;
use util\Text;


/**
 * Dispatcher for all cms actions.
 *
 * @package cms
 */
class Dispatcher
{
    /**
     * @var RequestParams
     */
    public $request;

    /**
     * Vollständige Abarbeitug einer Aktion.
     * Führt die gesamte Abarbeitung einer Aktion durch, incl. Datenbank-Transaktionssteuerung.
     *
     * @return array data for the client
     */
    public function doAction()
    {
        // Start the session. All classes should have been loaded up to now.
        session_name('or_sid');
		session_start();

        $this->checkConfiguration();

        // Vorhandene Konfiguration aus der Sitzung lesen.
        $conf = Configuration::rawConfig();

		define('PRODUCTION', Configuration::Conf()->is('production',true));
        define('DEVELOPMENT', !PRODUCTION);

        if( DEVELOPMENT)
        {
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        }else {
            ini_set('display_errors', 0);
            ini_set('display_startup_errors', 0);
            error_reporting(0);
        }

        $this->setContentLanguageHeader();

        // Nachdem die Konfiguration gelesen wurde, kann nun der Logger benutzt werden.
        $this->initializeLogger();

        // Sollte nur 1x pro Sitzung ausgeführt werden. Wie ermitteln wir das?
        //if ( DEVELOPMENT )
        //    Logger::debug( "Effective configuration:\n".YAML::YAMLDump($conf) );

        if (!empty($conf['security']['umask']))
            umask(octdec($conf['security']['umask']));

        if (!empty($conf['interface']['timeout']))
            set_time_limit(intval($conf['interface']['timeout']));

        $this->checkPostToken();

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

        $this->writeAuditLog();
        $this->commitDatabaseTransaction();

        if  ( DEVELOPMENT )
            Logger::trace('Output' . "\n" . print_r($result, true));

        // Weitere Variablen anreichern.
        $result['session'] = array('name' => session_name(), 'id' => session_id(), 'token' => Session::token());
        $result['version'] = Startup::VERSION;
        $result['api'] = '2';
        $result['output']['_token'] = Session::token();
        $result['output']['_id'   ] = $this->request->id;


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
            case Action::SECURITY_GUEST:
                // Ok.
                break;
            case Action::SECURITY_USER:
                if (!is_object($do->currentUser))
                    throw new SecurityException('No user logged in, but this action requires a valid user');
                break;
            case Action::SECURITY_ADMIN:
                if (!is_object($do->currentUser) || !$do->currentUser->isAdmin)
                    throw new SecurityException('This action requires administration privileges, but user ' . @$do->currentUser->name . ' is not an admin');
                break;
            default:
        }

    }

    private function checkPostToken()
    {
        if ( Configuration::subset('security')->is('use_post_token',true) &&
			 $this->request->isAction &&
			 $this->request->getToken() != Session::token() ) {
            Logger::error('Token mismatch: Needed ' . Session::token() . ' but got ' . Logger::sanitizeInput($this->request->getToken()) . '. Maybe an attacker?');
            throw new SecurityException("Token mismatch");
        }
    }

    /**
     * Logger initialisieren.
     */
    private function initializeLogger()
    {

        $logConfig = Configuration::subset('log');

        $logFile = $logConfig->get('file','');

        // Wenn Logfile relativ angegeben wurde, dann muss dies relativ zum Root der Anwendung sein.
        if   ( $logFile && $logFile[0] != '/' )
            $logFile = __DIR__ . '/../../' . $logFile;

        Logger::$messageFormat = $logConfig->get('format',['time','level','host','text']);
        Logger::$filename   = $logFile;
        Logger::$dateFormat = $logConfig->get('date_format','r');
        Logger::$nsLookup   = $logConfig->is('ns_lookup',false);

		Logger::$outputType = (int) @constant('\\logger\\Logger::OUTPUT_' . strtoupper($logConfig->get('output','PLAIN')));
		Logger::$level      = (int) @constant('\\logger\\Logger::LEVEL_'  . strtoupper($logConfig->get('level' ,'WARN' )));

        Logger::$messageCallback = function ( $key ) {

        	switch( $key) {
				case 'action':
					return Session::get('action');

				case 'user':
					$user = Session::getUser();
					if (is_object($user))
						return  $user->name;
					else
						return '';
				default:
					return '';
			}
        };

        Logger::init();
    }

    private function checkConfiguration()
    {
        $conf = Session::getConfig();

        // Konfiguration lesen.
        // Wenn Konfiguration noch nicht in Session vorhanden oder die Konfiguration geändert wurde (erkennbar anhand des Datei-Datums)
        // dann die Konfiguration neu einlesen.
        $configLoader = new ConfigurationLoader(__DIR__ . '/../../config/config.yml');

        if (!is_array($conf) || $conf['config']['auto_reload'] && $configLoader->lastModificationTime() > $conf['config']['last_modification_time']) {

            // Da die Konfiguration neu eingelesen wird, sollten wir auch die Sitzung komplett leeren.
            if (is_array($conf) && $conf['config']['session_destroy_on_config_reload'])
                session_unset();

            // Fest eingebaute Standard-Konfiguration laden.
            $conf = DefaultConfig::get();

            $customConfig = $configLoader->load();
            $conf = array_replace_recursive($conf, $customConfig);

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

                $language = new \language\Language();
                $lang = $language->getLanguage( $l );
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
     * Aufruf der Action-Methode.
     *
     * @return array Vollständige Rückgabe aller Daten als assoziatives Array
     */
    private function callActionMethod()
    {
        $actionClassName = ucfirst($this->request->action) . 'Action';
        $actionClassNameWithNamespace = 'cms\\'.($this->request->isUIAction?'ui\\':'').'action\\' . $actionClassName;

        if ( !class_exists($actionClassNameWithNamespace) )
            throw new LogicException('Action \''.$this->request->action.'\' is not available, class not found: '.$actionClassNameWithNamespace);

        // Erzeugen der Action-Klasse
        /* @type $do \cms\action\Action */
        $do = new $actionClassNameWithNamespace;

        $do->request         = $this->request;
        $do->init();

        $this->checkAccess($do);

        // POST-Request => ...Post() wird aufgerufen.
        // GET-Request  => ...View() wird aufgerufen.
        $methodSuffix = $this->request->isAction ? 'Post' :  'View';
        $subactionMethodName = $this->request->method . $methodSuffix;

        // Daten werden nur angezeigt, die Sitzung kann also schon geschlossen werden.
        // Halt! In Index-Action können Benutzer-Logins gesetzt werden.
        if   ( ! $this->request->isAction && $this->request->action != 'index' )
            Session::close();

        Logger::debug("Dispatcher executing {$this->request->action}/{$this->request->method}/" . $this->request->getRequestId().' -> '.$actionClassName.'#'.$subactionMethodName.'()');


        try {
			$method             = new \ReflectionMethod($do,$subactionMethodName);
            $declaredClassName  = $method->getDeclaringClass()->getShortName();
            $declaredActionName = strtolower(substr($declaredClassName,0,strpos($declaredClassName,'Action')));
			$params             = [];
			foreach( $method->getParameters() as $parameter ) {
				$params[ $parameter->getName() ] = $this->request->getRequiredRequestVar($parameter->getName(),RequestParams::FILTER_RAW);
			}

            $method->invokeArgs($do,$params); // <== Executing the Action
        }
        catch (\util\exception\ValidationException $ve)
        {
            $do->addValidationError( $ve->fieldName,$ve->key );
        }
        catch (\ReflectionException $re)
        {
            throw new BadMethodCallException("Method '$subactionMethodName' does not exist",0,$re);
        }

        // The action is able to change its method name.
        $this->request   = $do->request;
        $this->request->action = $declaredActionName;

        $result = $do->getOutputData();

        return $result;
    }

    /**
     * Startet die Verbindung zur Datenbank.
     */
    private function connectToDatabase()
    {
        $firstDbContact = ! Session::getDatabaseId() || $this->request->hasRequestVar('dbid');

        if   ( $this->request->hasRequestVar('dbid') )
            $dbid = $this->request->getRequestVar('dbid',RequestParams::FILTER_ALPHANUM);
        elseif   ( Session::getDatabaseId() )
            $dbid = Session::getDatabaseId();
        elseif   ( isset($_COOKIE['or_dbid']) )
            $dbid = $_COOKIE['or_dbid'];
        else {
            $databases = Configuration::subset('database')->subsets();

            // Filter all enabled databases
            $databases = array_filter($databases, function ($dbConfig) {
            	$dbConfig->is('enabled',true);
			});

            $dbids = array_keys( $databases );

            $defaultDbId = Configuration::subset('database-default')->get('default-id' );

            if  ( $defaultDbId && in_array($defaultDbId,$dbids) )
                // Default-Datenbankverbindung ist konfiguriert und vorhanden.
                $dbid = $defaultDbId;
            elseif  ( count($dbids) > 0)
                // Datenbankverbindungen sind vorhanden, wir nehmen die erste.
                $dbid = $dbids[0];
            else
                // Keine Datenbankverbindung vorhanden. Fallback:
                throw new \RuntimeException('No database configured');
        }


        $dbConfig = Configuration::config()->subset('database');

        if	( ! $dbConfig->has( $dbid ) )
            throw new \LogicException( 'unknown DB-Id: '.$dbid );

        $dbConfig = $dbConfig->subset($dbid );

        if   ( ! $dbConfig->is('enabled',true ) )
            throw new \RuntimeException('Database connection \''.$dbid.'\' is not enabled');

        try
        {
            $key = $this->request->isAction?'write':'read';

            $db = new Database( $dbConfig->subset($key)->getConfig() + $dbConfig->getConfig() );
            $db->id = $dbid;

            Session::setDatabaseId( $dbid );
            Session::setDatabase( $db );
        }catch(\Exception $e)
        {
            throw new UIException(Messages::DATABASE_CONNECTION_ERROR, $e->getMessage(),$e);
        }


        if   ( $firstDbContact )
            // Test, if we should update the database scheme.
            $this->updateDatabase( $dbid );
    }



    /**
     * Updating the database.
     *
     * @param $dbid integer
     * @throws UIException
     */
    private function updateDatabase($dbid)
    {
        $dbConfig = Configuration::Conf()->subset('database')->subset($dbid);

        if   ( ! $dbConfig->is('check_version',true))
            return; // Check for DB version is disabled.

        $updater = new Update();

        if   ( ! $updater->isUpdateRequired( DB::get() ) )
            return;


        if   ( ! $dbConfig->is('auto_update',true))
            throw new \LogicException('DB Update required, but auto-update is disabled. '.Startup::TITLE." ".Startup::VERSION." needs DB-version ".Update::SUPPORTED_VERSION );


        try {
            $adminDb = new Database( $dbConfig->subset('admin')->getConfig() + $dbConfig->getConfig() );
            $adminDb->id = $dbid;
        } catch (\Exception $e) {

            throw new UIException('DATABASE_ERROR_CONNECTION', $e->getMessage(),$e);
        }

        $updater->update($adminDb);

        // Try to close the PDO connection. PDO doc:
        // To close the connection, you need to destroy the object by ensuring that all
        // remaining references to it are deleted—you do this by assigning NULL to the variable that holds the object.
        // If you don't do this explicitly, PHP will automatically close the connection when your script ends.
        $adminDb = null;
        unset($adminDb);
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
            if  ( $this->request->isAction )
            {
                $db->start();

                //register_shutdown_function( function() {
                //        $this->rollbackDatabaseTransaction();
                //});
            }
        }

    }


    private function commitDatabaseTransaction()
    {
        $db = Session::getDatabase();

        if (is_object($db))
            // Transactions were only started for POST-Request
            if($this->request->isAction)
                $db->commit();
    }



    private function rollbackDatabaseTransaction()
    {
        $db = Session::getDatabase();

        if (is_object($db))
            // Transactions were only started for POST-Request
            if($this->request->isAction)
                $db->rollback();
    }


    /**
     * Sets the "Content-Language"-HTTP-Header with the user language.
     */
    private function setContentLanguageHeader()
    {
        header('Content-Language: ' . Configuration::Conf()->subset('language')->get('language_code') );
    }



    private function writeAuditLog()
    {
        // Only write Audit Log for POST requests.
        if   ( ! $this->request->isAction )
            return;

        $auditConfig = Configuration::config()->subset('audit-log');

        if   ( $auditConfig->is('enabled',false))
        {
            $dir = $auditConfig->get('directory','./audit-log' );

            if   ( $dir[0] != '/' )
                $dir = __DIR__ . '/../../' .$dir;

            $micro_date = microtime();
            $date = explode(" ",$micro_date);
            $filename = $dir.'/'.$auditConfig->get('prefix','audit' ).'-'.date('c',$date[1]).'-'.$date[0].'.json';

            $json = new JSON();
            $user = Session::getUser();

            $data = array(
                'database'    => array(
                    'id'      => DB::get()->id ),
                'user'        => array(
                    'id'      => @$user->userid,
                    'name'    => @$user->name ),
                'timestamp'   => date('c'),
                'action'      => $this->request->action,
                'method'      => $this->request->method,
                'remote-ip'   => $_SERVER['REMOTE_ADDR'],
                'request-time'=> $_SERVER['REQUEST_TIME'],
                'data'        => $this->filterCredentials( $_REQUEST )
            );

            // Write the file.
            if   ( file_put_contents( $filename, $json->encode($data) ) === FALSE )
                Logger::warn('Could not write audit log to file: '.$filename);
            else
                Logger::debug('Audit logfile: '.$filename);
        }

    }


    /*
     * Filter credentials from an array.
     */
    private function filterCredentials( $input )
    {
        foreach( array( 'login_password','password1','password2' ) as $cr )
            if  ( isset($input[$cr]))
                $input[$cr] = '***';

        return $input;
    }
}