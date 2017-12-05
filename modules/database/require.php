<?php

include( __DIR__ ."/Database.class.php" );
include( __DIR__. "/Statement.class.php" );
include( __DIR__ ."/Sql.class.php" );
include( __DIR__ ."/DbVersion.class.php" );

// PDO is available since PHP 5.1
if (version_compare(PHP_VERSION, '5.1.0', '>'))
	include(__DIR__ . "/driver/PDODriver.class.php");
	
?>