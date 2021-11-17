<?php
// Excecuting the CMS application programming interface (API)

require('../modules/autoload.php');

use cms\status\Status;
use cms\base\Startup;

Startup::initialize();

try {
	Status::execute();

} catch (Exception $e) {

    if (!headers_sent())
        header('HTTP/1.0 500 Internal Server Error');

    echo $e->__toString();
}
