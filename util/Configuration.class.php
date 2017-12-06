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
    public static $defaultConfigFile = './config/config.yml';

    /**
     * Ermittelt den Zeitpunkt der letzten Änderung der Konfigurationsdatei.
     *
     * @return int Zeitpunkt der letzten Änderung als Unix-Timestamp
     */
    public static function lastModificationTime()
    {
        return filemtime(self::$defaultConfigFile);
    }


    /**
     * Loads the configuration file an resolves all include-commands.
     *
     * @return array Configuration
     */
    public static function load()
    {
        $customConfig = Spyc::YAMLLoad(self::$defaultConfigFile);

        // Does we have includes?
        if (isset($customConfig['include'])) {

            // Resolve variables in include file names
            if (is_string($customConfig['include']))
                $customConfig['include'] = array(self::evaluateFilename($customConfig['include']));
            elseif (is_array($customConfig['include']))
                foreach ($customConfig['include'] as $key => $file)
                    $customConfig['include'][$key] = self::evaluateFilename($file);

            // Load include files.
            foreach ($customConfig['include'] as $key => $file) {
                if (is_file($file) || is_link($file)) {

                    if (substr($file, -4) == '.yml' || substr($file, -8) == '.yml.php') {

                        $customConfig += Spyc::YAMLLoad($file);
                        $customConfig['included-files'][] = 'Success: ' . $customConfig['include'][$key] . ' loaded as YAML';

                    } elseif (substr($file, -4) == '.ini' || substr($file, -8) == '.ini.php') {

                        $customConfig += parse_ini_file($file);
                        $customConfig['included-files'][] = 'Success: ' . $customConfig['include'][$key] . ' loaded as INI';

                    } else {
                        $customConfig['included-files'][] = 'Error: ' . $customConfig['include'][$key] . ' is no YAML and no INI - not loaded';
                    }

                } else {
                    $customConfig['included-files'][] = 'Error: ' . $customConfig['include'][$key] . ' not found';
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


        // Den Dateinamen der Konfigurationsdatei in die Konfiguration schreiben.
        $customConfig['config']['last_modification_time'] = filemtime(self::$defaultConfigFile);
        $customConfig['config']['last_modification'] = date('r', filemtime(self::$defaultConfigFile));
        $customConfig['config']['read'] = date('r');


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
            "|\\$\{([[:alnum:]]+)\:([[:alnum:]]+)\}|",

            function ($match) {
                $type = $match[1];
                $value = $match[2];
                $value = str_replace('-', '_', $value);
                switch (strtolower($type)) {
                    case 'env':
                        return $_ENV[strtoupper($value)];
                        break;

                    case 'http': // http:... is a shortcut for server:http-...
                        return $_SERVER['HTTP_' . strtoupper($value)];
                        break;
                    case 'server':
                        return $_SERVER[strtoupper($value)];
                        break;
                    default:
                }
            },

            $file);

        return $file;
    }

}

