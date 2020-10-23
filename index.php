<?php
// Excecuting the CMS user interface (UI)
require('modules/autoload.php');

use cms\base\Startup;
use cms\ui\UI;

Startup::initialize();

try {
    UI::execute();

} catch (Exception $e) {

if (!headers_sent())
{
    header('HTTP/1.0 500 Internal Server Error');
    header('Content-Type: text/html; charset=UTF-8');
    header('Content-Security-Policy: style-src: inline; default: self');
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Service currently unavailable</title>
    <style type="text/css">

        header, main {
            display: block
        }

        body {
            width: 100%;
            height: 100%;
            background-color: rgba(13,8,5,0.58);
            color: white;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            line-height: 1.4;
            font-size: 1.5em;
            text-align: center;
        }

        pre {
            margin:10%;
            width: 80%;
            overflow: visible;
            height: 40%;
            color: silver;
            text-align: left;
            font-size: 0.6rem;
        }

        h1 {
            font-size: 2em;
        }
</style>
</head>
<body>

<header>
    <h1>Sorry, our service is currently unavailable</h1>
</header>

<main>

    <p>Something went terribly wrong &#x1F61E;</p>

    <?php // Display exceptions only in development mode, because they may contain sensitive internal information like passwords.
      if (!defined('DEVELOPMENT') || DEVELOPMENT ) { ?>
    <pre><?php echo $e->__toString(); ?></pre>
    <?php } ?>
</main>

</body>
</html><?php

}
