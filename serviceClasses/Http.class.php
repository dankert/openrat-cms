<?php

/**
 * Bereitstellen von HTTP-Methoden
 *
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class Http
{
	/**
	 * Aus dem HTTP-Header werden die vom Browser angeforderten Sprachen
	 * gelesen.
	 *
	 * @return Array
	 */
	function getLanguages()
	{
		global $SESS,
		       $HTTP_SERVER_VARS,
		       $conf_php,
		       $conf;
	
		$languages = $HTTP_SERVER_VARS['HTTP_ACCEPT_LANGUAGE'];
		$languages = explode(',',$languages);
		
		return $languages;
	}
}

?>