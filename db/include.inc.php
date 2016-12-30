<?php

require_once( OR_DBCLASSES_DIR."postgresql.class.php" );
require_once( OR_DBCLASSES_DIR."mysql.class.php" );
if (version_compare(PHP_VERSION, '5.0.0', '>'))
	require_once( OR_DBCLASSES_DIR."mysqli.class.php" );
if (version_compare(PHP_VERSION, '5.0.0', '>'))
	require_once( OR_DBCLASSES_DIR."sqlite.class.php" );
if (version_compare(PHP_VERSION, '5.3.0', '>'))
	require_once( OR_DBCLASSES_DIR."sqlite3.class.php" );
if (version_compare(PHP_VERSION, '5.1.0', '>'))
	require_once( OR_DBCLASSES_DIR."pdo.class.php" );

?>