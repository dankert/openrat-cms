<?php

require_once( OR_SERVICECLASSES_DIR."GlobalFunctions.class.".PHP_EXT );
require_once( OR_SERVICECLASSES_DIR."Http.class.".PHP_EXT );
require_once( OR_SERVICECLASSES_DIR."Html.class.".PHP_EXT );
require_once( OR_SERVICECLASSES_DIR."Text.class.".PHP_EXT );
require_once( OR_SERVICECLASSES_DIR."Mail.class.".PHP_EXT );
require_once( OR_SERVICECLASSES_DIR."Ldap.class.".PHP_EXT );
require_once( OR_SERVICECLASSES_DIR."TemplateEngine.class.".PHP_EXT );
require_once( OR_SERVICECLASSES_DIR."Preferences.class.".PHP_EXT );
require_once( OR_SERVICECLASSES_DIR."FileUtils.class.".PHP_EXT );
require_once( OR_SERVICECLASSES_DIR."JSON.class.".PHP_EXT );
require_once( OR_SERVICECLASSES_DIR."Password.class.".PHP_EXT );
require_once( OR_SERVICECLASSES_DIR."OpenRatException.class.".PHP_EXT );


//if	( !empty($REQ[REQ_PARAM_ACTION]) && in_array($REQ[REQ_PARAM_ACTION],array('tree')) )
{
	require_once( OR_SERVICECLASSES_DIR."TreeElement.class.".PHP_EXT );
	require_once( OR_SERVICECLASSES_DIR."AbstractTree.class.".PHP_EXT );
	require_once( OR_SERVICECLASSES_DIR."AdministrationTree.class.".PHP_EXT );
	require_once( OR_SERVICECLASSES_DIR."ProjectTree.class.".PHP_EXT );
}

// Veroeffentlichung
//if	( !empty($REQ[REQ_PARAM_ACTION]) && in_array($REQ[REQ_PARAM_ACTION],array('file','page','pageelement','folder')) )
{
	require_once( OR_SERVICECLASSES_DIR."Publish.class.".PHP_EXT );
	require_once( OR_SERVICECLASSES_DIR."Ftp.class.".PHP_EXT );
}

// Nur bei der Erzeugung von Seiten notwendig.
//if	( !empty($REQ[REQ_PARAM_ACTION]) && in_array($REQ[REQ_PARAM_ACTION],array('pageelement','page','folder','element')) )
{
	require_once( OR_SERVICECLASSES_DIR."Macro.class.".PHP_EXT        );
	require_once( OR_SERVICECLASSES_DIR."Dynamic.class.".PHP_EXT        );
}

// Nur bei der Erzeugung von Seiten notwendig.
//if	( !empty($REQ[REQ_PARAM_ACTION]) && in_array($REQ[REQ_PARAM_ACTION],array('pageelement','page','folder')) )
{
	require_once( OR_SERVICECLASSES_DIR."Api.class.".PHP_EXT );
	require_once( OR_SERVICECLASSES_DIR."Code.class.".PHP_EXT           );
	require_once( OR_SERVICECLASSES_DIR."Transformer.class.".PHP_EXT    );
	require_once( OR_SERVICECLASSES_DIR."Line.class.".PHP_EXT           );
}


//if	( !empty($REQ[REQ_PARAM_ACTION]) && in_array($REQ[REQ_PARAM_ACTION],array('file','folder','filebrowser')) )
{
	require_once( OR_SERVICECLASSES_DIR."Upload.class.".PHP_EXT );
}


//if	( !empty($REQ[REQ_PARAM_ACTION]) && in_array($REQ[REQ_PARAM_ACTION],array('file','folder')) )
{
	require_once( OR_SERVICECLASSES_DIR."Upload.class.".PHP_EXT );
	require_once( OR_SERVICECLASSES_DIR."ArchiveTar.class.".PHP_EXT     );
	require_once( OR_SERVICECLASSES_DIR."ArchiveUnzip.class.".PHP_EXT   );
	require_once( OR_SERVICECLASSES_DIR."ArchiveZip.class.".PHP_EXT     );
}

?>