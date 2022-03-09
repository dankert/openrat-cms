<?php

namespace cms\action;


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
use cms\base\Configuration;
use cms\base\Startup;
use cms\model\BaseObject;
use cms\model\User;
use language\Language;
use language\Messages;
use logger\Logger;
use security\Base2n;
use util\exception\SecurityException;
use util\exception\ValidationException;
use util\mail\Mail;
use util\Session;
use util\UIUtils;


/**
 * profile data of current user.
 */
class ProfileAction extends BaseAction
{
	/**
	 * Current user.
	 *
	 * Current user or null, if no user is present.
	 *
	 * @var User|null
	 */
	protected $user;

	/**
	 * Konstruktor.
	 * Setzen der Benutzer-Objektes.
	 */
	function __construct()
	{
        parent::__construct();

        $this->user = Session::getUser();
	}


    /**
     * Setting new language for current session.
     *
     * @param $languageISOcode string ISO coded language
     */
    protected function setLanguage($languageISOcode )
    {
		// Overwrite configuration
        $conf = Session::getConfig();
        $language = new Language();
        $conf['language'] = $language->getLanguage($languageISOcode);
        $conf['language']['language_code'] = $languageISOcode;
		Session::setConfig($conf);
    }


	/**
	 * Theme name.
	 *
	 * Gets the theme name of the current user, or the
	 * default style if no user is present.
	 *
	 * @param User $user
	 * @return string
	 */
	protected function getUserStyle($user )
	{
		// Gets theme for current user.
		if  ( $user && Configuration::subset('style')->has($user->style))
			$style = $user->style;
		else
			// Fallback: Default theme.
			$style = Configuration::subset(['interface','style'])->get('default','');

		return $style;
	}


	/**
	 * Default permission: An authenticated user is necessary.
	 *
	 * @return void
	 */
	public function checkAccess() {
		if   ( !$this->user )
			throw new SecurityException();
	}

}