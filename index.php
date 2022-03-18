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
	// Switching to text/plain here because so there is no way to inject any HTML to the page.
	header('Content-Type: text/plain');
	error_log( $e->getMessage() );
	echo "Sorry, startup failed";
	exit;
}

// Creates the output driver
// Dependent on which data format is requested by the client.
$output = OutputFactory::createOutput();

$output->execute(); // Outputs the data.