<?php


/**
 * Configuration Loader.
 *
 * Loades the configuration values from a YAML file.
 *
 * @author Jan Dankert
 * @package openrat.util
 */
class Configuration
{
    public static $configFile = __DIR__.'/../../config/config.yml';

    /**
     * Ermittelt den Zeitpunkt der letzten Änderung der Konfigurationsdatei.
     *
     * @return int Zeitpunkt der letzten Änderung als Unix-Timestamp
     */
    public static function lastModificationTime()
    {
        return filemtime(self::$configFile);
    }


    /**
     * Loads the custom configuration file.
     *
     * @return array Configuration
     */
    public static function load()
    {
        $customConfig = Configuration::loadCustomConfig(self::$configFile);

        // Den Dateinamen der Konfigurationsdatei in die Konfiguration schreiben.
        $customConfig['config']['filename'              ] = self::$configFile;
        $customConfig['config']['last_modification_time'] = filemtime(self::$configFile);
        $customConfig['config']['last_modification'     ] = date('r', filemtime(self::$configFile));
        $customConfig['config']['read'                  ] = date('r');

        return $customConfig;
    }

    /**
     * Loads the configuration file an resolves all include-commands.
     *
     * @return array Configuration
     */
    public static function loadCustomConfig( $configFile )
    {
        if (!is_file($configFile) && !is_link($configFile)) {
            error_log('Warning: Configuration file ' . $configFile . ' not found');
            return array();
        }

        $customConfig = Spyc::YAMLLoad( $configFile );

        // Resolve variables in all custom configuration values
        array_walk_recursive( $customConfig, function(&$value,$key)
            {
                $value = Configuration::evaluateFilename($value);

            }
        );

        // Does we have includes?
        if (isset($customConfig['include'])) {

            if (is_string($customConfig['include']))
                $customConfig['include'] = array($customConfig['include']);

            // Load include files.
            foreach ($customConfig['include'] as $key => $file) {

                if (substr($file, -4) == '.yml' || substr($file, -8) == '.yml.php') {

                    $customConfig += Configuration::loadCustomConfig($file);

                } else {
                    error_log('Warning: ' . $file . ' is no YAML and no INI - not loaded');
                }

            }
        }


        // Resolve dot-notated configuration keys to arrays.
        // Means: a.b.c is converted to array['a']['b']['c']
        foreach ($customConfig as $key => $value) {
            $parts = explode('.', $key);
            if (count($parts) == 1)
                ; // Kein Punkt enthalten. Dieser Konfigurationsschlüssel wird nicht geändert.
            else {

                if (count($parts) == 2)
                    $customConfig[$parts[0]][$parts[1]] = $value;
                elseif (count($parts) == 3)
                    $customConfig[$parts[0]][$parts[1]][$parts[2]] = $value;
                elseif (count($parts) == 4)
                    $customConfig[$parts[0]][$parts[1]][$parts[2]][$parts[3]] = $value;
                elseif (count($parts) == 5)
                    $customConfig[$parts[0]][$parts[1]][$parts[2]][$parts[3]][$parts[4]] = $value;
                elseif (count($parts) == 6)
                    $customConfig[$parts[0]][$parts[1]][$parts[2]][$parts[3]][$parts[4]][$parts[5]] = $value;
                unset($customConfig[$key]);
            }
        }



        return $customConfig;
    }

    /**
     * Evaluates variables in an include file string.
     * Example: config-{http:host}.yml => config-yourdomain.yml
     * @param $file String filename
     * @return String
     */
    private static function evaluateFilename($file)
    {
        return preg_replace_callback(
            "|\\$\{([[:alnum:]]+)\:([[:alnum:]_]+)\}|",

            function ($match) {
                $type = $match[1];
                $value = $match[2];
                $value = str_replace('-', '_', $value);
                switch (strtolower($type)) {
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

            $file);
    }

}

