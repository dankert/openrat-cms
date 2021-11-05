<?php

namespace cms\status;

use BadMethodCallException;
use cms\action\RequestParams;
use cms\base\Configuration;
use cms\base\DB;
use cms\base\DefaultConfig;
use cms\base\Startup;
use cms\Dispatcher;
use cms\update\Update;
use configuration\Config;
use configuration\ConfigurationLoader;
use database\Database;
use Exception;
use util\Http;
use logger\Logger;
use \util\exception\ObjectNotFoundException;
use util\exception\UIException;
use util\exception\SecurityException;
use util\json\JSON;
use util\Session;
use util\XML;
use util\YAML;

/**
 * Actuator.
 */
class Status
{
	/**
     * Getting the state
     */
    public static function execute()
    {
		$cmd     = $_SERVER['QUERY_STRING'];
		$data    = [];
		$success = false;

		switch( $cmd ) {
			case '':
			case 'health':
			case 'status':
			case 'state':

				$data['state'] = 'UP';
				$success = true;
				break;

			case 'db':
			case 'database':

				$config = new Config( self::getConfiguration() );
				$databases = [];
				foreach( $config->subset('database')->subsets() as $dbName => $dbConfig ) {

					if (!$dbConfig->is('enabled', true)) {
						$dbState = [
							'state'   => 'DISABLED',
						];

					} else {

						try {
							$db = new Database($dbConfig->subset('read')->getConfig() + $dbConfig->getConfig());

							$update = new Update();
							$version = $update->getDbVersion( $db );

							$db->disconnect();

							$dbState = [
								'state'   => 'UP',
								'version' => $version,
							];

						} catch (\Exception $e) {
							$dbState = [
								'state' => 'DOWN',
								'message' => $e->getMessage(),
							];
						}

					}

					$databases[$dbName] = $dbState;
				}

				$data['databases'] = $databases;
				$success = true;
				break;

			case 'upgrade':
			case 'update':
			case 'install':

				$config = new Config( self::getConfiguration() );
				$databases = [];
				foreach( $config->subset('database')->subsets() as $dbName => $dbConfig ) {

					$dbState = [];

					if (!$dbConfig->is('enabled', true)) {
						$dbState = [
							'state'   => 'DISABLED',
						];

					} else {

						try {
							$adminDb = new Database($dbConfig->subset('admin')->getConfig() + $dbConfig->getConfig());
							$adminDb->id = $dbName;

							$updater = new Update();

							$version = $updater->getDbVersion($adminDb);

							Logger::debug("Need DB-Version: " . Update::SUPPORTED_VERSION . "; Actual DB-Version: " . $version);

							if ($version == Update::SUPPORTED_VERSION)

								// Cool, der aktuelle DB-Stand passt zu dieser Version. Das ist auch der Normalfall. Weiter so.
								$dbState = [
									'state'   => 'UP',
									'version' => $version,
								];

							elseif ($version > Update::SUPPORTED_VERSION)
								// Oh oh, in der Datenbank ist eine neuere Version, als wir unterstützen.
								$dbState = [
									'state'   => 'DOWN',
									'version' => $version,
									'message' => 'Actual DB version is not supported. ' . "DB-Version is $version, but " . Startup::VERSION . " only supports version " . Update::SUPPORTED_VERSION,
								];
							else {

								if (!$dbConfig->is('auto_update', true))
									$dbState = [
										'state'   => 'DOWN',
										'version' => $version,
										'message' => 'DB Update required, but auto-update is disabled. ' . Startup::TITLE . " " . Startup::VERSION . " needs DB-version " . Update::SUPPORTED_VERSION
										];
								else {
									$updater->update($adminDb);

									// Try to close the PDO connection. PDO doc:
									// To close the connection, you need to destroy the object by ensuring that all
									// remaining references to it are deleted—you do this by assigning NULL to the variable that holds the object.
									// If you don't do this explicitly, PHP will automatically close the connection when your script ends.
									$adminDb = null;
									unset($adminDb);
								}
							}


						} catch (\Exception $e) {
							$dbState = [
								'state' => 'DOWN',
								'message' => $e->getMessage(),
							];

							break;
						}

					}

					$databases[$dbName] = $dbState;
				}

				$data['databases'] = $databases;
				$success = true;
				break;

			case 'info':
				$data = [
					'version' => Startup::VERSION,
					'date' => Startup::DATE,
					'name' => Startup::TITLE,
					'api'  => Startup::API_LEVEL,
					'supportedDatabaseVersion'  => Update::SUPPORTED_VERSION,
				];
				$success = true;
				break;

			case 'env':
			case 'environment':
				if   ( version_compare(PHP_VERSION,'7.1','>=') )
					$data['environment'] = getenv(); // since PHP 7.1
				$success = true;
				break;

			case 'extensions':
					$data['extensions'] = get_loaded_extensions();
				$success = true;
				break;

			case 'config':
			case 'configuration':

				$data['configuration'] = self::getConfiguration();
				$success = true;

				break;

			default:
		}

		// Be safe! We must clear secret values.
		array_walk_recursive($data, function(&$value,$key) {
			if   ( stripos($key,'secret'  ) !== FALSE ||
				   stripos($key,'password') !== FALSE ||
				   stripos($key,'pass'    ) !== FALSE    )
				$value = '**********';
		});


		header('Content-Type: application/json; charset=UTF-8');
		$output = JSON::encode($data);

        if (!headers_sent()) {
            // HTTP Spec:
            // "Applications SHOULD use this field to indicate the transfer-length of the
        	//  message-body, unless this is prohibited by the rules in section 4.4."
            //
            // And the overhead of 'Transfer-Encoding: chunked' is eliminated...
			header('HTTP/1.0 ' . ($success ? '200 OK' : '503 Internal Server Error') );
            header('Content-Length: ' . strlen($output));

		}

		echo $output;
    }


    private static function getConfiguration() {
		$configFile = getenv( 'CMS_CONFIG_FILE' );
		if   ( ! $configFile )
			$configFile = Startup::DEFAULT_CONFIG_FILE;

		$configLoader = new ConfigurationLoader( $configFile );
		return  $configLoader->load();
	}
}
