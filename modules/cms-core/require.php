<?php

// Require other modules
require_once(__DIR__ . '/../cms-publish/require.php');
require_once(__DIR__ . '/../database/require.php');
require_once(__DIR__ . '/../database-update/require.php');
require_once(__DIR__ . '/../util/require.php');
require_once(__DIR__ . '/../configuration/require.php');
require_once(__DIR__ . '/../security/require.php');
require_once(__DIR__ . '/../wikiparser/require.php');
require_once(__DIR__ . '/../logger/require.php');
require_once(__DIR__ . '/../language/require.php');

// Internal baseclasses
require_once(__DIR__ . '/action/Action.class.php');
require_once(__DIR__ . '/action/ObjectAction.class.php');
require_once(__DIR__ . '/action/FileAction.class.php');
require_once(__DIR__ . '/action/RequestParams.class.php');

// Internal packages
require_once(__DIR__ . "/model/require.php");
require_once(__DIR__ . "/auth/require.php");

// Session functions
require_once(__DIR__ . "/../util/Session.class.php");

// Helper functions...
require_once(__DIR__ . "/functions/common.inc.php");
require_once(__DIR__ . "/functions/language.inc.php");
require_once(__DIR__ . "/functions/request.inc.php");


require_once(__DIR__ . '/init.php');

require_once(__DIR__ . "/Dispatcher.class.php");

?>