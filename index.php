<?php
// Excecuting the CMS HTTP Endpoint
// This is both for UI and API requests.


require('modules/autoload.php'); // Autoloading all classes

use cms\base\Startup;
use cms\output\OutputFactory;

// - Validating the environment
// - Initialize all constants
Startup::initialize();

// Creates the output driver
// Dependent on which data format is requested by the client.
$output = OutputFactory::createOutput();
header('Content-Type: ' . $output->getContentType() . '; charset=' . Startup::CHARSET);

$output->execute(); // Outputs the data.