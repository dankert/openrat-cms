<?php

class GlobalFunctions
{
	function getIsoCodes()
	{
		global $conf_php;
		
		$iso = parse_ini_file( './language/lang.ini.'.$conf_php );
		asort( $iso );
		return $iso;
	}


	function lang( $text )
	{
	     global $SESS;
		$text = strtoupper($text);
	
	     if   ( isset( $SESS['lang'][$text] ) )
	     {
	          return $SESS['lang'][$text];
	     }
	     else
	     {
	          return( '?'.$text.'?' );
	     }
	}


	# Spracheinstellungen laden
	
	function language_from_http()
	{
		global $SESS,
		       $HTTP_SERVER_VARS,
		       $conf_php,
		       $conf;
	
		$languages = $HTTP_SERVER_VARS['HTTP_ACCEPT_LANGUAGE'];
		$languages = explode(',',$languages);
		foreach( $languages as $l )
		{
			$l = substr($l,0,2);
			if   ( file_exists("./language/$l.ini.$conf_php") )
				return( $l );
		}
	
		// Keine passende Sprache im HTTP-Header gefunden 			
		return $conf['global']['default_language'];
	}
	
	
	function language_read( $l='' )
	{
		global $SESS,
		       $HTTP_SERVER_VARS,
		       $conf_php;
	     
		$l = language_from_http();
		$SESS['lang'] = parse_ini_file( "./language/$l.ini.$conf_php" );
	}
}

?>