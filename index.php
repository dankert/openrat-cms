<?php
// Excecuting the CMS HTTP Endpoint
// This is both for UI and API requests.


require('modules/autoload.php'); // Autoloading all classes

use cms\base\Startup;
use cms\output\OutputFactory;

try {
	// Starting the application
	// - Validating the environment
	// - Initialize all constants
	Startup::initialize();

} catch (ErrorException $e) {
	header('Content-Type: text/plain');
	error_log( $e->getMessage() );
	echo "Startup failed";
}

// Creates the output driver
// Dependent on which data format is requested by the client.
$output = OutputFactory::createOutput();
header('Content-Type: ' . $output->getContentType() . '; charset=' . Startup::CHARSET);

$output->execute(); // Outputs the data.