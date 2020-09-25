<?php
// Excecuting the CMS application programming interface (API)

require('../modules/autoload.php');
require('../modules/cms/ui/require.php');

use cms\api\API;
use cms\base\Startup;

Startup::initialize();

try {
    // Cookie-Path: Actual path without '/api'.
    define('COOKIE_PATH',substr(dirname($_SERVER['SCRIPT_NAME']),0,-3));

    API::execute();

} catch (Exception $e) {

    if (!headers_sent())
        header('HTTP/1.0 500 Internal Server Error');

    echo $e->__toString();
}


?>