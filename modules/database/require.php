<?php

include( dirname(__FILE__) . "/Database.class.php" );
include( dirname(__FILE__) . "/Statement.class.php" );
include( dirname(__FILE__) . "/Sql.class.php" );

if (version_compare(PHP_VERSION, '5.1.0', '>'))
	include( dirname(__FILE__) . "/driver/pdo.class.php" );
	
?>