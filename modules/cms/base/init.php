<?php
// OpenRat Content Management System
// Copyright (C) 2002-2009 Jan Dankert, cms@jandankert.de
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; version 2.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.

use logger\Logger;
use util\exception\ValidationException;

define('MIN_VERSION','5.4');

if	( version_compare(phpversion(),MIN_VERSION,"<") )
    throw new ValidationException('This version of PHP is not supported any more. Minimum required: '.MIN_VERSION);


define('PHP_EXT'         ,'php'    );

define('IMG_EXT'         ,'.gif'   );
define('IMG_ICON_EXT'    ,'.png'   );

require(__DIR__ . '/version.php');
define('OR_TITLE'        ,'OpenRat CMS');

define( 'CMS_ROOT_DIR', __DIR__ . '/../cms09/');

define('OR_MODULES_DIR'       , __DIR__ . '/modules/');
define('OR_DYNAMICCLASSES_DIR',OR_MODULES_DIR.'cms-macros/macro/' );
define('OR_SERVICECLASSES_DIR',OR_MODULES_DIR.'util/' );
define('OR_AUTHCLASSES_DIR'   ,OR_MODULES_DIR.'cms-core/auth/' );
define('OR_TMP_DIR'           ,CMS_ROOT_DIR.'tmp/'            );

define('START_TIME'           ,time()              );
define('REQUEST_ID'           ,'req0' ); // Nicht mehr notwendig, kann entfallen.

// Must be relative to HTML-Path!
define('OR_HTML_MODULES_DIR'  ,'./modules/'      );
define('OR_THEMES_DIR'        ,OR_HTML_MODULES_DIR.'cms-ui/themes/');



/**
 * Wandelt jeden Fehler in eine ErrorException um.
 */
function exception_error_handler($severity, $message, $file, $line) {
	if	( !(error_reporting() & $severity) )
	{
		// Dieser Fehlercode ist nicht in error_reporting enthalten
		return;
	}
	throw new ErrorException($message, 0, $severity, $file, $line);
}

set_error_handler("exception_error_handler");


/**
 * Ermöglicht das Loggen von Fatal-Errors.
 */
function fatal_handler() {
    
    $error = error_get_last();
    
    if( !is_null($error) )
    {
        $errno   = $error["type"];
        $errfile = $error["file"];
        $errline = $error["line"];
        $errstr  = $error["message"];

        $message = 'Error '.$errno .' '. $errstr.' in '. $errfile.':'. $errline;
        if(class_exists('logger\Logger'))
        	Logger::error( $message);
        else
        {
            error_log($message);
        }

        // It is not possibile to throw an exception out of a shutdown function!
        // PHP will exit the request directly after executing this method, so a
        // Exception would never reach a caller.
        //throw new ErrorException($errstr, $errno, 1, $errfile, $errline);
    }

}

register_shutdown_function( "fatal_handler");



?>