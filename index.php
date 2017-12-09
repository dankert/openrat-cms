<?php

if (version_compare(PHP_VERSION, '5.3.0', '<'))
    die("Sorry, PHP 5.3 is required.");

// Welcome to OpenRat content management system.

$_GET['action']    = 'index';
$_GET['subaction'] = 'show';

require('dispatcher.php'); 

?>