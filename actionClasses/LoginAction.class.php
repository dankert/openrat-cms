<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// OpenRat Content Management System
// Copyright (C) 2002-2004 Jan Dankert, cms@jandankert.de
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
// ---------------------------------------------------------------------------
// $Log$
// Revision 1.1  2004-04-24 15:14:52  dankert
// Initiale Version
//
// Revision 1.2  2003/10/02 20:56:17  dankert
// Benutzer entfernen
//
// Revision 1.1  2003/09/29 18:18:21  dankert
// erste Version
//
// ---------------------------------------------------------------------------


class LoginAction extends Action
{
	var $defaultSubAction = 'login';

	function LoginAction()
	{
	}


	function blank()
	{
		$this->forward('blank');
	}


	function login()
	{
		global $conf;


		$databases = explode(',',$conf['database']['databases']);
		$dbids = array();
		
		foreach( $databases as $db )
		{
			if   ( !isset($conf['database_'.$db]) )
				$this->message( '',"configuration for 'database_$db' not defined in config.ini.php");
		
			$dbids[$db] = $conf['database_'.$db]['comment'];
		}

		$this->setTemplateVar( 'dbids',$dbids );
		
		if	( $this->getSessionVar('dbid') != '' )
			$this->setTemplateVar('actdbid',$this->getSessionVar('dbid'));
			$this->setTemplateVar('actdbid',$conf['database']['default']);

		$this->setTemplateVar('loginmessage',$this->getSessionVar('loginmessage'));
		$this->setSessionVar('loginmessage','');

		$this->forward('login');
	}
}