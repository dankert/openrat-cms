<?php


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

        $customConfig = Spyc::YAMLLoad( $configFile );

        // Resolve variables in all custom configuration values
        array_walk_recursive( $customConfig, function(&$value,$key)
            {
                $value = ConfigurationLoader::resolveVariables($value);

            }
        );

        // Does we have includes?
        if (isset($customConfig['include'])) {

            // 'include' must be an array
            if (is_string($customConfig['include']))
                $customConfig['include'] = array($customConfig['include']);

            // Load include files.
            foreach ($customConfig['include'] as $key => $file) {

                if   ( $file[0] == '/')
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
     * Evaluates variables in a text value.
     * Examples:
     * - config-${http:host}.yml => config-yourdomain.yml
     * - config-${server:http-host}.yml => config-yourdomain.yml
     * - config-${env:myvar}.yml => config-myvalue.yml
     * @param $value String Configuration value
     * @return String
     */
    private function resolveVariables($value)
    {
        return preg_replace_callback(
            "|\\$\{([[:alnum:]]+)\:([[:alnum:]_]+)\}|",

            function ($match)
            {
                $type  = $match[1];
                $value = $match[2];
                $value = str_replace('-', '_', $value);

                switch( strtolower( $type ) )
                {
                    case 'env':
                        return getenv(strtoupper($value));

                    case 'http': // http:... is a shortcut for server:http-...
                        return @$_SERVER['HTTP_' . strtoupper($value)];

                    case 'server':
                        return @$_SERVER[strtoupper($value)];
                    default:
                        return "";
                }
            },

            $value);
    }

}

