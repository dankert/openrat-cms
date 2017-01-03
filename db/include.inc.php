<?php

require_once( OR_DBCLASSES_DIR."Database.class.php" );
require_once( OR_DBCLASSES_DIR."driver/postgresql.class.php" );
require_once( OR_DBCLASSES_DIR."driver/mysql.class.php" );
if (version_compare(PHP_VERSION, '5.0.0', '>'))
	require_once( OR_DBCLASSES_DIR."driver/mysqli.class.php" );
if (version_compare(PHP_VERSION, '5.0.0', '>'))
	require_once( OR_DBCLASSES_DIR."driver/sqlite.class.php" );
if (version_compare(PHP_VERSION, '5.3.0', '>'))
	require_once( OR_DBCLASSES_DIR."driver/sqlite3.class.php" );
if (version_compare(PHP_VERSION, '5.1.0', '>'))
	require_once( OR_DBCLASSES_DIR."driver/pdo.class.php" );

?>