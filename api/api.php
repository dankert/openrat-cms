<?php

const API_CALL = true;

$paths = explode('/', trim($_SERVER['PATH_INFO'],'/'));

// respond to CORS preflight request
if   ( $_SERVER['REQUEST_METHOD'] == 'OPTIONS' ) {

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Headers: *');
	header('Access-Control-Allow-Methods: GET,POST');
	header('204 No content');
	exit;
}

header('Access-Control-Allow-Origin: *');

define("API_ACTION"   , $paths[0]);
define("API_SUBACTION", @$paths[2]);
define("API_ID"       , @$paths[1]);

require_once("../index.php");