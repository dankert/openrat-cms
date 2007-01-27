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
	
		$languages = array();
		$http_languages = $HTTP_SERVER_VARS['HTTP_ACCEPT_LANGUAGE'];
		foreach( explode(',',$http_languages) as $l )
		{
			$parts = explode(';',$l);
			$languages[] = trim($parts[0]);
			// aus "xx_yy" das "xx" extrahieren.
			$languages[] = current(explode('_',trim($parts[0])));
			$languages[] = current(explode('-',trim($parts[0])));
			
		}
		
		return array_unique( $languages );
	}
}

?>