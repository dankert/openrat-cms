<?php
// CMS metrics for openmetrics/prometheus

require('../../modules/autoload.php');

use cms\base\Startup;
use cms\status\Metrics;

Startup::initialize();

try {
	Metrics::execute();

} catch (Exception $e) {

    if (!headers_sent())
        header('HTTP/1.0 500 Internal Server Error');

    echo $e->__toString();
}
