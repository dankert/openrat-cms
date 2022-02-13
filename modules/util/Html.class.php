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
use cms\base\Configuration;

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
	 * creates a relative url to an action.
	 *
	 * @param string Aktion, die aufgerufen werden soll
	 * @param string Unteraktion, die innerhalb der Aktion aufgerufen werden soll
	 * @param int Id fuer diesen Aufruf
	 * @param array Weitere beliebige Parameter
	 * @deprecated UI logic, should not be used on the server.
	 */
	public static function url($action, $subaction = '', $id = '', $params = array())
	{
		if (intval($id) == 0)
			$id = '';

		$conf = Configuration::Conf();

		// Session-Id ergaenzen
		if ($conf->subset('interface')->subset('url')->is('add_sessionid',false))
			$params[session_name()] = session_id();

		if ($conf->subset('security')->is('use_post_token'.true))
			$params['token'] = Session::token();

		if (isset($params['objectid']) && !isset($params['id']))
			$params['id'] = $params['objectid'];

		$params[RequestParams::PARAM_ACTION   ] = $action;

		if	( $subaction )
			$params[RequestParams::PARAM_SUBACTION] = $subaction;

		if	( $id )
			$params[RequestParams::PARAM_ID] = $id;

		$urlParameterList = array_map( function($name,$value) {
			return urlencode($name) . '=' . urlencode($value);
		},array_keys($params),$params);

		// We do not escape '&' as '&amp;' here, as it would brake things like Ajax-Urls.
		// Maybe the escaping should be controlled by a parameter.
		return './?'.implode('&', $urlParameterList);
	}


	/**
	 * creates a relative url to the UI.
	 *
	 * @param string $action Aktion, die aufgerufen werden soll
	 * @param $id string Unteraktion, die innerhalb der Aktion aufgerufen werden soll
	 */
	public static function locationUrl($action, $id = '')
	{
		if (intval($id) == 0)
			$id = '';

		return './#/'.$action.'/'.$id;
	}
}
