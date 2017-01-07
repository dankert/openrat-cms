<?php

require_once( OR_DBCLASSES_DIR."Database.class.php" );
require_once( OR_DBCLASSES_DIR."Statement.class.php" );
require_once( OR_DBCLASSES_DIR."Sql.class.php" );
if (version_compare(PHP_VERSION, '5.1.0', '>'))
	require_once( OR_DBCLASSES_DIR."driver/pdo.class.php" );

?>