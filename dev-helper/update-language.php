<?php

use language\Language;

require(__DIR__ . '/../modules/language/require.php');

header('Content-Type: text/plain');

try {
    Language::updateProduction();

    echo 'OK';
} catch (Exception $e) {
    if (!headers_sent())
        header('HTTP/1.0 500 Internal Server Error');

    echo 'Failed: ' . $e->getMessage();
}