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

define('OR_TYPE_PAGE'  ,'page'  );
define('OR_TYPE_FILE'  ,'file'  );
define('OR_TYPE_LINK'  ,'link'  );
define('OR_TYPE_FOLDER','folder');


define('OR_ACTIONCLASSES_DIR' ,'./action/'  );
define('OR_FORMCLASSES_DIR'   ,'./formClasses/'    );
define('OR_OBJECTCLASSES_DIR' ,'./model/'  );
define('OR_LANGUAGE_DIR'      ,'./language/'       );
define('OR_DBCLASSES_DIR'     ,'./db/'             );
define('OR_DYNAMICCLASSES_DIR','./dynamicClasses/' );
define('OR_TEXTCLASSES_DIR'   ,'./textClasses/'    );
define('OR_PREFERENCES_DIR'   ,defined('OR_EXT_CONFIG_DIR')?OR_EXT_CONFIG_DIR:'./config/');
define('OR_CONFIG_DIR'        ,OR_PREFERENCES_DIR  );
define('OR_THEMES_DIR'        ,'./themes/'         );
define('OR_THEMES_EXT_DIR'    ,defined('OR_BASE_URL')?slashify(OR_BASE_URL).'themes/':OR_THEMES_DIR);
define('OR_TMP_DIR'           ,'./tmp/'            );
define('OR_CONTROLLER_FILE'   ,defined('OR_EXT_CONTROLLER_FILE')?OR_EXT_CONTROLLER_FILE:'dispatcher');
define('START_TIME'           ,time()              );


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

require_once( "functions/request.inc.php" );

// Werkzeugklassen einbinden.
require_once( OR_SERVICECLASSES_DIR."include.inc.".PHP_EXT );

// TODO: Muss aus Datenbank kommen!
$charset = 'US-ASCII';

?>