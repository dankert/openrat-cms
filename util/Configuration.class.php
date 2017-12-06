<?php


/**
 * Hilfsmethoden fuer das Lesen von Einstellungen.
 *
 * @author Jan Dankert
 * @package openrat.util
 */
class Configuration
{
    /**
     * Ermittelt den Zeitpunkt der letzten Änderung der Konfigurationsdatei.
     *
     * @return int Zeitpunkt der letzten Änderung als Unix-Timestamp
     */
    public static function lastModificationTime()
    {
        return filemtime('./config/config.yml');
    }


    /**
     * Liest die Konfigurationsdateien im angegebenen Ordner.
     *
     * @return array Configuration
     */
    public static function load()
    {
        $customConfig = Spyc::YAMLLoad('./config/config.yml');

        // Does we have includes?
        if (isset($customConfig['include'])) {

            // Resolve include file names
            if (is_string($customConfig['include']))
                $customConfig['include'] = array(Configuration::evaluateFilename($customConfig['include']));
            elseif (is_array($customConfig['include']))
                foreach ($customConfig['include'] as $key => $file)
                    $customConfig['include'][$key] = Configuration::evaluateFilename($file);

            // Load include files.
            foreach ($customConfig['include'] as $key => $file) {
                if (is_file($file) || is_link($file)) {

                    if (substr($file, -4) == '.yml' || substr($file, -8) == '.yml.php')
                        $customConfig += Spyc::YAMLLoad($file);
                    elseif (substr($file, -4) == '.ini' || substr($file, -8) == '.ini.php')
                        $customConfig += parse_ini_file($file);

                    $customConfig['included-files'][] = $customConfig['include'][$key] . ' loaded';
                } else {
                    $customConfig['included-files'][] = $customConfig['include'][$key] . ' not found';
                }
            }
        }


        // Besonderheit:
        // Alle Konfigurationsschlüssel mit einem Punkt ('.') im Namen zu Arrays auflösen.
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

        // Fest eingebaute Standard-Konfiguration laden.
        $conf = array();
        require('./util/config-default.php');

        $conf = array_replace_recursive($conf, $customConfig);

        // Den Dateinamen der Konfigurationsdatei in die Konfiguration schreiben.
        $conf['config']['last_modification_time'] = filemtime('./config/config.yml');
        $conf['config']['last_modification'] = date('r', filemtime('./config/config.yml'));
        $conf['config']['read'] = date('r');


        return $conf;
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

