<?php

// Direkte Umleitung auf die WebDAV-Aktionsklasse.
// Diese Datei ist notwendig, um Parameter in der Webdav-Einstiegs-URL zu vermeiden.
$_GET['action'   ] = 'webdav';
$_GET['subaction'] = strtolower($_SERVER['REQUEST_METHOD']);

require( 'do.php' );

?>