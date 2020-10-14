<?php

header('Content-Type: text/plain');

/**
 * Using the Component classes and generating a XSD-File.
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

use cms\base\Startup;
use template_engine\AppInfo;
use template_engine\engine\TemplateEngine;
use util\FileUtils;

Startup::initialize();

AppInfo::$styleClassPrefix = Startup::CSS_PREFIX;

$searchDir = __DIR__ . '/../../modules/cms/ui/themes/default/html/views';


echo "Searching in $searchDir\n";

$count = 0;


foreach(FileUtils::readDir( $searchDir ) as $action )
{
	if   ( !is_dir($searchDir.'/'.$action ) )
		continue;

    echo "Action: $action\n";

    foreach(FileUtils::readDir( $searchDir.'/'.$action ) as $file )
    {
        if   ( substr($file,-12 ) == '.tpl.src.xml' )
        {
        	$count++;
            $method = substr($file, 0,-12 );
            echo "\tMethod $method\n";

            $templateFile = $searchDir.'/'.$action.'/'.$file;
            $outFile      = $searchDir.'/'.$action.'/'.$method.'.php';

            $engine = new TemplateEngine();

            // We are creating a fake request, because the template compiler needs to know
			// the action and subaction in which it will be executed.
            $fakeRequest = new \cms\action\RequestParams();
            $fakeRequest->action = $action;
            $fakeRequest->method = $method;
            $engine->request = $fakeRequest;

            echo "\t\tcompiling $templateFile\n\t\t       to $outFile\n";

            $engine->compile( $templateFile,$outFile );
        }
    }
}
echo "\nSummary: Compiled $count files.\n";

