<?php
// Excecuting the CMS application programming interface (API)

require('../modules/cms-api/require.php');

use cms_api\API;

try {
    // Cookie-Path: Actual path without '/api'.
    define('COOKIE_PATH',substr(dirname($_SERVER['SCRIPT_NAME']),0,-4));

    API::execute();

} catch (Exception $e) {

    echo $e->__toString();

}


?>