<?php
// ---------------------------------------------------------------------------
// $Id$
// ---------------------------------------------------------------------------
// OpenRat Content Management System
// Copyright (C) 2002 Jan Dankert, jandankert@jandankert.de
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
// Revision 1.2  2004-05-02 14:49:37  dankert
// Einfügen package-name (@package)
//
// Revision 1.1  2004/04/24 15:14:52  dankert
// Initiale Version
//
// ---------------------------------------------------------------------------


/**
 * Actionklasse zum Anzeigen der Titelleiste
 * @author $Author$
 * @version $Revision$
 * @package openrat.actions
 */
class TitleAction extends Action
{
	/**
	 * Standard-Subaction
	 * @type String
	 */
	var $defaultSubAction = 'show';


	/**
	 * Fuellen der Variablen und Anzeigen der Titelleiste
	 */
	function show()
	{
		global $SESS,$conf;

		$this->setTemplateVar('css_body_class','title');

		if  ( $this->getSessionVar('dbid') != '' )
		{
			$this->setTemplateVar('dbid'  ,$this->getSessionVar('dbid')                               ); 
			$this->setTemplateVar('dbname',$conf['database_'.$this->getSessionVar('dbid')]['comment'] );
		}
		
		if  ( isset($SESS['user']) )
		{
			$this->setTemplateVar('username'    ,$SESS['user']['name']    );
			$this->setTemplateVar('userfullname',$SESS['user']['fullname']);
		}
		
		// Urls zum Benutzerprofil und zum Abmelden
		$this->setTemplateVar('profile_url',Html::url( array('action'   =>'user',
		                                                     'subaction'=>'profile' ) ));
		$this->setTemplateVar('logout_url' ,Html::url( array('action'   =>'index',
		                                                     'subaction'=>'logout'  ) ));
		
		$this->forward( 'title' );
	}
}

?>