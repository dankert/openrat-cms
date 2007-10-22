<?php


// URL of the base installation
define('OR_BASE_URL'         ,'/openrat'                                      );

// base installation directory
define('OR_INSTALLATION_PATH','/home/dankert/privat/public_html/cms-test/cms/');

// your config dir
define('OR_CONFIG','config');


// do not change below here.
define('OR_EXT_CONTROLLER_FILE',basename(getenv('SCRIPT_FILENAME')));
define('OR_EXT_CONFIG_DIR',dirname(getenv('SCRIPT_FILENAME')).'/'.OR_CONFIG.'/');
chdir(OR_INSTALLATION_PATH);
require('do.php');

?>