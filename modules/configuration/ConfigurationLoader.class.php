<?php

use util\VariableResolver;


/**
 * Configuration Loader.
 *
 * Loades the configuration values from a YAML file.
 *
 * @author Jan Dankert
 * @package openrat.util
 */
class ConfigurationLoader
{
    public $configFile;


    /*
     * Erzeugt eine neue Instanz.
     */
    public function __construct( $configFile )
    {
        $this->configFile = $configFile;
    }



    /**
     * Ermittelt den Zeitpunkt der letzten Änderung der Konfigurationsdatei.
     *
     * @return int Zeitpunkt der letzten Änderung als Unix-Timestamp
     */
    public function lastModificationTime()
    {
        return filemtime($this->configFile);
    }


    /**
     * Loads the custom configuration file.
     *
     * @return array Configuration
     */
    public function load()
    {
        $customConfig = ConfigurationLoader::loadCustomConfig($this->configFile);

        // Den Dateinamen der Konfigurationsdatei in die Konfiguration schreiben.
        $customConfig['config']['filename'              ] = $this->configFile;
        $customConfig['config']['last_modification_time'] = filemtime($this->configFile);
        $customConfig['config']['last_modification'     ] = date('r', filemtime($this->configFile));
        $customConfig['config']['read'                  ] = date('r');

        return $customConfig;
    }


    /**
     * Loads the configuration file an resolves all include-commands.
     *
     * @return array Configuration
     */
    private function loadCustomConfig( $configFile )
    {
        if (!is_file($configFile) && !is_link($configFile)) {
            error_log('Warning: Configuration file ' . $configFile . ' not found');
            return array();
        }

        $customConfig = YAML::parse( file_get_contents($configFile) );

        // resolve variables
        $customConfig = ConfigurationLoader::resolveVariables($customConfig);

        // Does we have includes?
        if (isset($customConfig['include'])) {

            // 'include' must be an array
            if (is_string($customConfig['include']))
                $customConfig['include'] = array($customConfig['include']);

            // Load include files.
            foreach ($customConfig['include'] as $key => $file) {

                if   ( $file[0] == '/') // File begins with '?'
                    ; // File has an absolute path - do not change.
                else
                    // Prepend file path with our config directory.
                    $file = __DIR__.'/../../config/'.$file;

                if   (substr($file, -4) == '.yml'    ||
                      substr($file, -5) == '.yaml'   ||
                      substr($file, -8) == '.yml.php'  )
                    $customConfig = array_replace_recursive( $customConfig, ConfigurationLoader::loadCustomConfig($file) );
                else
                    error_log('Warning: ' . $file . ' is no .yml file - not loaded');

            }
        }

        return $customConfig;
    }

    /**
     * Evaluates variables in a config array.
     * Examples:
     * - config-${http:host}.yml        => config-yourdomain.yml
     * - config-${server:http-host}.yml => config-yourdomain.yml
     * - config-${env:myvar}.yml        => config-myvalue.yml
     * @param $config array Configuration
     * @return array
     */
    private function resolveVariables($config)
    {
		$resolver = new VariableResolver();

		return $resolver->resolveVariablesInArrayWith($config,[

			'env'   => function($var) { return getenv(strtoupper($var));              },
			// http:... is a shortcut for server:http-...
			'http'  => function($var) { return @$_SERVER['HTTP_' . strtoupper($var)]; },
			'server'=> function($var) { return @$_SERVER[strtoupper($var)];           }
		] );
    }

}

