<?php

// TODO: We should use $_REQUEST everywhere.
$REQ = array_merge($_GET,$_POST);

// REGISTER_GLOBALS
// This feature has been DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0.
if	( ini_get('register_globals') )
    Logger::warn("REGISTER_GLOBALS is active. For security reasons: DO NOT USE THIS!");

// MAGIC_QUOTES
// This feature has been DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0.
// always returns FALSE as of PHP 5.4.0.
if	( get_magic_quotes_gpc() == 1 )
    Logger::warn("MAGIC_QUOTES is active. For security reasons: DO NOT USE THIS!");


?>