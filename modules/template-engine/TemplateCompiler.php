<?php

header('Content-Type: text/plain');

/**
 * Using the Component classes and generating a XSD-File.
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

use template_engine\TemplateEngine;



$dir = __DIR__.'/../../modules/cms-ui/themes/default/html/views';

require('../../modules/util/require.php');
require('../../modules/template-engine/require.php');
require('../../modules/cms-core/require.php');

echo "Searching in $dir\n";

foreach(FileUtils::readDir( $dir ) as $action )
{
    echo "Action: $action\n";

    foreach(FileUtils::readDir( $dir.'/'.$action ) as $file )
    {
        if   ( substr($file,-12 ) == '.tpl.src.xml' )
        {
            $method = substr($file, 0,-12 );
            echo "\tMethod $method\n";

            $templateFile = $dir.'/'.$action.'/'.$file;
            $outFile      = $dir.'/'.$action.'/'.$method.'.php';

            $engine = new TemplateEngine();
            $fakeRequest = new \cms\action\RequestParams();
            $fakeRequest->action = $action;
            $fakeRequest->method = $method;
            $engine->request = $fakeRequest;

            echo "\t\tcompiling $templateFile\n\t\t       to $outFile\n";

            $engine->compile( $templateFile,$outFile );
        }
    }
}

