<?php

namespace util;
/**
 * Bereitstellen von globalen Funktionen
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class GlobalFunctions
{
	public static function getIsoCodes()
	{
		global $conf_php;

		$iso = parse_ini_file('./language/lang.ini.' . $conf_php);
		asort($iso);
		return $iso;
	}


	public static function \cms\base\Language::lang($text)
	{
		global $SESS;
		$text = strtoupper($text);

		if (isset($SESS['lang'][$text])) {
			return $SESS['lang'][$text];
		} else {
			return ('?' . $text . '?');
		}
	}


}

?>