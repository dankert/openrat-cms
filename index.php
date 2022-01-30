<?php
// Excecuting the CMS user interface (UI)
require('modules/autoload.php');

use cms\base\Startup;
use cms\output\OutputFactory;
use cms\ui\UI;

Startup::initialize();

$output = OutputFactory::createOutput();
header('X-CMS-Output-Type: ' . get_class($output ) );
header('Content-Type: ' . $output->getContentType() . '; charset=' . Startup::CHARSET);
$output->execute();