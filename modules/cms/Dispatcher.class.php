<?php

/*
 * Loading and calling the action class (the "controller").
 */
namespace cms;

use BadMethodCallException;
use cms\action\Action;
use cms\action\RequestParams;
use cms\action\Response;
use cms\auth\Auth;
use cms\auth\InternalAuth;
use cms\base\Configuration;
use cms\base\DB;
use cms\base\DefaultConfig;
use cms\base\Startup;
use cms\base\Version;
use cms\model\User;
use configuration\Config;
use configuration\ConfigurationLoader;
use database\Database;
use cms\update\Update;
use Exception;
use language\Language;
use language\Messages;
use util\Cookie;
use util\ClassName;
use util\ClassUtils;
use util\exception\DatabaseException;
use util\exception\ObjectNotFoundException;
use util\exception\ValidationException;
use util\FileUtils;
use util\Http;
use logger\Logger;
use LogicException;
use util\exception\UIException;
use util\exception\SecurityException;
use util\json\JSON;
use util\Request;
use util\Session;
use util\Text;
use util\text\TextMessage;


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
    private $request;

	/**
	 * @var Response
	 */
	private $response;

    /**
     * Vollständige Abarbeitug einer Aktion.
     * Führt die gesamte Abarbeitung einer Aktion durch, incl. Datenbank-Transaktionssteuerung.
     */
    public function doAction()
    {
		if   ( $this->request->withAuthorization )
			; // No session required (otherwise every API request would create a new session)
		else
			Session::start();

        $this->checkConfiguration();

		define('PRODUCTION' , Configuration::Conf()->is('production',true));
        define('DEVELOPMENT', !PRODUCTION);

        if( DEVELOPMENT)
        {
            ini_set('display_errors'        , 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        }else {
            ini_set('display_errors'        , 0);
            ini_set('display_startup_errors', 0);
            error_reporting(0);
        }

        $this->setContentLanguageHeader();

        // Nachdem die Konfiguration gelesen wurde, kann nun der Logger benutzt werden.
        $this->initializeLogger();

        // Sollte nur 1x pro Sitzung ausgeführt werden. Wie ermitteln wir das?
        //if ( DEVELOPMENT )
        //    Logger::debug( "Effective configuration:\n".YAML::YAMLDump($conf) );

		$umask = Configuration::subset('security')->get('umask','');
		if   ( $umask )
            umask(octdec($umask));

		$timeout = Configuration::subset('interface')->get('timeout',0);
		if   ( $timeout )
            set_time_limit($timeout);

        $this->checkPostToken();

        $this->connectToDatabase();
        $this->startDatabaseTransaction();
		$this->checkLogin();

        try{
            $this->callActionMethod();
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
            Logger::trace('Output' . "\n" . print_r( $this->response->getOutputData(),true));


        // Ablaufzeit für den Inhalt auf aktuelle Zeit setzen.
		if   ( !$this->response->hasHeader('Expires') )
        	$this->response->addHeader('Expires', substr(date('r', time() - date('Z')), 0, -5) . 'GMT', false);
    }


	/**
	 * @param $request RequestParams
	 * @param $response Response
	 */
	public function setRequestAndResponse($request, $response)
	{
		$this->request  = $request;
		$this->response = $response;
	}



	/**
	 * Clear up after the work is done.
	 */
	private function clear() {
		// Yes, closing the session flushes the session data and unlocks other waiting requests.
		// Now another request is able to be executed.
		Session::close();
		if   ( $this->request->authUser ) {
			session_destroy();
			setcookie('or_sid','',time());
		}
	}


	/**
	 * Make an authentication, if there is a HTTP authorization.
	 */
	private function checkLogin() {

		if   ( $this->request->withAuthorization ) {
			$securityConfig = Configuration::subset('security');
			$authConfig = $securityConfig->subset('authorization');

			if   ( $this->request->authUser ) {
				if   ( ! $authConfig->is('basic'))
					throw new SecurityException('Basic Authorization is disabled');

				$userAuth = new InternalAuth();
				$status = $userAuth->login( $this->request->authUser,$this->request->authPassword,'' );
				if   ( ! ($status & Auth::STATUS_SUCCESS) )
					throw new SecurityException('user cannot be authenticated');

				$user = User::loadWithName( $this->request->authUser,User::AUTH_TYPE_INTERNAL );
				Request::setUser( $user );
			}
			elseif   ( $authToken = $this->request->authToken ) {
				if   ( ! $authConfig->is('bearer'))
					throw new SecurityException('Bearer Authorization is disabled');

				// We are expecting a JSON webtoken here
				function base64url_decode( $data ){
					return base64_decode( strtr( $data, '-_', '+/') . str_repeat('=', 3 - ( 3 + strlen( $data )) % 4 ));
				}

				list( $b64Header,$b64Payload,$signature ) = array_pad(explode('.',$authToken),3,'');
				$header = JSON::decode( base64url_decode($b64Header) );
				$supportedAlgos = [
					'HS256' => 'sha256',
					'HS384' => 'sha384',
					'HS512' => 'sha512',
				];
				if ( ! $algo = @$supportedAlgos[ @$header['alg'] ] )
					throw new SecurityException('Unknown algorithm in JWT, only supporting: '.implode(',',array_keys($supportedAlgos) ));
				elseif( ! in_array( $algo,hash_algos() ) )
					throw new SecurityException('Unsupported algorithm');
				elseif( hash_hmac( $algo,$b64Header.'.'.$b64Payload,$securityConfig->get('key'),true) != base64url_decode($signature) )
					throw new SecurityException('Signature does not match');

				$payload = JSON::decode( base64url_decode($b64Payload));

				if   ( $notBefore = @$payload['nbf'] )
					if   ( $notBefore < Startup::getStartTime() )
						throw new SecurityException('token is not valid');

				if   ( $expires = @$payload['exp'] )
					if   ( $expires > Startup::getStartTime() )
						throw new SecurityException('token is not valid');

				if   ( $subject = @$payload['sub'] ) {
					if   ( $user = User::loadWithName( $subject,User::AUTH_TYPE_INTERNAL ) )
						Request::setUser( $user );
					else
						throw new SecurityException('User not found');
				}
				else
					throw new SecurityException('User not found');
			}
		}
	}


	/**
	 * checks if the request contains a pleasant CSRF token.
	 *
	 * @return void
	 */
    private function checkPostToken()
    {
		if ( $this->request->withAuthorization )
			return; // no CSRF token necessary if there are no cookies used for authentication.

        if ( Configuration::subset('security')->is('use_post_token',true) &&
			 $this->request->isAction &&
			 $this->request->getToken() != Session::token() ) {
            Logger::warn( TextMessage::create(
            	'Token mismatch: Needed ${expected}), but got ${actual} Maybe an attacker?',
				[
					'expected' => Session::token(),
					'actual'   => $this->request->getToken()
				])
			);
            throw new SecurityException("Token mismatch");
        }
    }

    /**
     * Logger initialisieren.
     */
    private function initializeLogger()
    {
        $logConfig = Configuration::subset('log');

        Logger::$messageFormat = $logConfig->get('format',['time','level','host','text']);

        Logger::$logto = 0; // initially disable all logging endpoints.

		$logFile = $logConfig->get('file','');
        if    ( $logFile ) {
        	// Write to a logfile
        	if   ( FileUtils::isRelativePath($logFile) )
				$logFile = __DIR__ . '/../../' . $logFile; // prepend relativ path to app root
			Logger::$filename = $logFile;
			Logger::$logto    = Logger::$logto |= Logger::LOG_TO_FILE;
		}
        if   ( $logConfig->is('syslog')) // write to syslog
			Logger::$logto    = Logger::$logto |= Logger::LOG_TO_ERROR_LOG;
        if   ( $logConfig->is('stdout')) // write to standard out
			Logger::$logto    = Logger::$logto |= Logger::LOG_TO_STDOUT;
        if   ( $logConfig->is('stderr')) // write to standard error
			Logger::$logto    = Logger::$logto |= Logger::LOG_TO_STDERR;

        Logger::$dateFormat = $logConfig->get('date_format','r'); // 'M j H:i:s'
        Logger::$nsLookup   = $logConfig->is('ns_lookup',false);

		Logger::$outputType = (int) @constant('\\logger\\Logger::OUTPUT_' . strtoupper($logConfig->get('output','PLAIN')));
		Logger::$level      = (int) @constant('\\logger\\Logger::LEVEL_'  . strtoupper($logConfig->get('level' ,'WARN' )));

        Logger::$messageCallback = function ( $key ) {

        	switch( $key) {
				case 'action':
					return Session::get('action');

				case 'user':
					$user = Request::getUser();
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
        $conf = Request::getConfig();

		$configFile = getenv( 'CMS_CONFIG_FILE' ) ?: Startup::DEFAULT_CONFIG_FILE;

		// Konfiguration lesen.
		// Wenn Konfiguration noch nicht in Session vorhanden oder die Konfiguration geändert wurde (erkennbar anhand des Datei-Datums)
		// dann die Konfiguration neu einlesen.
		$configLoader = new ConfigurationLoader( $configFile );

        if (!is_array($conf) || @$conf['config']['auto_reload'] && $configLoader->lastModificationTime() > @$conf['config']['last_modification_time']) {

            // Da die Konfiguration neu eingelesen wird, sollten wir auch die Sitzung komplett leeren.
            if (is_array($conf) && $conf['config']['session_destroy_on_config_reload'])
                session_unset();

            // Fest eingebaute Standard-Konfiguration laden.
            $conf = DefaultConfig::get();

            $customConfig = $configLoader->load();
            $conf = array_replace_recursive($conf, $customConfig);

            // Sprache lesen
			$languages = [];

			if	( $user = Request::getUser() )
				$languages[] = $user->language; // user language has precedence.
			else {
				$i18nConfig = (new Config($conf))->subset('i18n');

				$languages[] = $i18nConfig->get('default','en');

				if	( $i18nConfig->is('use_http',true ) )
					// Die vom Browser angeforderten Sprachen ermitteln
					$languages = array_merge( $languages,Http::getLanguages() );
			}

			// Default-Sprache hinzufuegen.
			// Wird dann verwendet, wenn die vom Browser angeforderten Sprachen
			// nicht vorhanden sind
			$languages[] = 'en'; // last fallback.


			foreach ($languages as $l) {
                if (!in_array($l, Messages::$AVAILABLE_LANGUAGES))
                    continue; // language is not available.

                $language = new Language();
                $lang = $language->getLanguage( $l );
                $conf['language'] = $lang;
                $conf['language']['language_code'] = $l;
                break;
            }


            if (!isset($conf['language']))
                throw new \LogicException('no language found! (languages=' . implode(',', $languages) . ')');

            // Schreibt die Konfiguration in die Sitzung. Diese wird anschliessend nicht
            // mehr veraendert.
            Request::setConfig($conf);
        }

    }

    /**
     * Aufruf der Action-Methode.
     *
     * @return Response Vollständige Rückgabe aller Daten
     */
    private function callActionMethod()
    {
    	$action = $this->request->action;
    	$method = $this->request->method;

    	while( true ) {
			$actionClassName = new ClassName( ucfirst($action) . ucfirst($method) . 'Action');
			$actionClassName->addNamespace( 'cms\\' . ($this->request->isUIAction ? 'ui\\' : '') . 'action\\' . $action );

			if ( $actionClassName->exists() )
				break;

			$baseActionClassName = new ClassName( ucfirst($action) . 'Action' );
			$baseActionClassName->addNamespace( 'cms\\' . ($this->request->isUIAction ? 'ui\\' : '') . 'action' );

			if ( ! $baseActionClassName->exists() )
				throw new LogicException('Action \''.$action.'\' is not available, class not found: '.$baseActionClassName->get() );

			if   ( ! $baseActionClassName->getParent()->exists() )
				throw new BadMethodCallException($baseActionClassName->get().' does not exist.');

			$action = strtolower( $baseActionClassName->dropNamespace()->dropSuffix('Action')->get() );

			if   ( ! $action ) {
				throw new BadMethodCallException( TextMessage::create( 'No action found for action ${0} and method ${1}',[$this->request->action,$this->request->method] ) );
			}
		}


        // Erzeugen der Action-Klasse
		$class = $actionClassName->get();
        /* @type $do Action */
        $do = new $class;

        $do->request         = $this->request;
        $do->response        = $this->response;
        $do->init();

        $do->checkAccess();

        // POST-Request => ...Post() wird aufgerufen.
        // GET-Request  => ...View() wird aufgerufen.
        $subactionMethodName = $this->request->isAction ? 'post' :  'view';;

        // Daten werden nur angezeigt, die Sitzung kann also schon geschlossen werden.
        // Halt! In Index-Action können Benutzer-Logins gesetzt werden.
        if   ( ! $this->request->isAction && $this->request->action != 'index' && $this->request->method != 'oidc' )
            Session::close();

        Logger::debug("Dispatcher executing {$action}/{$method}/" . $this->request->getId().' -> '.$actionClassName->get().'#'.$subactionMethodName.'()');


        try {
			$method = new \ReflectionMethod($do,$subactionMethodName);
			$params = [];
			foreach( $method->getParameters() as $parameter ) {
				$params[ $parameter->getName() ] = $this->request->getRequiredRaw($parameter->getName());
			}

            $method->invokeArgs($do,$params); // <== Executing the Action
        }
        catch (ValidationException $ve)
        {
        	// The validation exception is catched here
            $do->addValidationError( $ve->fieldName,$ve->key,$ve->params );

            if   ( !$this->request->isAction )
            	// Validation exceptions should only be thrown in POST requests.
            	throw new BadMethodCallException("Validation error in GET request",0,$ve);
        }
        catch (\ReflectionException $re)
        {
            throw new BadMethodCallException("Method '$subactionMethodName' does not exist",0,$re);
        }

        // The action is able to change its method name.
        $this->request   = $do->request;
        $this->request->action = $action;
    }

    /**
     * Startet die Verbindung zur Datenbank.
     */
    private function connectToDatabase()
    {
		$allDbConfig = Configuration::subset('database');

		// Filter all enabled databases
		$enabledDatabases = array_filter($allDbConfig->subsets(), function ($dbConfig) {
			return $dbConfig->is('enabled',true);
		});

		$enabledDbids     = array_keys( $enabledDatabases );

		if   ( ! $enabledDbids )
			throw new UIException(Messages::DATABASE_CONNECTION_ERROR, 'No database configured.', [], new DatabaseException('No database configured'));

        $possibleDbIds = [];

        if   ( $databaseId = $this->request->getDatabaseId() )
            $possibleDbIds[] = $databaseId;

        if   ( $dbId = Request::getDatabaseId() )
            $possibleDbIds[] = $dbId;

        if   ( Cookie::has(Action::COOKIE_DB_ID) )
            $possibleDbIds[] = Cookie::get(Action::COOKIE_DB_ID);

		$possibleDbIds[] = Configuration::subset('database-default')->get('default-id' );

		$possibleDbIds[] = $enabledDbids[0];

		foreach( $possibleDbIds as $dbId ) {
			if	( in_array($dbId,$enabledDbids) ) {

				$dbConfig = $allDbConfig->subset( $dbId );

				try
				{
					$key = $this->request->isAction && !Startup::readonly() ?'write':'read';

					$db = new Database( $dbConfig->merge( $dbConfig->subset($key))->getConfig() );
					$db->id = $dbId;

				}
				catch(\Exception $e) {
					throw new UIException(Messages::DATABASE_CONNECTION_ERROR, "Could not connect to DB " . $dbId, [], $e);
				}

				// Is this the first time we are connected to this database in this session?
				$firstDbContact = Request::getDatabaseId() != $dbId;

				Request::setDatabase  ( $db   );

				if   ( $firstDbContact )
					// Test, if we must install/update the database scheme.
					$this->updateDatabase( $dbId );

				return;
			}
		}

		throw new LogicException('Unreachable code'); // at least the first db connection should be found
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

		Logger::error("Database update required. Please call /status/?upgrade");
		throw new LogicException("Database update required, try calling /status/?upgrade");
    }




    /**
     * Eröffnet eine Transaktion.
     */
    private function startDatabaseTransaction()
    {
        // Verbindung zur Datenbank
        //
        $db = Request::getDatabase();

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
        $db = Request::getDatabase();

        if (is_object($db))
            // Transactions were only started for POST-Request
            if($this->request->isAction)
                $db->commit();
    }



    private function rollbackDatabaseTransaction()
    {
        $db = Request::getDatabase();

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

        $auditConfig = Configuration::subset('audit-log');

        if   ( $auditConfig->is('enabled',false))
        {
            $dir = $auditConfig->get('directory','./audit-log' );

            if   ( $dir[0] != '/' )
                $dir = __DIR__ . '/../../' .$dir;

            $micro_date = microtime();
            $date = explode(" ",$micro_date);
            $filename = $dir.'/'.$auditConfig->get('prefix','audit' ).'-'.date('c',$date[1]).'-'.$date[0].'.json';

            $user = Request::getUser();

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
            if   ( file_put_contents( $filename, JSON::encode($data) ) === FALSE )
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