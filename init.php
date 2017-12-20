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



define('PHP_EXT'         ,'php'    );
require_once( "functions/common.inc.".PHP_EXT );

define('IMG_EXT'         ,'.gif'   );
define('IMG_ICON_EXT'    ,'.png'   );
define('MAX_FOLDER_DEPTH',5        );

define('OR_VERSION'      ,'1.1-snapshot'  );
define('OR_TITLE'        ,'OpenRat CMS');

define('OR_TYPE_FOLDER','folder');
define('OR_TYPE_PAGE'  ,'page'  );
define('OR_TYPE_FILE'  ,'file'  );
define('OR_TYPE_IMAGE' ,'image'  );
define('OR_TYPE_TEXT'  ,'text'  );
define('OR_TYPE_LINK'  ,'link'  );
define('OR_TYPE_URL'   ,'url'   );


define('OR_MODULES_DIR'       ,'./modules/');
define('OR_ACTIONCLASSES_DIR' ,OR_MODULES_DIR.'cms-core/action/'  );
define('OR_FORMCLASSES_DIR'   ,'./formClasses/'    );
define('OR_OBJECTCLASSES_DIR' ,OR_MODULES_DIR.'cms-core/model/'  );
define('OR_LANGUAGE_DIR'      ,'./language/'       );
define('OR_DBCLASSES_DIR'     ,'./db/'             );
define('OR_DYNAMICCLASSES_DIR',OR_MODULES_DIR.'cms-macros/macro/' );
define('OR_TEXTCLASSES_DIR'   ,OR_MODULES_DIR.'wikiparser/'    );
define('OR_PREFERENCES_DIR'   ,'./config/');
define('OR_CONFIG_DIR'        ,OR_PREFERENCES_DIR  );
define('OR_THEMES_DIR'        ,'./themes/'         );
define('OR_TMP_DIR'           ,'./tmp/'            );
define('OR_CONTROLLER_FILE'   ,'dispatcher');
define('START_TIME'           ,time()              );
define('REQUEST_ID'           ,'req'.time().rand() );

define('SECURITY_GUEST',1); // Jeder (auch nicht angemeldete) dürfen diese Aktion ausführen
define('SECURITY_USER' ,2); // Angemeldete Benutzer dürfen diese Aktion ausführen
define('SECURITY_ADMIN',3); // Nur Administratoren dürfen diese Aktion ausführen

define('REQ_PARAM_TOKEN'          ,'token'          );
define('REQ_PARAM_ACTION'         ,'action'         );
define('REQ_PARAM_SUBACTION'      ,'subaction'      );
define('REQ_PARAM_TARGETSUBACTION','targetSubAction');
define('REQ_PARAM_ID'             ,'id'             );
define('REQ_PARAM_OBJECT_ID'      ,'objectid'       );
define('REQ_PARAM_LANGUAGE_ID'    ,'languageid'     );
define('REQ_PARAM_MODEL_ID'       ,'modelid'        );
define('REQ_PARAM_PROJECT_ID'     ,'projectid'      );
define('REQ_PARAM_ELEMENT_ID'     ,'elementid'      );
define('REQ_PARAM_TEMPLATE_ID'    ,'templateid'     );
define('REQ_PARAM_DATABASE_ID'    ,'dbid'           );
define('REQ_PARAM_TARGET'         ,'target'         );

define('OR_SERVICECLASSES_DIR','./util/' );
define('OR_AUTHCLASSES_DIR'   ,OR_MODULES_DIR.'cms-core/auth/' );


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



function fatal_handler() {
    
    $errfile = "unknown file";
    $errstr  = "shutdown";
    $errno   = E_CORE_ERROR;
    $errline = 0;
    
    $error = error_get_last();
    
    if( $error !== NULL) {
        $errno   = $error["type"];
        $errfile = $error["file"];
        $errline = $error["line"];
        $errstr  = $error["message"];

        $message = $errno .' '. $errstr.' '. $errfile.' '. $errline;
        if(class_exists('Logger'))
        	Logger::error( $message);
        else
        {
            error_log($message);
            var_dump($error);
        }
    }
}

register_shutdown_function( "fatal_handler" );


require_once( "functions/request.inc.php" );

// Werkzeugklassen einbinden.
require_once( OR_MODULES_DIR."util/require.".PHP_EXT );
require_once( OR_AUTHCLASSES_DIR."include.inc.".PHP_EXT );

require_once( OR_MODULES_DIR."security/require.".PHP_EXT );
require_once( OR_MODULES_DIR."template-engine/require.".PHP_EXT );
require_once( OR_MODULES_DIR."configuration/require.".PHP_EXT );


?>