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
	echo "Sorry, startup failed\n";
	echo $e->getMessage();
	exit;
}

// Creates the output driver
// Dependent on which data format is requested by the client.
$output = OutputFactory::createOutput();

$output->execute(); // Outputs the data.

// Notification if this file is called without a running interpreter:
// <h1>Error</h1><b>If this text is visible, your script execution is disabled. Please contact your system administrator.</b> <a href="http://www.openrat.de">OpenRat CMS</a>