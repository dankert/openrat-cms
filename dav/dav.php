<?php

/**
 * WebDAV für OpenRat Content Management System<br>
 * 
 * Das virtuelle Ordnersystem dieses CMS kann ueber das WebDAV-Protokoll
 * dargestellt werden.
 * 
 * Diese Klasse nimmt die Anfragen von WebDAV-Clients entgegen, zerlegt die
 * Anfrage und erzeugt eine Antwort, die im HTTP-Body zurueck uebertragen
 * wird.
 * <br>
 * WebDAV ist spezifiziert in der RFC 2518.<br>
 * Siehe <code>http://www.ietf.org/rfc/rfc2518.txt</code><br>
 * 
 * Implementiert wird DAV-Level 1 (d.h. ohne LOCK).
 * 
 * Der Zugang über WebDAV beinhaltet einige Nachteile:
 * - Login ist nur mit Name/Kennwort möglich (kein OpenId)
 * - Nur die Standard-Datenbank kann verwendet werden
 * - Der Client muss Cookies unterstützen
 * 
 * @author Jan Dankert
 * @package openrat.actions
 */



if (!defined('E_STRICT'))
	define('E_STRICT', 2048);

define('TIME_20000101',946681200); // default time for objects without time information.

// Default-Configuration.
$config = array('dav.enable'               => false,
                   'dav.create'               => true,
                   'dav.readonly'             => false,
                   'dav.expose_openrat'       => true,
                   'dav.compliant_to_redmond' => true,
                   'dav.realm'                =>'OpenRat CMS WebDAV Login',
		           'dav.anonymous'            => false,
                   'cms.host'                 => 'localhost',
		           'cms.port'                 => 80,
                   'cms.username'             => null,
                   'cms.password'             => null,
		           'cms.database'             => 'db1',
		           'cms.path'                 => '/',
		           'cms.max_file_size'        => 1000,
		           'log.level'                => 'info',
		           'log.file'                 => null
                   );

// Configuration-Loader
foreach( array( 'dav-'.$_SERVER['HTTP_HOST'].'.ini',
                'dav-custom.ini',
                'dav.ini') as $iniFile )
    if   ( is_file($iniFile))
        $config = array_merge($config,parse_ini_file( $iniFile) );


require('Logger.class.php');
require('Client.class.php');
require('CMS.class.php');
require('WebDAV.class.php');

//Logger::info( print_r($config,true));



// PHP-Fehler ins Log schreiben, damit die Ausgabe nicht zerstoert wird.
if (version_compare(PHP_VERSION, '5.0.0', '>'))
    set_error_handler('webdavErrorHandler',E_ERROR | E_WARNING);
else
    set_error_handler('webdavErrorHandler');


try {

    $dav = new WebDAV();

    $httpMethod = strtoupper($_SERVER['REQUEST_METHOD']);
    $davMethodName = 'dav' . $httpMethod;

    $dav->$davMethodName();
}
catch( Exception $e )
{
    error_log('WEBDAV ERROR: '.$e->getMessage()."\n".$e->getTraceAsString() );

    // Wir teilen dem Client mit, dass auf dem Server was schief gelaufen ist.
    header('HTTP/1.1 503 Internal WebDAV Server Error');
    echo 'WebDAV-Request failed'."\n".$e->getTraceAsString();
}

/**
 * Fehler-Handler fuer WEBDAV.<br>
 * Bei einem Laufzeitfehler ist eine Ausgabe des Fehlers auf der Standardausgabe sinnlos,
 * da der WebDAV-Client dies nicht lesen oder erkennen kann.
 * Daher wird der Fehler-Handler umgebogen, so dass nur ein Logeintrag sowie ein
 * Server-Fehler erzeugt wird.
 */
function webdavErrorHandler($errno, $errstr, $errfile, $errline) 
{
	error_log('WEBDAV ERROR: '.$errno.'/'.$errstr.'/file:'.$errfile.'/line:'.$errline);


    header('HTTP/1.1 503 Internal WebDAV Server Error');

    // Wir teilen dem Client mit, dass auf dem Server was schief gelaufen ist.
	echo 'WebDAV-Request failed with "'.$errstr.'"';
	exit;
}
