<?php

$_GET['action']    = 'webdav';
$_GET['subaction'] = strtolower($_SERVER['REQUEST_METHOD']);

require( 'do.php' );

?>