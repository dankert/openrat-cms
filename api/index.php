<?php
// Excecuting the CMS application programming interface (API)

require('../modules/autoload.php');
require('../modules/cms-api/require.php');

use cms_api\API;

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