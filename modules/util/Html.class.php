<?php
// OpenRat Content Management System
// Copyright (C) 2002-2012 Jan Dankert, cms@jandankert.de
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.


namespace util;
use cms\action\RequestParams;

/**
 * Bereitstellen von Methoden fuer die Darstellung von HTML-Elementen
 *
 * @author $Author$
 * @version $Revision$
 * @package openrat.services
 */
class Html
{


	/**
	 * Erzeugt eine relative Url innerhalb von Openrat
	 *
	 * @param string Aktion, die aufgerufen werden soll
	 * @param string Unteraktion, die innerhalb der Aktion aufgerufen werden soll
	 * @param int Id fuer diesen Aufruf
	 * @param array Weitere beliebige Parameter
	 * @deprecated Das ist Dialog-Logik. Besser im Frontend erzeugen.
	 */
	public static function url($action, $subaction = '', $id = '', $params = array())
	{
		if (intval($id) == 0)
			$id = '-';

		$conf = \cms\base\Configuration::rawConfig();

		if (is_array($action)) {
			$params = $action;

			if (isset($params['callAction'])) {
				$params['subaction'] = $params['callAction'];
				unset($params['callAction']);
				unset($params['callSubaction']);
			}


			if (!isset($params['action'])) $params['action'] = '';
			if (!isset($params['subaction'])) $params['subaction'] = '';
			if (!isset($params['id'])) $params['id'] = '';
			$action = $params['action'];
			$subaction = $params['subaction'];
			$id = $params['id'];
			unset($params['action']);
			unset($params['subaction']);
			unset($params['id']);
			$params['old'] = 'true';
		}

		// Session-Id ergaenzen
		if ($conf['interface']['url']['add_sessionid'])
			$params[session_name()] = session_id();

		if (\cms\base\Configuration::config('security', 'use_post_token'))
			$params['token'] = Session::token();

		$fake_urls = $conf['interface']['url']['fake_url'];
		$url_format = $conf['interface']['url']['url_format'];

		if (isset($params['objectid']) && !isset($params['id']))
			$params['id'] = $params['objectid'];

		if ($fake_urls) {
//			if	( $id != '' )
//				$id = '.'.$id;
		} else {
			$params[RequestParams::PARAM_ACTION] = $action;
			$params[RequestParams::PARAM_SUBACTION] = $subaction;
			$params[RequestParams::PARAM_ID] = $id;
		}

		if (count($params) > 0) {
			$urlParameterList = array();
			foreach ($params as $var => $value) {
				$urlParameterList[] = urlencode($var) . '=' . urlencode($value);
			}

			$urlParameterList['_'] = @$urlParameterList[RequestParams::PARAM_ACTION] . '-' . @$urlParameterList[RequestParams::PARAM_ID];
			unset($urlParameterList[RequestParams::PARAM_ACTION], $urlParameterList[RequestParams::PARAM_ID]);

			// We do not escape '&' as '&amp;' here, as it would brake things like Ajax-Urls.
			// Maybe the escaping should be controled by a parameter.
			$urlParameter = '?' . implode('&', $urlParameterList);
		} else {
			$urlParameter = '';
		}

		if (@$conf['interface']['url']['index'])
			$controller_file_name = '';
		else
			$controller_file_name = '';

		$prefix = './';

		if ($fake_urls)
			$src = sprintf($url_format, $action, $subaction, $id, session_id()) . $urlParameter;
		else
			$src = $prefix . $controller_file_name . $urlParameter;

		return $src;
	}
}

?>